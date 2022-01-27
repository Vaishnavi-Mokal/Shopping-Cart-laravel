<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Product_image;
use App\Models\Product_category;
use App\Models\Product_attribute_assoc;





class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.Product.AddProduct',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedata=$request->validate([
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'color'=>'required',
            'size'=>'required'
        ],
        [
           'name.required'=>'Name is required', 
           'description.required'=>'Description is required', 
           'price.required'=>'Price is required', 
           'color.required'=>'Color is required', 
           'size.required'=>'Size is required', 
        ]);

        if($validatedata)
        {
            $pname=$request->name;
            $pdescription=$request->description;
            $pprice=$request->price;
            $pcategory=$request->product_category;
            $pcolor=$request->color;
            $psize=$request->size;
            $product = new Product();
            $product->name=$pname;
            $product->description=$pdescription;
            $product->price=$pprice;
            $product->save();
            
            
            
            
            $productcat = new Product_category();
            $productcat->product_category=$pcategory;
            $productcat->product_id=$product->id;
            $productcat->save();

            $productattribute = new Product_attribute_assoc();
            $productattribute->color=$pcolor;
            $productattribute->size=$psize;
            $productattribute->product_id=$product->id;
            
            $productattribute->save();
            if($files=$request->file('img')){
               
                
                foreach($files as $file):
                    $pimage = new Product_image();
                    $filename=time().$file->getClientOriginalName();
                    $pimage->imagepath=$filename;
                    $pimage->product_id=$product->id;
                    //$ass->aid=$asstype->id;
                    $dest=public_path("/productimages");
                    if($file->move($dest,$filename))
                        {
                            $product->image()->save($pimage);
                        }
                endforeach;
                
            }
            return back()->with('success',"Details Added !");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $products=Product::with(['productcategory','image','attribute','category'])->get();
        return view('admin.Product.ProductList',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::where('id',$id)->first();
        $attribute=Product_attribute_Assoc::where('product_id',$product->id)->get();
        $image=Product_image::where('product_id',$product->id)->get();
        $category=Category::all();
        $selectedcategory=Product_category::where('product_id',$product->id)->first();
        return view('admin.Product.EditProduct',compact('category','product','selectedcategory','attribute','image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        
        $validate = $req->validate([
            'name'=>'required',
            'description'=>'required|min:10',
            'price'=>'required|numeric',
            'color'=>'required',
            'size'=>'required|min:1|max:5', 
        ]);
           
        if($validate){
            Product::where('id',$req->id)->update([
                'name' => $req->name,
                'description' => $req->description,
                'price' => $req->price,
               
                
            ]);
            
            if($file=$req->file('img')){
                $fname=$file->getClientOriginalName();
                    $filename=rand() . "-" . time() . "-" . $fname;
                    $dest=public_path("/productimages");
                    if($file->move($dest,$filename)){
                        Product_image::where('product_id',$req->id)->update([
                            'imagepath' => $filename
                        ]);
                    }             
            }

            
            if($files=$req->file('img'))
            {
                $productid=Product::where('id',$req->id)->first();
                foreach($files as $file):
                    $imagepath = new Product_image();
                    $fname=$file->getClientOriginalName();
                    $filename=rand() . "-" . time() . "-" . $fname;
                    $imagepath->imagepath=$filename;
                    $dest=public_path("/productimages");
                    if($file->move($dest,$filename))
                        {
                            $productid->images()->save($imagepath);
                        }
                endforeach;
            }
            if($req->attr){
                $productid = Product::where('id',$req->id)->first();
                foreach ($req->attr as $key => $value ) {
                    $att = $value;
                    $prodassoc = new Product_attribute_assoc();
                    $prodassoc->color = $att->color;
                    $prodassoc->size = $att->size;
                    $productid->attribute()->save($prodassoc);
                }
            }            
        }
        return back();
    
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_data = Product::find($id);

        if($product_data)
        {
            $attribute=Product_attribute_assoc::where('product_id',$product_data->id)->delete();
        $category=Product_category::where('product_id',$product_data->id)->delete();
        $images =  Product_image::where('product_id', $id)->get(); 
        //  print_r($images);
        //  die();
        if($images){
            foreach($images as $img)
            {
                $file = public_path('productimages/' . $img->imagepath);
                if(file_exists($file))
                {
                    unlink($file);
                    
                }
                $img->delete();
            }
            

        
            
            
        }
        
        $product_data->delete();
        return back()->with("success","Data Deleted");
        }
        else
        {
            return back()->with("errMesg","Data not Deleted");
        }
        
       
    }
}
