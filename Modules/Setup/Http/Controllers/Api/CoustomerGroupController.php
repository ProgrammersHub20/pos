<?php

namespace Modules\Setup\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Setup\Entities\CustomerGroup;
use Modules\Setup\Http\Requests\CustomerGroupRequest;

class CoustomerGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return json
     */
    public function index()
    {
        $customerGroup = CustomerGroup::orderBy('id','DESC')->paginate(15);

        return $this->success($customerGroup, 'Customer group data fetch successfully', 200);
    }



    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return json
     */
    public function store(CustomerGroupRequest $request)
    {
         try {
            $data = $request->all();
            CustomerGroup::create($data);

            return $this->success(null,'Tax Created.',201);
        } catch (\Exception $e) {
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
        try {
            $CustomerGroup = CustomerGroup::findOrFail($id);
            return $this->success($CustomerGroup,'Customer group fetch successfully.',201);
            
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CustomerGroupRequest $request, $id)
    {
        try {
            $customerGrout = CustomerGroup::findOrFail($id);
            $customerGrout->update($request->all());

            return $this->success(null,'Customer group Updated.',204);            
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
            CustomerGroup::find($id)->delete();
            return $this->success(null,'Customer Group deleted.',204); 
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }
}
