<?php

namespace App\Http\Controllers\Do_An;

use App\Http\Controllers\Controller;
use App\Http\Requests\CriteriaRequest;
use App\Models\Criteria;
use App\Models\Family;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class CriteriaController extends Controller
{
    public function index()
    {
        $query = Criteria::query()->orderBy('id', 'DESC');
        $criterias = $query->paginate(10);
        return view('admin.criteria.index',compact('criterias'));
    }

    public function create()
    {
        return view('admin.criteria.create');
    }

    public function store(CriteriaRequest $request)
    {
        try {
            $result = Criteria::create($request->except('_token'));
            return redirect()->route('criteria.index')->with('success', 'Tạo tiêu chí thành công');
        }catch (\Exception $exception)
        {
            Log::error($exception->getMessage());
            return redirect()->back()->withInput()->with('error', 'Xảy ra lỗi khi tạo tiêu chí');
        }
    }

    public function edit($id)
    {
        $criteria = Criteria::find($id);
        if ($criteria)
        {
            return view('admin.criteria.edit', compact('criteria'));
        }
    }

    public function update(CriteriaRequest $request, $id)
    {
        try {
            $data = $request->except('_token', '_method');
            $result = Criteria::find($id)->update($data);
            return redirect()->route('criteria.index')->with('success', 'Cập nhật tiêu chí thành công');
        }catch (\Exception $exception)
        {
            Log::error($exception->getMessage());
            return redirect()->back()->withInput()->with('error', 'Xảy ra lỗi khi cập nhật tiêu chí');
        }
    }

    public function destroy($id)
    {
        try {
            $criteria = Criteria::find($id);
            $criteria->delete();
            return Redirect::route('criteria.index')->with('success','Xóa tiêu chí thành công');
        }catch (\Exception $exception)
        {
            Log::error($exception->getMessage());
            return Redirect::back()->withErrors('Xóa tiêu chí thất bại');
        }
    }
}
