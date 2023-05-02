<?php

namespace App\Http\Controllers\Do_An;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FamilyRequest;
use App\Models\Family;
use App\Models\FamilyMoment;
use App\Models\FamilyMomentImage;
use App\Models\JobFamily;
use App\Models\Job;
use App\Models\MemberFamily;
use App\Models\User;
use App\Traits\LoggerTrait;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class FamilyController extends Controller
{
    use LoggerTrait;

    public function index()
    {
        $roles = Sentinel::getRoleRepository()->where('slug', '!=', 'root')->pluck('name', 'id');
        $query = Family::query()->orderBy('id', 'DESC');
        $families = $query->paginate(10);
        return view('admin.family.listfamily', compact('families', 'roles'));
    }


    public function create()
    {
        $roles = Sentinel::getRoleRepository()->where('slug', '!=', 'con')->where('slug', '!=', 'root')->pluck('name', 'id');

        return view('admin.family.addfamily', compact('roles'));
    }

   public function see($id){
    $user = User::find($id);
    $family = Family::with(['member.user'])->find($id);
   
    return view('admin.family.seefamily', compact('family','user'));
   }
    public function store(FamilyRequest $request)
    {

        try {
            $user = Sentinel::getUser();
            $data = $request->except('_token');
            $data['created_by'] = Sentinel::getUser()->id;
            $result = Family::create($data);
            $user->roles()->sync($data['role_id']);
            $jobs = Job::query()->pluck('id')->toArray();
            $result->jobFamily()->attach($jobs, ['status' => 1]);
            return redirect()->route('family.index')->with('success', 'Tạo gia đình thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->withInput()->with('error', 'Xảy ra lỗi khi tạo gia đình');
        }
    }

    public function edit($id)
    {
        $user = Sentinel::getUser()->roles()->first();
        if ($user->id == 4)
        {
            return redirect()->back()->withInput()->with('error', 'Bạn không có quyền được vào trang này');
        }
        $family = Family::with(['member.user'])->find($id);

        if ($family) {
            $roles = Sentinel::getRoleRepository()->where('slug', '!=', 'con')->where('slug', '!=', 'root')->pluck('name', 'id');

            return view('admin.family.editfamily', compact('roles', 'family'));
        } else {
            abort(404);
        }
    }

    public function update(FamilyRequest $request, $id)
    {
        try {
            $user = Sentinel::getUser();
            $data = $request->except('_token', '_method');
            $result = Family::find($id)->update($data);
            $user->roles()->sync($data['role_id']);
            return redirect()->route('family.index')->with('success', 'Cập nhật gia đình thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->withInput()->with('error', 'Xảy ra lỗi khi cập nhật gia đình');
        }
    }

    public function destroy($id)
    {
        try {

            $user = Sentinel::getUser();
            $family = Family::find($id);
            $family->delete();
            $user->roles()->detach();
            return Redirect::route('family.index')->with('success', 'Xóa gia đình thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return Redirect::back()->withErrors('Xóa gia đình thất bại');
        }
    }

    public function addMember(Request $request, $id)
    {
        try {
            $family = Family::find($id);
            $member = null;
            $role = in_array($request->role_id, [2,3]) ? $request->role_id : null;
            if (isset($family->member) && $role)
            {
                $member = $family->member()->where('role_id',  $role)->first();
            }
            if ($family->role_id == $request->role_id || $member)
            {
                return \redirect()->back()->with('error', 'Đã tồn tại quyền này. Vui lòng chọn quyền khác!');
            }
            $user = Sentinel::getUser();
            $user->roles()->sync($request->role_id);
            $family->memberFamily()->attach($user->id, ['role_id' => $request->role_id, 'status' => '1']);
            return Redirect::route('family.index')->with('success', 'Tham gia gia đình thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return Redirect::back()->withErrors('Tham gia thất bại');
        }
    }

    public function accessMember($id)
    {
        $family = MemberFamily::find($id);
        $status = 2;
        if ($family->status == 2) {
            $status = 1;
        }
        $result = $family->update(['status' => $status]);

        if ($result) {
            return \redirect()->back()->with('success', 'Duyệt thành công');
        }
        return \redirect()->back()->with('error', 'Duyệt thất bại');
    }

    public function jobOfFamily(Request $request)
    {
        try {
            $user = User::query()->with('memberFamily')->find(Sentinel::getUser()->getUserId());
            if (!isset($user->memberFamily) && !isset($user->family)) {
                return back()->with('error', 'Vui lòng gia nhập gia đình để sử dụng chức năng này');
            }

            $familyId = isset($user->memberFamily) ? $user->memberFamily->family_id : $user->family->id;

            $jobs = JobFamily::query()
                ->with(['job', 'user'])
                ->where('family_id', $familyId)
                ->paginate(10);

            return view('admin.family.job-of-family', compact('jobs'));

        } catch (\Exception $exception) {
            $this->logError($exception);
            return back()->with('error', 'Có lỗi xảy ra vui lòng quay lại sau');
        }
    }

    public function getJob($id)
    {
        try {
            $job = JobFamily::query()->find($id);
            if (!$job) {
                return back()->with('error', 'Không tồn tại công việc này');
            }
            $job->status = JobFamily::RECEIVED;
            $job->user_id = Sentinel::getUser()->id;
            $job->save();
            return back()->with('success', 'Nhận công việc thành công');
        } catch (\Exception $exception) {
            $this->logError($exception);
            return back()->with('error', 'Nhận công việc thất bại');
        }
    }

    public function deleteJob($id)
    {
        try {
            $job = JobFamily::find($id);
            $job->delete();
            return Redirect::route('family.job_of_family')->with('success', 'Xóa công việc thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return Redirect::back()->withErrors('Xóa công việc thất bại');
        }
    }

    public function deleteMember($id)
    {
        try {
            $family = MemberFamily::with('user')->find($id);
            $user = User::find($family->user_id);
            $user->point = 0;
            $user->save();
            $family->delete();
            return Redirect::back()->with('success', 'Xóa thành viên thành công');
        } catch (\Exception $exception) {
            return Redirect::back()->withErrors('Xóa thành viên thất bại');
        }

    }

    public function familyMoment()
    {
        $familyMoment = FamilyMoment::with('image', 'user')->get();
        return view('admin.family.family_moment', compact('familyMoment'));
    }

    public function familyMomentCreate()
    {
        return view('admin.family.family_moment_create');
    }

    public function familyMomentStore(Request $request)
    {
        try {
            $user = Sentinel::getUser();
            $data = $request->except('_token', 'image');
            $data['content'] = nl2br($data['content']);
            $data['created_by'] = $user->id;
            $data['family_id'] = $user->family ? $user->family->id :  $user->memberFamily->id;
            $result = FamilyMoment::create($data);
            if ($request->hasFile('image')) {
                $images = $request->file('image');
                foreach ($images as $image)
                {
                    $path = $image->storeAs(
                        'jobs', time() . $image->getClientOriginalName()
                    );
                    FamilyMomentImage::create(['family_moment_id' => $result->id, 'image' => $path]);
                }
            }

            return Redirect::route('family.family_moment', $data['family_id'])->with('success','Tạo khoảnh khắc thành công');
        }catch (\Exception $exception)
        {
            Log::error($exception->getMessage());
            return Redirect::back()->with('error','Tạo khoảnh khắc thất bại');
        }
    }

    public function familyMomentEdit($id)
    {
        $familyMoment = FamilyMoment::with('image')->find($id);
        if ($familyMoment)
        {
            return view('admin.family.family_moment_edit', compact('familyMoment'));
        }else {
            abort(404);
        }
    }

    public function familyMomentUpdate(Request $request, $id)
    {
        try {
            $familyMoment = FamilyMoment::with('image')->find($id);
            $data = $request->except('_token', 'image');
            $data['content'] = nl2br($data['content']);
            $familyMoment->update($data);
            $familyMoment->image()->delete();
            if ($request->hasFile('image')) {
                $images = $request->file('image');
                foreach ($images as $image)
                {
                    $path = $image->storeAs(
                        'jobs', time() . $image->getClientOriginalName()
                    );
                    FamilyMomentImage::create(['family_moment_id' => $familyMoment->id, 'image' => $path]);
                }
            }

            return Redirect::back()->with('success','Chỉnh sửa khoảnh khắc thành công');
        }catch (\Exception $exception)
        {
            Log::error($exception->getMessage());
            return Redirect::back()->with('error','Chỉnh sửa khoảnh khắc thất bại');
        }
    }
    public function familyMomentDelete($id)
    {
        try {
            $familyMoment = FamilyMoment::with('image')->find($id);
            $familyMoment->delete();
            $familyMoment->image()->delete();
            return Redirect::back()->with('success','Xóa khoảnh khắc thành công');
        }catch (\Exception $exception)
        {
            Log::error($exception->getMessage());
            return Redirect::back()->with('error','Xóa khoảnh khắc thất bại');
        }
    }

    public function updateJobFamily($id)
    {
        try {
            return view('admin.family.update-job-family', compact('id'));
        } catch (\Exception $exception) {
            $this->logError($exception);
            return Redirect::back()->withErrors('Có lỗi xảy ra vui lòng thử lại');
        }
    }

    public function completeJobFamily(Request $request, $id)
    {
        try {
            $data['image_1'] = FileHelper::upload($request, 'image_1', 'jobs');
            $data['image_2'] = FileHelper::upload($request, 'image_2', 'jobs');
            $data['image_3'] = FileHelper::upload($request, 'image_3', 'jobs');

            if (!$data['image_1'] || !$data['image_2'] || !$data['image_3']) {
                return Redirect::back()->withErrors('Có lỗi xảy ra vui lòng thử lại');
            }

            $data['status'] = JobFamily::COMPLETE;

            JobFamily::query()
                ->where('id', $id)
                ->update($data);

            $jobFamily = JobFamily::query()
                ->with('job')
                ->find($id);

            $point = isset($jobFamily->job) ? $jobFamily->job->point : 0;

            $user = User::query()
                ->find(Sentinel::getUser()->id);

            $old_point = $user->point;

            $user->point = $old_point + $point;

            $user->save();

            return redirect(route('family.job_of_family'))->with('success', 'Đã hoàn thành công việc');
        } catch (\Exception $exception) {
            $this->logError($exception);
            return Redirect::back()->with('error', 'Có lỗi xảy ra vui lòng thử lại');
        }
    }

    public function watchJobFamily($id){
        try {
            $job = JobFamily::query()
                ->find($id);
            if (!$id){
                return Redirect::back()->with('error', 'Không tồn tại công việc');
            }
            return view('admin.family.watch_job_family', compact('job'));
        }catch (\Exception $exception) {
            $this->logError($exception);
            return Redirect::back()->with('error', 'Có lỗi xảy ra vui lòng thử lại');
        }
    }
}
