<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResources;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryProductCollection;
use App\Http\Resources\CategoryProductsResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     *  @Get("api/public/categories")
     * @return CategoryCollection
     */
    public function index()
    {
        $categories=Category::all();
        return  new CategoryCollection($categories);
    }

    /**
     * @param Request $request
     * @return CategoryResource
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->title= $request->get('title');
        $category->save();
        return  new CategoryResource($category);
    }

    /**
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return CategoryResource
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return new CategoryResource($category);
    }

    /**
     * @param Category $category
     * @return CategoryResource
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return new CategoryResource($category);
    }

    /**
     *  @Get("api/public/categories/products/{id}")
     * @param $id
     * @return mixed
     */
    public function showProducts($id)
    {
        //$category=Category::findOrFail($id);
        $category=Category::find($id);
        $category->products;
        return  new CategoryProductsResource($category);
    }
}
