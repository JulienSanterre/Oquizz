<?php

namespace App\Utils;
use App\User;

abstract class UserSession
{
    // Constante contenant l'index du tableau de session
    const SESSION_INDEX_NAME = 'connected_user';

    /**
     * Méthode permettant de connecter un utilisateur
     *
     * @param \App\User $user
     */
    public static function connect(User $user)
    {
        $_SESSION[self::SESSION_INDEX_NAME] = $user;
    }

    /**
     * Méthode permettant de déconnecter un utilisateur
     */
    public static function disconnect()
    {
        unset($_SESSION[self::SESSION_INDEX_NAME]);
    }

    /**
     * Méthode permettant de savoir si le visiteur est connecté à un compte
     * On précise la valeur de retour de la fonction avec « : bool». Elle retourne forcément un booléen
     *
     * @return bool
     */
    public static function isConnected()
    {
        // Session définie ?
        if (!isset($_SESSION[self::SESSION_INDEX_NAME])) {
            return false;
        }
        // De type User ?
        if (!$_SESSION[self::SESSION_INDEX_NAME] instanceof User) {
            return false;
        }

        // User connecté
        return true;
    }

    /**
     * Méthode permettant de récupérer le Model de l'utilisateur connecté
     *
     * @return \App\User
     */
    // Valeur de retour nullable : peut recevoir chaine de caractère ou null cela signiera qu'il n'a pas trouvé de user
    public static function getUser() : ?User
    {
        // On aurait pu se contenter de retourner la valeur de $_SESSION[self::SESSION_INDEX_NAME]
        // Cependant si y'a rien dans cette clé de $_SESSION on retourne une truc imprécis et on ne peut assurer la validité de la donnée.
        // On souhaite s'assurer que getUser retourne soit un objet User soit null

        // Session définie ?
        if (!isset($_SESSION[self::SESSION_INDEX_NAME])) {
            return null;
        }
        // De type User ?
        if (!$_SESSION[self::SESSION_INDEX_NAME] instanceof User) {
            return null;
        }
        // Retourne le User
        return $_SESSION[self::SESSION_INDEX_NAME];

        /* Autre solution

        if(!self::isConnected()) {
            return null;
        }
        return $_SESSION[self::SESSION_INDEX_NAME];
        */
    }


    /**
     * Méthode permettant de savoir si l'utilisateur connecté est admin
     * @todo Implements roles
     *
     * @return bool
     */
    public static function isAdmin() : bool
    {
        // @todo Update with real role
        return false;
    }

}
