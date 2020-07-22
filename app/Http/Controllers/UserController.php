<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppUsersModel;
use Illuminate\Support\Facades\DB;
use App\QuizzesModel;
use App\Utils\UserSession;
use App\User;
use App\UsersAnswersModel;
use App\QuestionsModel;

class UserController extends Controller
{
    public function signup(){
        return view('signup');
    }

    public function signupPost(Request $request){
        $user = new User();
        $email = $request->post('email');
        $pass = $request->post('password');
        $firstname = $request->post('firstname');
        $lastname= $request->post('lastname');
        $password = $request->post('password');
        $password_confirm = $request->post('password_confirm');
        $errors = [];

        // Test valid email
        if(filter_var($email, FILTER_VALIDATE_EMAIL) !== false){
            // Test email exist in DB
            if (User::where('email', $email)->count() == 0){
                $user->email = $email;
            }else{
                $errors[] = "L'email est déja enregistrée";
            }

        }else{
            $errors[] = "Email invalide";
        }
        // Test empty string
        if(empty (trim($firstname)) || empty (trim($lastname)) || empty (trim($password))){
            $errors[] = "Tous les champ doivent être remplis";
        }else{
            $user->firstname = $firstname;
            $user->lastname = $lastname;
        }

        if($password === $password_confirm){
            $user->password = password_hash($pass,PASSWORD_DEFAULT);
        }else{
            $errors[] = "Vos mots de passe ne correspondent pas";
        }

        // Test si une erreur est détectée
        if(count($errors) == 0){
            $user->save();
            $user = User::where('email', $email)->first();
            UserSession::connect($user);
            $quizData = QuizzesModel::all();
            return redirect()->route('home_home', ['quizData' => $quizData]);
            //return view('accueil',['quizData' => $quizData]);
        }else{
            return view('signup',[ 'users' => $user,'errors' => $errors]);
        }
    }

    public function signinPost(Request $request){
        $email = $request->post('email_in');
        $pass = $request->post('password_in');

        if(filter_var($email, FILTER_VALIDATE_EMAIL) !== false){
            // Test email exist in DB
            if (User::where('email', $email)->count() != 0){
                $user = User::where('email', $email)->first();
                if (password_verify($pass , $user->password)) {
                    UserSession::connect($user);
                    $quizData = QuizzesModel::all();
                    return redirect()->route('home_home',['users' => $user, 'quizData' => $quizData]);
                    // return view('accueil',['users' => $user, 'quizData' => $quizData]);
                }else{
                    $errors[] = "Mot de passe incorrect";
                }
            }else{
                $errors[] = "Aucun utilisateur pour cette email";
            }

        }else{
            $errors[] = "Email invalide";
        }
        return view('signin', ['errors' => $errors]);
    }

    public function signin(){
        return view('signin');
    }

    public function logout(Request $request){
        UserSession::disconnect();
        $quizData = QuizzesModel::all();
        return redirect()->route('home_home',['quizData' => $quizData]);
        //return view('accueil',['quizData' => $quizData]);
    }

    public function profile(){
        $user = UserSession::getUser();
        $registred_data = new UsersAnswersModel();
        $quiz = new QuizzesModel();
        $quizData = QuizzesModel::all();
        $dataUser = $registred_data->where('user_id', $user["id"])->get();
        return view('user',['user' => $user, 'dataUser' => $dataUser, 'quizData' => $quizData]);
    }

    public function mail_verif(){
        $email = $_POST['email'];
        if(isset ($email)){
            if(User::where('email', $email)->count() != 0){
                $response['success'] = true;
                return $this->showJson($response);
            }else{
                $response['success'] = false;
                return $this->showJson($response);
            }
        }
    }

    public function showJson($data)
    {
        // Autorise l'accès à la ressource depuis n'importe quel autre domaine
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        // Dit au navigateur que la réponse est au format JSON
        header('Content-Type: application/json');
        // La réponse en JSON est affichée
        echo json_encode($data);
    }

    public function storeQuizData($user,$quizId,$score){
        $registred_data = new UsersAnswersModel();
        $registred_data->user_id = $user["id"];
        $registred_data->quizzes_id = $quizId;
        $registred_data->score = $score;

        $registred_data->save();
    }
}
