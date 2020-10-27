<?php

namespace Modules\Setup\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Setup\Entities\Category;
use Modules\Setup\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return CategoryCollection
     */
    public function index()
    {
        $categories = Category::active()->orderBy('id','DESC')->paginate(15);

        return $this->success($categories, 'Category data fetch successfully', 200);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return json
     */
    public function store(CategoryRequest $request)
    {
        try{
            $data = $request->all();
            Category::create($data);

            return $this->success(null, 'Category Created.',201);
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
            $category = Category::findOrFail($id);

            return $this->success($category, 'Category fetch successfully', 200);

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
    public function update(CategoryRequest $request, $id)
    {
        try {
            $input = $request->all();
            $category = Category::findOrFail($id);
            $category->update($input);

            return $this->success(null,'Category Updated.',204);
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
            Category::find($id)->delete();
            return $this->success(null,'Category Deleted.',200);
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }
}
