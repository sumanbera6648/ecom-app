<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category','brand')->latest()->paginate();
        return view('backend.product.show', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = Brand::get();
        $category = Category::where('is_parent', 1)->get();
        return view('backend.product.add', compact('brand', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        // return $req->all();
        $product = new Product();
        $image = $req->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalName();
        $image->move(public_path('product_photo'), $imageName);
        $product->title = $req->title;
        $product->summary = $req->summary;
        $product->description = $req->description;
        $product->is_featured = $req->is_featured;
        $product->cat_id = $req->cat_id;
        $product->child_cat_id = $req->child_cat_id;
        $product->price = $req->price;
        $product->discount = $req->discount;
        // $product->size = $req->size;
        $size = $req->input('size');
        if ($size) {
            $product['size'] = implode(',', $size);
        } else {
            $product['size'] = '';
        }
        $product->brand_id = $req->brand_id;
        $product->condition = $req->condition;
        $product->stock = $req->stock;
        $product->photo =  $imageName;
        $product->status = $req->status;


        $product->save();
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productEdit = Product::find($id);
        $brand = Brand::get();
        $category = Category::where('is_parent', 1)->get();
        return view('backend.product.edit', compact('productEdit', 'brand', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $product_update = Product::find($id);
        $old_photo = $req->input('old_photo');
        if (!empty($req->file('photo'))) {
            $product = $req->file('photo');
            $productName = time() . '.' . $product->getClientOriginalName();
            $product->move(public_path('product_photo'), $productName);
            $product_update->photo =  $productName;
        } else {
            $product_update->photo = $old_photo;
        }
        $product_update->title = $req->title;
        $product_update->summary = $req->summary;
        $product_update->description = $req->description;
        $product_update->is_featured = $req->is_featured;
        $product_update->cat_id = $req->cat_id;
        $product_update->child_cat_id = $req->child_cat_id;
        $product_update->price = $req->price;
        $product_update->discount = $req->discount;
        // $product_update->size = $req->size;
        $size = $req->input('size');
        if ($size) {
            $product_update['size'] = implode(',', $size);
        } else {
            $product_update['size'] = '';
        }
        $product_update->brand_id = $req->brand_id;
        $product_update->condition = $req->condition;
        $product_update->stock = $req->stock;
        $product_update->status = $req->status;


        $product_update->save();
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Product::findOrFail($id);
        $status = $brand->delete();
        if ($status) {
            request()->session()->flash('success', 'Brand successfully deleted');
        } else {
            request()->session()->flash('error', 'Error occurred while deleting brand');
        }
        return redirect()->route('product.index');
    }
}
