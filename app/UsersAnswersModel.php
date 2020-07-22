<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersAnswersModel extends Model
{
    /**
     * The table associated with the model.
     *
     * On doit préciser à Eloquent que la table de ce Model est platform
     * Sinon, par défaut, il prend le nom du modèle, le met en minuscules et lui ajoute un S
     *
     * @var string
     */
    protected $table = 'users_answers';

    public function Quizzes()
    {
        return $this->belongsTo('App\QuizzesModel', 'quizzes_id');
    }

    public function Users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
