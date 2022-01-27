<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;


class BannerController extends Controller
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
        return view('admin.Banner.AddBanner');
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
            'image'=>'required|mimes:jpg,png,jpeg'
        ],['name.required'=>'Name is required']);
       
            $name=$request->name;
            $image=$request->file('image');
            $dest=public_path('/Banners');
            $fname="Image-".rand()."-".time().".".$image->extension();

            if($image->move($dest,$fname))
            {
                $banner=new Banner();
                $banner->name=$name;
                $banner->image=$fname;
                if($banner->save())
                {
                    return back()->with('success','Banner Image Added');
                }
                else
                {
                    $path=public_path()."Banners/".$fname;
                    unlink($path);
                    return back()->with('errMsg','Banner Image not Added');
                }
    
            }
            else
            {
                return back()->with('errMesg',"Uploading error");
    
            }


            $banner=new Banner();
            $banner->name=$name;
            $banner->image=$image;
            
            
            if($banner->save())
            {
                return back()->with('success','Banner Image Added!!');

            }
            else
            {
                return back();
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
        $bannerdata=Banner::all();
        return view("admin.Banner.BannerList",['bannerdata'=>$bannerdata]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bannerdata=Banner::where('id',$id)->first();
        return view("admin.Banner.EditBanner",['bannerdata'=>$bannerdata]);
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
        $validate=$request->validate([
            'name'=>'required|min:5|max:150',
            'image'=>'required|mimes:jpg,png,jpeg',
        ]);
    if($validate){
       $name=$request->name;
       $file=$request->file('image');
       $dest=public_path('/Banners');
       $fname="Image-".rand()."-".time().".".$file->extension();
       if($file->move($dest,$fname))
       {
            $bannerid=$request->bannerid;
           Banner::where('id',$bannerid)->update([
            'name'=>$name,
            'image'=>$fname,

           ]);
           return back()->with('success','Banner Data Updated');
        }
        else{
               $path=public_path()."Banners/".$fname;
               unlink($path);
               return back()->with('error','banner could not added');
           }
       }
       else {
           return back()->with('error','Uploading Error');
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
        $bannerdata=Banner::where('id',$request->aid)->first();
        $image=public_path().'/Banners/'.$bannerdata->image;
        $bannerdata=Banner::find($request->aid);
        if($bannerdata->delete())
        {
            unlink($image);
            return "Banner Deleted";

        }
        else{
            return "Banner Not Deleted";

        }
    }
}
