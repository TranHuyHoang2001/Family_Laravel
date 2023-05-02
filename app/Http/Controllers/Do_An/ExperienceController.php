<?php

namespace App\Http\Controllers\Do_An;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Criteria;
use App\Models\Experience;
use App\Models\Job;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class ExperienceController extends Controller
{
    public function index(Request $request)
    {
        $keyword="";
        if($request->input('keyword')){
         $keyword = $request->input('keyword');
         }        
         $experiences = Experience::where('name','LIKE',"%{$keyword}%")->paginate(5);       
        return view('admin.experience.list', compact('experiences'));
    }

    public function create()
    {
        $category = Category::all();
        return view('admin.experience.add', compact('category'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except('_token');
            $path = null;
            if ($request->hasFile('image'))
            {
                $image = $request->file('image');
                $path = $image->storeAs(
                    'jobs', time() . $image->getClientOriginalName()
                );
            }
            $data['image'] = $path;
            $data['content'] = nl2br($data['content']);
            Experience::create($data);
            return redirect(route('experience.index'))->with('success', 'Thêm mới thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with('error', 'Thêm mới thất bại');
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
        //
    }

    public function edit($id)
    {
        $experience = Experience::find($id);
        if ($experience)
        {
            $category = Category::all();
            return view('admin.experience.edit', compact('category', 'experience'));
        }else {
            abort(404);
        }


    }

    public function update(Request $request, $id)
    {
        try {
            $experience = Experience::find($id);
            $data = $request->except('_token');
            $path = null;
            if ($request->hasFile('image'))
            {
                $image = $request->file('image');
                $path = $image->storeAs(
                    'jobs', time() . $image->getClientOriginalName()
                );
            }
            $data['image'] = $path;
            $data['content'] = nl2br($data['content']);
            $experience->update($data);
            return redirect(route('experience.index'))->with('success', 'Thêm mới thành công');
        } catch (\Exception $exception) {
            return back()->withInput()->with('error', 'Thêm mới thất bại');
        }
    }

    public function destroy($id)
    {
        try {
            $criteria = Experience::find($id);
            $criteria->delete();
            return Redirect::route('experience.index')->with('success','Xóa thành công');
        }catch (\Exception $exception)
        {
            Log::error($exception->getMessage());
            return Redirect::back()->withErrors('Xóa thất bại');
        }
    }
}
