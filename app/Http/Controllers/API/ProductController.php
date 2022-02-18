<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductsResource;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * @Get("api/public/products")
     * @return ProductCollection
     */
    public function index()
    {
        $products=Product::paginate(5);
        return new ProductCollection($products) ;
    }

    /**
     * @Get("api/public/products/name/{name}")
     * @param $name
     * @return ProductCollection
     */
    public function indexByName($name)
    {
        $products=Product::query()->where('title', 'LIKE',"%".$name."%")->get();
        return new ProductCollection($products) ;
    }

    /**
     * @param Request $request
     * @return ProductResource
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->title=$request->get("title");
        $product->price=$request->get("price");
        $product->description=$request->get("description");
        $product->category_id=$request->get("category_id");
        if($request->hasFile('image')){
            $destination= 'images/products';
            $image = $request->file('image');
            $image_title = time().$image->getClientOriginalName();
            $image->storeAs($destination,$image_title,'public');
            $product->image = $image_title;
        }
        $product->save();
        return new ProductResource($product);
    }

    /**
     * @Get("api/public/products/{id}")
     * @param Product $product
     * @return ProductResource
     */
    public function show($id)
    {
        $product=Product::findOrFail($id);
        return new ProductResource($product);
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return ProductResource
     */
    public function update(Request $request, Product $product)
    {
        $product->title=$request->get("title");
        $product->price=$request->get("price");
        $product->description=$request->get("description");
        //$product->category_id=$request->get("category_id");
        if($request->hasFile('image')){
            if($product->image !=null){
                $imagePath = public_path('storage/images/products/'.$product->image);
                File::delete($imagePath);
            }
            $destination= 'images/products';
            $image = $request->file('image');
            $image_title = time().$image->getClientOriginalName();
            $image->storeAs($destination,$image_title,'public');
            $product->image = $image_title;
        }
        $product->save();
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        //$image = explode("/", $product->image);
        //$name = array_pop($image);
        $imagePath = public_path('storage/images/products/'.$product->image);
        File::delete($imagePath);

        $response = [
            'product' => $product,
            "msg"=>"deleted"
        ];

        return $response;
    }
}
