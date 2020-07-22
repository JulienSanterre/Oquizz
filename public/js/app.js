var app =
{
    init : function(){
        var test = false;
        var value = "";
        app.error_msg = new Array();
        app.error_msg["firstname"] = app.error_msg["lastname"] = app.error_msg["email"] = app.error_msg["password"] = app.error_msg["password_confirm"] = "";
        // Préséléction des inputs
        var user_log_input_firstname = document.querySelector("input#firstname");
        var user_log_input_lastname = document.querySelector("input#lastname");
        var user_log_input_email = document.querySelector("input#email");
        var user_log_input_password = document.querySelector("input#password");
        var user_log_input_password_confirm = document.querySelector("input#password_confirm");
        var user_log_input_submit = document.querySelector("input#submit-form-register");

        // Séléction d élément du menu pour slide auto
        $user_log_input_submit = $("#navConsulter > li");
        if($user_log_input_submit){
            $user_log_input_submit.click(app.go_to_anchor);
        }

        // Ecouteur d'évènement sur les inputs
        if(user_log_input_firstname){
            user_log_input_firstname.addEventListener('blur',app.error);
        }
        if(user_log_input_lastname){
            user_log_input_lastname.addEventListener('blur',app.error);
        }
        if(user_log_input_email){
            user_log_input_email.addEventListener('blur',app.error);
        }
        if(user_log_input_password){
            user_log_input_password.addEventListener('blur',app.error);
        }
        if(user_log_input_password_confirm){
            user_log_input_password_confirm.addEventListener('blur',app.error);
        }
        if(user_log_input_submit){
            user_log_input_submit.addEventListener('click',app.error);
        }
    },
    mail_db_check: function(value,evt) {
        // On lance l'appel Ajax (XHR)
        // console.log("valeur a tester" + value);
        let xhr = $.ajax(
          {
            url: 'mail_verif', // URL relative
            method: 'POST',
            dataType: 'json',
            data: "email="+value
          }
        );

        // On définit la fonction anonyme à appeler une fois la réponse reçue
        xhr.done(
          function(response,evt) {
            //console.log(response);
            var error_user_login = document.querySelector(".error_login");
            // Cette fois, on ne stocke pas le tableau dans une propriété
            // On passe par un argument/paramètre pour transmettre la donnée à la méthode addCards
            if(response["success"] == false){
                app.test = true;
                app.error_msg["emai"]= "";
            }else{
                app.test = false;
                app.error_msg["email"] = "</br> Email déja existant";
            }
            if(app.test == false){
                console.log("ok");
                evt.target.style.borderColor="red";
                error_user_login.style.display = "block";
            }else{
                evt.target.style.borderColor = "green";
                error_user_login.style.display = "none";
            }
            return app.test;
          }
        );

        xhr.fail(
          function() {
            alert('Ajax failed');
          }
        );
      },
    error : function(evt){
        app.clear_error_messages();
        var pass_test = document.querySelector("input#password").value;
        // Séléction de la balise pour affichage des erreurs
        var error_user_login = document.querySelector(".error_login");
        // Switch de chargement de test en fx de l'input
        switch(evt.target.name) {
            case "firstname":
                if(evt.target.value != ""){
                    if(/^[a-z0-9ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ_\-\s]+$/i.test(evt.target.value)){
                        app.test = true;
                        app.error_msg["firstname"] = "";
                    }else{
                        test = false;
                        app.error_msg["firstname"] = "</br> Votre nom ne pas contenir que des caractères spéciaux";
                    }
                }else{
                    app.test = false;
                    app.error_msg["firstname"] = "</br> Votre nom ne peut pas être vide";
                }
                break;
            case "lastname":
                if(evt.target.value != ""){
                    if(/^[a-z0-9ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ_\-\s]+$/i.test(evt.target.value)){
                        app.test = true;
                        app.error_msg["lastname"] = "";
                    }else{
                        app.test = false;
                        app.error_msg["lastname"] = "</br> Votre prénom ne pas contenir que des caractères spéciaux";
                    }
                }else{
                    app.test = false;
                    app.error_msg["lastname"] = "</br> Votre prénom ne peut pas être vide";
                }
                break;
            case "email":
                if(evt.target.value != ""){
                    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(evt.target.value)){;
                        app.mail_db_check(evt.target.value,evt);
                    }else{
                        app.test = false;
                        app.error_msg["email"] = "</br> Format d'email incorrect";
                    }
                }else{
                    app.test = false;
                    app.error_msg["email"] = "</br> Votre email ne peut pas être vide";
                }
                break;
            case "password":
                if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?|&])[A-Za-z\d@$!%*?&|]{8,}$/.test(evt.target.value)) {
                    app.test = true;
                    app.error_msg["password"] = "";
                }else{
                    app.error_msg["password"] = "</br> Votre mot de passe doit contenir au moin 8 caractère une majuscule et un caractère spécial";
                }
                break;
            case "password_confirm":
                if(pass_test === evt.target.value){
                    error_msg["password_confirm"] = "";
                    app.app.test = true;
                }else{
                    app.test = false;
                    app.error_msg["password_confirm"] = "</br> Les 2 mots de passe ne sont pas identique";
                }
                break;
            case "submit":
                break;
            default :
                app.test = false;
        }
        if(app.test == false){
            evt.preventDefault();
            evt.target.style.borderColor="red";
            error_user_login.style.display = "block";
        }else{
            evt.target.style.borderColor = "green";
            error_user_login.style.display = "none";

        }
        error_user_login.innerHTML += app.error_msg["firstname"];
        error_user_login.innerHTML += app.error_msg["lastname"];
        error_user_login.innerHTML += app.error_msg["email"];
        error_user_login.innerHTML += app.error_msg["password"];
        error_user_login.innerHTML += app.error_msg["password_confirm"];
    },
    clear_error_messages : function(){
        document.querySelector(".error_login").innerHTML = "";
    },
    go_to_anchor : function (evt) {
            console.log(evt.target.getAttribute('href'));
            var page = evt.target.getAttribute('href'); // Page cible
            var speed = 5000; // Durée de l'animation (en ms)
            $('html, body').animate( { scrollTop: $(page).offset().top }, speed ); // Go
            return false;
    }
}

document.addEventListener('DOMContentLoaded', app.init);
