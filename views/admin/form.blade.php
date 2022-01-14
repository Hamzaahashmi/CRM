@extends('layouts.app')


@section('content')
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

@include('layouts.includes.headerbar')
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
@include('layouts.includes.sidebar')
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Form Wizard</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Library
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="card">
            <div class="card-body wizard-content">
                <h4 class="card-title">Basic Form Example</h4>
                <h6 class="card-subtitle"></h6>
                <form id="employe-form" method="POST" action="" class="mt-5" enctype="multipart/form-data">
                   @csrf
                    <div>
                         <h3>Account</h3>
                         <section>
                            <label for="userName">Email *</label>
                            <input id="email" name="email" type="email" class="required form-control" />
                            <label for="password">Password *</label>
                            <input id="password" name="password" type="password" class="required form-control" />
                            <label for="confirm">Confirm Password *</label>
                            <input id="confirm" name="confirm" type="password" class="required form-control" />
                            <p>(*) Mandatory</p>
                        </section>
                        <h3>Profile</h3>
                        <section>
                            <label for="name">Name *</label>
                            <input id="name" name="name" type="text" class="required form-control" />
                            
                            <label for="dob">Date Birth*</label>
                            <input id="datepicker-autoclose" name="dob" type="date" class="required form-control"  />
                            
                            <label for="phone">Phone NO </label>
                            <input id="phone" name="phone" type="number" class="form-control" />

                            <label for="image">Profile Picture</label>
                            <input id="image" name="image" type="file" class="form-control" />
                            <p>(*) Mandatory</p>

                        </section>
                        <h3>Designation</h3>
                        <section>
                            <label for="salry">Role</label>
                            <select
                        class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px"
                        name='role' >
                       <option selected>select role..</option>
                      @foreach ($roles as $role )
                      
                          <option  value='{{$role->title}}'> {{$role->title}}</option>
                      @endforeach
                      </select>
                            <label for="salry">Initial Sallary</label>
                            <input id="salry" name="salry" type="number" class="form-control" />
                        </section>
                        <h3>Finish</h3>
                        <section>
                            <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required" />
                            <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                            <div id="submit_button"></div>
                        </section>
                    </div>
                </form>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer text-center">
        All Rights Reserved by Matrix-admin. Designed and Developed by
        <a href="https://www.wrappixel.com">WrapPixel</a>.
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
@endsection
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->

@section('footerJs')
<script>
    var eighteenYearsAgo = new Date();
     eighteenYearsAgo = eighteenYearsAgo.setFullYear(eighteenYearsAgo.getFullYear()-18);
     var todayDate = new Date(eighteenYearsAgo).toISOString().slice(0, 10);
     $('#datepicker-autoclose').attr('max',todayDate);
    // Basic Example with form
    var form = $("#employe-form");
    form.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.before(error);
        },
        rules: {
            confirm: {
                equalTo: "#password",
            },
        },
    });
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex) {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex) {

            $( "#submit_button" ).append( "<input style='display:none' type='submit' id='test' value='submit'/>" );
           $('#test').click();
         },
    });
    

    $(document).on('submit', '#employe-form', function (e) {
                e.preventDefault();
             
     let formData = new FormData(this);
         $.ajax({
          type:'POST',
          url: '{{route("create")}}',
           data: formData,
           contentType: false,
           processData: false,
           success: (response) => {
             if (response == 'ok') {
              Swal.fire({
                            type: 'success',
                            title: 'save',
                            text: 'Record saved Successfully'
                        }).then(function () {
                          location.replace('{{route("allemployee")}}');
                        
                        });  
             }
              $('#employe-form')['0'].reset();
           },
           
          });
            });

</script>
@endsection