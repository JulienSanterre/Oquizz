<?php
$pageTitle = 'Connexion';
    include(__DIR__.'/layout/header.php');
    include(__DIR__.'/layout/nav.php');
?>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
        <i class="fa fa-male" aria-hidden="true"></i>
    </div>

    <div class="<?php
        if(!isset($errors)){
            echo "error_login";
        }else{
            echo "error_login_php";
        }
    ?>">
        <?php if(isset ($errors)){
            foreach ($errors as $error){
                echo "</p>".$error."</p>";
            }
        }
        ?>
    </div>

    <!-- Login Form -->
    <form method="POST" action="<?= route('user_signinPost')?>">
      <input type="email" id="email_in" class="fadeIn second" name="email_in" placeholder="Votre Email" value="<?php if(isset($users['email'])){ echo $users['email']; } ?>">
      <input type="password" id="password_in" class="fadeIn third" name="password_in" placeholder="Mot de passe">
      <input type="submit" class="fadeIn fourth" value="Se connecter">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="<?= route('user_signup')?>">S'incrire ?</a>
    </div>

  </div>
</div>
<?php include(__DIR__.'/layout/footer.php'); ?>
