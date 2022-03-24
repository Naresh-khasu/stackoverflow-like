<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Comment;

class HomeController extends Controller
{
    public function home()
    {
        $top_questions = Question::latest('id')->limit(10)->get();
        $data = [
            'top_questions' => $top_questions,
        ];
        return view('index', $data);
    }
    public function questionDetail($id, $slug)
    {
        $question = Question::where(['id' => $id, 'slug' => $slug])->first();
        $data = [
            'question' => $question,
            'comments' => $question->comments
        ];
        return view('question', $data);
    }
    public function postComment(Request $request)
    {
        $comment = Comment::create(
            [
                'user_id' => auth()->id(),
                'question_id' => $request->question_id,
                'comment' => $request->comment,
            ]
        );
        return response()->json(['message'=>'submitted','comment' => $comment]);

    }
}
