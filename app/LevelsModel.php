<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelsModel extends Model
{
    /**
     * The table associated with the model.
     *
     * On doit préciser à Eloquent que la table de ce Model est platform
     * Sinon, par défaut, il prend le nom du modèle, le met en minuscules et lui ajoute un S
     *
     * @var string
     */
    protected $table = 'levels';

    public function Levels()
    {
        return $this->hasMany('App\QuestionsModel', 'levels_id');
    }
}
