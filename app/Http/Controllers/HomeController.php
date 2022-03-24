<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Comment;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['postComment']]);

    }
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
        $question = Question::where('id', $request->question_id)->first();
        $comments = $question->comments;
        $view = view('_partials.comment', compact('comments'))->render();
        return $view;
    }
    public function updateComment(Request $request)
    {
        $comment = Comment::find($request->comment_id);

        $comment->update(
            [
                'comment' => $request->comment,
            ]
        );
        $question = Question::where('id', $request->question_id)->first();
        $comments = $question->comments;
        $view = view('_partials.comment', compact('comments'))->render();
        return $view;
    }
}
