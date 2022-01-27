<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-commerce Application</title>
    <!-- plugins:css -->
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
                  <i class="mdi mdi-plus"></i>
                </span> Coupon Management
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

                    <form class="forms-sample" action="{{route('CouponUpdate')}}" method="post">
                        @csrf()
                        <input type="hidden" name="couponid" value="{{$coupons['id']}}"/>
                      <div class="form-group">
                        <label for="exampleInputName1">Code</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter First Name" name="code" value="{{$coupons['code']}}">
                      </div>
                      @if($errors->has('code'))
                            <label class="alert alert-danger">{{$errors->first('code')}}</label>
                        @endif


                        <div class="form-group">
                        <label for="exampleInputName1">Value</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Last Name" name="value" value="{{$coupons['value']}}">
                      </div>
                      @if($errors->has('value'))
                            <label class="alert alert-danger">{{$errors->first('value')}}</label>
                        @endif

                        <div class="form-group">
                        <label for="exampleInputName1">Cart Value</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Last Name" name="cart_value" value="{{$coupons['cart_value']}}">
                      </div>
                      @if($errors->has('cart_value'))
                            <label class="alert alert-danger">{{$errors->first('cart_value')}}</label>
                        @endif

                        <div class="form-group">
                            <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active" value="{{$coupons['status']}}">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Active
                            </label>

                            </div>
                            <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="in-active" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                In-Active
                            </label>
                            </div>
                        </div>
                      
                      
          
                      
                      
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
    <!-- container-scroller -->
    @include('admin.includes.foot')
    <!-- End custom js for this page -->
  </body>
</html>