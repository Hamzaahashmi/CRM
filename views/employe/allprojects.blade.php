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
    @include('layouts.includes.employesidebar')
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
                    <h5 class="card-title">Projects</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Assign</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                @foreach ($projects as $project)
                                <tr id="student_{{$project['id']}}">
                                    <td class=""><b>{{$project['title']}}</b></td>
                                    <td><?php echo $project['description'] ?></td>
                                    <td>{{username($project['assign_user'])}}</td>
                                    <td><a data-id="" href="{{route('kanban',['id'=>$project['id']])}}"
                                            class="btn btn-outline-primary ">View tickets</a>
                                        
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
        //  multi select2 default js code
        $(document).ready(function () {
            $(".mul-select").select2({
                placeholder: "Select Employes",
            });
        });
        $(document).ready(function () {
            $('#summernotes2').summernote();
        });

        //    Add New Project 

        $(document).on('submit', '#addprojectform', function (e) {
            e.preventDefault();
            var txt = $(".note-editable").html();
            $("#summernoteinput2").val(txt);
            $.ajax({
                type: "POST",
                url: '{{route("addproject")}}',
                data: $('#addprojectform').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data === 'success') {
                        // $('#AddprojectModal').modal('toggle');
                        $('#addprojectform').trigger("reset");
                    } else {
                        $('.successmsg').html("Can't Save");


                    }
                }
            });
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
