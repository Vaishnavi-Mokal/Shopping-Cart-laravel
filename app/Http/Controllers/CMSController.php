<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CMS;


class CMSController extends Controller
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
        return view('admin.CMS.Addcms');
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
            'title'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:jpg,png,jpeg'
        ],
        ['name.required'=>'Name is required']);
       
            $title=$request->title;
            $description=$request->description;
            $image=$request->file('image');
            $dest=public_path('/cms');
            $fname="Image-".rand()."-".time().".".$image->extension();

            if($image->move($dest,$fname))
            {
                $banner=new CMS();
                $banner->title=$title;
                $banner->description=$description;
                $banner->image=$fname;
                if($banner->save())
                {
                    return back()->with('success','CMS Added');
                }
                else
                {
                    $path=public_path()."cms/".$fname;
                    unlink($path);
                    return back()->with('errMesg','CMS images not Added');
                }
    
            }
            else
            {
                return back()->with('errMesg',"Uploading error");
    
            }


            $banner=new CMS();
            $banner->title=$title;
            $banner->description=$description;
            $banner->image=$image;
            
            
            if($banner->save())
            {
                return back()->with('success','CMS Image Added!!');

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
        $cms=CMS::all();
        return view("admin.CMS.CmsList",['cms'=>$cms]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cms=CMS::where('id',$id)->first();
        return view("admin.CMS.Editcms",['cms'=>$cms]);
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
            'title'=>'required|min:5|max:150',
            'description'=>'required|min:10|max:150',
            'image'=>'required|mimes:jpg,png,jpeg',
        ]);
    if($validate){
       $title=$request->title;
       $description=$request->description;
       $file=$request->file('image');
       $dest=public_path('/cms');
       $fname="Image-".rand()."-".time().".".$file->extension();
       if($file->move($dest,$fname))
       {
            $bannerid=$request->bannerid;
           CMS::where('id',$bannerid)->update([
            'title'=>$title,
            'description'=>$description,
            'image'=>$fname,

           ]);
           return back()->with('success','CMS Data Updated');
        }
        else{
               $path=public_path()."cms/".$fname;
               unlink($path);
               return back()->with('error','CMS data could not added');
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
        $bannerdata=CMS::where('id',$request->aid)->first();
        $image=public_path().'/cms/'.$bannerdata->image;
        $bannerdata=CMS::find($request->aid);
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
