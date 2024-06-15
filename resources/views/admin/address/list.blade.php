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
                          
                                <a href="#" class="btn btn-primary" data-role='addAddressButton' data-bs-toggle="tooltip"
                                data-bs-dismiss="click" title="Add Address" data-bs-custom-class="tooltip-dark">Add</a>                        
                         
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
                                    <th class="min-w-125px">House no.</th>
                                    <th class="min-w-125px">Address</th>
                                    <th class="min-w-125px">Country</th>
                                    <th class="min-w-125px">Province</th>
                                    <th class="min-w-125px">city</th>
                                    <th class="min-w-125px">zipcode</th>
                                    <th class="min-w-100px">Type </th>
                                    <th class="min-w-100px">Defaut</th>
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
                                            {{$item->house_no}}
                                        </td>
                                        <td>
                                            {{ $item->address }}
                                        </td>
                                        <td>
                                            {{ $item->countryName }}
                                        </td>
                                        <td>
                                            {{ $item->provinceName }}
                                        </td>
                                        <td>
                                            {{ $item->cityName }}
                                        </td>
                                        <td>
                                            {{ $item->zipcode }}
                                        </td>
                                        <td>
                                            {{ Str::title($item->type) }}
                                        </td>
                                        <td>
                                            <div class="col-lg-8 d-flex align-items-center">
                                                <div class="form-check form-check-solid form-switch fv-row">
                                                    <input  type ="checkbox" data-id="{{ $item->id }}" name="cat_visible"  class="form-check-input default-class" {{ $item->is_default == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="allowmarketing"></label>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex gap-3">
                                                <a href="#" data-id="{{ $item->id }}" data-latitude="{{$item->latitude}}" data-longitude="{{$item->longitude}}"
                                                    data-house="{{ $item->house_no }}" data-address="{{ $item->address }}" data-country={{$item->country_id}} 
                                                    data-province={{$item->province_id}} data-city={{$item->city_id}} data-zipcode={{$item->zipcode}} data-type={{$item->type}} data-default={{$item->is_default}}
                                                    data-role="editAddress" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Edit address" data-bs-custom-class="tooltip-dark">
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
                                                @if ($item->is_default != 1)
                                                    
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
                                                @endif

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
<div class="modal fade" id="kt_modal_add_address" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" id="kt_modal_add_address_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{request()->id}}">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_address_header">
                    <!--begin::Modal title-->
                    <h2 id="model_heading" class="fw-bolder">Add a address</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_add_address_close"
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
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_address_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_address_header"
                        data-kt-scroll-wrappers="#kt_modal_add_address_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="fv-row mb-7">
                            <div class="fv-row mb-2 mt-1 form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_default_address" id="is_default_address">
                                <label class="form-check-label fs-6 fw-bold mb-2" for="is_default_address">Default Address</label>
                                <input type="hidden" name="is_default" id='is_default' value="">
                            </div>
                            <!--begin::Label-->
                            <div class="fv-row mb-4 mt-1 radio-class">
                                <label class="required fs-6 fw-bold mb-2">Type</label>
                                <div class="d-flex ">
                                    <div class="form-check me-5 ">
                                        <input class="form-check-input" type="radio" name="type" id="type_home" value="home">
                                        <label class="form-check-label" for="type_home">
                                            Home
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" id="type_work" value="work">
                                        <label class="form-check-label" for="type_work">
                                            Work
                                        </label>
                                    </div>
                                </div>

                            <label id="type-error" class="error" for="type"></label>
                            </div>
                            <div class="fv-row mb-4 mt-1">
                                <label class="required fs-6 fw-bold mb-2">House no.</label>
                                <input class="form-control form-control" placeholder="Enter house no." name="house_no" id="house_no" value="" />
                            </div>
                           
                            <div class="fv-row mb-4 mt-1">
                                <label class="required fs-6 fw-bold mb-2">Address</label>
                                <input class="form-control form-control" placeholder="Enter address" name="address" id="address" value="" />
                            </div>
                            <div class="fv-row mb-4 mt-1">
                                <label class="required fs-6 fw-bold mb-2">Country</label>
                                <select class="form-select" name="country_id" id="country_id" data-placeholder="Select an option">
                                    <option value="" disabled selected>Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-4 mt-1">
                                <label class="required fs-6 fw-bold mb-2">Province</label>
                                <select class="form-select" name="province_id" id="province_id" data-placeholder="Select an option">
                                    <option value="" disabled selected>-- Select Province --</option>
                                </select>
                            </div>
                            <div class="fv-row mb-4 mt-1">
                                <label class="required fs-6 fw-bold mb-2">City</label>
                                <select class="form-select" name="city_id" id="city_id" data-placeholder="Select an option">
                                    <option value="" disabled selected>-- Select City --</option>
                                </select>
                            </div>
                            <div class="fv-row mb-4 mt-1">
                                    <label class="required fs-6 fw-bold mb-2">Zipcode</label>
                                    <input class="form-control form-control" placeholder="Enter zipcode" name="zipcode" id="zipcode" value="" />
                            </div>
                            <div class="fv-row mb-4 mt-1">
                                <div class="row">

                              
                                    <div class="col-6">
                                        <label class="required fs-6 fw-bold mb-2">Latitude</label>
                                        <input class="form-control form-control" placeholder="Enter latitude" name="latitude" id="latitude" value="" />

                                    </div>
                                    <div class="col-6">
                                        <label class="required fs-6 fw-bold mb-2">Longitude</label>
                                        <input class="form-control form-control" placeholder="Enter longitude" name="longitude" id="longitude" value="" />
                                    </div>
                                </div>
                            </div>

                            <div>
                                <input type="hidden" name="id" id="address_id" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer flex-center">
                        <button type="reset" id="kt_modal_add_address_cancel"
                            class="btn btn-light me-3">Discard</button>
                        <button type="submit" id="kt_modal_add_address_submit"
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
    function fetchAndSetProvince(countryId, selectedProvinceId = null) {
        $("#province_id").html('');
        $.ajax({
            url: "{{route('admin.getProvince')}}",
            type: "POST",
            data: {
                id: countryId,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(res) {
                $('#province_id').html('<option value="" disabled selected>-- Select Province --</option>');
                $.each(res, function(key, value) {
                    var selected = (selectedProvinceId && selectedProvinceId == value.id) ? 'selected' : '';
                    $("#province_id").append('<option value="' + value.id + '" ' + selected + '>' + value.name+'</option>');
                });
            }
        });
    }
    function fetchAndSetCity(provinceId, selectedCityId = null) {
        $("#city_id").html('');
        $.ajax({
            url: "{{route('admin.getCity')}}",
            type: "POST",
            data: {
                id: provinceId,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(res) {
                $('#city_id').html('<option value="" disabled selected>-- Select City --</option>');
                $.each(res, function(key, value) {
                    var selected = (selectedCityId && selectedCityId == value.id) ? 'selected' : '';
                    $("#city_id").append('<option value="' + value.id + '" ' + selected + '>' + value.name+'</option>');
                });
            }
        });
    }
    $('.default-class').change(function () {
            let is_visible = $(this).prop('checked') === true ? 1 : 0;
            let Id = $(this).data('id');
            $.ajax({
                headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                type: "POST",
                dataType: "json",
                url: '{{ route('admin.address.isDefault') }}',
                data: {'is_default': is_visible, 'id': Id},
                success: function (data) {
                    if(data == 1){
                        location.reload();
                    }
                }
            });
        });
    $(document).on('click', 'a[data-role=addAddressButton]', function() {
        $('#kt_modal_add_address_form')[0].reset();
        $('#model_heading').html('Add Address');
        $('#kt_modal_add_address').modal('toggle');
    });
    $('#kt_modal_add_address_close').click(function() {
        $('#kt_modal_add_address').modal('toggle');
    });
    $('#country_id').on('change', function () {
        $("#city_id").html('');
        $('#city_id').html('<option value="" disabled selected>-- Select City --</option>');
        var idState = this.value;
        fetchAndSetProvince(idState);
    });
    $('#province_id').on('change', function () {
        var idState = this.value;
        fetchAndSetCity(idState);
    });
    $(document).on('click', 'a[data-role=editAddress]', function() {
        var id = $(this).data('id');
        var house = $(this).data('house');
        var address = $(this).data('address');
        var country = $(this).data('country');
        var province = $(this).data('province');
        var city = $(this).data('city');
        var zipcode = $(this).data('zipcode');
        var type = $(this).data('type'); 
        var isdefault = $(this).data('default'); 
        var latitude = $(this).data('latitude'); 
        var longitude = $(this).data('longitude'); 

        fetchAndSetProvince(country, province);
        fetchAndSetCity(province, city);
        if(type === 'home') {
            $("#type_home").prop('checked', true);
        } else if(type === 'work') {
            $("#type_work").prop('checked', true);
        }
        if(isdefault == 1){
            $("#is_default_address").prop('checked', true);
            $("#is_default").val('1');
        }else{
            $("#is_default").val('0');
        }
        $("#address_id").val(id);
        $("#latitude").val(latitude);
        $("#longitude").val(longitude);
        $("#house_no").val(house);
        $("#country_id").val(country);
        $("#zipcode").val(zipcode);
        $("#address").val(address);
        $('#model_heading').html('Edit address');
        $('#kt_modal_add_address').modal('toggle');
    });
    $(document).on('click', 'a[data-role=deleteReq]', function() {
        var id = $(this).data('id');
        Swal.fire({
            text: "Are you sure you want to delete Address?",
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
                url: "{{ route('admin.delete.address') }}",
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
                            text: "You have deleted Address!.",
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
    jQuery.validator.addMethod("noSpace", function(value, element) {
        return value.trim() != "";
    }, "No space please and don't leave it empty");
    var id = $("#subcat_id").val();
    var validator = $('form[id="kt_modal_add_address_form"]').validate({
        rules: {
            type: 'required',
            house_no: 'required',
            address: 'required',
            country_id: 'required',
            province_id: 'required',
            city_id: 'required',
            zipcode: 'required',
            latitude: 'required',
            longitude: 'required',
        },
        messages: {
            type: 'Address type is required',
            house_no: 'House no is required',
            address: 'Address is required',
            country_id: 'Country is required',
            province_id: 'Province is required',
            city_id: 'City is required',
            zipcode: 'Zipcode is required',
            latitude: 'Latitude is required',
            longitude: 'Longitude is required',
        },
        submitHandler: function(form) {
            if ($('#is_default_address').is(':checked')) {
                $('#is_default').val('1');
            } else {
                $('#is_default').val('0');
            }
            var formData = new FormData($('#kt_modal_add_address_form')[0]);
            $.ajax({
                url: "{{ route('admin.add.address') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if(data == 1) {
                        $('#kt_modal_add_address').modal('toggle');
                        swal.fire({
                            text: "Address has been successfully submitted!",
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
</script>
@endsection