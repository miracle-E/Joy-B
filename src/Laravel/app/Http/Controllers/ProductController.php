<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;
use App\Traits\FileUploadTrait;
// use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['orders','categories','tags'])->orderBy('name', 'desc')->paginate(5);

        return view('pages.admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.product.create');
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
        {
            return [
                'name.required' => 'A product name is required',
                'description.required'  => 'A product description is required',
                'image.required'  => 'An image speaks a thousand words; An image is required',
            ];
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validator::make($request->all(),[
        $request->validate([
            'name'=>'bail|required|string|unique:products|max:255',
            'price'=> 'nullable',
            'description' => 'required|string',
            'image' => 'required|file'
        ]);


      try {
        // return response("".$request->image);
      } catch (\Exception $th) {
          return $th;
      }
      $product = new Product([
        'id' => uniqid("jb", false),
        'name' => $request->get('name'),
        'price' => $request->get('price'),
        'description' => $request->get('description'),
        'is_available' => true,
        'image' => "". $this->saveAttachment($request->image, 'product-images')
      ]);
      $product->save();
      $products = Product::with(['orders','categories','tags'])->orderBy('name', 'desc')->paginate(3);
      session()->flash('message','Created Successfully!');
      return view('pages.admin.product.index', compact(['success'=>"Created Successfully!",'products']));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // $products = Product::with(['orders','categories','tags'])->orderBy('name', 'desc')->paginate(5);

        return view('pages.admin.product.view', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', '=', $id)->first();

        return view('pages.admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'bail|required|string|max:255',
            'price'=> 'nullable',
            'description' => 'required|string',
        ]);

        $product = Product::find($id);
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->description = $request->get('description');
        $product->image = ($request->get('image') ? $this->saveAttachment($request->image, 'product-images') : $product->image);
        $product->is_available = $request->get('is_available') ? $request->get('is_available') : $product->is_available;
        $product->likes = $request->get('likes');
        $product->save();

        $products = Product::with(['orders','categories','tags'])->orderBy('name', 'desc')->paginate(3);
        session()->flash('message','Updated Successfully!');
        return view('pages.admin.product.index', compact(['success'=>"Updated Successfully!",'products']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
     $product = Product::findOrFail($id);
     isset($product) ? $product->delete() : null;

     $products = Product::with(['orders','categories','tags'])->orderBy('name', 'desc')->paginate(3);
     session()->flash('message','Deleted Successfully!');
     return view('pages.admin.product.index', compact(['success'=>"Deleted Successfully!",'products']));
}
}
