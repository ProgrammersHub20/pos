<?php

namespace Modules\Setup\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Setup\Entities\Varient;
use Modules\Setup\Entities\VarientValue;
use Modules\Setup\Http\Requests\VarientRequest;
use Modules\Setup\Http\Requests\VarientValueRequest;
use Carbon\Carbon;


class VarientController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Json
     */
    public function index()
    {
        $varients = Varient::with('vairentValue')->orderBy('id','DESC')->paginate(15);

        return $this->success($varients, 'Varients data fetch successfully', 200);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(VarientRequest $request)
    {
       // return $request->all();
        $data['name'] = $request->name;
        $data['description'] = $request->description;

        $varient = Varient::create($data);

        if($request->varientValue){
            $varientValueArr = [];
            foreach ($request->varientValue as $key => $value) {

                $varientValueArr[] = [ 
                    "varient_id" => $varient->id,
                    "name" => $value['name'],
                    "value" => $value['value'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                
            }

            VarientValue::insert($varientValueArr);

        }
        
        return $this->success(null,'Varient Created.',201);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
         try {
            $varient = Varient::with('vairentValue')->find($id);
            return $this->success($varient, 'Varient fetch successfully', 200);
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
    public function update(VarientRequest $request, $id)
    {
         try {
            $varient = Varient::findOrFail($id);
            $varient->update($request->all());

            return $this->success(null,'Varient Updated.',204);            
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return json
     */
    public function destroy($id)
    {
        try {
            $varient = Varient::with('vairentValue')->find($id);

            foreach ($varient->vairentValue as $key => $value) {
                $value->delete();
            }

            $varient->delete();
            return $this->success(null,'Varient Deleted.',200);
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }


    /**
     * [getVarientValue description]
     * @param  [type] $id [description]
     * @return [type] json    [description]
     */
    public function getVarientValue($id)
    {
        try {
            $varientValue = VarientValue::findOrFail($id);

            return $this->success($varientValue,'Varient Value fetch.',204);            
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }

    /**
     * [storeVarientValue description]
     * @param  VarientValueRequest $request [description]
     * @return [type]     json                  [description]
     */
    public function storeVarientValue(VarientValueRequest $request)
    {
        try {
            $data = $request->all();
            VarientValue::create($data);

            return $this->success(null,'Varient Value Created.',201);
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }


    /**
     * [updateVarientValue description]
     * @param  VarientValueRequest $request [description]
     * @param  [type]              $id      [description]
     * @return [type]               json     [description]
     */
    public function updateVarientValue(VarientValueRequest $request, $id)
    {
        try {
            $varientValue = VarientValue::findOrFail($id);
            $varientValue->update($request->all());

            return $this->success(null,'Varient Value Updated.',204);            
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }

    /**
     * [deleteVarientValue description]
     * @param  [type] $id [description]
     * @return [type] json    [description]
     */
    public function deleteVarientValue($id)
    {
        try {
            $varient = VarientValue::find($id)->delete();
            return $this->success(null,'Varient Value Deleted.',200);
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }





}
