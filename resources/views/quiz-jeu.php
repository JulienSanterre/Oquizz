<?php
use App\Http\Controllers\QuizController;
use App\Utils\UserSession;
$pageTitle = $quizData->title;
$radioIndex = 0;
    include(__DIR__.'/layout/header.php');
    include(__DIR__.'/layout/nav.php');
    if($isUserConnected){
?>
<main class="container">

    <div class="row d-flex justify-content-around">
        <div class=" col-9 col-3 card quiz-border-card">
            <div class="card-header present">
                <h3><?= $quizData->title ?></h3>
                <h3>
                    <?php
                    foreach($quizData->Tags as $tag){ echo $tag->name . ' '; }
                    ?>
                </h3>
            </div>
            <div class="card-body title-body-card">
                <h4 class="card-text">Sujet :</h4>
                <p class="card-text"><?= $quizData->description ?></p>
                <p class="card-title"><?= "Auteur : ".$quizData->AppUsers->firstname." ".$quizData->AppUsers->lastname ?></p>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-around">
        <form action="<?= route('quiz_quizPost',['quizData' => $quizData])?>" method="POST">
            <?php foreach($questionData as $index => $question){ ?>
                <div class="quiz-border-card col-12 card">
                    <div class="card-header present">
                        <h3><?= $question->question ?></h3>
                    </div>
                    <?php if(isset($score)){ ?>
                        <div class="card-body text-center quiz-border-bot" id="background_wiki">
                            <p class="card-text"><?= $question->anecdote ?></p>
                            <a class="card-title" href="https://fr.wikipedia.org/wiki/<?= $question->wiki ?>" target="_blank">Liens wiki : <?php echo str_replace("_", " ", $question->wiki);?></a>
                        </div>
                    <?php } ?>
                    <?php
                        $quizController = new QuizController();
                        $answers = $quizController->getAnswers($question->id);
                        if(!isset($score)){
                            $answers =  $answers->shuffle();
                        }
                    ?>
                    <?php foreach($answers as $index2 => $answer){ ?>
                        <div class="card-header
                        <?php
                        if(isset($score) && $question["answers_id"] == $answer->id)
                        {
                            echo "good-answer ";
                        }
                        if(isset($score) && $quizAnswers[$index] == $answer->id)
                        {
                            echo "user-answer ";
                        }

                        ?>">
                            <input type="radio" name="Radios<?= $index ?>" id="Radios" value="<?= $answer->id ?>">
                            <?= $answer->description ?>
                        </div>
                    <?php } ?>
                    <div class="card-header text-center level-card">
                        <div class="button-menu">
                            Level : <?= $question->Levels->name ?>
                        </div>
                    </div>
                </div>
             <?php } ?>
             <div>
                <?php if(!isset($score)){ ?>
                    <div>
                        <input class="col-1 submit-btn" type="submit" value="Valider le Quiz" />
                    </div>
                 <?php } ?>
                <?php if(isset($score)){ ?>
                    <div class="row d-flex justify-content-around score-box">
                        <div class="quiz-border-card card">
                            <div class="card-header present">
                                <h3 class="reduce-score">Score</h3>
                            </div>
                            <div class="card-body text-center">
                                <h4 class="card-text"> <?= $score ?> / <?= $questionData->count() ?> </h4>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
         </form>
    </div>

</main>
<?php }else{
    include(__DIR__.'/layout/error.php');
} ?>
<?php include(__DIR__.'/layout/footer.php'); ?>
