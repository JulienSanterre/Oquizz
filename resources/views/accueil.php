<?php
use App\Utils\UserSession;
$pageTitle = 'Acceuil';
    include(__DIR__.'/layout/header.php');
    include(__DIR__.'/layout/nav.php');
?>
<div id="align-content-page"></div>
<main class="container">

    <div class="row d-d-flex justify-content-around first">
        <h2> Bienvenue sur O'Quiz </h2>
        <p>

            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et
            dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet
            clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet,
            consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
            sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no
            sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing
            elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
            vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est
            Lorem ipsum dolor sit amet.

        </p>
    </div>

    <div class="row d-flex justify-content-around">
        <?php foreach($quizData as $index => $quiz){
            if($quiz->status === 1){ ?>
                <div class=" col-3 card quiz-border-card">
                    <div class="card-header present">
                        <h3><?= $quiz->title ?></h3>
                    </div>
                    <div class="card-body">
                        <h4 class="card-text">Sujet :</h4>
                        <p class="card-text"><?= $quiz->description ?></p>
                        <p class="card-title"><?= "Auteur : ".$quiz->AppUsers->firstname." ".$quiz->AppUsers->lastname ?></p>
                        <?php if($isUserConnected){ ?>
                            <a href="<?= route('quiz_quiz', ['id' => $quiz->id]) ?>" class="btn btn-primary">Go !!!</a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</main>
<?php include(__DIR__.'/layout/footer.php'); ?>
