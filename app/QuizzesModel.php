<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizzesModel extends Model
{
    /**
     * The table associated with the model.
     *
     * On doit préciser à Eloquent que la table de ce Model est platform
     * Sinon, par défaut, il prend le nom du modèle, le met en minuscules et lui ajoute un S
     *
     * @var string
     */
    protected $table = 'quizzes';

    public function AppUsers()
    {
        return $this->belongsTo('App\AppUsersModel');
    }

    public function Questions()
    {
        return $this->belongsTo('App\QuestionsModel');
    }

    public function Tags()
    {
        return $this->belongsToMany('App\TagsModel', 'quizzes_has_tags', 'quizzes_id', 'tags_id');
    }
}
