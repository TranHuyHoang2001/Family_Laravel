<?php

namespace App\Http\Controllers\Do_An;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\IntroduceFamily;
use App\Models\User;
use App\Traits\LoggerTrait;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

class IntroduceFamilyController extends Controller
{
    use LoggerTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $user = User::query()->with(['memberFamily', 'family'])->find(Sentinel::getUser()->getUserId());
            if (!isset($user->memberFamily) && !isset($user->family)) {
                return back()->with('error', 'Vui lòng gia nhập gia đình để sử dụng chức năng này');
            }

            $familyId = isset($user->memberFamily) ? $user->memberFamily->id : $user->family->id;

            $introduce = IntroduceFamily::query()
                ->with(['family'])
                ->where('family_id', $familyId)
                ->first();

            return view('admin.introduce_family.form', compact('introduce'));

        } catch (\Exception $exception) {
            $this->logError($exception);
            return back()->with('error', 'Có lỗi xảy ra vui lòng quay lại sau');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $data = $request->except('_token', '_method', 'image');

            $user = User::query()->with('memberFamily')->find(Sentinel::getUser()->getUserId());

            if (!isset($user->memberFamily) && !isset($user->family)) {
                return back()->with('error', 'Vui lòng gia nhập gia đình để sử dụng chức năng này');
            }

            $familyId = isset($user->memberFamily) ? $user->memberFamily->id : $user->family->id;

            $data['family_id'] = $familyId;

            if ($request->image){
                $data['image'] = FileHelper::upload($request, 'image', 'families');
            }

            IntroduceFamily::create($data);

            return redirect()->back()->with('success', 'Thêm giới thiệu thành công');
        } catch (\Exception $exception) {
            $this->logError($exception);
            return back()->withInput()->with('error', 'Thêm mới thất bại');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $data = $request->except('_token', '_method', 'image');

            $user = User::query()->with('memberFamily')->find(Sentinel::getUser()->getUserId());

            if (!isset($user->memberFamily) && !isset($user->family)) {
                return back()->with('error', 'Vui lòng gia nhập gia đình để sử dụng chức năng này');
            }

            $familyId = isset($user->memberFamily) ? $user->memberFamily->id : $user->family->id;

            $data['family_id'] = $familyId;

            if ($request->image){
                $data['image'] = FileHelper::upload($request, 'image', 'families');
            }

            IntroduceFamily::query()
                ->where('id', $id)
                ->update($data);

            return redirect()->back()->with('success', 'Thêm giới thiệu thành công');
        } catch (\Exception $exception) {
            $this->logError($exception);
            return back()->withInput()->with('error', 'Thêm mới thất bại');
        }
    }
}
