<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Family;
use App\Models\FamilyMoment;
use App\Models\Honors;
use App\Models\IntroduceFamily;
use App\Models\JobFamily;
use App\Models\MemberFamily;
use App\Models\Product;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $family = null;
        $experiences = Experience::orderBy('id', 'desc')->limit(3)->get();
        $products = Product::orderBy('id', 'desc')->limit(3)->get();
        $members  = User::orderBy('point', 'desc')->limit(4)->get();
        if (Sentinel::check() && Sentinel::getUser()->family || Sentinel::check() && Sentinel::getUser()->memberFamily)
        {
             $id = Sentinel::getUser()->family ? Sentinel::getUser()->family->id : Sentinel::getUser()->memberFamily->family_id;
             $family = Family::with('job', 'member')->find($id);

        }
        return view('frontend.home', compact('family', 'experiences', 'products', 'members'));
    }

    public function job()
    {
        $jobs = [];
        $jobs_highlight = [];
        $family = null;
        $honors = [];
        $members  = User::orderBy('point', 'desc')->limit(4)->get();
        if (Sentinel::check() &&  Sentinel::getUser()->family || Sentinel::check() &&  Sentinel::getUser()->memberFamily)
        {
            $id = Sentinel::getUser()->family ? Sentinel::getUser()->family->id : Sentinel::getUser()->memberFamily->family_id;
            $jobs = JobFamily::query()->with('job')->where('family_id', $id)->orderBy('id', 'DESC')->paginate(10);
            $jobs_highlight = JobFamily::with('job')->orderByDesc('id')->where('family_id', $id)->limit(3)->get();
            $family = Family::with( 'member')->find($id);
            $honors = Honors::query()->with(['family', 'criteria', 'user'])->orderBy('id', 'DESC')->paginate(10);
        }

        
        return view('frontend.job.index', compact('jobs', 'jobs_highlight', 'family', 'honors', 'members'));
    }

    public function introduce()
    {
        $introduce = IntroduceFamily::orderBy('id', 'desc')->first();
        $family = null;
        $members  = User::orderBy('point', 'desc')->limit(4)->get();
        if (Sentinel::check() && Sentinel::getUser()->family || Sentinel::check() && Sentinel::getUser()->memberFamily)
        {
            $id = Sentinel::getUser()->family ? Sentinel::getUser()->family->id : Sentinel::getUser()->memberFamily->family_id;
            $family = Family::with( 'member')->find($id);
        }
        return view('frontend.about-us', compact('introduce', 'family', 'members'));
    }

    public function product()
    {
        $product = Product::orderBy('id', 'desc')->limit(9)->get();
        $family = null;
        $members  = User::orderBy('point', 'desc')->limit(4)->get();
        if (Sentinel::check() && Sentinel::getUser()->family || Sentinel::check() && Sentinel::getUser()->memberFamily)
        {
            $id = Sentinel::getUser()->family ? Sentinel::getUser()->family->id : Sentinel::getUser()->memberFamily->family_id;
            $product = Product::orderBy('id', 'desc')->limit(9)->get();
            $family = Family::with( 'member')->find($id);
        }
        return view('frontend.category_product', compact('product', 'family', 'members'));
    }

    public function moment()
    {
        $moment = FamilyMoment::orderBy('id', 'desc')->limit(9)->get();
        $family = null;
        $members  = User::orderBy('point', 'desc')->limit(4)->get();
        if (Sentinel::check() && Sentinel::getUser()->family || Sentinel::check() && Sentinel::getUser()->memberFamily)
        {
            $id = Sentinel::getUser()->family ? Sentinel::getUser()->family->id : Sentinel::getUser()->memberFamily->family_id;
            $family = Family::with( 'member')->find($id);
        }
        return view('frontend.moment', compact('moment', 'family', 'members'));
    }

    public function experience()
    {
        $members  = User::orderBy('point', 'desc')->limit(4)->get();
        $experienceCook = Experience::where('category_id', 1)->orderBy('id', 'desc')->limit(3)->get();
        $experienceHealth = Experience::where('category_id', 2)->orderBy('id', 'desc')->limit(3)->get();
        $experienceTravel = Experience::where('category_id', 3)->orderBy('id', 'desc')->limit(3)->get();
        return view('frontend.experience-category', compact('experienceCook', 'experienceHealth', 'experienceTravel','members'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }

    
}
