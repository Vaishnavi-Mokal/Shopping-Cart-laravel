<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;


class CategoryController extends Controller
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
        return view('admin.Category.AddCategory');
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
            
        ],[
            'name.required'=>'Name is Required',
            
        ]);

        if($validateData)
        {
            $name=$request->name;

            $category=new Category();
            $category->name=$name;
            

            if($category->save())
            {
                return back()->with('success','Category Data Added!!');
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
        $categorydata=Category::all();
        return view('admin.Category.CategoryList',['categorydata'=>$categorydata]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorydata=Category::where('id',$id)->first();
        return view("admin.Category.EditCategory",['categorydata'=>$categorydata]);
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
            
        ],[
            'name.required'=>'Name is Required',
            
        ]);

        if($validateData){
            $cname=$request->name;
           
            
            $catid=$request->catid;
            Category::where('id',$catid)->update([
                'name'=>$request->name
            ]);
            return back()->with('success',"Details Added !");
        }
    }

    public function categories()
    {
        return CategoryResource::collection(Category::all());
        // return Category::all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Category::where('id',$request->aid)->delete();
        return back();
    }
}
