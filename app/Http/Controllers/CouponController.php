<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
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
        return view('admin.Coupon.AddCoupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'code'=>'required',
            'value'=>'required',
            'cart_value'=>'required',
            'status'=>'required'
        ],[
            'code.required'=>'Code is Required',
            'value.required'=>'Value  is Required',
            'cart_value.required'=>'cart_value is Required',
            'status.required'=>'Status is Required'
        ]);
        if($validateData)
        {
            $code=$request->code;
            $value=$request->value;
            $cart_value=$request->cart_value;
            $status=$request->status;

            $coupon=new Coupon();
            $coupon->code=$code;
            $coupon->value=$value;
            $coupon->cart_value=$cart_value;
            $coupon->status=$status;
            
            if($coupon->save())
            {
                return back()->with('success','Coupon Data Added!!');
            }
            else {
                
                return back()->with('errMesg','Coupon not Added');
            }

        }
        else {
            
            return back()->with('errMsg','Uploading Error');
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
        $coupons=Coupon::all();
        return view('admin.Coupon.CouponList',['coupons'=>$coupons]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupons=Coupon::where('id',$id)->first();
        return view('admin.Coupon.EditCoupon',['coupons'=>$coupons]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validateData=$request->validate([
            'code'=>'required',
            'value'=>'required',
            'cart_value'=>'required',
            'status'=>'required'
        ],[
            'code.required'=>'Code is Required',
            'value.required'=>'Value  is Required',
            'cart_value.required'=>'Cart Value is Required'
        ]);

        if($validateData){
            $code=$request->code;
            $value=$request->value;
            $cart_value=$request->cart_value;
            $status=$request->status;
            
            $couponid=$request->couponid;
            Coupon::where('id',$couponid)->update([
                'code'=>$request->code,
                'value'=>$request->value,
                'cart_value'=>$request->cart_value,
                'status'=>$request->status
            ]);
            return back()->with('success',"Details Added !");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Coupon::where('id',$request->aid)->delete();
        return back();
    }
}
