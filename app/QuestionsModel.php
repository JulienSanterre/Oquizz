<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionsModel extends Model
{
    /**
     * The table associated with the model.
     *
     * On doit préciser à Eloquent que la table de ce Model est platform
     * Sinon, par défaut, il prend le nom du modèle, le met en minuscules et lui ajoute un S
     *
     * @var string
     */
    protected $table = 'questions';

    public function Quizzes()
    {
        return $this->belongsTo('App\QuizzesModel', 'quizzes_id');
    }

    public function Answers()
    {
        return $this->belongsTo('App\AnswersModel', 'questions_id');
    }

    public function Levels()
    {
        return $this->belongsTo('App\LevelsModel', 'levels_id');
    }
}
