<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAchievement;

class AcheivementController extends Controller
{
    public function getAcheivement()
    {
        $achievements = UserAchievement::where('user_id',auth()->id())->get();
        return view('achievement',compact('achievements'));
    }
}
