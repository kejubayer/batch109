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
        $photo = $request->file('photo');
        $newName = 'product_'.time().'.'.$photo->getClientOriginalExtension();
        $photo->move('uploads/products',$newName);
        $inputs = [
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'desc'=>$request->input('desc'),
            'photo'=>$newName
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
        $photo = $request->file('photo');
        if ($photo){
            if (file_exists('uploads/products/'.$product->photo)){
                unlink('uploads/products/'.$product->photo);
            }
            $newName = 'product_'.time().'.'.$photo->getClientOriginalExtension();
            $photo->move('uploads/products',$newName);
            $inputs['photo'] = $newName;
        }
        $product->update($inputs);
        return redirect()->route('admin.product');
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if (file_exists('uploads/products/'.$product->photo)){
            unlink('uploads/products/'.$product->photo);
        }
        $product->delete();
        return redirect()->back();
    }
}
