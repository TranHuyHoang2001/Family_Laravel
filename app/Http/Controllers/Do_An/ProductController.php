<?php

namespace App\Http\Controllers\Do_An;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Traits\LoggerTrait;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\FamilyMoment;

class ProductController extends Controller
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
         
      
         $products = Product::where('name','LIKE',"%{$keyword}%")->paginate(5); 
                    
         return view('admin.product.index', compact('products'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
           

            $data = $request->except('_token', '_method', 'image');

            if ($request->image) {
                $data['image'] = FileHelper::upload($request, 'image', 'products');
            }
            $data['created_by'] = Sentinel::getUser()->getUserId();
            $data['updated_by'] = Sentinel::getUser()->getUserId();

            Product::create($data);

            return redirect(route('product.index'))->with('success', 'Thêm mới thành công');
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
        $product = Product::find($id);

        if ($product) {
            return view('admin.product.form', compact('product'));
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
    public function update(ProductRequest $request, $id)
    {
        try {

            $data = $request->except('_token', '_method', 'image');

            if ($request->image) {
                $data['image'] = FileHelper::upload($request, 'image', 'products');
            }
            $data['created_by'] = Sentinel::getUser()->getUserId();
            $data['updated_by'] = Sentinel::getUser()->getUserId();

            Product::query()
                ->where('id', $id)
                ->update($data);

            return redirect(route('product.index'))->with('success', 'Chỉnh sửa thành công');
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
            Product::destroy($id);
            return redirect(route('product.index'))->with('success', 'Xóa sản phẩm thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect(route('product.index'))->with('error', 'Xoá sản phẩm thất bại');
        }

       
    }
}
