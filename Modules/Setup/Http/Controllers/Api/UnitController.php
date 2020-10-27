<?php

namespace Modules\Setup\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Setup\Entities\Unit;
use Modules\Setup\Http\Requests\UnitRequest;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Unit Collection
     */
    public function index()
    {
        $units = Unit::active()->orderBy('id','DESC')->paginate(15);

        return $this->success($units, 'Unit data fetch successfully', 200);
    }



    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(UnitRequest $request)
    {
        try {
            $data = $request->all();
            if(!$data['base_unit']){
                $data['operator'] = '*';
                $data['operation_value'] = 1;
            }
            Unit::create($data);

            return $this->success(null,'Unit Created.',201);            
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
        


    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        try {
            $unit = Unit::findOrFail($id);
            return $this->success($units, 'Unit fetch successfully', 200);
        } catch (Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }



    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UnitRequest $request, $id)
    {
        try {
            $unit = Unit::findOrFail($id);
            $unit->update($request->all());

            return $this->success(null,'Unit Updated.',204);            
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
            Unit::find($id)->delete();
            return $this->success(null,'Unit Deleted.',200);
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }
}
