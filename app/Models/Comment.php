<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','question_id','comment'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
    public function commentHistory()
    {
        return $this->hasMany(CommentHistory::class);
    }
}
