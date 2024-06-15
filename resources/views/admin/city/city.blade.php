@extends('layouts.master')
@section('css')

@endsection
@section('content')
<!--begin::Toolbar-->
<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
            class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{$title}}</h1>
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
                <li class="breadcrumb-item text-dark">{{$page}}</li>
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
<!--end::Toolbar-->
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                    rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                <path
                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" id="myInput" data-kt-customer-table-filter="search"
                            class="form-control form-control-solid w-250px ps-15" placeholder="Search City" />
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <!--begin::Add customer-->
                        <a href="{{route('cities')}}" type="button" class="btn btn-dark me-4" >Reset</a>
                        <button type="button" class="btn btn-primary" data-role='addSubCategory' data-bs-toggle="tooltip" data-bs-dismiss="click" title="Add province" data-bs-custom-class="tooltip-dark">Add</button>
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
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="kt_datatable">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th>No.</th>
                                <th class="min-w-125px">Name</th>
                                <th class="min-w-100px">Province</th>
                                <th class="min-w-125px">Actions</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                            @foreach ($list as $index => $item)
                            <tr data-target="fullRow" id="{{ $item->id }}">
                                <!--begin::Checkbox-->

                                <td><a href="javascript: void(0);" id="roleID"
                                        class="text-body fw-bold"></a>{{ $index + 1 }}</td>
                                <input class="text-gray-800 text-hover-primary mb-1" type="hidden"
                                    value="{{ $item->id }}" />
                                </td>
                                <td>{{ $item->name }}</td>
                                <!--begin::Name=-->
                                <td>{{ $item->provinceData->name }}</td>
                                <!--end::Name=-->
                                <!--begin::Payment method=-->
                                <td class="text-end">
                                    <div class="d-flex gap-3">
                                        <a href="#" data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}" data-province="{{ $item->province_id }}"
                                            data-role="editSubCategory" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Edit city" data-bs-custom-class="tooltip-dark">
                                            <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen055.svg-->
                                            <span class="svg-icon svg-icon-primary svg-icon-2qx"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" fill-rule="evenodd"
                                                        clip-rule="evenodd"
                                                        d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z"
                                                        fill="currentColor" />
                                                </svg></span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        <a href="#" id="deleteCatId" data-role="deleteSubCategory"
                                            data-id="{{ $item->id }}" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Delete province" data-bs-custom-class="tooltip-dark">
                                            <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen027.svg-->
                                            <span class="svg-icon svg-icon-danger svg-icon-2qx"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                        fill="currentColor" />
                                                    <path opacity="0.5"
                                                        d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                        fill="currentColor" />
                                                    <path opacity="0.5"
                                                        d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                        fill="currentColor" />
                                                </svg></span>
                                            <!--end::Svg Icon-->
                                        </a>
                                    </div>
                                </td>
                                <!--end::Action=-->
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>
            </div>
            <!--end::Card body-->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->

<!--Begin::Modal - City - Add/Edit-->
<div class="modal fade" id="kt_modal_add_city" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" id="kt_modal_add_city_form" enctype="multipart/form-data">
                @csrf
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_city_header">
                    <!--begin::Modal title-->
                    <h2 id="model_heading" class="fw-bolder">Add a City</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_add_city_close"
                        class="btn btn-icon btn-sm btn-active-icon-primary">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16"
                                    height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                    fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2"
                                    rx="1" transform="rotate(45 7.41422 6)"
                                    fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_city_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_city_header"
                        data-kt-scroll-wrappers="#kt_modal_add_city_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="fv-row mb-7">
                            <!--begin::Label-->

                            <div class="fv-row mb-7 mt-1">
                                <label class="required fs-6 fw-bold mb-2">Name</label>
                                <!--begin::Input-->
                                <input type="text" class="form-control" placeholder="City Name"
                                    name="name" id="city_name" value="" />
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7 mt-8">
                                <label class="required fs-6 fw-bold mb-2">Province</label>
                                <!--begin::Select-->
                                <select class="form-select" name="province_id" id="province_id" data-placeholder="Select an option">
                                    <option value="" disabled selected>Select Province</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                                <!--end::Select-->
                            </div>
                            <div class="fv-row mb-1">
                                <label for="" class="error"></label>
                            </div>
                            <div>
                                <input type="hidden" name="id" id="subcat_id" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer flex-center">
                        <button type="reset" id="kt_modal_add_city_cancel"
                            class="btn btn-light me-3">Discard</button>
                        <button type="submit" id="kt_modal_add_city_submit"
                            class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span
                                    class="spinner-border spinner-border-sm align-middle ms-2">
                                </span>
                            </span>
                        </button>
                    </div>
                    <!--end::Modal footer-->
                </div>
            </form>
            <!------------------------------end::Form------------------------------------------>
        </div>
    </div>
</div>
<!--End::Modal - City - Add/Edit-->
@endsection

@section('script')
<script>
    $(document).ready(function(){
    // <!--start::Datatable-->
        var table = $('#kt_datatable').DataTable();
        $('#myInput').on('keyup', function() {
            table.search(this.value).draw();
        });
    // <!--end::Datatable-->

    // <!--Start::City Add Function-->
        $(document).on('click', 'button[data-role=addSubCategory]', function() {
            validator.resetForm();
            $('#kt_modal_add_city_form')[0].reset();
            $('#model_heading').html('Add City');
            $('#kt_modal_add_city').modal('toggle');
        });
    // <!--End::City Add Function-->

    // <!--Start::City Edit Function-->
        $(document).on('click', 'a[data-role=editSubCategory]', function() {
            validator.resetForm();
            var id = $(this).data('id');
            var province = $(this).data('province');
            var name = $(this).data('name');
            $("#subcat_id").val(id);
            $("#city_name").val(name);
            $("#province_id").val(province);
            $('#model_heading').html('Edit a City');
            $('#kt_modal_add_city').modal('toggle');
        });
    // <!--End::City Edit Function-->

    // <!--Start::Form Validation-->
        jQuery.validator.addMethod("noSpace", function(value, element) {
            return value.trim() != "";
        }, "No space please and don't leave it empty");
        var id = $("#subcat_id").val();
        var validator = $('form[id="kt_modal_add_city_form"]').validate({
            rules: {
                name: {
                    noSpace: true
                },
                province_id: 'required'

            },
            messages: {
                name: 'name is required',
                avatar: 'Province is required',
            },
            submitHandler: function(form) {
                var formData = new FormData($('#kt_modal_add_city_form')[0]);
                $.ajax({
                    url: "{{ route('admin.city.create') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if(data == 1) {
                            $('#kt_modal_add_city').modal('toggle');
                            swal.fire({
                                text: "City has been successfully submitted!",
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got It!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then((function(e) {
                                location.reload();
                            }));
                        } else {
                            location.reload();
                        }
                    },
                    error: function(response) {
                        $.each(response.responseJSON.msg, function(field_name, error) {
                            $(document).find('[name=' + field_name + ']').after(
                                '<span style="color:#D9214E" class="text-strong textdanger error">' +
                                error + '</span>')
                        });
                    }
                });
            }
        });
    // <!--End::Form Validation-->

    // <!--Start::City Delete Function-->
        $(document).on('click', 'a[data-role=deleteSubCategory]', function() {
            var id = $(this).data('id');
            Swal.fire({
                text: "Are you sure you want to delete City?",
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then((function(e) {
                e.value ?
                $.ajax({
                    url: "{{ route('admin.city.delete') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if(data == 1) {
                            Swal.fire({
                                text: "You have deleted City!.",
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary"
                                }
                            }).then((function() {
                                location.reload();
                            }))
                        } else {
                            location.reload();
                        }
                    },
                    error: function(data) {
                        if (data.status === 422) {
                            let response = $.parseJSON(data.responseText);
                            $.each(response.errors, function(key, val) {
                                $("#" + "ajax_" + key + "_error").text(val[0]);
                            });
                        }
                    }
                }) : ""
            }))
        });
    // <!--End::City Delete Function-->

    // <!--Start::City Model Close Function-->
        $('#kt_modal_add_city_close').click(function() {
            $('#kt_modal_add_city').modal('toggle');
        })
    // <!--End::City Model Close Function-->
    });
</script>
@endsection
