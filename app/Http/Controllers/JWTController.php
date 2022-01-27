<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\ContactUs;
use App\Models\Banner;
use App\Models\CMS;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product_category;
use App\Models\Product_attribute_assoc;
use App\Models\Product_image;
use App\Models\Product;
use App\Models\UserDetails;
use App\Models\OrderDetails;
use App\Models\Order;
use App\Mail\registermail;
use App\Mail\contactusmail;
use App\Mail\ordermail;
use App\Models\Configuration;
use App\Http\Resources\UserApiResource;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Hash;

class JWTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login','register','contactus','banner','category','product','show','checkout','CMSDetails','MyOrder','Coupons']]);
    }

    public function register(Request $request){
        $validator=Validator::make($request->all(),[
            'firstname'=>'required|min:2|alpha',
            'lastname'=>'required|min:2|alpha',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:6|max:12',
            
        ]);
        Mail::to($request->email)->send(new registermail($request->all()));
       
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else {
            $user=User::create([
                'firstname'=>$request->firstname,
                'lastname'=>$request->lastname,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'status'=>$request->status ?? 'active',
                'role' => $request->role ?? 'Customer',
            ]);
            return response()->json([
                'message'=>'User create successfully',
                'user'=>$user
            ],201);
        }
    }

    public function login(Request $request){
        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required|min:6|max:12',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else {
            
            $user=User::where('email',$request->email)->first();
            if($user->status=='active')
            {
                if(!$token=auth()->attempt($validator->validated()))
                {
                    return response()->json(['token'=>$token,'error'=>0,'message'=>'Login Successfully','status'=>'active','email'=>$request->email],200);
                }
                
            }
            else{
                return response()->json(['token' => '','error'=>0, 'message' => 'User is inactive.', 'status' => 'in-active']);

            }

        }
        return response()->json(['token' => $token,'error'=>0 ,'message' => 'Login successfully.', 'status' => 'active', 'email'=>$request->email],200);
            // return $this->respondWithToken($token);
            
        
    }


    public function contactus(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:2|alpha',
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required|min:6',
          
        ]);
        // $config=[];
        $configs=Configuration::select("value")->whereIn("name",["contact_email","admin_email"])->get();
        
        foreach($configs as $con)
        {
            Mail::to($con->value)->send(new contactusmail($request->all()));

        }
      
        
        
      
        
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else {
            $contactus=ContactUs::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'subject'=>$request->subject,
                'message'=>$request->message,
               
            ]);
            
            return response()->json([
                'error'=>1,
                'contact'=>$contactus,
                'config'=>$configs
            ],201);
        }
    }

    public function banner()
    {
        $banner = Banner::all();
        foreach($banner as $ban){
            $listbanner[]=[
                'name'=>$ban->name,
                'image'=> asset('Banners/'.$ban->image)
              ];
          }
 
        return response()->json(['banner' => $listbanner]);
    }



    public function category()
    {
        $category = Category::all();
        foreach($category as $cat){
            $listcat[]=[
                'id'=>$cat->id,
                'name'=>$cat->name,
              ];
          }
 
        return response()->json(['category' => $listcat]);
    }

    public function product()
    {
        
        $products = Product::with('image','attribute')->get();
        return response()->json(['products' => $products]);



        // foreach($product as $prod){
        //   foreach($prod->image as $image){
        //         $listimage[]=[
        //             'imagepath'=> asset('productimages/'.$image->imagepath)
        //           ];
        //   }       
        //     $list[]=[
        //         'name'=>$prod->name,
        //         'pid'=>$prod->id,
        //         'category'=>$prod->productcategory,
        //         'attributes'=>$prod->attribute,
        //         'imagepath'=>$listimage,
        //     ];
        //     $listimage=[];
        // }
    
    }

    public function show($id)
    {
        $list = [];
        $product = Product::join('product_categories','products.id','=','product_categories.product_id')->where('product_categories.product_category',$id)->get();
        foreach ($product as $prod) {
            foreach($prod->image as $image){
                $listimage[]=[
                    'image'=> asset('productimages/'.$image->imagepath)
                  ];
          }
            $list[] = [
                'name' => $prod->name,
                'price' => $prod->price,
                'pid' => $prod->id,
                'category'=>$prod->productcategory,
                'attributes'=>$prod->attribute,
                'images'=>$listimage,
            ];
            $listimage = [];

        }
        return response()->json(['categorybyid' => $list]);
        
    }
 
    public function profile(){
        $profile=auth('api')->user();
         return response()->json(['profile'=>$profile]);
    }


    public function changePassword(Request $request){


        $validator = Validator::make($request->all(), [
            'oldpass'=>'required',
            'newpass'=>'required|min:6|max:100',
            'confirmpass'=>'required|same:newpass'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'=>'Validations fails',
                'error'=>$validator->errors()
            ],422);
        }

        $user=User::where('email',$request->email)->first();
        if(Hash::check($request->oldpass,$user->password)){
            $user->update([
                'password'=>Hash::make($request->newpass)
            ]);
            return response()->json([
                'message'=>'Password successfully updated',
            ],200);
        }else{
            return response()->json([
                'message'=>'Old password does not matched'
            ],400);
        }

    }

    public function checkout(Request $req){
        // return response()->json($req->all());
        $uemail = $req->email;

        $user = User::where('email',$uemail)->first();
        $userdetails = new UserDetails();
        $userdetails->user_id = $user->id;
        $userdetails->email = $req->email;
        $userdetails->firstname = $req->firstname;
        $userdetails->lastname = $req->lastname;
        $userdetails->address1 = $req->address1;
        $userdetails->zip = $req->zip;
        $userdetails->phone = $req->phone;
        $userdetails->shipping = $req->shipping;
        $userdetails->save();

        $userdetail = UserDetails::latest()->first();

        $orders = $req->product;
    
            foreach($orders as $ord)
            {
                $order = new Order();
                $order->userdetail_id = $userdetail->id;
                $order->product_id = $ord['pid'];
                $order->save();

                
                $orderdetail = new OrderDetails();
                $orderdetail->userdetail_id = $userdetail->id;
                $orderdetail->order_id = $order->id;
                $orderdetail->producttotal = $req->producttotal;
                $orderdetail->finalTotal = $req->finalTotal;
                $orderdetail->coupon_id =$req->coupon;
                $orderdetail->save();


            }
           
            
        
            Mail::to($req->email)->send(new ordermail($req->all()));
            return response()->json(['msg'=>"Order Placed Successfully !"]);
    }

    public function CMSDetails()
    {
        $services = CMS::all();
        foreach($services as $c){
            $listbanner[]=[
                'title'=>$c->title,
                'description'=>$c->description,
                'image'=> asset('/cms'.$c->image)
              ];
          }
 
        return response()->json(['services' => $listbanner]);
    }

    public function MyOrder(){
        $user=auth()->guard('api')->user();
        $userdetail = UserDetails::where('user_id',$user->id)->get();
        // return response()->json($userdetail);
        $list=[];
        foreach($userdetail as $udetail)
        {
            $orderdetail = OrderDetails::where("userdetail_id",$udetail->id)->get();
            $orders = Order::where("userdetail_id",$udetail->id)->get();
            $list[]=[
                'user_detail'=>$udetail,
                'order_detail'=>$orderdetail,
                'orders'=>$orders
            ];
        }
        
        // $orderdetails = ["userdetail"=>$userdetail,"orderdetail"=>$orderdetail,"orders"=>$orders];
        return response()->json($list);
    }

    public function Coupons(){
        $coupon = Coupon::where('status','active')->get();
        return response(['coupons'=>UserApiResource::collection($coupon)]);
    }



    public function logout(){
        auth()->logout();
        return response()->json(["message"=>"User Logout Successfully"]);
    }

    public function respondWithToken($token){
        return response()->json([

            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth()->factory()->getTTL()*60
        ]);
    }
    
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
