<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-commerce Application</title>
    <!-- plugins:css -->
   @include('admin.includes.header')
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <style>
       .cat{
           display:none;
       }
   </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      @include('admin.includes.nav')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('admin.includes.sidebar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row" id="proBanner">
              
            </div>
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-plus"></i>
                </span> Configration Management
              </h3>
            </div>

            <div class="row">
            @if(Session::has('success'))
                <div class="alert alert-success"> {{Session::get('success')}} </div>
            @endif
            @if(Session::has('errMesg'))
                <div class="alert alert-danger"> {{Session::get('errMesg')}} </div>
            @endif

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">

                    <form class="forms-sample" action="{{route('ProductUpdate')}}" method="post" enctype="multipart/form-data">
                        @csrf()
                        <input type="hidden" value="{{$product->id}}" name="id"/>
                      <div class="form-group">
                        <label for="exampleInputName1">Product Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter First Name" name="name" value="{{$product->name}}">
                      </div>
                      @if($errors->has('name'))
                            <label class="alert alert-danger">{{$errors->first('name')}}</label>
                        @endif

                        <div class="form-group">
                        <label for="exampleInputName1">Product Description</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter First Name" name="description" value="{{$product->description}}">
                      </div>
                      @if($errors->has('description'))
                            <label class="alert alert-danger">{{$errors->first('description')}}</label>
                        @endif

                        <div class="form-group">
                        <label for="exampleInputName1">Product Price</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Price" name="price" value="{{$product->price}}">
                      </div>
                      @if($errors->has('price'))
                            <label class="alert alert-danger">{{$errors->first('price')}}</label>
                        @endif

                      <div class="form-group">
                        <label for="exampleInputName1">Product Category</label>
                       
                        <select class="form-control" id="exampleSelectAssetType" name="product_category">
                            <!-- foreach render types  -->
                          @foreach($category as $cat)
                            @if($cat->id == $selectedcategory->id)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endif
                            @endforeach

                            @foreach ($category as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                          @endforeach

                          
                         
                        </select>
                       
                       

                      </div>
                      

                      @if($errors->has('product_category'))
                            <label class="alert alert-danger">{{$errors->first('product_category')}}</label>
                        @endif

                        @foreach($image as $img)
                        <div class="form-group">
                        <label for="exampleInputName1">Product Image</label>
                        <input type="file" class="form-control" id="exampleInputName1" name="img" multiple>
                        <image src="{{asset('/productimages/'.$img->imagepath)}}" width="50" height="50" />
                      </div>
                      @if($errors->has('image'))
                            <label class="alert alert-danger">{{$errors->first('image')}}</label>
                        @endif

                      @endforeach
                        @foreach($attribute as $att)
                        <div class="form-group">
                        <label for="exampleInputName1">Product Color</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Color" name="color" value="{{$att->color}}">
                      </div>
                      @if($errors->has('color'))
                            <label class="alert alert-danger">{{$errors->first('color')}}</label>
                        @endif

                        <div class="form-group">
                        <label for="exampleInputName1">Product Size</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Size" name="size" value="{{$att->size}}">
                      </div>
                      @if($errors->has('size'))
                            <label class="alert alert-danger">{{$errors->first('size')}}</label>
                        @endif

                        @endforeach

                        
                      
                      
          
                      
                      
                      <button type="submit" class="btn btn-success mr-2">Submit</button>
                      <button class="btn btn-primary">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>



            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          @include('admin.includes.footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <script type="text/javascript">
        $('#category').click(
            function()
            {
                $('#addcategory').show();
            }
        );
    </script>
    <!-- container-scroller -->
    @include('admin.includes.foot')
    <!-- End custom js for this page -->
    
  </body>
</html>