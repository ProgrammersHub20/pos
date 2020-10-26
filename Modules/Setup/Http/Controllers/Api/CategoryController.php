<?php

namespace Modules\Setup\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setup\Entities\Category;
use Modules\Setup\Http\Requests\CategoryRequest;
use Modules\Setup\Transformers\CategoryCollection;
use Modules\Setup\Transformers\CategoryResource;
use App\Traits\ApiResponse;

class CategoryController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories = Category::active()->orderBy('id','DESC')->paginate(15);

        return new CategoryCollection($categories);
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
    public function store(CategoryRequest $request)
    {
        $data['name'] = $request->name;
        $data['parent_id'] = $request->parent_id;
        $data['is_active'] = true;
        Category::create($data);

        return $this->success('Category Created.',201);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        
        return new CategoryResource($category);
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
    public function update(CategoryRequest $request, $id)
    {
        $input = $request->all();
        $category = Category::findOrFail($id);
        $category->update($input);

        return $this->success('Category Updated.',204);
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
