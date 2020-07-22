<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuizzesModel;

class MainController extends Controller
{
    public function home(Request $request){
        $quizData = QuizzesModel::all();
        return view('accueil',['quizData' => $quizData]);
    }
}
