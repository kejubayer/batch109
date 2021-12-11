<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::OrderBy('id','desc')->get();
        return view('backend.products.index',compact('products'));
    }

    public function create()
    {
        return view('backend.products.create');
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $inputs = [
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'desc'=>$request->input('desc'),
        ];
        Product::create($inputs);
        return redirect()->route('admin.product');
    }

    public function edit($id)
    {
      $product = Product::find($id);
      return view('backend.products.edit',compact('product'));
    }

    public function update(Request $request,$id)
    {
        $product = Product::find($id);
        $inputs = [
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'desc'=>$request->input('desc'),
        ];
        $product->update($inputs);
        return redirect()->route('admin.product');
    }

    public function delete($id)
    {
        Product::where('id',$id)->delete();
        return redirect()->back();
    }
}
