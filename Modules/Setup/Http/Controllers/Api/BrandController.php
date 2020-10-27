<?php

namespace Modules\Setup\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Setup\Entities\Brand;
use Modules\Setup\Http\Requests\BrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return BrandCollection
     */
    public function index()
    {
        $brands = Brand::active()->orderBy('id','DESC')->paginate(15);

        return $this->success($brands, 'Brnad data fetch successfully', 200);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return json
     */
    public function store(BrandRequest $request)
    {
        try{
            $data = $request->all();
            $image = $request->file('image');
            if ($image) {

                // ck dir
                if (!file_exists('uploads/images/brand')) {
                    mkdir('uploads/images/brand', 0777, true);
                }

                $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                $imageName = preg_replace('/[^a-zA-Z0-9]/', '', $data['name']);
                $imageName = $imageName . '.' . $ext;
                $filePath = "uploads/images/brand/{$imageName}";
                $image->move('uploads/images/brand', $imageName);
                $data['image'] = $filePath;
            }
            Brand::create($data);

            return $this->success(null, 'Brand Created.',201);

        }catch(\Exception $e){
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Brand
     */
    public function show($id)
    {
        try {
             $barnd = Brand::findOrFail($id);

            return $this->success($barnd, 'Brnad fetch successfully', 200);           
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }

    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return json
     */
    public function update(BrandRequest $request, $id)
    {
        try{

            $barnd = Brand::findOrFail($id);
            $barnd->title = $request->title;
            $barnd->contact_person = $request->contact_person;
            $barnd->contact_phone = $request->contact_phone;
            $barnd->contact_address = $request->contact_address;
            $barnd->is_active = $request->is_active;
            $image = $request->file('image');
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

            return $this->success(null, 'Brand Updated.',204);

        }catch(\Exception $e){
            return $this->error($e->getMessage() ,500);
        }

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return json
     */
    public function destroy($id)
    {
        try{

            Brand::find($id)->delete();

            return $this->success(null, 'Brand deleted.',200);

        }catch(\Exception $e){
            return $this->error($e->getMessage() ,500);
        }
    }
}
