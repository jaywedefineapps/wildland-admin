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
                            @if ($type != 'completed')
                                <a href="#" class="btn btn-primary" data-role='addRequestButton' data-bs-toggle="tooltip"
                                data-bs-dismiss="click" title="Add Request" data-bs-custom-class="tooltip-dark">Add</a>                        
                            @endif
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
                                    <th class="min-w-125px">User Image</th>
                                    <th class="min-w-125px">Technician Image</th>
                                    <th class="min-w-100px">Date</th>
                                    <th class="min-w-100px">Time in</th>
                                    <th class="min-w-100px">Time out</th>
                                    <th class="min-w-100px">Status</th>
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
                                            <img src="@if(!empty($item->user)){{$item->user->profile_image}}@else{{ asset('assets/media/img/no-user.png') }} @endif"
                                                class="w-50px me-3" alt="User image"
                                                onclick="toggleFullScreen(this)" loading="lazy" />
                                        </td>
                                        <td data-filter="image">
                                            <img src="@if(!empty($item->technician)){{$item->technician->profile_image}}@else{{ asset('assets/media/img/no-user.png') }} @endif"
                                                class="w-50px me-3" alt="Technicain image"
                                                onclick="toggleFullScreen(this)" loading="lazy" />
                                        </td>
                                        <td>
                                            <?php //echo stringReadMoreInline($item->name, 30); ?>
                                            {{$item->date}}
                                        </td>
                                        <td>
                                            {{ $item->time_in ?? '--'}}
                                        </td>
                                        <td>
                                            {{ $item->time_out ?? '--'}}
                                        </td>
                                        <td>
                                            {{ Str::title($item->status) }}
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex gap-3">
                                                @if ($type != 'completed')
                                                <a href="#" data-id="{{ $item->id }}"
                                                    data-user="{{ $item->user_id }}" data-address="{{ $item->address_id }}" data-technician={{$item->technician_id}} data-date={{$item->date}}
                                                    data-role="editRequest" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Edit request" data-bs-custom-class="tooltip-dark">
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
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </a>
                                                @endif

                                                <a href="#" id="deleteReq" data-role="deleteReq"
                                                    data-id="{{ $item->id }}" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Delete request" data-bs-custom-class="tooltip-dark">
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
    <!--end::Container-->
</div>
<div class="modal fade" id="kt_modal_add_request" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" id="kt_modal_add_request_form" enctype="multipart/form-data">
                @csrf
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_request_header">
                    <!--begin::Modal title-->
                    <h2 id="model_heading" class="fw-bolder">Add a Request</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_add_request_close"
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
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_request_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_request_header"
                        data-kt-scroll-wrappers="#kt_modal_add_request_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="fv-row mb-7">
                            <!--begin::Label-->

                            <div class="fv-row mb-4 mt-1">
                                <label class="required fs-6 fw-bold mb-2">Users</label>
                                <select class="form-select" name="user_id" id="user_id" data-placeholder="Select an option">
                                    <option value="" disabled selected>Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                           
                            <div class="fv-row mb-4 mt-1">
                                <label class="required fs-6 fw-bold mb-2">Address</label>
                                <select class="form-select" name="address_id" id="address_id" data-placeholder="Select an option">
                                    <option value="" disabled selected>-- Select Address --</option>
                                </select>
                            </div>
                            <div class="fv-row mb-4 mt-1">
                                <label class="required fs-6 fw-bold mb-2">Technician</label>
                                <select class="form-select" name="technician_id" id="technician_id" data-placeholder="Select an option">
                                    <option value="" disabled selected>Select Technician</option>
                                    @foreach ($technicians as $technicians)
                                        <option value="{{$technicians->id}}">{{$technicians->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-4 mt-1">
                                    <label class="required fs-6 fw-bold mb-2">Date</label>
                                    <input class="form-control form-control-solid" placeholder="select date" name="date" id="date" value="" />
                            </div>

                            <div>
                                <input type="hidden" name="id" id="request_id" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer flex-center">
                        <button type="reset" id="kt_modal_add_request_cancel"
                            class="btn btn-light me-3">Discard</button>
                        <button type="submit" id="kt_modal_add_request_submit"
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

@endsection
@section('script')
<script>
    function fetchAndSetAddresses(userId, selectedAddressId = null) {
        $("#address_id").html('');
        $.ajax({
            url: "{{route('admin.getAddress')}}",
            type: "POST",
            data: {
                id: userId,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(res) {
                $('#address_id').html('<option value="" disabled selected>-- Select Address --</option>');
                $.each(res, function(key, value) {
                    var selected = (selectedAddressId && selectedAddressId == value.id) ? 'selected' : '';
                    $("#address_id").append('<option value="' + value.id + '" ' + selected + '>' + value.house_no + ' ' + value.address + ' ' + value.zipcode + '</option>');
                });
            }
        });
    }
    $("#date").flatpickr({
            minDate: 'today'
        });
        
     $(document).on('click', 'a[data-role=addRequestButton]', function() {
        $('#kt_modal_add_request_form')[0].reset();
        $('#model_heading').html('Add Request');
        $('#kt_modal_add_request').modal('toggle');
    });
    $('#kt_modal_add_request_close').click(function() {
        $('#kt_modal_add_request').modal('toggle');
    });
    $(document).on('click', 'a[data-role=editRequest]', function() {
            validator.resetForm();
            var id = $(this).data('id');
            var user = $(this).data('user');
            var address = $(this).data('address');
            var technician = $(this).data('technician');
            var date = $(this).data('date');
            fetchAndSetAddresses(user, address);
            $("#request_id").val(id);
            $("#user_id").val(user);
            $("#address_id").val(address);
            $("#technician_id").val(technician);
            $("#date").val(date);
            $('#model_heading').html('Edit request');
            $('#kt_modal_add_request').modal('toggle');
        });

    $('#user_id').on('change', function () {
        var idState = this.value;
        $("#address_id").html('');
        $.ajax({
            url: "{{route('admin.getAddress')}}",
            type: "POST",
            data: {
                id: idState,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (res) {
                $('#address_id').html('<option value="" disabled selected>-- Select Address --</option>');
                $.each(res, function (key, value) {
                    $("#address_id").append('<option value="' + value
                        .id + '">' + value.house_no +' '+value.address+ ' '+ value.zipcode+ '</option>');
                });
            }
        });
    });
    jQuery.validator.addMethod("noSpace", function(value, element) {
        return value.trim() != "";
    }, "No space please and don't leave it empty");
    var id = $("#subcat_id").val();
    var validator = $('form[id="kt_modal_add_request_form"]').validate({
        rules: {
            user_id: 'required',
            address_id: 'required',
            technician_id: 'required',
            date: 'required',
        },
        messages: {
            user_id: 'User is required',
            address_id: 'Address is required',
            technician_id: 'Technician is required',
            date: 'Date is required',
        },
        submitHandler: function(form) {
            var formData = new FormData($('#kt_modal_add_request_form')[0]);
            $.ajax({
                url: "{{ route('admin.add.techreq') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if(data == 1) {
                        $('#kt_modal_add_province').modal('toggle');
                        swal.fire({
                            text: "Request has been successfully submitted!",
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
    $(document).on('click', 'a[data-role=deleteReq]', function() {
            var id = $(this).data('id');
            Swal.fire({
                text: "Are you sure you want to delete Request?",
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
                    url: "{{ route('admin.delete.techreq') }}",
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
                                text: "You have deleted Request!.",
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