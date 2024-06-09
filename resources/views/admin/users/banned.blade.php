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
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            @if ($type=='users')
                                <form action="{{ route('user.banned') }}" method="get">
                            @else
                                <form action="{{ route('technician.banned') }}" method="get">
                            @endif
                                @csrf
                                <div class="d-flex align-items-center position-relative my-1">
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
                                    <input type="text" id="myInput" name="query"
                                        data-kt-customer-table-filter="search"
                                        class="form-control form-control-solid w-250px ps-15 mr-5"
                                        placeholder="Search name or email" autocomplete="off"
                                        value="@if (request()->input('query') !== null) {{ request()->input('query') }} @endif" />
                                    &nbsp;&nbsp;
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success pl-3">Search</button>
                                        @if ($type=='users')  
                                            <a href="{{ route('user.banned') }}" class="btn btn-dark pl-3">Reset</a>
                                        @else
                                            <a href="{{ route('technician.banned') }}" class="btn btn-dark pl-3">Reset</a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                            <!--end::Search-->
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            </div>
                            <div class="d-flex justify-content-end align-items-center d-none"
                                data-kt-customer-table-toolbar="selected">
                                <div class="fw-bolder me-5">
                                    <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4"
                                id="kt_datatable">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th>No.</th>
                                        <th class="min-w-125px">Image</th>
                                        <th class="min-w-100px">Name</th>
                                        <th class="min-w-100px">Email</th>
                                        <th class="min-w-100px">Mobile</th>
                                        <th class="min-w-125px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600">
                                    @foreach ($list as $index => $item)
                                        <tr data-target="fullRow" id="{{ $item->id }}">
                                            <td>
                                                <a href="javascript: void(0);" id="roleID" class="text-body fw-bold"></a>
                                                {{ $list->firstItem() + $index }}
                                            </td>

                                            <td data-filter="image">
                                                <img src="@if (!empty($item->image)) {{ $item->profile_image }} @else {{ asset('assets/media/img/no-user.png') }} @endif"
                                                    class="w-50px me-3" alt="Merchant image"
                                                    onclick="toggleFullScreen(this)" loading="lazy" />
                                            </td>
                                            <td>
                                                <?php echo stringReadMoreInline($item->name, 30); ?>
                                            </td>
                                            <td>
                                                {{ $item->email }}
                                            </td>
                                            <td>
                                                {{ $item->country_code }}&nbsp;&nbsp;{{ $item->phone }}
                                            </td>
                                            <td class="text-end">
                                                <div class="d-flex gap-3">
                                                    <!---------------------ACTIVE/DEACTIVE------------------>
                                                    @if ($item->verified == 0)
                                                        <a href="#" id="verified" data-role="verified"
                                                            data-status="1" data-id="{{ $item->id }}"
                                                            data-bs-toggle="tooltip" data-bs-dismiss="click" title=""
                                                            data-bs-custom-class="tooltip-dark"
                                                            data-bs-original-title="Active User">
                                                            <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr019.svg-->
                                                            <span class="svg-icon svg-icon-success svg-icon-2hx"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M10.3 14.3L11 13.6L7.70002 10.3C7.30002 9.9 6.7 9.9 6.3 10.3C5.9 10.7 5.9 11.3 6.3 11.7L10.3 15.7C9.9 15.3 9.9 14.7 10.3 14.3Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M21 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H21C21.6 2 22 2.4 22 3V21C22 21.6 21.6 22 21 22ZM11.7 15.7L17.7 9.70001C18.1 9.30001 18.1 8.69999 17.7 8.29999C17.3 7.89999 16.7 7.89999 16.3 8.29999L11 13.6L7.70001 10.3C7.30001 9.89999 6.69999 9.89999 6.29999 10.3C5.89999 10.7 5.89999 11.3 6.29999 11.7L10.3 15.7C10.5 15.9 10.8 16 11 16C11.2 16 11.5 15.9 11.7 15.7Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                    @else
                                                        <a href="#" id="deactiveReasons" data-role="addreasons"
                                                            data-status="0" data-id="{{ $item->id }}"
                                                            data-bs-dismiss="click" title="Deactive account"
                                                            data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark">
                                                            <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr019.svg-->
                                                            <span class="svg-icon svg-icon-danger svg-icon-2hx"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M12 10.6L14.8 7.8C15.2 7.4 15.8 7.4 16.2 7.8C16.6 8.2 16.6 8.80002 16.2 9.20002L13.4 12L12 10.6ZM10.6 12L7.8 14.8C7.4 15.2 7.4 15.8 7.8 16.2C8 16.4 8.30001 16.5 8.50001 16.5C8.70001 16.5 9.00002 16.4 9.20002 16.2L12 13.4L10.6 12Z"
                                                                        fill="currentColor" />
                                                                    <path
                                                                        d="M21 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H21C21.6 2 22 2.4 22 3V21C22 21.6 21.6 22 21 22ZM13.4 12L16.2 9.20001C16.6 8.80001 16.6 8.19999 16.2 7.79999C15.8 7.39999 15.2 7.39999 14.8 7.79999L12 10.6L9.20001 7.79999C8.80001 7.39999 8.19999 7.39999 7.79999 7.79999C7.39999 8.19999 7.39999 8.80001 7.79999 9.20001L10.6 12L7.79999 14.8C7.39999 15.2 7.39999 15.8 7.79999 16.2C7.99999 16.4 8.3 16.5 8.5 16.5C8.7 16.5 9.00001 16.4 9.20001 16.2L12 13.4L14.8 16.2C15 16.4 15.3 16.5 15.5 16.5C15.7 16.5 16 16.4 16.2 16.2C16.6 15.8 16.6 15.2 16.2 14.8L13.4 12Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    @endif
                                                    <!---------------------INFORMATION------------------>
                                                    <a href="#" id="info" data-role="userInfo"
                                                        data-bs-toggle="tooltip" title="User information"
                                                        data-bs-custom-class="tooltip-dark" data-id="{{ $item->id }}"
                                                        data-image="{{ $item->profile_image }}"
                                                        data-notification="{{ $item->notification }}"
                                                        data-email="{{ $item->email }}" data-name="{{ $item->name }}"
                                                        data-phone="{{ $item->country_code . ' ' . $item->phone }}">
                                                        <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.3" x="2" y="2" width="20"
                                                                    height="20" rx="10" fill="currentColor" />
                                                                <rect x="11" y="17" width="7" height="2"
                                                                    rx="1" transform="rotate(-90 11 17)"
                                                                    fill="currentColor" />
                                                                <rect x="11" y="9" width="2" height="2"
                                                                    rx="1" transform="rotate(-90 11 9)"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <!---------------------RESTORE------------------>
                                                    <a href="#" id="info" data-role="RestoreUser"
                                                        data-delete="1" data-status="1" data-id="{{ $item->id }}"
                                                        data-bs-toggle="tooltip" title="Restore User"
                                                        data-bs-custom-class="tooltip-dark">
                                                        <span class="svg-icon svg-icon-success svg-icon-2hx">
                                                            <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path
                                                                        d="M17.1 15.8C16.6 15.7 16 16 15.9 16.5C15.7 17.4 14.9 18 14 18H6C4.9 18 4 17.1 4 16V8C4 6.9 4.9 6 6 6H14C15.1 6 16 6.9 16 8V9.4H18V8C18 5.8 16.2 4 14 4H6C3.8 4 2 5.8 2 8V16C2 18.2 3.8 20 6 20H14C15.8 20 17.4 18.8 17.9 17.1C17.9 16.5 17.6 16 17.1 15.8Z"
                                                                        fill="currentColor" />
                                                                    <path opacity="0.3"
                                                                        d="M11.9 9.39999H21.9L17.6 13.7C17.2 14.1 16.6 14.1 16.2 13.7L11.9 9.39999Z"
                                                                        fill="currentColor" />
                                                                </svg></span>
                                                        </span>
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
                        <div class="row">
                            <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                                <div class="paginationDiv">
                                    Showing {{ $list->firstItem() }} to {{ $list->lastItem() }} of {{ $list->total() }} records
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                <div>
                                    {{ $list->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!----------------------------------USERS INFO MODEL--------------------------------->
    <div class="modal fade" id="kt_modal_user_info" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_user_info_form" enctype="multipart/form-data">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_user_info_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">User Details</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_modal_user_info_close" data-role="close_button"
                            class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="card mb-5 mb-xl-0" id="kt_profile_details_view">
                        <style>
                            .constant {
                                margin-left: 35px;
                                margin-top: 5px;
                            }

                            .image_div {
                                display: grid;
                                place-items: center;
                            }

                            .img-photo {
                                height: 60px;
                                /*  photo = square aspect ratio  */
                                width: 60px;
                                object-fit: cover;
                                border-radius: 50% !important;
                            }
                        </style>
                        <!--begin::Card body-->
                        <div class="modal-body p-9">
                            <!--begin::Row-->
                            <div class="row">
                                <div class="col-2">
                                    <img class="img-photo" id="user_img" src="" alt="Avatar">
                                </div>
                                <div class="col-10">
                                    <h4 id="info_employeename" style="margin-top: 14px;"></h4>
                                </div>
                            </div>
                            <hr>
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Name</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <span id="name" class="fw-bold text-gray-800 fs-6">Keenthemes</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Email</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <span id="info_email" class="fw-bold text-gray-800 fs-6"></span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Contact Number</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 d-flex align-items-center">
                                    <span id="info_phone" class="fw-bolder fs-6 text-gray-800 me-2">044 3276 454
                                        935</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-bold text-muted">Notification Status</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row" id="notification">
                                    <span id="info_notification" class="fw-bold text-gray-800 fs-6"></span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Modal body-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!----------------------------------DEACTIVE MODEL--------------------------------->
    <div class="modal fade" id="kt_modal_add_reason" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" id="kt_modal_add_reason_form" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_category_header">
                        <!--begin::Modal title-->
                        <h2 id="model_heading" class="fw-bolder">Account Deactivate Reasons</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div id="kt_modal_add_reason_close" data-bs-dismiss="modal"
                            class="btn btn-icon btn-sm btn-active-icon-primary">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body py-5 px-lg-17">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_add_category_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_modal_add_category_header"
                            data-kt-scroll-wrappers="#kt_modal_add_category_scroll" data-kt-scroll-offset="300px">

                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <input type="hidden" name="status" value="0" id="status">
                                <div class="fv-row mb-3 mt-4" id="dreasonsdrop">
                                    <label class="required fs-6 fw-bold mb-2">Reasons</label>
                                    <!--begin::Input-->
                                    <select class="form-select" name="deactivate_reasons" id="dreasonsdrop1">
                                        <option value="" selected disabled>Select Reasons</option>
                                        <option class="cus" value="cus" id="custom">Custom</option>
                                        @foreach ($deactivereason as $dreason)
                                            <option value="{{ $dreason->content }}">
                                                {{ $dreason->content }}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <div class="fv-row mb-3 mt-4" id="resontext" style="display: none">
                                    <label class="required fs-6 fw-bold mb-2">Custom Reason</label>
                                    <textarea class="form-control" name="deactivate_reasons_cutoms" id="CustomReason" cols="15" rows="5"></textarea>
                                    @error('deactivate_reasons')
                                        <label class="error" id="errorMsg">{{ $message }}</label>
                                    @enderror
                                    <label id="deactivate_reasons-error" class="error" for="deactivate_reasons"></label>
                                </div>

                                <div class="fv-row mb-7">
                                    <label for="" class="error"></label>
                                </div>
                                <div>
                                    <input type="hidden" name="id" id="user_id" value="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer flex-center" style="padding: 5px;">
                            <button id="kt_modal_add_category_submit_genrate" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2">
                                    </span>
                                </span>
                            </button>
                        </div>

                    </div>
                </form>
                <!------------------------------end::Form------------------------------------------>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!----------------------------------TOOLTIP DISPOSE AND READ MORE-LESS--------------------------------->
    <script>
        $(document).ready(function() {
            $('[data-bs-toggle="tooltip"]').tooltip('dispose');
            $('[data-bs-toggle="tooltip"]').tooltip({
                trigger: 'hover'
            })
        })
        $(document).on('click', '.inline-readmore', function(event) {
            if ($(this).prev().is(":visible")) {
                $(this).prev('.full-string-span').hide();
                $(this).html('<small>...more</small>');
            } else {
                $(this).prev('.full-string-span').show();
                $(this).html('<small> less</small>');
            }
            event.preventDefault();
        });
    </script>
    <!----------------------------------USERS DEACTIVE--------------------------------->
    <script>
        $(document).on('click', '#deactiveReasons', function() {
            var id = $(this).data('id');
            $('#user_id').val(id);
            $('#kt_modal_add_reason_form')[0].reset();
            $('#kt_modal_add_reason').modal('toggle');
        });
        $(document).on('change', '#dreasonsdrop1', function() {
            if ($(this).val() == 'cus') {
                $('#resontext').show();
            } else {
                $('#resontext').hide();
            }
        });
        $(document).ready(function() {
            $('form[id="kt_modal_add_reason_form"]').validate({
                rules: {
                    deactivate_reasons: 'required',
                    deactivate_reasons_cutoms: 'required',
                },
                messages: {},
                submitHandler: function(form) {
                    var id = $('#user_id').val();
                    var status = $('#status').val();
                    if ($('#dreasonsdrop1').val() == 'cus') {
                        var deactivate_reasons = $('#CustomReason').val();
                    } else {
                        var deactivate_reasons = $('#dreasonsdrop1').val();
                    }
                    $.ajax({
                        url: "{{ route('user.verify') }}",
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: id,
                            status: status,
                            deactivate_reasons: deactivate_reasons
                        },
                        success: function(data) {
                            location.reload();
                        },
                    });
                }
            });
        });
    </script>
    <!----------------------------------USERS ACTIVE--------------------------------->
    <script>
        $(document).on('click', 'a[data-role=verified]', function() {
            var id = $(this).data('id');
            var status = $(this).data('status');
            if (status == '1') {
                var msg = "Are you sure you want to verify User?";
                var type = "Verify";
                var btn = "btn fw-bold btn-success";
            } else {
                var msg = "Are you sure you want to deactive User?";
                var type = "Deactive";
                var btn = "btn fw-bold btn-danger";

            }
            Swal.fire({
                text: msg,
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Yes, " + type + "!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: btn,
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then((function(e) {

                e.value ?
                    $.ajax({
                        url: "{{ route('user.verify') }}",
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: id,
                            status: status
                        },
                        success: function(data) {
                            if (data == 1) {
                                Swal.fire({
                                    text: "You have " + type + " User!.",
                                    icon: "success",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                }).then((function() {
                                    location.reload();
                                }))
                            }

                        },
                        error: function(data) {
                            if (data.status === 422) {
                                let response = $.parseJSON(data.responseText);
                                $.each(response.errors, function(key, val) {
                                    $("#" + "ajax_" + key + "_error").text(
                                        val[0]);
                                });
                            }
                        }
                    }) : "";
            }))
        });
    </script>
    <!----------------------------------USERS INFO--------------------------------->
    <script>
        $(document).on('click', 'a[data-role=userInfo]', function() {
            event.preventDefault();
            var id = $(this).data('id');
            var image = $(this).data('image');
            var notificationStatus = $(this).data('notification');
            var email = $(this).data('email');
            var name = $(this).data('name');
            var phone = $(this).data('phone');
            if (image == "") {
                image = '{{ asset('assets/media/img/no-user.png') }}'
            }
            if (notificationStatus == 1) {
                notificationStatus = 'on';
            } else {
                notificationStatus = 'Off';
            }
            $('#name').html(name);
            $('#info_email').html(email);
            $('#info_phone').html(phone);
            $('#user_img').prop('src', image)
            $('#info_notification').html(notificationStatus);
            $('#kt_modal_user_info').modal('toggle');

        });
    </script>
    <!----------------------------------USERS RESTORE--------------------------------->
    <script>
        $(document).on('click', 'a[data-role=RestoreUser]', function(event) {
            event.preventDefault();
            $('[data-bs-toggle="tooltip"]').tooltip('dispose');
            $('[data-bs-toggle="tooltip"]').tooltip({
                trigger: 'hover'
            })
            var id = $(this).data('id');
            var status = $(this).data('status');
            if (status == 1) {
                var msg = "Are you sure you want to restore User?";
                var type = "restore";
                var btn = "btn fw-bold btn-danger";
            } else {
                var msg = "Are you sure you want to delete User?";
                var type = "delete";
                var btn = "btn fw-bold btn-success"
            }
            Swal.fire({
                text: msg,
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Yes, " + type + "!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: btn,
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then((function(e) {
                e.value ?
                    $.ajax({
                        url: "{{ route('user.restorUser') }}",
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            Swal.fire({
                                text: "You have " + type + " User!.",
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary"
                                }
                            }).then((function() {
                                location.reload();
                            }))
                        },
                        error: function(data) {
                            if (data.status === 422) {
                                let response = $.parseJSON(data.responseText);
                                $.each(response.errors, function(key, val) {
                                    $("#" + "ajax_" + key + "_error").text(val[0]);
                                });
                            }
                        }
                    }) : "";
            }))

        });
    </script>
    <!----------------------------------IMAGE FULLSCREEN--------------------------------->
    <script>
        function toggleFullScreen(element) {
            if (!document.fullscreenElement) {
                element.classList.add('fullscreen');
                if (element.requestFullscreen) {
                    element.requestFullscreen();
                } else if (element.mozRequestFullScreen) { // Firefox
                    element.mozRequestFullScreen();
                } else if (element.webkitRequestFullscreen) { // Chrome, Safari and Opera
                    element.webkitRequestFullscreen();
                } else if (element.msRequestFullscreen) { // IE/Edge
                    element.msRequestFullscreen();
                }
            } else {
                element.classList.remove('fullscreen');
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) { // Firefox
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) { // Chrome, Safari and Opera
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { // IE/Edge
                    document.msExitFullscreen();
                }
            }
        }
    </script>
@endsection
