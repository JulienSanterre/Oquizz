<?php
use App\Utils\UserSession;
$pageTitle = 'Quiz consultation'; ?>
<?php if($sorted == False){ ?>
<?php if($pageTitle == 'Quiz consultation'){ ?>
    <nav id="mainNavConsulter">
        <ul id="navConsulter">
            <li class="navTitle">
                <a href="">
                    <i></i>
                    Les Thèmes
                </a>
            </li>
            <?php foreach($quizTags as $tag){ ?>
            <li class="navbar">
                <a href="#<?= $tag->name ?>">
                    <i></i>
                    <?= $tag->name ?>
                </a>
            </li>
            <?php } ?>
        </ul>
    </nav>
    <?php } ?>
<?php } ?><?php
    include(__DIR__.'/layout/header.php');
    include(__DIR__.'/layout/nav.php');
    if($isUserConnected){
?>
    <?php if($sorted == False){ ?>
        <div id="align-content-page"></div>
        <main class="container" id="consultation">
            <?php foreach($quizTags as $tag){ ?>
                <div class="row d-flex justify-content-around" id="<?= $tag->name ?>">
                    <div class=" col-9 col-3 card quiz-border-card">
                        <div class="card-header present">
                            <h3><a href="<?= route('tag_quiz', ['id' => $tag->id]) ?>" class="btn btn-primary-special"><?= $tag->name ?></a></h3>
                        </div>
                        <?php foreach($tag->Quizzes as $quiz){ ?>
                            <div class="card-header title-card">
                                <p class="card-text"><?= $quiz->title ?></p>
                                <h4 class="card-text">Sujet :</h4>
                                <p class="card-text"><?= $quiz->description ?></p>
                                <?php if($isUserConnected){ ?>
                                    <a href="<?= route('quiz_quiz', ['id' => $quiz->id]) ?>" class="btn btn-primary">Go !!!</a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </main>
    <?php }else{ ?>
        <main class="container" id="consultation">
            <div class="row d-flex justify-content-around">
                <div class=" col-9 col-3 card quiz-border-card">
                    <div class="card-header present">
                        <h3><a href="<?= route('tag_quiz', ['id' => $quizTags->id]) ?>" class="btn btn-primary-special"><?= $quizTags->name ?></a></h3>
                    </div>
                    <?php foreach($quizTags->Quizzes as $quiz){ ?>
                        <div class="card-header title-card">
                            <p class="card-text"><?= $quiz->title ?></p>
                            <h4 class="card-text">Sujet :</h4>
                            <p class="card-text"><?= $quiz->description ?></p>
                            <?php if($isUserConnected){ ?>
                                <a href="<?= route('quiz_quiz', ['id' => $quiz->id]) ?>" class="btn btn-primary">Go !!!</a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </main>
    <?php } ?>
<?php }else{
    include(__DIR__.'/layout/error.php');
} ?>
<?php include(__DIR__.'/layout/footer.php'); ?>
