<?php use App\Utils\UserSession; ?>
    <h1 id="title">O'Quiz</h1>
<nav id="mainNav">
    <ul id="nav">
        <li class="navbar">
            <a href="<?= route('home_home') ?>">
                <i></i>
                Accueil
            </a>
        </li>

        <?php if (UserSession::isConnected()) { ?>
        <li class="navbar">
            <a href="<?= route('tag_tags') ?>">
                <i></i>
                Quiz par Thème
            </a>
        </li>
        <?php } ?>

        <?php if (UserSession::isConnected()) { ?>
        <li class="navbar">
            <a href="<?= route('user_profile') ?>">
                <i></i>
                Mon compte
            </a>
        </li>
        <?php } ?>

        <?php if (UserSession::isConnected()) { ?>
            <li class="connexion">
                <a href="<?= route('user_logout') ?>">
                    <i></i>
                    Déconnexion
                </a>
            </li>
        <?php } else { ?>
            <li class="connexion">
                <a href="<?= route('user_signin') ?>">
                    <i></i>
                    Connexion
                </a>
            </li>
        <?php } ?>

    </ul>
</nav>
<video class= "intro_video" id="myVideo" autoplay loop muted>
    <source src="<?= url('img/science-intro.mp4') ?>" type="video/mp4">
</video>



