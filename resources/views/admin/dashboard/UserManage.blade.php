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

                    <form class="forms-sample" action="{{route('UserStore')}}" method="post">
                        @csrf()
                      <div class="form-group">
                        <label for="exampleInputName1">First Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter First Name" name="firstname">
                      </div>
                      @if($errors->has('firstname'))
                            <label class="alert alert-danger">{{$errors->first('firstname')}}</label>
                        @endif

                      <div class="form-group">
                        <label for="exampleInputName1">Last Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Last Name" name="lastname">
                      </div>
                      @if($errors->has('lastname'))
                            <label class="alert alert-danger">{{$errors->first('lastname')}}</label>
                        @endif

                      <div class="form-group">
                        <label for="exampleInputName1">Email</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Email ID" name="email">
                      </div>
                      @if($errors->has('email'))
                            <label class="alert alert-danger">{{$errors->first('email')}}</label>
                        @endif

                      <div class="form-group">
                        <label for="exampleInputName1">Password</label>
                        <input type="password" class="form-control" id="exampleInputName1" placeholder="Enter Password" name="password">
                      </div>
                      @if($errors->has('password'))
                            <label class="alert alert-danger">{{$errors->first('password')}}</label>
                        @endif

                      
                        <div class="form-group">
                            <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active">
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

                      
                      <div class="form-group">
                        <label for="exampleSelectAssetType">Roles</label>
                        <select class="form-control" id="exampleSelectAssetType" name="role">
                            <!-- foreach render types  -->
                            @foreach($roles as $role)
                          <option value="{{$role->role_name}}">{{$role['role_name']}}</option>
                          @endforeach
                          
                          
                        </select>
                      </div>            
                      @if($errors->has('role'))
                            <label class="alert alert-danger">{{$errors->first('role')}}</label>
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