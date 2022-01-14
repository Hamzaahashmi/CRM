@extends('layouts.app')


@section('content')
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
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
                <h4 class="page-title">All Record</h4>
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
                <div class="card-body">
                    <h5 class="card-title">Basic Datatable</h5>
                    <div class="table-responsive">
                        <table
                            id="zero_config"
                            class="table table-striped table-bordered"
                        >
                            <thead>
                            <tr>
                                <th scope="col">Profile</th>
                                <th >Name</th>
                                <th >Email</th>
                                <th >DOB</th>
                                <th >Role</th>
                                <th >Phone</th>
                                <th >Delete</th>
                                
                            </tr>
                            </thead>
                            <tbody class="table-body">
                            @foreach ($users as $user)
                                <tr id="student_{{$user['id']}}">
                                    <td><img src="{{asset($user['image'])}}"  style="height:50px; width:50px; border-radius: 25px" alt=""></td>
                                    <td>{{$user['name']}}</td>
                                    <td>{{$user['email']}}</td>
                                    <td>{{$user['dob']}}</td>
                                    <td>{{$user['role']}}</td>
                                    <td>{{$user['phone']}}</td>
                                    <td><a data-id="{{$user->id}}" class="btn btn-outline-danger delete">delete</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
       
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

@section('footerJs')
<script>
     $(document).ready(function() {
    $('#summernotes2').summernote();
    });
// Delete user

    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        if (confirm('Are you sure You want to delete!')) {
            $.ajax({
                url: '{{route("delete")}}',
                type: 'post',
                data: {
                    id: id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data === 'success') {
                        $('#student_' + id).remove();
                    }
                }
            });
        }
    });

</script>
@endsection