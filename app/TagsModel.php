<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagsModel extends Model
{
    /**
     * The table associated with the model.
     *
     * On doit préciser à Eloquent que la table de ce Model est platform
     * Sinon, par défaut, il prend le nom du modèle, le met en minuscules et lui ajoute un S
     *
     * @var string
     */
    protected $table = 'tags';

    public function Quizzes()
    {
        return $this->belongsToMany('App\QuizzesModel', 'quizzes_has_tags', 'tags_id', 'quizzes_id');
    }

}
