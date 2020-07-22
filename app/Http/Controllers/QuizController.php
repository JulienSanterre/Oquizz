<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuizzesModel;
use App\QuestionsModel;
use App\AnswersModel;
use App\QuizzesHasTagsModel;
use App\TagsModel;
use App\Utils\UserSession;

class QuizController extends Controller
{
    public function quiz($request){
        $quizData = QuizzesModel::find($request);
        //$quizData = QuizzesModel::where('id', '=', $request)->get();
        $questionData = QuestionsModel::where('quizzes_id', '=', $request)->get();
        $responseData = AnswersModel::where('questions_id', '=', $request)->get();
        return view('quiz-jeu', ['quizData' => $quizData, 'questionData' => $questionData, 'responseData' => $responseData ]);
    }

    public function getAnswers($question_id){
        $responseData = AnswersModel::where('questions_id', '=', $question_id)->get();
        return $responseData;
    }

    public function quizPost(Request $request){
        $quizId = $request->get("quizData");
        $quizData = QuizzesModel::find($quizId);
        $responseData = AnswersModel::where('questions_id', '=', $quizId)->get();
        $quizAnswers = $answers = $userAnswer = array();
        $score = 0;
        $questionData = QuestionsModel::where('quizzes_id', '=', $quizId)->get();
        // recupere nos valeurs du formulaire
        foreach ($request->post() as $answer){
            $quizAnswers[] = $answer;
        }
        // recupere toutes les bonnes réponses
        foreach ($questionData as $question){
            $answers[] = $question["answers_id"];
        }

        // compare les reponses avec les bonnes
        foreach ($quizAnswers as $index => $quizAnswer) {
            if ($quizAnswer == $answers[$index]) {
                $userAnswer[] = true;
                $score ++;
            }
            $userAnswer[] = false;
        }

        // recupération de l utilisateur
        $user = UserSession::getUser();
        // insertion en bdd
        $store_quiz_item = new UserController;
        $store_quiz_item->storeQuizData($user,$quizId,$score);

        return view('quiz-jeu', ['quizData' => $quizData, 'questionData' => $questionData, 'responseData' => $responseData,'score' => $score, "quizAnswers" => $quizAnswers]);
    }

}
