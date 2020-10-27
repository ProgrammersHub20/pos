<?php

namespace Modules\Setup\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Setup\Entities\Tax;
use Modules\Setup\Http\Requests\TaxRequest;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $taxes = Tax::active()->orderBy('id','DESC')->paginate(15);

        return $this->success($taxes, 'Tax data fetch successfully', 200);
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
        try {
            $data = $request->all();
            Tax::create($data);

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
            $tax = Tax::findOrFail($id);
            return $this->success($tax,'Tax fetch successfully.',201);
            
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
    public function update(TaxRequest $request, $id)
    {
        try {
            $tax = Tax::findOrFail($id);
            $tax->update($request->all());

            return $this->success(null,'Tax Updated.',204);            
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
            Tax::find($id)->delete();
            return $this->success(null,'Tax deleted.',204); 
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }
}
