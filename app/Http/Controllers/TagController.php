<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuizzesModel;
use App\QuestionsModel;
use App\AnswersModel;
use App\QuizzesHasTagsModel;
use App\TagsModel;

class TagController extends Controller
{
    public function tags(){
        $quizTags = TagsModel::all();
        return view('quiz-consulter', ['quizTags' => $quizTags, 'sorted' => False]);
    }

    public function quiz($id){
        $quizTags = TagsModel::find($id);
        return view('quiz-consulter', ['quizTags' => $quizTags, 'sorted' => True]);
    }
}
