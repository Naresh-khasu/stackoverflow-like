<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'user_id',
        'view_count'

    ];
    protected $dates = ['deleted_at'];
    public function questionHasTags()
    {
        return $this->belongsToMany(Tag::class, 'question_tags', 'question_id', 'tag_id')->withTimestamps();;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
