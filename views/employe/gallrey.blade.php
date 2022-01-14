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
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

    @include('layouts.includes.headerbar')
    <!-- Left Sidebar -->
    @include('layouts.includes.employesidebar')
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
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
                    <button class="btn btn-lg btn-primary margin-5 text-white" data-toggle="modal"
                        data-target="#exampleModal">Upload Files</button>
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
            <div class="row el-element-overlay" id="galleryImages">
                @include('employe.filegallrey')
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Files</h5>
                            <button type="button" class="close btn-secondary" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('dropzone')}}" id="form1" method="POST">
                                <div class="dropzone dropzone-default" id="my-dropzone" style="margin-bottom:15px;">
                                    <div class="dropzone-msg dz-message needsclick">
                                        <h3 class="dropzone-msg-title">Drop files here or
                                            click to upload.</h3>
                                        <span class="dropzone-msg-desc">Drop module images here.</span>
                                        <div class="fallback">
                                            <input name="files" type="file" id="files" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="buttondismiss"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" style="position:relative">
                                        <img
                                            style="postion:absolute; z-index:1; height:20px " id="loadingpic"
                                            src="https://i.gifer.com/origin/b4/b4d657e7ef262b88eb5f7ac021edda87.gif"
                                            alt="">
                                        Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer text-center">
                All Rights Reserved by Matrix-admin. Designed and Developed by
                <a href="https://www.wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    @endsection


    @section('footerJs')
    
    <script>
        $("#loadingpic").css("display", "none");
        jQuery(document).ready(function () {
            $("#my-dropzone").dropzone({
                maxFiles: 5,
                method: "post",
                maxFilesize: 10,
                clickable: true,
                paramName: "files",
                uploadMultiple: true,
                parallelUploads: 5,
                addRemoveLinks: true,
                autoProcessQueue: false,
                url: "{{route('dropzone')}}",
                acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.ppt,.docx,.txt,.xlsx,.xls,.csv",
                dictDefaultMessage: "Drop your photos here or Click to upload",
                dictRemoveFile: "<i class='fa fa-times cross-btn'>x</i>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                init: function () {
                    wrapperThis = this;
                    this.on("error", function (file) {
                        if (!file.accepted) {
                            alert(
                                "Invalid file upload only (.jpeg,.jpg,.png,.pdf,.doc,.ppt,.docx,.txt,.xlsx,.xls,.csv) images files are allowed."
                            );
                            return false;
                        }
                    });
                    this.on("canceled", function (file) {
                        this.removeFile(file);

                    });
                    this.on("queuecomplete", function (file, responce) {
                        // $(".succ").css("display", "block");

                    });
                    this.on("success", function (file, responseText) {
                        this.removeAllFiles();
                        $('#galleryImages').html('');
                        $('#galleryImages').html(responseText);
                        $('#buttondismiss').click();
                         $("#loadingpic").css("display", "none");

                        Swal.fire({
                            type: 'success',
                            title: 'save',
                            text: 'Record saved Successfully'
                        }).then(function () {
                            //location.reload();
                        });
                        $('#form1')['0'].reset();
                        //myDropzone.removeFile(file);
                    });
                    this.on("sending", function (file, xhr, formData) {
                         $("#loadingpic").css("display", "block");
                        let module_ids = $("input[name='status[]']")
                            .map(function () {
                                if ($(this).is(':checked')) {
                                    return $(this).val();
                                }
                            }).get();
                        var data = $('#form1').serializeArray();
                        $.each(data, function (key, el) {
                            formData.append(el.name, el.value);
                        });

                    });
                    this.on('maxfilesreached', function () {
                        this.removeEventListeners();
                    });
                    this.on('removedfile', function (file) {
                        this.setupEventListeners();

                    });
                },
            });
        });

        // implement dropzone 1
        $(document).on('submit', '#form1', function (e) {
            e.preventDefault();
            e.stopPropagation();
            if (wrapperThis.getQueuedFiles().length > 0) {
                wrapperThis.processQueue();
            } else {
                Swal.fire({
                    type: 'danger',
                    title: 'Requird',
                    text: 'Please Upload Files!'
                }).then(function () {
                    //location.reload();
                });
                return false;
            }
        });

        $(document).on('click', '.delete', function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            if (confirm('Are you sure You want to delete!')) {
                $.ajax({
                    url: '{{route("deletefiles")}}',
                    type: 'post',
                    data: {
                        id: id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('#galleryImages').html('');
                        $('#galleryImages').html(data);
                    }
                });
            }
        });

    </script>
    @endsection
