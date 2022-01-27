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
                </span> User Management
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

                    <form class="forms-sample" action="{{route('UpdateConfig')}}" method="post">
                        @csrf()
                        <input type="hidden" name="configid" value="{{$configdata['id']}}"/>
                      <div class="form-group">
                        <label for="exampleInputName1">Config Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Name" name="name" value="{{$configdata['name']}}">
                      </div>
                      @if($errors->has('name'))
                            <label class="alert alert-danger">{{$errors->first('name')}}</label>
                        @endif

                      <div class="form-group">
                        <label for="exampleInputName1">Config Value</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Value" name="value" value="{{$configdata['value']}}">
                      </div>
                      @if($errors->has('value'))
                            <label class="alert alert-danger">{{$errors->first('value')}}</label>
                        @endif

                      
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