<?php

namespace Modules\Setup\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setup\Entities\Warehouse;
use Modules\Setup\Http\Requests\WarehouseRequest;
use Modules\Setup\Transformers\WarehouseCollection;
use Modules\Setup\Transformers\WarehouseResource;
use App\Traits\ApiResponse;

class WarehouseController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $warehouses = Warehouse::active()->orderBy('id','DESC')->paginate(15);

        return new WarehouseCollection($warehouses);
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
    public function store(WarehouseRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = true;
        Warehouse::create($data);

        return $this->success('Warehouse Created.',201);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $warehouse = Warehouse::findOrFail($id);

        return new  WarehouseResource($warehouse);
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
    public function update(WarehouseRequest $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->update($request->all());

        return $this->success('Warehouse Updated.',204);
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
