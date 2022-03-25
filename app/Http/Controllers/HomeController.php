<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Comment;
use App\Models\Upvote;
use App\Models\CommentHistory;
use App\Traits\SharedTrait;

class HomeController extends Controller
{
    use SharedTrait;
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
        $this->createCommentHistory($comment);
        $this->updateCommentAchievement();
        return $this->getComments($request->question_id);
    }
    public function updateComment(Request $request)
    {
        $comment = Comment::find($request->comment_id);
        $comment->update(
            [
                'comment' => $request->comment,
            ]
        );
        $this->createCommentHistory($comment);
        return $this->getComments($request->question_id);
    }
    public function upvote(Request $request)
    {
        if (Upvote::where('user_id', auth()->id())->where('comment_id', $request->comment_id)->count()) {
            return $this->getComments($request->question_id);
        }
        $comment = Comment::find($request->comment_id);
        $comment->increment('up_vote');
        Upvote::create([
            'user_id' => auth()->id(),
            'comment_id' => $comment->id,
        ]);
        $this->updateUpvoteAchievement($comment);

        return $this->getComments($request->question_id);
    }
    protected function getComments($question_id)
    {
        $question = Question::where('id', $question_id)->first();
        $comments = $question->comments;
        $view = view('_partials.comment', compact('comments'))->render();
        return $view;
    }
    protected function createCommentHistory($comment){
        CommentHistory::create(
            [
                'comment_id' => $comment->id,
                'comment' => $comment->comment,
            ]);
    }
}
