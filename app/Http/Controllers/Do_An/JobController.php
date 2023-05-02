<?php

namespace App\Http\Controllers\Do_An;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Models\Family;
use App\Models\Job;
use App\Traits\LoggerTrait;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class JobController extends Controller
{
    use LoggerTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword="";
        if($request->input('keyword')){
         $keyword = $request->input('keyword');
         }
         
         $jobs = Job::where('name','LIKE',"%{$keyword}%")->paginate(10); 
                    
                return view('admin.job.index', compact('jobs'));
            
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Sentinel::getRoleRepository()->all()->pluck('name', 'id');
        return view('admin.job.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        try {
            $data = $request->except('_token', '_method','image');
            $data['created_by'] = Sentinel::getUser()->getUserId();
            $data['updated_by'] = Sentinel::getUser()->getUserId();
            $path=null;
            if ($request->hasFile('image'))
            {
                $image = $request->file('image');
                $path = $image->storeAs(
                    'jobs', time() . $image->getClientOriginalName()
                );
            }
            $data['image'] = $path;
            Job::create($data);
            return redirect(route('job.index'))->with('success', 'Thêm mới thành công');
        } catch (\Exception $exception) {
            $this->logError($exception);
            return back()->withInput()->with('error', 'Thêm mới thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::find($id);

        if ($job) {
            $roles = Sentinel::getRoleRepository()->all()->pluck('name', 'id');

            return view('admin.job.form', compact('roles', 'job'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, $id)
    {
        try {
            $data = $request->except('_token', '_method');
            $data['updated_by'] = Sentinel::getUser()->getUserId();
            $path=null;
            if ($request->hasFile('image'))
            {
                $image = $request->file('image');
                $path = $image->storeAs(
                    'jobs', time() . $image->getClientOriginalName()
                );
            }
            $data['image'] = $path;
            Job::where('id', $id)->update($data);
            return redirect(route('job.index'))->with('success', 'Chỉnh sửa thành công');
        } catch (\Exception $exception) {
            $this->logError($exception);
            return back()->withInput()->with('error', 'Chỉnh sửa thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Job::destroy($id);
            return redirect(route('job.index'))->with('success', 'Xóa công việc thành công');
        } catch (\Exception $exception) {
            $this->logError($exception);
            return redirect(route('job.index'))->with('error', 'Xoá công việc thất bại');
        }
    }

    public function report()
    {
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i:s');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i:s');
        $families = Family::with(['job.job', 'member', 'member.user', 'job' => function ($query) use ($weekEndDate, $weekStartDate) {
            $query->whereBetween('updated_at', [$weekStartDate, $weekEndDate ])->where('status', 3);
        }])->get();
        return view('admin.job.report', compact('families'));
    }
}
