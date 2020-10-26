<?php

namespace Modules\Setup\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setup\Entities\Brand;
use Modules\Setup\Http\Requests\BrandRequest;
use Modules\Setup\Transformers\BrandCollection;
use Modules\Setup\Transformers\BrandResource;
use App\Traits\ApiResponse;

class BrandController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $brands = Brand::active()->orderBy('id','DESC')->paginate(15);

        return new BrandCollection($brands);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('setup::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BrandRequest $request)
    {
        
        $data = $request->except('image');
        $data['is_active'] = true;
        $image = $request->image;
        if ($image) {
            $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = preg_replace('/[^a-zA-Z0-9]/', '', $data['title']);
            $imageName = $imageName . '.' . $ext;
            $filePath = "public/images/brand/{$imageName}";
            $image->move('public/images/brand', $imageName);
            $data['image'] = $filePath;
        }
        Brand::create($input);

        return $this->success('Brand Created.',201);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $barnd = Brand::findOrFail($id);

        return new BrandResource($brands);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('setup::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(BrandRequest $request, $id)
    {
        $barnd = Brand::findOrFail($id);
        $barnd->title = $request->title;
        $image = $request->image;
        if ($image) {
            // Unlink old image
            if(file_exists($barnd->image)){
                unlink($barnd->image);
            }

            $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = preg_replace('/[^a-zA-Z0-9]/', '', $request->title);
            $imageName = $imageName . '.' . $ext;
            $filePath = "public/images/brand/{$imageName}";
            $image->move('public/images/brand', $imageName);
            $barnd->image = $filePath;
        }
        $barnd->save();

        return $this->success('Brand Updated.',204);

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
