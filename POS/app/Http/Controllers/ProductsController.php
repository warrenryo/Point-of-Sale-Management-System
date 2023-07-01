<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Products;
use App\Models\Brands;
use DB;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        return view('products.add_products');
    }

    public function brandIndex()
    {
        $brand = Brands::all();
        return view('products.brands_index',compact('brand'));
    }

    

    //STORE BRANDS
    public function addBrand(Request $request)
    {
        $brand = new Brands;
        $brand->brand_name = $request->input('brand_name');
        $brand->manufacturer = $request->input('manufacturer');

        $brand->save();

        return redirect()->back()->with('success', 'Brand Added Successfully');
    }
    //EDIT BRANDS
    public function editBrand(Request $request, Brands $brands)
    {
        $brand_id = $request->input('brand_id');

        $brand = Brands::find($brand_id);

        $brand->brand_name = $request->input('brand_name');
        $brand->manufacturer = $request->input('manufacturer'); 

        $brand->update();

        return redirect()->back()->with('success', 'Brand Updated Successfully');
    }
    //DELETE BRANDS
    public function deleteBrand(Request $request)
    {
        $delBrand_id = $request->input('delete_brand');

        $delBrand = Brands::find($delBrand_id);
        
        $delBrand->delete();

        return redirect()->back()->with('success', 'Brand Deleted Successfully');
    }


    //STORATION OF PRODUCTS ONLY
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_photo' => 'required',
        ]);
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['description'] = $request->description;
        $data['brand'] = $request->brand;
        $data['price'] = $request->price;
        $data['quantity'] = $request->quantity;
        $image = $request->file('product_photo');

        if($image){
            $image_name = Str::random(5);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/ProductPhoto/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if($success){
                $data['product_photo'] = $image_url;
                $prod = DB::table('products')->insert($data);
                if($prod){
                    //$notification = array('message'=>'Successfully Inserted', 'alert-type'=>'success');
                    return redirect()->back()->with('success','Product Added Successfully');
                }else{
                    //$notification = array('message'=>'error','alert-type'=>'error');
                    return redirect()->back()->with('error','Product Added Failed');
                }
            }else{
                return redirect()->back();
            }

            return redirect()->back();
        }

    }

    //PRODUCT LISTS
    public function listOfProducts()
    {
        $prod = Products::all();
        $product = DB::table('products')->count();
        return view('products.list_products',compact('prod','product'));
    }
    //EDIT PRODUCT
    public function editProduct($id)
    {
        $prod = DB::table('products')->where('id', $id)->first();
        return view('products.edit_product', compact('prod'));
    }
    //DELETE PRODUCT
    public function deleteProduct(Request $request)
    {
        $prod_id = $request->input('delete_product');

        $prod = Products::find($prod_id);
        $prod->delete();

        return redirect()->back()->with('success','Product Deleted Successfully');
    }
    //UPDATE PRODUCT
    public function updateProduct(Request $request, $id)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['description'] = $request->description;
        $data['brand'] = $request->brand;
        $data['price'] = $request->price;
        $data['quantity'] = $request->quantity;
        $image = $request->file('product_photo');

        if($image){
            $image_name = Str::random(5);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/ProductPhoto/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if($success){
                $data['product_photo'] = $image_url;
                $img = DB::table('products')->where('id', $id)->first();
                $image_path = $img->product_photo;
                $done = unlink($image_path);
                $prod = DB::table('products')->where('id', $id)->update($data);
                if($prod){
                    //$notification = array('message'=>'Successfully Inserted', 'alert-type'=>'success');
                    return redirect()->route('list_product')->with('success','Product Added Successfully');
                }else{
                    //$notification = array('message'=>'error','alert-type'=>'error');
                    return redirect()->route('list_product')->with('error','Product Added Failed');
                }
            }else{
                return redirect()->back();
            }
        }else{
            $oldphoto = $request->old_photo;
            if($oldphoto){
                $data['product_photo']=$oldphoto;
                $user=DB::table('products')->where('id', $id)->update($data);
                if($user){
                    return redirect()->route('list_product')->with('success', 'Product Updated Successfully');
                }else{
                    return redirect()->back();
                }
            }
        }
    }
}
