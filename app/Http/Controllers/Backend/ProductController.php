<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::OrderBy('id','desc')->paginate(10);
        return view('backend.products.index',compact('products'));
    }

    public function create()
    {
        return view('backend.products.create');
    }

    public function store(Request $request)
    {
//        dd($request->all());
      /*  $request->validate([
            'name' => 'required|max:96',
            'price' => 'required',
            'desc' => 'required',
            'photo' => 'required|image|max:1024',
        ],[
            'photo.max'=>'The photo must not be greater than 1 MB.'
        ]);*/
         $validate = Validator::make($request->all(),[
             'name' => 'required|max:96',
             'price' => 'required',
             'desc' => 'required',
             'photo' => 'required|image|max:1024',
         ],[
             'photo.max'=>'The photo must not be greater than 1 MB.',
             'photo.image'=>'The photo must be an image!'
         ]);
         if ($validate->fails()){
             return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
         }
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
        $validate = Validator::make($request->all(),[
            'name' => 'required|max:96',
            'price' => 'required',
            'desc' => 'required',
            'photo' => 'image|max:1024',
        ],[
            'photo.max'=>'The photo must not be greater than 1 MB.',
            'photo.image'=>'The photo must be an image!'
        ]);
        if ($validate->fails()){
            return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
        }
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
