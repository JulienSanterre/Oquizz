<?php
use App\Utils\UserSession;
use App\QuestionsModel;
$pageTitle = 'Profile';
    include(__DIR__.'/layout/header.php');
    include(__DIR__.'/layout/nav.php');
    if($isUserConnected){
        // return view('user',['user' => $user, 'dataUser' => $dataUser, 'quizData' => $quizData]);
?>

<main class="container">

<div class="row d-flex justify-content-around">
    <div class=" col-9 col-3 card quiz-border-card">
        <div class="card-header present">
            <h3><?= "Bienvenu " . $user["firstname"]. " " .$user["lastname"] ?></h3>
        </div>
        <div class="card-body title-body-card">
            <p><?= "Email : " . $user["email"]?></p>
        </div>
    </div>
</div>

<?php foreach($dataUser as $data){ ?>
<?php $quizSelect = $quizData->where("id", $data["quizzes_id"])->first()->title;
$nbr = QuestionsModel::where('quizzes_id', '=', $data["quizzes_id"])->get()->count();
?>
<div class="row d-flex justify-content-around">
    <div class=" col-9 col-3 card quiz-border-card">
        <div class="card-header present">
            <h3><?= "Quiz : " . $quizSelect?></h3>
        </div>
        <div class="card-body title-body-card">
            <p><?= "Score : " . $data["score"] . " / ".$nbr?></p>
        </div>
    </div>
</div>
<?php } ?>


</main>

<?php }else{
    include(__DIR__.'/layout/error.php');
} ?>
