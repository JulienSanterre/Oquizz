<?php
$pageTitle = 'Inscription';
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

    <!-- Register Form -->
    <form method="POST" action="<?= route('user_signupPost')?>">
        <div class="col-12">
        <label for ="firstname" class="col-4 text-left">Nom :</label>
        <input type="text" id="firstname" class="col-7 fadeIn second" name="firstname" placeholder="Nom de famille" value="<?php if(isset($users['firstname'])){ echo $users['firstname']; } ?>">
        </div>
        <div class="col-12">
        <label for ="lastname" class="col-4 text-left">Prénom :</label>
        <input type="text" id="lastname" class="col-7 fadeIn third" name="lastname" placeholder="Prénom"  value="<?php if(isset($users['lastname'])){ echo $users['lastname']; } ?>">
        </div>
        <div class="col-12">
        <label for ="email" class="col-4 text-left">Email :</label>
        <input type="email" id="email" class="col-7 fadeIn third" name="email" placeholder="Email" value="<?php if(isset($users['email'])){ echo $users['email']; }?>">
        </div>
        <div class="col-12">
        <label for ="password" class="col-4 text-left">Mot de passe :</label>
        <input type="password" id="password" class="col-7 fadeIn third" name="password" placeholder="Mot de passe">
        </div>
        <div class="col-12">
        <label for ="password_confirm" class="col-4 text-left">Confirmation :</label>
        <input type="password" id="password_confirm" class="col-7 fadeIn third" name="password_confirm" placeholder="Mot de passe">
        </div>
        <div class="col-12 d-flex justify-content-end button-form-submit">
        <input type="submit" name="submit" id="submit-form-register" class="col-7 fadeIn fourth" value="S'incrire">
        </div>
    </form>

  </div>
</div>
<?php include(__DIR__.'/layout/footer.php'); ?>
