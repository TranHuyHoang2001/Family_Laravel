<?php

namespace App\Http\Controllers\Do_An;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Family;
use App\Models\Honors;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HonorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $honors = Honors::query()->with(['family', 'criteria', 'user'])->orderBy('id', 'DESC')->paginate(10);
        return view('admin.honors.index',compact('honors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createFamily()
    {
        $families = Family::query()->orderBy('id', 'DESC')->pluck('name', 'id');
        $criterias = Criteria::query()->orderBy('id', 'DESC')->pluck('name', 'id')->toArray();
        return view('admin.honors.form_family', compact('families', 'criterias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser()
    {
        $users = User::query()->orderBy('id', 'DESC')->pluck('first_name', 'id')->toArray();
        $criterias = Criteria::query()->orderBy('id', 'DESC')->pluck('name', 'id')->toArray();
        return view('admin.honors.form_user', compact('users', 'criterias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->except('_token', '_method');
            Honors::create($data);
            return redirect(route('honors.index'))->with('success', 'Vinh danh thành công');
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return back()->withInput()->with('error', 'Vinh danh thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Honors::destroy($id);
            return redirect(route('honors.index'))->with('success', 'Xóa vinh danh thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect(route('honors.index'))->with('error', 'Xoá vinh danh thất bại');
        }
    }
}
