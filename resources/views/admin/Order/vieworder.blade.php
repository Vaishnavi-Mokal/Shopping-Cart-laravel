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
                </span> Order Management
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
                   
                  <table class="table" id="example1">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer Email</th>
                        <th scope="col">Customer Address</th>
                        <th scope="col">Customer Phone</th>
                        <th scope="col">Customer ZipCode</th>
                        <th scope="col">Order Amount</th>
                        <th scope="col">Order Amount (Coupons)</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userdetails as $detail )
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$detail->firstname}} {{$detail->lastname}}</td>
                                <td>{{$detail->email}}</td>
                                <td>{{$detail->address1}}</td>
                                <td>{{$detail->phone}}</td>
                                <td>{{$detail->zip}}</td>
                                @foreach ($orderdetails as $ordetail)
                                    @if ($ordetail->userdetail_id == $detail->id)
                                        <td>{{$ordetail->producttotal}}</td>
                                        <td>{{$ordetail->finalTotal}}</td>
                                        
                                        
                                    @endif
                                @endforeach
                                <td><a href="displayorder/{{ $detail->id }}" class="btn btn-info btn-sm" role="button">Details</a></td>
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
                        if(confirm(" Your User will be deleted !!")){
                            //alert(aid);
                            $.ajax({
                                url:"{{url('/deleteuser')}}",
                                type:'post',
                                method:'patch',
                                data:{_token:'{{csrf_token()}}',aid:aid},
                                success:function(response){
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
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ?? <a href="#" target="_blank">vaishu12@gmail.com</a>   2021</span>
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