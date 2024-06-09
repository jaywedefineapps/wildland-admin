@extends('layouts.master')
@section('css')
@endsection
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div>
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{ $page }}</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ URL::to('/admin/dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">{{ $title }}</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-body">

                    </div>
                    <!--end::Card toolbar-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <!--begin::Add customer-->
                            {{-- <button type="button" class="btn btn-primary" data-role='addType' data-bs-toggle="tooltip" data-bs-dismiss="click" title="Create merchant" data-bs-custom-class="tooltip-dark">Add</button> --}}
                            <!--end::Add customer-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none"
                            data-kt-customer-table-toolbar="selected">
                            <div class="fw-bolder me-5">
                                <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected
                            </div>
                        </div>
                        <!--end::Group actions-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <form id="myForm" action="{{ route('admin.update.profile') }}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <label class="required fs-6 fw-bold mb-2" for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="" value="{{ old('name',Auth::guard('admin')->user('name')) }}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-4">
                                    <label class="required fs-6 fw-bold mb-2 bg-white" for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id=""
                                        autocomplete="off" readonly value="{{ old('email',Auth::guard('admin')->user('email')) }}">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="password" class="text-gray-700 select-none font-medium">Password</label>
                                    <input class="form-control" id="password" type="password" name="password"
                                        placeholder="Enter Password" minlength="" value="{{ old('password') }}"/>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-4">
                                    <label for="password_confirmation" class="text-gray-700 select-none font-medium">Confirm
                                        Password</label>
                                    <input class="form-control" id="password_confirmation" type="password"
                                        name="password_confirmation" placeholder="Re-enter Password" value="" />
                                    <label for="" id="message"></label>
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

    <!--begin::Modal - Service - Details-->

    <!--end::Modal-->
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

    <script>
        $("input").on("keypress", function(e) {
            if (e.which === 32 && !this.value.length)
                e.preventDefault();
        });

        $("#password_confirmation").keyup(function() {
            var password = $("#password").val();
            var confirmPassword = $("#password_confirmation").val();

            if (password != confirmPassword) {
                $("#message").html("Passwords do not match!").css("color", "red");
                return false;
            } else {
                $("#message").html("Passwords match!").css("color", "green");
                return true;
            }
        });

        // $("#password").keyup(function() {
        //     var password = $("#password").val();
        //     var confirmPassword = $("#password_confirmation").val();

        //     if (password != confirmPassword) {
        //         // $("#message").html("Passwords do not match!").css("color", "red");
        //         $("#message").html("Passwords do not match!").css("color", "red");
        //         return false;
        //     } else {
        //         $("#message").html("Passwords match!").css("color", "green");
        //         return true;
        //     }




        // });



        $("#myForm").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 50
                },
                email: {
                    // required: true,
                    email: true,
                    maxlength: 100
                },
                password_confirmation: {
                    equalTo: "#password"
                },
            },
            messages: {
                "name": {
                    required: "Please Enter Your Name.",
                    maxlength: "Please enter no more than {0} characters"
                },
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                password_confirmation: {
                    equalTo: "Please enter the same Password again."
                },
            }

        });
    </script>
@endsection
