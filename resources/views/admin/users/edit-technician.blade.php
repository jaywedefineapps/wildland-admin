@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" />
@endsection
@section('content')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{ $page }}</h1>
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ URL::to('/admin/dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-dark">{{ $title }}</li>
                </ul>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card card-bordered">
                <div class="card-body">
                    <form action="{{ route('users.post') }}" method="post" id="kt_modal_add_business_form">
                        <input type="hidden" name="verified" value="{{isset($list->verified) ? $list->verified : 0}}">
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Heading-->
                                @csrf
                                <input type="hidden" name="id" name="id" value="{{ request()->id }}">
                                <input type="hidden" name="type" name="type" value="technician">

                                <center style="padding-top: 25px">
                                    <div class="image-input image-input-circle image-input-empty" data-kt-image-input="true"
                                        style="background-image: url({{ asset('assets/media/avatars/blank.png') }})">
                                        <!--begin::Image preview wrapper-->
                                        <div class="image-input-wrapper w-125px h-125px" id="show_image_div" loading="lazy"
                                            onclick="toggleFullScreen(this)"
                                            style="background-position:center; object-fit: contain;background-image: url('{{ isset($list->image) && $list->image != '' ? $list->profile_image : asset('assets/media/avatars/blank.png') }}')">
                                        </div>

                                        <!--end::Image preview wrapper-->
                                        <!--begin::Edit button-->
                                        <label id="pencil"
                                            class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                            data-bs-dismiss="click" title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>

                                            <!--begin::Inputs-->
                                            <input type="file" id="image" name="image"
                                                accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="hidden_base64_input" id="hidden_base64_input">
                                            <input type="hidden" name="avatar_remove" value="" />
                                            <input type="hidden" name="old_image"
                                                value="{{ isset($list) ? $list->image : '' }}" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit button-->

                                        <!--begin::Cancel button-->
                                        <span
                                            class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            data-bs-dismiss="click" title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel button-->

                                        <!--begin::Remove button-->
                                        <span
                                            class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                            data-bs-dismiss="click" title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Remove button-->
                                    </div>
                                    {{-- <label id="image-error" class="error" for="image"></label> --}}
                                </center>
                                <center>
                                    @error('image')
                                        <label class="error" for="">{{ $message }}</label>
                                    @enderror
                                </center>
                                <div class="row">
                                    <div class="fv-row mb-7 col-md-6">
                                        <label class="form-label fw-bolder text-dark fs-6">Name</label>
                                        <input class="form-control form-control-lg form-control-solid" type="text"
                                            placeholder="Name" name="name" autocomplete="off"
                                            value="{{ old('name', isset($list) ? $list->name : '') }}" />
                                        @error('name')
                                            <label class="error" for="">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="fv-row mb-7 col-md-6">
                                        <label class="form-label fw-bolder text-dark fs-6">Email</label>
                                        <input class="form-control form-control-lg form-control-solid read-only"
                                            onKeyPress="edValueKeyPress()" type="email" id="email" placeholder="Email"
                                            name="email" autocomplete="off"
                                            value="{{ old('email', isset($list) ? $list->email : '') }}" />
                                        @error('email')
                                            <label class="error" for="">{{ $message }}</label>
                                        @enderror
                                        <input type="hidden" id="hiddenEmail" name="hiddenEmail"
                                            class="form-control mt-2 read-only" value="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-bold mb-2">Phone No</label>
                                        <div class="input-group input-group">
                                            <select class="form select input-group-text" name="country_code"
                                                id="countryCode">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->code }}"  @isset($list) @selected($list->country_code == $country->code) @endisset>{{ $country->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input class="form-control" id="phone" placeholder="Phone No"
                                                name="phone" onkeyup="phoneKeyPressValue()"
                                                value="{{ old('phone', isset($list) ? $list->phone : '') }}"
                                                onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                                            <input type="hidden" id="hiddenPhone" name="hiddenPhone"
                                                class="form-control mt-2 read-only" value="">
                                        </div>
                                        @error('phone')
                                            <label class="error" for="">{{ $message }}</label>
                                        @enderror
                                        <label id="phone-error" class="error" for="phone"></label>
                                    </div>
                                    <div class="fv-row mb-7 col-md-6">
                                        <label class="form-label fw-bolder text-dark fs-6">Zipcode</label>
                                        <input class="form-control form-control-lg form-control-solid" type="text"
                                            placeholder="Zipcode" name="zipcode" autocomplete="off"
                                            value="{{ old('zipcode', isset($list) ? $list->zipcode : '') }}" />
                                        @error('zipcode')
                                            <label class="error" for="">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="fv-row mb-7 col-md-12">
                                        <label class="form-label fw-bolder text-dark fs-6">Address</label>
                                        <input class="form-control form-control-lg form-control-solid" type="text"
                                            placeholder="Address" name="address" autocomplete="off"
                                            value="{{ old('address', isset($list) ? $list->address : '') }}" />
                                        @error('address')
                                            <label class="error" for="">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-center">
                                        <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                                            <span class="indicator-label">Update</span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="display_image_model" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_category_header">
                    <!--begin::Modal title-->
                    <h2 id="model_heading" class="fw-bolder">Image Crop</h2>
                </div>
                <div class="modal-body py-10 px-lg-17">
                    <div id="display_image_div">
                        <img src="" id="sample_image" />
                    </div>
                    <button type="button" id="crop" class="btn btn-primary">Crop</button>
                    <button type="button" class="btn btn-secondary" id="cancel" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script>
        $("#pencil").on('click', function() {
            $('[data-bs-toggle="tooltip"]').tooltip('dispose');
            $('[data-bs-toggle="tooltip"]').tooltip({
                trigger: 'hover'
            })
        });
        $(document).ready(function() {
            $("#kt_modal_add_business_form").validate({
                rules: {
                    name: "required",
                    phone: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 15,
                    },
                    latitude: {
                        required: true,
                        maxlength: 15,
                    },
                    longitude: {
                        required: true,
                        maxlength: 15,
                    },
                    zipcode: {
                        required: true,
                        maxlength: 7,
                    },
                    country_id: "required",
                    province_id: "required",
                    city_id: "required",
                    address: "required",
                    countryCode: "required",
                    ar_description: "required",
                    en_description: "required",
                    ar_recommendation: "required",
                    en_recommendation: "required",
                    email: {
                        required: true,
                        email: true
                    },
                },
                messages: {
                    name: {
                        required: 'Please enter name',
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address",
                    },
                    image: {
                        required: "Please select image",
                    },
                    countryCode: {
                        required: 'Please select country code',
                    },
                    phone: {
                        required: 'Please enter phone number',
                    },
                    address: {
                        required: 'Please enter address',
                    },
                    country_id: {
                        required: 'Please enter country',
                    },
                    province_id: {
                        required: 'Please enter province',
                    },
                    city_id: {
                        required: 'Please enter city',
                    },
                    zipcode: {
                        required: 'Please enter zipcode',
                    }
                },
                submitHandler: function(form) {
                    console.log("Submit handler is called.");
                    form.submit();
                }
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            var $modal = $('#display_image_model');
            var image = document.getElementById('sample_image');
            var cropper;

            $('#image').change(function(event) {
                var files = event.target.files;
                var done = function(url) {
                    image.src = url;
                    $modal.modal('show');
                };

                if (files && files.length > 0) {
                    reader = new FileReader();
                    reader.onload = function(event) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(files[0]);
                }
            });

            $modal.on('shown.bs.modal', function() {
                cropper = new Croppie(image, {
                    viewport: {
                        width: 300,
                        height: 300,
                        type: 'square'
                    },
                    boundary: {
                        width: 400,
                        height: 400
                    },
                    enableExif: true,
                });
            }).on('hidden.bs.modal', function() {
                if (cropper) {
                    cropper.destroy();
                }
                cropper = null;
            });

            $('#crop').click(function() {
                cropper.result({
                    type: 'blob',
                    size: {
                        width: 300,
                        height: 300
                    }
                }).then(function(blob) {
                    var url = URL.createObjectURL(blob);

                    // Update the background image of the preview div
                    $('#show_image_div').css('background-image', '');
                    $('#show_image_div').css('background-image', 'url(' + url + ')');

                    // Update hidden input with base64
                    var reader = new FileReader();
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        $('#hidden_base64_input').val(base64data);
                    };
                    reader.readAsDataURL(blob);

                    $modal.modal('hide');
                });
            });

            $('#cancel').click(function() {
                if (cropper) {
                    cropper.destroy();
                }
                cropper = null;
                $('#hidden_base64_input').val('');
                $modal.modal('hide');
            });
        });
    </script>
    <script>
        function edValueKeyPress() {
            var s = $("#email").val();
            $("#hiddenEmail").val(s);
            var edValue = document.getElementById("email");
            var s = edValue.value;

            var lblValue = document.getElementById("hiddenEmail");
            lblValue.value = s;
        }

        function phoneKeyPressValue() {
            var s = $("#phone").val();
            $("#hiddenPhone").val(s);
            var edValue = document.getElementById("phone");
            var s = edValue.value;

            var lblValue = document.getElementById("hiddenPhone");
            lblValue.value = s;
        }
    </script>
@endsection
