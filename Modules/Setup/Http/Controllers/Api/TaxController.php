<?php

namespace Modules\Setup\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setup\Entities\Tax;
use Modules\Setup\Http\Requests\TaxRequest;
use Modules\Setup\Transformers\TaxCollection;
use Modules\Setup\Transformers\TaxResource;
use App\Traits\ApiResponse;

class TaxController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $taxes = Tax::active()->orderBy('id','DESC')->paginate(15);

        return new TaxCollection($taxes);
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
    public function store(TaxRequest $request)
    {
        $data['name'] = $request->name;
        $data['rate'] = $request->rate;
        $data['is_active'] = true;
        Tax::create($data);

        return $this->success('Tax Created.',201);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $tax = Tax::findOrFail($id);
        
        return new TaxResource($tax);
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
    public function update(TaxRequest $request, $id)
    {
        $tax = Tax::findOrFail($id);
        $tax->update($request->all());

        return $this->success('Tax Updated.',204);

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
