<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\UserAchievement;
use App\Models\Upvote;

trait SharedTrait
{

    public function updateCommentAchievement()
    {
        $comment_count = Comment::where('user_id', auth()->id())->count();
        if ($comment_count == 1) {
            UserAchievement::create([
                'title' => 'First comment',
                'user_id' => auth()->id(),
            ]);
        }
        if ($comment_count == 5) {
            UserAchievement::create([
                'title' => 'Fifth comment',
                'user_id' => auth()->id(),
            ]);
        }
        if ($comment_count == 10) {
            UserAchievement::create([
                'title' => 'Tenth comment',
                'user_id' => auth()->id(),
            ]);
        }
    }
    public function updateUpvoteAchievement($comment)
    {
        $upvote_count = Upvote::where('user_id', $comment->user_id)->where('comment_id',$comment->id)->count();
        if ($upvote_count == 1) {
            UserAchievement::create([
                'title' => 'Got First Upvote',
                'user_id' => $comment->user_id,
            ]);
        }
        if ($upvote_count == 5) {
            UserAchievement::create([
                'title' => 'Got Fifth Upvote',
                'user_id' => $comment->user_id,
            ]);
        }
        if ($upvote_count == 10) {
            UserAchievement::create([
                'title' => 'Got Tenth Upvote',
                'user_id' => $comment->user_id,
            ]);
        }
        if ($upvote_count == 20) {
            UserAchievement::create([
                'title' => 'Got Twententh Upvote',
                'user_id' => $comment->user_id,
            ]);
        }
        if ($upvote_count == 50) {
            UserAchievement::create([
                'title' => 'Got Fifty Upvote',
                'user_id' => $comment->user_id,
            ]);
        }
        if ($upvote_count == 100) {
            UserAchievement::create([
                'title' => 'Got Hundred Upvote',
                'user_id' => $comment->user_id,
            ]);
        }
    }
}
