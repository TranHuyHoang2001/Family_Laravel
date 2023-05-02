<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function show($id)
    {
        $members  = User::orderBy('point', 'desc')->limit(4)->get();
        $Experience = Experience::all()->find($id);

        // dd($Experience);
        return view('frontend.detail-experience',compact('Experience','members'));
    }
}
