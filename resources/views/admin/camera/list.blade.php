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
                        <form action="" method="get">
                            @csrf
                            <div class="d-flex align-items-center position-relative my-1">
                                
                            </div>
                        </form>
                        <!--end::Search-->
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <!--begin::Add customer-->
                          
                                {{-- <a href="#" class="btn btn-primary" data-role='addAddressButton' data-bs-toggle="tooltip"
                                data-bs-dismiss="click" title="Add Address" data-bs-custom-class="tooltip-dark">Add</a>                         --}}
                         
                        <!--end::Add customer-->
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
                                    <th class="min-w-125px">Device name</th>
                                    <th class="min-w-125px">Ip Address</th>
                                    <th class="min-w-125px">Port</th>
                                    <th class="min-w-125px">User name</th>
                                    <th class="min-w-125px">Password</th>
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
                                        <td>
                                            {{$item->device_name}}
                                        </td>
                                        <td>
                                            {{ $item->ip_address }}
                                        </td>
                                        <td>
                                            {{ $item->port }}
                                        </td>
                                        <td>
                                            {{ $item->user_name }}
                                        </td>
                                        <td>
                                            {{ str_repeat('*', strlen($item->password))}}
                                        </td>
                                      
                                        <td class="text-end">
                                            <div class="d-flex gap-3">                                              
                                                <a href="#" id="deleteCamera" data-role="deleteCamera"
                                                    data-id="{{ $item->id }}" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Delete camera" data-bs-custom-class="tooltip-dark">
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
                    <div class="row">
                        <div
                            class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                            <div class="paginationDiv">
                                Showing {{ $list->firstItem() }} to {{ $list->lastItem() }} of {{ $list->total() }}
                                records
                            </div>
                        </div>
                        <div
                            class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
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
</div>
@endsection
@section('script')
<script>
     $(document).on('click', 'a[data-role=deleteCamera]', function() {
        var id = $(this).data('id');
        Swal.fire({
            text: "Are you sure you want to delete Camera?",
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
                url: "{{ route('admin.delete.camera') }}",
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
                            text: "You have deleted Camera!.",
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
</script>
@endsection
