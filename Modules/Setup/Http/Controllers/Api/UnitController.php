<?php

namespace Modules\Setup\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setup\Entities\Unit;
use Modules\Setup\Http\Requests\UnitRequest;
use Modules\Setup\Transformers\UnitCollection;
use Modules\Setup\Transformers\UnitResource;
use App\Traits\ApiResponse;

class UnitController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $units = Unit::active()->orderBy('id','DESC')->paginate(15);

        return new UnitCollection($units);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(UnitRequest $request)
    {
        
        $data = $request->all();
        $data['is_active'] = true;
        if(!$data['base_unit']){
            $data['operator'] = '*';
            $data['operation_value'] = 1;
        }
        Unit::create($data);

        return $this->success('Unit Created.',201);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $unit = Unit::findOrFail($id);

        return new UnitResource($unit);
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
    public function update(UnitRequest $request, $id)
    {
        $unit = Unit::findOrFail($id);
        $unit->update($request->all());

        return $this->success('Unit Updated.',204);

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
