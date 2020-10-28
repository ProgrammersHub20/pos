<?php

namespace Modules\Setup\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Setup\Entities\Store;
use Modules\Setup\Http\Requests\StoreRequest;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Store Collection
     */
    public function index()
    {
        $brands = Store::active()->orderBy('id','DESC')->paginate(15);

        return $this->success($brands, 'Store data fetch successfully', 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return json
     */
    public function store(StoreRequest $request)
    {
        try{
            $data = $request->except('weekend');
            $data['weekend'] = json_encode($request->weekend);
            Store::create($data);

            return $this->success(null, 'Store Created.',201);
        }catch(\Exception $e){
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return json
     */
    public function show($id)
    {
        try{
            $store = Store::findOrFail($id);

            return $this->success($store, 'Store fetch successfully', 200);

        }catch(\Exception $e){
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return json
     */
    public function update(StoreRequest $request, $id)
    {
        try {
            $data = $request->except('weekend');
            $data['weekend'] = json_encode($request->weekend);
            $store = Store::findOrFail($id);
            $store->update($data);

            return $this->success(null,'Store Updated.',200);
        } catch (\Exception $e) {
             return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            Store::find($id)->delete();
            return $this->success(null,'Store Deleted.',200);
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }
}
