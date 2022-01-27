<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-commerce Application</title>
    @include('admin.includes.header')
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
                  <i class="mdi mdi-table-large"></i>
                </span> Product Management
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div>
              
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success"> {{Session::get('success')}} </div>
            @endif
            @if(Session::has('errMesg'))
                <div class="alert alert-danger"> {{Session::get('errMesg')}} </div>
            @endif


            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                   
                    <table class="table table-hover" id="example1" width="100%">
                      <thead>
                      <tr class="text-center"><a href="{{route('productdata')}}" class="btn btn-success btnn" role="button">ADD Product</a></tr>
                        <tr>
                            <th class="text-center">Sr No</th>
                            <th class="text-center">Product Name</th>
                            <th class="text-center">Product Description</th>
                            <th class="text-center">Product Price</th>
                            <th class="text-center">Product Category</th>
                            <th class="text-center">Product Image</th>
                            <th class="text-center">Product Color</th>
                            <th class="text-center">Product Size</th>
                            <th class="text-center">Action</th>

                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($products as $product)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{$product['name']}}</td>
                                <td class="text-center">{{$product['description']}}</td>
                                <td class="text-center">{{$product['price']}}</td>
                               
                                @foreach($product->productcategory as $cat)
                                <td class="text-center">{{$cat->product_category}}</td>
                                @endforeach
                                
                                
                                  @foreach($product->image as $img)
                                  <td class="text-center"><img src="{{asset('/productimages/'.$img->imagepath)}}" width="50" height="50"></td>
                                  @endforeach
                                
                                
                                  @foreach($product->attribute as $att)
                                  <td class="text-center">{{$att->color}}</td>
                                  <td class="text-center">{{$att->size}}</td>
                                  @endforeach
                                
                                <td class="text-center"><a href="{{url('EditProduct/'.$product->id)}}" class="btn btn-info" role="button">Edit </a> 
                                 <a  href="javascript:void(0)" class="btn btn-danger dtlpro" aid="{{ $product['id'] }}"  role="button"> Delete</a></td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

          <table>  
          
          <style>
              .w-5{
               
                display: -webkit-flex;
                display: -ms-flexbox;
                display: none;
                padding-left: 0;
                list-style: none;
                border-radius: 0.25rem;
              }
              .btnn{
                padding-left:10;
              }
          </style>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    $(".dtlpro").click(function(e){
                      var aid = $(this).attr("aid");
                        if(confirm(" Your Product will be deleted !!")){
                          
                            //alert(aid);
                            $.ajax({
                                url:"{{url('/deleteproduct')}}/"+aid,
                                type:'get',
                                data:{_token:'{{csrf_token()}}',aid:aid},
                                success:function(response){
                                  alert('Data deleted');
                                  window.location.reload();
                              },
                              error: function(jqXHR, status, err){
                                
                                  window.location.reload();
                              }
                            })
                        }
                        else{
                            alert(" Action Cancelled !")
                        }
                    })
                });
                
            </script>
          
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © <a href="#" target="_blank">vaishu12@gmail.com</a>   2021</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> NeoSOFT Technologies</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.includes.footer')
   
    <!-- End custom js for this page -->
  </body>
</html>