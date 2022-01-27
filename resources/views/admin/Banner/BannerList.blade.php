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
                </span> Banner Management
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

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                   
                    <table class="table table-hover" id="example1" width="100%">
                      <thead>
                      <tr class="text-center"><a href="{{route('bannerdata')}}" class="btn btn-secondary" role="button">ADD Data</a></tr>
                        <tr>
                            <th class="text-center">Sr No</th>
                            <th class="text-center">Banner Name</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Action</th>

                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($bannerdata as $data)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{$data['name']}}</td>
                                <td class="text-center"><img src="{{asset('/Banners/'.$data->image)}}" width=50 height=50 /></td>
                                <td class="text-center"><a href="EditBanner/{{ $data['id'] }}" class="btn btn-info" role="button">Edit </a> 
                                 <a  href="javascript:void(0)" class="btn btn-danger dtlpro" aid="{{ $data['id'] }}"  role="button"> Delete</a></td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

          <table>  
          
          <style>
              
          </style>

          <!-- delete data from table -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    $(".dtlpro").click(function(e){
                        var aid = $(this).attr("aid");
                        if(confirm(" Your Banner Data will be deleted !!")){
                            //alert(aid);
                            $.ajax({
                                url:"{{url('/DeleteBanner')}}",
                                type:'post',
                                method:'patch',
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