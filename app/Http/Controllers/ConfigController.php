<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;


class ConfigController extends Controller
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
        return view('admin.Configration.AddConfig');
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
            'name'=>'required',
            'value'=>'required'
        ],[
            'name.required'=>'Name is Required',
            'value.required'=>'Value is Required'
        ]);

        if($validateData)
        {
            $cname=$request->name;
            $cvalue=$request->value;

            $config=new Configuration();
            $config->name=$cname;
            $config->value=$cvalue;

            if($config->save())
            {
                return back()->with('success','Config Data Added!!');
            }
            else {
                
                return back()->with('errMesg','Data not Added');
            }
        }
        else {
            
            return back()->with('errMesg','Uploading Error');
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
        $configdata=Configuration::all();
        return view('admin.Configration.ConfigList',['configdata'=>$configdata]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $configdata=Configuration::where('id',$id)->first();
        return view('admin.Configration.EditConfig',compact('configdata'));
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
            'name'=>'required',
            'value'=>'required'
        ],[
            'name.required'=>'Name is Required',
            'value.required'=>'Value  is Required'
            
        ]);

        if($validateData){
            $cname=$request->name;
            $cvalue=$request->value;
            
            $configid=$request->configid;
            Configuration::where('id',$configid)->update([
                'name'=>$request->name,
                'value'=>$request->value
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
        Configuration::where('id',$request->aid)->delete();
        return back();
    }
}
