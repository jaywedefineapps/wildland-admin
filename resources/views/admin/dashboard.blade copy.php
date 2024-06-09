@extends('layouts.master')
@section('css')
<style>
    h1.dashhead {
    margin-left: 31px;
    margin-top: 10px;
    margin-bottom: 18px;
}
</style>
<style>
    body {
        background: #ececec;
    }

    .display-none {
        display: none !important;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: rgba(0, 0, 0, .8);
        z-index: 999;
        opacity: 1;
        transition: all 0.5s;
    }


    .lds-dual-ring {
        display: inline-block;
    }

    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 64px;
        height: 64px;
        margin: 5% auto;
        border-radius: 50%;
        border: 6px solid #fff;
        border-color: #fff transparent #fff transparent;
        animation: lds-dual-ring 1.2s linear infinite;
    }

    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    #getDataBtn {
        background: #e2e222;
        border: 1px solid #e2e222;
        padding: 10px 20px;
    }

    .text-center {
        text-align: center;
    }

    #data-table table {
        margin: 20px auto;
    }
</style>
@endsection
@section('content')
<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            {{-- <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1"><span class="text-primary">HA</span><span class="text-warning">W</span>&nbsp; Dashboard</h1> --}}
            <!--end::Title-->
            {{-- <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end"> --}}
                {{-- <img src="/assets/media/logos/Asset 1.png" alt="user" class="img-fluid" style="width: 100px"> --}}
                <h1>Dashboard</h1>
        {{-- </div> --}}
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->
<div id="kt_content_container" class="container-xxl">
    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-xl-10">
        <div class="col-md-12 col-lg-12 col-xl-6 col-xxl-6 mb-md-5 mb-xl-10">
            <!--begin::Card widget 4-->
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Currency-->
                            <span class="fs-4 fw-bold text-gray-400 me-1 align-self-start"></span>
                            <!--end::Currency-->
                            <!--begin::Amount-->
                            <a href="{{ Route('admin.dashboard') }}" class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{ $data['bookingCount'] }} Booking</a>
                            <!--end::Amount-->

                        </div>
                        <!--end::Info-->
                        <!--begin::Subtitle-->

                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body pt-2 pb-4 d-flex align-items-center">

                    <!--begin::Labels-->
                    <div class="d-flex flex-column content-justify-center w-100">
                        <!--begin::Label-->
                        <div class="d-flex fs-6 fw-bold align-items-center">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">This month</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-boldest text-gray-700 text-xxl-end">{{ $data['thisMonthBookingCount'] }} users</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                        <!--begin::Label-->
                        <div class="d-flex fs-6 fw-bold align-items-center my-3">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">Previews Month</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-boldest text-gray-700 text-xxl-end">{{  $data['LastMonthBookingCount']  }} users</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                        <!--begin::Label-->

                        <!--end::Label-->
                    </div>
                    <!--end::Labels-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 4-->
            <!--begin::Card widget 5-->
            <div class="card card-flush h-md-50 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Amount-->
                            <a href="{{ Route('active.freelancers') }}" class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{ $data['freelancers'] }} Freelancers</a>
                            <!--end::Amount-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Subtitle-->

                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body pt-2 pb-4 d-flex align-items-center">

                    <!--begin::Labels-->
                    <div class="d-flex flex-column content-justify-center w-100">
                        <!--begin::Label-->
                        <div class="d-flex fs-6 fw-bold align-items-center">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">Active</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-boldest text-gray-700 text-xxl-end">{{ $data['activeFreelancers'] }}</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                        <!--begin::Label-->
                        <div class="d-flex fs-6 fw-bold align-items-center my-3">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">Pending</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-boldest text-gray-700 text-xxl-end">{{ $data['pendingFreelancers'] }}</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                        <!--begin::Label-->
                        <!--begin::Label-->
                        <div class="d-flex fs-6 fw-bold align-items-center">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">Banned</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-boldest text-gray-700 text-xxl-end">{{ $data['bannedFreelancers'] }}</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                        <!--end::Label-->
                    </div>
                    <!--end::Labels-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 5-->
        </div>
        <div class="col-md-12 col-lg-12 col-xl-6 col-xxl-6 mb-md-5 mb-xl-10">
            <!--begin::Card widget 6-->
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Currency-->
                            <span class="fs-4 fw-bold text-gray-400 me-1 align-self-start"></span>
                            <!--end::Currency-->
                            <!--begin::Amount-->
                            <a href="{{ Route('all.users') }}" class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{  $data['client'] }} Customers</a>
                            <!--end::Amount-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Subtitle-->

                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->

                </div>
                <!--begin::Card body-->
                <div class="card-body pt-2 pb-4 d-flex align-items-center">

                    <!--begin::Labels-->
                    <div class="d-flex flex-column content-justify-center w-100">
                        <!--begin::Label-->
                        <div class="d-flex fs-6 fw-bold align-items-center">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">This month</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-boldest text-gray-700 text-xxl-end">{{  $data['thisMonthclientCount'] }} Customers</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                        <!--begin::Label-->
                        <div class="d-flex fs-6 fw-bold align-items-center my-3">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">Previews Month</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-boldest text-gray-700 text-xxl-end">{{  $data['LastMonthclientCount'] }} Customers</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                        <!--begin::Label-->

                        <!--end::Label-->
                    </div>
                    <!--end::Labels-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 6-->
            <!--begin::Card widget 7-->
            <div class="card card-flush h-md-50 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Amount-->
                        <a href="{{ Route('companies') }}" class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{ $data['companies'] }} Companies</a>
                        <!--end::Amount-->
                        <!--begin::Subtitle-->

                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body pt-2 pb-4 d-flex align-items-center">

                    <!--begin::Labels-->
                    <div class="d-flex flex-column content-justify-center w-100">
                        <!--begin::Label-->
                        <div class="d-flex fs-6 fw-bold align-items-center">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">This month</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-boldest text-gray-700 text-xxl-end">{{ $data['thisMonthCompaniesCount'] }} </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                        <!--begin::Label-->
                        <div class="d-flex fs-6 fw-bold align-items-center my-3">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">Previews Month</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-boldest text-gray-700 text-xxl-end">{{  $data['LastMonthCompaniesCount'] }}</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                        <!--begin::Label-->

                        <!--end::Label-->
                    </div>
                    <!--end::Labels-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 7-->
        </div>
    </div>
    <!--end::Row-->

    <!--end::Row-->
{{--  bookings --}}
{{--  --}}
{{--  bookings --}}
<div class="card my-5">
    <!--begin::Card body-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">Today Bookings</span>
            {{-- <span class="text-muted mt-1 fw-bold fs-7">More than {{$data['bookingCount']}} Bookings</span> --}}
        </h3>
        <div class="card-toolbar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bolder px-4 me-1 active" href="{{route('admin.booking.index')}}">See All</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_2">Week</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bolder px-4" data-bs-toggle="tab" href="#kt_table_widget_5_tab_3">Day</a>
                </li> --}}
            </ul>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4"
                id="kt_datatable">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th>No.</th>
                        <th class="min-w-125px">Image</th>
                        <th class="min-w-100px">Freelancer<br> Name</th>
                        <th class="min-w-100px">booking N0</th>
                        {{-- <th class="min-w-100px">Service</th> --}}
                        <th class="min-w-100px">Status</th>
                        <th class="min-w-125px">Actions</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                    {{-- {{ dd($data["freelancersBooking"]) }} --}}
                    @foreach ($data["freelancersBooking"] as $index => $item)
                        <tr data-target="fullRow" id="{{ $item->id }}">

                            <td>
                                <a href="javascript: void(0);" id="roleID"
                                    class="text-body fw-bold"></a>{{ $data["freelancersBooking"]->firstItem() + $index }}
                            </td>

                            <td data-filter="image">
                                <img src="@if (!empty($item->image)) {{ getS3Img($item->image) }} @else {{ asset('assets/media/img/no-user.png') }} @endif"
                                    class="w-50px h-50px me-3" alt="Merchant image" />
                            </td>
                            <!--begin::Name=-->
                            <td>
                                <?php echo stringReadMoreInline(Str::ucfirst($item->name), 30); ?>
                            </td>
                            <!--end::Name=-->
                            <!--begin::Name=-->
                            <td>
                                {{ $item->booking_no }}
                            </td>
                            <!--end::Name=-->
                            <!--begin::Name=-->
                            {{-- <td>
                                {{ $item->title ? $item->title : 'N/A' }} --}}
                            {{-- {{$item->serviceImages}} --}}
                            {{-- </td> --}}
                            {{-- <td> {{ Str::ucfirst($item->status) }} --}}
                                {{-- {{$item->serviceImages}} --}}
                            {{-- </td> --}}
                            <td> <?php if($item->status == "pending"){echo Str::ucfirst("pending"); }elseif($item->status == "accepted"){echo Str::ucfirst("accepted");}elseif($item->status == "cancelled"){echo Str::ucfirst("cancelled");}elseif($item->status == "completed"){echo Str::ucfirst("completed");}elseif($item->status == "dispute"){echo Str::ucfirst("dispute");}elseif($item->status == "customer_approved"){echo Str::ucfirst("Customer Approved");}elseif($item->status == "dispute_complete"){echo Str::ucfirst("Dispute Complete");}elseif($item->status == "dispute_reject"){echo Str::ucfirst("Dispute Reject");}elseif($item->status == "ongoing"){echo Str::ucfirst("On Going");} ?>
                                {{-- {{$item->serviceImages}} --}}
                            </td>
                            <!--end::Name=-->
                            <!--begin::Name=-->

                            <!--end::Name=-->
                            <td class="text-end">
                                <div class="d-flex gap-3">
                                    <a href="#" id="info" data-role="serviceInfo"
                                        data-bs-toggle="tooltip" data-bs-dismiss="click"
                                        title="Booking information" data-bs-custom-class="tooltip-dark"
                                        data-date="{{ $item->date }}" data-time="{{ $item->time }}"
                                        data-total="{{ $item->total }}"
                                        data-bookingid="{{ $item->bookingId }}"
                                        data-payment_type="{{ $item->payment_type }}"
                                        data-note="{{ $item->note }}" {{-- data-transportation_charge="{{ $item->transportation_charge }}" --}}
                                        data-id="{{ $item->id }}" data-image="{{ $item->s3image }}"
                                        {{-- data-serviceimages="{{ $item->serviceImages }}" --}} {{-- data-servicename="{{ $item->view_name }}" --}}
                                        data-username="{{ $item->name }}" {{-- data-bookingid="{{ $item->bookingId }}" --}}
                                        {{-- data-servicetitle="{{ $item->services }}" --}} data-bookingno="{{ $item->booking_no }}"
                                        data-status="{{ $item->status }}" data-dob="{{ $item->dob }}"
                                        {{-- data-pending="{{ $item->pending }}" --}} {{-- data-rejected="{{ $item->rejected }}" --}} {{-- data-completed="{{ $item->completed }}" --}}
                                        {{-- data-review="{{ $item->review }}" --}} {{-- data-subcategory="{{ $item->subCategory->name }}" --}} {{-- data-category="{{ $item->subCategory->categoryData->name }}" --}}
                                        data-phone="{{ $item->phone }}"
                                        data-title="{{ $item->title }}">
                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen045.svg-->
                                        <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2"
                                                    width="20" height="20" rx="10"
                                                    fill="currentColor" />
                                                <rect x="11" y="17" width="7"
                                                    height="2" rx="1"
                                                    transform="rotate(-90 11 17)" fill="currentColor" />
                                                <rect x="11" y="9" width="2"
                                                    height="2" rx="1"
                                                    transform="rotate(-90 11 9)" fill="currentColor" />
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
        <div id="loader" class="lds-dual-ring display-none overlay"></div>
        <div class="row">
            <div
                class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                <div class="paginationDiv">
                    Showing {{$data["freelancersBooking"]->firstItem() }} to {{$data["freelancersBooking"]->lastItem() }} of
                    {{$data["freelancersBooking"]->total() }} records
                </div>
            </div>
            <div
                class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                <div>
                    {{$data["freelancersBooking"]->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <!--end::Card body-->
</div>
<!--begin::Modal - Service - Details-->
<div class="modal fade" id="kt_modal_service_info" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="#" id="kt_modal_service_info_form" enctype="multipart/form-data">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_service_info_header">
                    <!--begin::Modal title-->

                    @isAdmin
                        <h2 class="fw-bolder">Booking Details</h2>
                    @endisAdmin
                    @isBusiness
                        <h2 class="fw-bolder">Business Service Details</h2>
                    @endisBusiness
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_service_info_close" data-role="close_button"
                        class="btn btn-icon btn-sm btn-active-icon-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
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

                    <div class="modal-bodys p-5">
                        <!--begin::Row-->
                        {{-- <div class="row">
                            <div class="col-2">
                                <img class="img-photo" id="user_img" src="" alt="Avatar">
                            </div>
                            <div class="col-10"> --}}
                        {{-- <h4 id="info_servicename" style="margin-top: 14px;">Booking Name</h4> --}}
                        {{-- </div>
                        </div>
                        <hr> --}}
                        <div style="display: flex;justify-content: space-between;align-content: center;align-items: flex-start;">
                            <div style="text-align: start;">
                                <h3>Freelancer Details</h3>
                                <div>
                                    <img class="img-photo" id="freelancer_img" src="" alt="Avatar">
                                </div>
                                <div>
                                    <label class="">Name : </label>
                                    <span id="info_freelancername" class=""></span>
                                </div>
                                <div>
                                    <label class="">Email : </label>
                                    <span id="info_email" class=""></span>
                                </div>
                                <div>
                                    <label class="">Gender : </label>
                                    <span id="info_gender" class=""></span>
                                </div>
                                <div class="">
                                    <label class="">Experiance : </label>
                                    <span id="info_experiance_year" class=""></span>
                                </div>
                                <div class="">
                                    <label class="">cell : </label>
                                    <span id="info_phone" class=""></span>
                                </div>
                            </div>
                            <div style="text-align: end;">
                                <h3>Customer Details</h3>
                                <div>
                                    <img class="img-photo" id="user_img" src="" alt="Avatar">
                                </div>
                                <div>
                                    <label class="">Customer Name : </label>
                                    <span id="info_username" class=""></span>
                                </div>
                                <div>
                                    <label class="">Working Time : </label>
                                    <span id="info_date" class=""></span>
                                </div>
                                <div>
                                    <label class="">Location : </label>
                                    <span id="info_address" class=""></span>
                                </div>
                                <div class="chek">
                                    <label class="">Note : </label>
                                    <span id="info_note" class=""></span>
                                </div>
                                <div class="chekpayment">
                                    <label class="">Payment Type : </label>
                                    <span id="info_paymenttype" class=""></span>
                                </div>
                            </div>

                        </div>

                        <hr>
                        <div class="">
                            {{-- <label class="">service : </label> --}}
                            <h3>Booked Services</h3>

                            <div class="mb-5">
                                <table id="info_servicetitle">
                                </table>
                            </div>
                        </div>
                        <div class="mb-5 chektransportation">
                            <table>
                                <tr>
                                    <th style="width: 200px">Extra Charges</th>
                                    <td style="width: 200px">Transportation Charge</td>
                                    <td style="width: 200px;text-align:right;"><span id="transportation"></span></td>
                                </tr>
                            </table>
                            {{-- <span class="inline"><b>Extra Charges</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                        </div>
                        <div class="mb-5">
                            <table>
                                <tr>
                                    <td style="width: 400px" ><span class="inline"><b>Tax</b></span></td>
                                    <td style="width: 200px;text-align:right;"><span><span id="info_tax"style=""></span></span></td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <div class="mb-5">
                            <table>
                                <tr>
                                    <td style="width: 400px" ><span class="inline"><b>Total</b></span></td>
                                    <td style="width: 200px;text-align:right;"><span><b><span id="info_total"></span></b></span></td>
                                </tr>
                            </table>
                        </div>
                        {{-- <div class="">
                            <table>
                                <tr>
                                    <td style="width: 400px"> <span class="inline"><b>Payment Type</b></span></td>
                                    <td style="width: 200px"><span><b><span id="info_paymenttype"style=""></span></b></span></td>
                                </tr>
                            </table>

                        </div> --}}
                        <hr>
                        <div>
                            <span><b>Proof images</b></span>
                            <div class="" id="proufImages">
                                <span id="proufImage" class=""></span>
                            </div>
                        </div>
                        {{-- <div class="row mb-7">
                            <label class="col-lg-4 fw-bold">Customer Name</label>
                            <div class="col-lg-8 fv-row">
                                <span id="info_username" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                        </div> --}}

                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Working Time</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span id="info_date" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Location</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span id="info_address" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Note</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span id="info_note" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Service Name</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span id="info_servicename" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Extra Charges</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span id="info_transportationcharge" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Total</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span id="info_total" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">booking Order</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span id="info_bookingno" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Status</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 d-flex align-items-center">
                                <span id="info_status" class="fw-bolder fs-6 text-gray-800 me-2"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}

                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">dob</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 d-flex align-items-center">
                                <span id="info_dob" class="fw-bolder fs-6 text-gray-800 me-2"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">service</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-12">
                                <table id="info_servicetitle">


                                </table>
                                <span class="fw-bolder fs-6 text-gray-800 me-2"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Extra Charges</label>
                            <table> --}}
                        {{-- <tr><th>Transportation Charge</th></tr> --}}
                        {{-- <tr>
                                    <td class="p-5">Transportation Charge &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><span id="transportation"></span></b></td>
                                </tr>
                            </table>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 d-flex align-items-center" id="result">
                                <span id="info_excharge" class="fw-bolder fs-6 text-gray-800 me-2"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Total</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 d-flex align-items-center" id="result">
                                <span id="info_total" class="fw-bolder fs-6 text-gray-800 me-2"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Payment Type</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 d-flex align-items-center" id="result">
                                <span id="info_paymenttype" class="fw-bolder fs-6 text-gray-800 me-2"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        <!--begin::Input group-->
                        {{-- <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Service Images</label>
                            <div class="col-lg-8 fv-row" id="productImages">
                                <span id="imageStatus" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Upload Proof images</label>
                            <div class="col-lg-8 fv-row" id="proufImages">
                                <span id="proufImage" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                        </div> --}}
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Modal body-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal-->
{{-- custom package --}}
<div class="card">
    <!--begin::Card body-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">Today package </span>
            {{-- <span class="text-muted mt-1 fw-bold fs-7">More than {{$data['bookingCount']}} Bookings</span> --}}
        </h3>
        <div class="card-toolbar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bolder px-4 me-1 active" href="{{route("admin.bookingpackage")}}">See All</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_2">Week</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-secondary fw-bolder px-4" data-bs-toggle="tab" href="#kt_table_widget_5_tab_3">Day</a>
                </li> --}}
            </ul>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4"
                id="kt_datatable">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th>No.</th>
                        <th class="min-w-125px">Image</th>
                        <th class="min-w-100px">Freelancer<br> Name</th>
                        <th class="min-w-100px">booking N0</th>
                        {{-- <th class="min-w-100px">Service</th> --}}
                        <th class="min-w-100px">Status</th>
                        <th class="min-w-125px">Actions</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                    {{-- {{ dd($freelancers) }} --}}
                    @foreach ($data["freelancerspackage"] as $index => $item)
                        <tr data-target="fullRow" id="{{ $item->id }}">

                            <td>
                                <a href="javascript: void(0);" id="roleID"
                                    class="text-body fw-bold"></a>{{ $data["freelancerspackage"] ->firstItem() + $index }}
                            </td>

                            <td data-filter="image">
                                <img src="@if (!empty($item->image)) {{ getS3Img($item->image) }} @else {{ asset('assets/media/img/no-user.png') }} @endif"
                                    class="w-50px h-50px me-3" alt="Merchant image" />
                            </td>
                            <!--begin::Name=-->
                            <td>
                                <?php echo stringReadMoreInline(Str::ucfirst($item->name), 30); ?>
                            </td>
                            <!--end::Name=-->
                            <!--begin::Name=-->
                            <td>
                                {{ $item->booking_no }}
                            </td>
                            <!--end::Name=-->
                            <!--begin::Name=-->
                            {{-- <td>
                                {{ $item->title ? $item->title : 'N/A' }} --}}
                            {{-- {{$item->serviceImages}} --}}
                            {{-- </td> --}}

                            <td> <?php if($item->status == "pending"){echo Str::ucfirst("pending"); }elseif($item->status == "accepted"){echo Str::ucfirst("accepted");}elseif($item->status == "cancelled"){echo Str::ucfirst("cancelled");}elseif($item->status == "completed"){echo Str::ucfirst("completed");}elseif($item->status == "dispute"){echo Str::ucfirst("dispute");}elseif($item->status == "customer_approved"){echo Str::ucfirst("Customer Approved");}elseif($item->status == "dispute_complete"){echo Str::ucfirst("Dispute Complete");}elseif($item->status == "dispute_reject"){echo Str::ucfirst("Dispute Reject");}elseif($item->status == "ongoing"){echo Str::ucfirst("On Going");} ?>
                                {{-- {{$item->serviceImages}} --}}
                            </td>
                            <!--end::Name=-->
                            <!--begin::Name=-->

                            <!--end::Name=-->
                            <td class="text-end">
                                <div class="d-flex gap-3">
                                    <a href="#" id="info" data-role="serviceInfopackage"
                                        data-bs-toggle="tooltip" data-bs-dismiss="click"
                                        title="Booking information" data-bs-custom-class="tooltip-dark"
                                        data-date="{{ $item->date }}" data-time="{{ $item->time }}"
                                        data-total="{{ $item->total }}"
                                        data-bookingid="{{ $item->bookingId }}"
                                        data-payment_type="{{ $item->payment_type }}"
                                        data-note="{{ $item->note }}" {{-- data-transportation_charge="{{ $item->transportation_charge }}" --}}
                                        data-id="{{ $item->id }}" data-image="{{ $item->s3image }}"
                                        {{-- data-serviceimages="{{ $item->serviceImages }}" --}} {{-- data-servicename="{{ $item->view_name }}" --}}
                                        data-username="{{ $item->name }}" {{-- data-bookingid="{{ $item->bookingId }}" --}}
                                        {{-- data-servicetitle="{{ $item->services }}" --}} data-bookingno="{{ $item->booking_no }}"
                                        data-status="{{ $item->status }}" data-dob="{{ $item->dob }}"
                                        {{-- data-pending="{{ $item->pending }}" --}} {{-- data-rejected="{{ $item->rejected }}" --}} {{-- data-completed="{{ $item->completed }}" --}}
                                        {{-- data-review="{{ $item->review }}" --}} {{-- data-subcategory="{{ $item->subCategory->name }}" --}} {{-- data-category="{{ $item->subCategory->categoryData->name }}" --}}
                                        data-phone="{{ $item->phone }}"
                                        data-title="{{ $item->title }}">
                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen045.svg-->
                                        <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2"
                                                    width="20" height="20" rx="10"
                                                    fill="currentColor" />
                                                <rect x="11" y="17" width="7"
                                                    height="2" rx="1"
                                                    transform="rotate(-90 11 17)" fill="currentColor" />
                                                <rect x="11" y="9" width="2"
                                                    height="2" rx="1"
                                                    transform="rotate(-90 11 9)" fill="currentColor" />
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
        <div id="loader" class="lds-dual-ring display-none overlay"></div>
        <div class="row">
            <div
                class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                <div class="paginationDiv">
                    Showing {{ $data["freelancerspackage"] ->firstItem() }} to {{ $data["freelancerspackage"] ->lastItem() }} of
                    {{ $data["freelancerspackage"] ->total() }} records
                </div>
            </div>
            <div
                class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                <div>
                    {{ $data["freelancerspackage"] ->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <!--end::Card body-->
</div>
{{-- cutom packagemodel --}}
<div class="modal fade" id="kt_modal_service_infos" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="#" id="kt_modal_service_info_form" enctype="multipart/form-data">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_service_info_header">
                    <!--begin::Modal title-->

                    @isAdmin
                        <h2 class="fw-bolder">Booking Details</h2>
                    @endisAdmin
                    @isBusiness
                        <h2 class="fw-bolder">Business Service Details</h2>
                    @endisBusiness
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_service_info_closes" data-role="close_button"
                        class="btn btn-icon btn-sm btn-active-icon-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
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

                    <div class="modal-bodys p-5">
                        <!--begin::Row-->
                        {{-- <div class="row">
                            <div class="col-2">
                                <img class="img-photo" id="user_img" src="" alt="Avatar">
                            </div>
                            <div class="col-10"> --}}
                        {{-- <h4 id="info_servicename" style="margin-top: 14px;">Booking Name</h4> --}}
                        {{-- </div>
                        </div>
                        <hr> --}}
                        <div style="display: flex;justify-content: space-between;align-content: center;align-items: flex-start;">
                            <div style="text-align: start;">
                                <h3>Freelancer Details</h3>
                                <div>
                                    <img class="img-photo" id="freelancer_img" src="" alt="Avatar">
                                </div>
                                <div>
                                    <label class="">Name : </label>
                                    <span id="info_freelancername" class=""></span>
                                </div>
                                <div>
                                    <label class="">Email : </label>
                                    <span id="info_email" class=""></span>
                                </div>
                                <div>
                                    <label class="">Gender : </label>
                                    <span id="info_gender" class=""></span>
                                </div>
                                <div class="">
                                    <label class="">Experiance : </label>
                                    <span id="info_experiance_year" class=""></span>
                                </div>
                                <div class="">
                                    <label class="">cell : </label>
                                    <span id="info_phone" class=""></span>
                                </div>
                            </div>
                            <div style="text-align: end;">
                                <h3>Customer Details</h3>
                                <div>
                                    <img class="img-photo" id="user_img" src="" alt="Avatar">
                                </div>
                                <div>
                                    <label class="">Customer Name : </label>
                                    <span id="info_username" class=""></span>
                                </div>
                                <div>
                                    <label class="">Working Time : </label>
                                    <span id="info_date" class=""></span>
                                </div>
                                <div>
                                    <label class="">Location : </label>
                                    <span id="info_address" class=""></span>
                                </div>
                                <div class="chek">
                                    <label class="">Note : </label>
                                    <span id="info_note" class=""></span>
                                </div>
                                <div class="chekpayment">
                                    <label class="">Payment Type : </label>
                                    <span id="info_paymenttype" class=""></span>
                                </div>
                            </div>

                        </div>

                        <hr>
                        <div class="">
                            {{-- <label class="">service : </label> --}}
                            <h3>Package</h3>

                            <div class="mb-5">
                                <table id="info_servicetitle">
                                </table>
                            </div>
                        </div>
                        <div class="mb-5 chektransportation">
                            <table>
                                <tr>
                                    <th style="width: 200px">Extra Charges</th>
                                    <td style="width: 200px">Transportation Charge</td>
                                    <td style="width:200px;text-align: end;"><span id="transportation"></span></td>
                                </tr>
                            </table>
                            {{-- <span class="inline"><b>Extra Charges</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                        </div>
                        <div class="mb-5">
                            <table>
                                <tr>
                                    <td style="width: 400px" ><span class="inline"><b>Tax</b></span></td>
                                    <td style="width:200px;text-align: end;"><span><span id="info_tax"style=""></span></span></td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <div class="mb-5">
                            <table>
                                <tr>
                                    <td style="width: 400px" ><span class="inline"><b>Total</b></span></td>
                                    <td style="width:200px;text-align: end;"><span><b><span id="info_total"style=""></span></b></span></td>
                                </tr>
                            </table>
                        </div>
                        {{-- <div class="">
                            <table>
                                <tr>
                                    <td style="width: 400px"> <span class="inline"><b>Payment Type</b></span></td>
                                    <td style="width: 200px"><span><b><span id="info_paymenttype"style=""></span></b></span></td>
                                </tr>
                            </table>

                        </div> --}}
                        <hr>
                        <div>
                            <span><b>Proof images</b></span>
                            <div class="" id="proufImages">
                                <span id="proufImage" class=""></span>
                            </div>
                        </div>
                        {{-- <div class="row mb-7">
                            <label class="col-lg-4 fw-bold">Customer Name</label>
                            <div class="col-lg-8 fv-row">
                                <span id="info_username" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                        </div> --}}

                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Working Time</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span id="info_date" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Location</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span id="info_address" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Note</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span id="info_note" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Service Name</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span id="info_servicename" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Extra Charges</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span id="info_transportationcharge" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Total</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span id="info_total" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">booking Order</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span id="info_bookingno" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Status</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 d-flex align-items-center">
                                <span id="info_status" class="fw-bolder fs-6 text-gray-800 me-2"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}

                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">dob</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 d-flex align-items-center">
                                <span id="info_dob" class="fw-bolder fs-6 text-gray-800 me-2"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">service</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-12">
                                <table id="info_servicetitle">


                                </table>
                                <span class="fw-bolder fs-6 text-gray-800 me-2"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Extra Charges</label>
                            <table> --}}
                        {{-- <tr><th>Transportation Charge</th></tr> --}}
                        {{-- <tr>
                                    <td class="p-5">Transportation Charge &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><span id="transportation"></span></b></td>
                                </tr>
                            </table>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 d-flex align-items-center" id="result">
                                <span id="info_excharge" class="fw-bolder fs-6 text-gray-800 me-2"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Total</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 d-flex align-items-center" id="result">
                                <span id="info_total" class="fw-bolder fs-6 text-gray-800 me-2"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Payment Type</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 d-flex align-items-center" id="result">
                                <span id="info_paymenttype" class="fw-bolder fs-6 text-gray-800 me-2"></span>
                            </div>
                            <!--end::Col-->
                        </div> --}}
                        <!--begin::Input group-->
                        {{-- <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Service Images</label>
                            <div class="col-lg-8 fv-row" id="productImages">
                                <span id="imageStatus" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                        </div> --}}
                        {{-- <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">Upload Proof images</label>
                            <div class="col-lg-8 fv-row" id="proufImages">
                                <span id="proufImage" class="fw-bold text-gray-800 fs-6"></span>
                            </div>
                        </div> --}}
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Modal body-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
{{-- cutom packagemodel --}}
{{-- custom package --}}
</div>
<!--end::Post-->

@endsection
@section('script')
<script>
    $(document).ready(function() {
        var businessId = $("#user").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#user").change(function() {
            var businessId = $(this).val();
            $.ajax({
                url: "{{ URL::route('admin.businessBooking') }}",
                dataType: "json",
                type: "get",
                async: true,
                data: {
                    businessId
                },
                success: function(data) {
                    console.log(data.freelancerslist);
                    $('#category').html('<option value="0">Select Freelancer</option>');
                    $.each(data.freelancerslist, function(key, value) {
                        $("#category").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                },
                error: function(xhr, exception) {
                    var msg = "";
                    if (xhr.status === 0) {
                        msg = "Not connect.\n Verify Network." + xhr.responseText;
                    } else if (xhr.status == 404) {
                        msg = "Requested page not found. [404]" + xhr.responseText;
                    } else if (xhr.status == 500) {
                        msg = "Internal Server Error [500]." + xhr.responseText;
                    } else if (exception === "parsererror") {
                        msg = "Requested JSON parse failed.";
                    } else if (exception === "timeout") {
                        msg = "Time out error." + xhr.responseText;
                    } else if (exception === "abort") {
                        msg = "Ajax request aborted.";
                    } else {
                        msg = "Error:" + xhr.status + " " + xhr.responseText;
                    }

                }
            });
        });
    });
    var table = $('#kt_customers_table').DataTable();

    const resetForm = () => {
        $('#kt_modal_add_customer').modal('toggle');
    };
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

    $('#kt_modal_service_info_close').click(function() {
        $('#kt_modal_service_info').modal('toggle');
    })

    $(document).on('click', 'a[data-role=serviceInfo]', function() {
        event.preventDefault();
        var username = $(this).data('username');
        var image = $(this).data('image');
        var bookingid = $(this).data('bookingid');
        // console.log(bookingid);
        var servicetitle = $(this).data('servicetitle');
        var title = $(this).data('title');
        if (title == '') {
            title = "N/A";
        } else {
            title = $(this).data('title');
        }
        // var serviceImages = $(this).data('image');
        // if (image == "") {
        //     image = '{{ asset('assets/media/img/no-user.png') }}'
        // }
        $('#user_img').attr("src", image);
        // console.log(serviceImages);
        $('#productImages').empty();
        $('#servicetitle').empty();
        $("#info_username").empty();
        $("#info_date").empty();
        $("#info_address").empty();
        $("#info_note").empty();
        $("#info_total").empty();
        $("#info_tax").empty();
        $("#str").empty();
        $("#info_paymenttype").empty();
        $("#proufImages").empty();
        $("#info_servicetitle").empty();
        $("#info_freelancername").empty();
        $(".chek").show();
        $(".chekpayment").show();
        $(".chektransportation").show();

        var html = "";
        // debugger
        // if (serviceImages.length == 0) {
        //     html += '<span id="imageStatus" class="fw-bold text-gray-800 fs-6">No Imaage Available.</span>';
        // } else {
        //     html = "";
        // }
        // for (let i = 0; i < serviceImages.length; i++) {
        //     if (i == 0 || i == 1 || i == 2) {
        //         html += '<img src="' + serviceImages[i].s3image +
        //             '" alt="" width="100" class="fw-bold text-gray-800 fs-6 ml-5" style="max-height: 100px;max-width: 100px;" id="infoImage' +
        //             [i + 1] + '">&nbsp&nbsp&nbsp'
        //     } else {
        //         html += '<img src="' + serviceImages[i].s3image +
        //             '" alt="" width="100" class="fw-bold text-gray-800 fs-6 ml-5 mt-12" style="max-height: 100px;max-width: 100px;" id="infoImage' +
        //             [i + 1] + '">&nbsp&nbsp&nbsp'
        //     }
        // }
        // var html = "";
        // if (servicetitle.length == 0) {
        //     html += '<span id="info_servicetitle" class="fw-bold text-gray-800 fs-6">No</span>';
        // } else {
        //     html = "";
        // }
        // for (let x = 0; x < servicetitle.length; x++) {
        //     html += '<span id="info_servicetitle" class="fw-bold text-gray-800 fs-6">' + title + '</span>';
        // }
        var html2 = "";
        // $('#info_address').html(address);
        $.ajax({
            url: "{{ route('admin.bookingsdetails') }}",
            method: 'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: bookingid,
                // status: status
            },
            beforeSend: function() {
                $('#loader').removeClass('display-none')
            },
            success: function(data) {
                // var document = data.get_document_data;
                // console.log(data.services[0].service.title);
                // console.log(data.services[1].service.title);
                // console.log(data.services[2].service.title);
                // console.log(Object.keys(data).length);
                // console.log(getSettings());
                // var symbol = {{ getSettings()->currency }}
                // console.log({{ getSettings()->currency }})
                console.log(data);

                // console.log(data.review[1].review);
                // console.log(data.review[2].review);
                var strDate = data.booking_at;
                var regex = /(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/;
                var arrDate = regex.exec(strDate);
                var objDate = new Date(
                    (+arrDate[1]),
                    (+arrDate[2]) - 1, // Month starts at 0!
                    (+arrDate[3]),
                    (+arrDate[4]),
                    (+arrDate[5]),
                    (+arrDate[6])
                );
                /* Convert the date object to string with format of your choice */
                const month = ["January", "February", "March", "April", "May", "June", "July",
                    "August", "September", "October", "November", "December"
                ];
                var newDate = objDate.getDate() + ' ' + month[objDate.getMonth()] + " " + objDate
                    .getFullYear();

                /* Get the time in your format */
                var newTime = objDate.toLocaleString('en-US', {
                    hour: 'numeric',
                    minute: 'numeric',
                    second: 'numeric',
                    hour12: true
                });
                /* Concatenate new date and new time */
                // alert(newDate + " " + newTime);
                // console.log(data.booking_at);
                $("#info_username").html(data.customer.name);
                var customerImage = data.customer.profile_image;
                if (customerImage == "") {
                    customerImage = '{{ asset('assets/media/img/no-user.png') }}'
                }
                $('#user_img').attr("src", customerImage);
                $("#info_date").html(newDate + " " + newTime);
                $("#info_address").html(data.address.address + ", " + data.address.cityName + ", " +
                    data.address.provinceName + ", " + data.address.countryName);
                var note = data.note;
                if (note == null) {
                    note = "N/A";
                    $(".chek").hide();
                }
                $("#info_note").html(note);
                var transportationcharge = data.transportation_charge;
                console.log(transportationcharge);
                if(transportationcharge == "0.00"){
                    $(".chektransportation").hide();
                }
                // chektransportation
                $("#transportation").html("{{ getSettings()->currency }}" + transportationcharge);
                $("#info_tax").html("{{ getSettings()->currency }}" + data.tax);
                $("#info_total").html("{{ getSettings()->currency }}" + data.total);
                var chekpayment = data.payment_type;
                console.log(chekpayment);
                if(chekpayment == ""){
                    $(".chekpayment").hide();
                }
                $("#info_paymenttype").html(data.payment_type);
                $("#info_freelancername").html(data.services[0].service.user_data.name);
                var freelancerImage = data.services[0].service.user_data.profile_image;
                if (freelancerImage == "") {
                    freelancerImage = '{{ asset('assets/media/img/no-user.png') }}'
                }
                $("#freelancer_img").attr("src", freelancerImage);
                $("#info_email").html(data.services[0].service.user_data.email);
                $("#info_phone").html(data.services[0].service.user_data.phone);
                $("#info_experiance_year").html(data.services[0].service.user_data.experiance_year + " Year");
                if(data.services[0].service.user_data.gender === "0"){
                    $("#info_gender").html("Male")
                }else if(data.services[0].service.user_data.gender === "1"){
                    $("#info_gender").html("Female")
                }else if(data.services[0].service.user_data.gender === "2"){
                    $("#info_gender").html("Other")
                }
                // $("#info_gender").html(data.services[0].service.user_data.gender);



                console.log(data);
                // if(data.review == ""){

                // }
                html2 = "";
                for (var y = 0; y < Object.keys(data.services).length; y++) {
                    if (y == 0) {
                        if(Object.keys(data.review).length != "0"){
                            var star =  data.review[y].star;
                            var reaview =  data.review[y].review;
                        }else{
                            star = "N/A";
                            reaview = "N/A";
                        }
                        // if(data.review[y].review != ""){
                        //     data.review[y].review = "N/A";
                        // }
                        // if(star == ""){
                        //     star = "N/A";
                        // }
                        // var str = star;
                        $("#info_servicetitle").append(
                            `<tr>
                                <th class="pb-5" style="width:200px">No</th>
                                <th class="pb-5" style="width:200px">Services Name</th>
                                <th class="pb-5" style="width:200px;text-align:right;">Price</th>
                            </tr>
                            <br>
                            <tr>
                                <td valign="top">` + [y + 1] + `</td>
                                <td>
                                    <span` + '  [y + 1] ' + `class=fw-bold text-gray-800 fs-6>` + data.services[y].service.title + `&nbsp</span>
                                    <div id="str`+[y + 1]+`" style="">
                                        <span>
                                            <b>Review -></b>&nbsp
                                            <span>`+ reaview +`</span>
                                            <br><b>Star -></b>&nbsp
                                            <span>`+ star +`</span>
                                        </span>
                                    </div>
                                    <br>
                                </td>
                                <td valign="top" style="text-align:right;">
                                    <span id="info_servicetitle"` + ' [y + 2] ' + `class=fw-bold text-gray-800 fs-6>{{ getSettings()->currency }}` + data.services[y].service.price + `</span>
                                </td>
                            </tr>
                            <br>`);

                        if(Object.keys(data.review).length != "0"){
                            $("#str" + [y + 1]).show();
                        }else{
                            $("#str" + [y + 1]).hide();
                        }
                    } else {
                        if(Object.keys(data.review).length != "0"){
                            var star =  data.review[y].star;
                            var reaview =  data.review[y].review;
                        }else{
                            star = "N/A";
                            reaview = "N/A";
                        }
                        // var star =  data.review[y].star

                        $("#info_servicetitle").append(
                            `<tr>
                                <td valign="top">` + [y + 1] + `</td>
                                <td>
                                    <span` + '  [y + 1] ' + `class=fw-bold text-gray-800 fs-6>` + data.services[y].service.title + `&nbsp</span>
                                    <div id="str`+[y + 1]+`" style="">
                                        <span>
                                            <b>Review -></b>&nbsp
                                            <span>`+ reaview +`</span>
                                            <br><b>Star -></b>&nbsp
                                            <span>`+ star +`</span>
                                        </span>
                                    </div>
                                    <br>
                                </td>
                                <td valign="top" style="text-align:right;">
                                    <span id="info_servicetitle"` + ' [y + 2] ' + `class=fw-bold text-gray-800 fs-6>
                                        {{ getSettings()->currency }}` + data.services[y].service.price + `&nbsp
                                    </span>
                                </td>
                            </tr>
                            <br>`);
                        if(Object.keys(data.review).length != "0"){
                            $("#str" + [y + 1]).show();
                        }else{
                            $("#str" + [y + 1]).hide();
                        }
                    }
                }
                // $('#servicetitle').append(html2);
                // var html = "";
                // // debugger
                // // console.log(data.services);
                // for (var a = 0; a < Object.keys(data.services).length; a++) {
                //     var serviceImages = data.services[a].service.service_images;
                // }
                // console.log(serviceImages.length);
                // if (serviceImages.length == 0) {
                //     html +=
                //         '<span id="imageStatus" class="fw-bold text-gray-800 fs-6">No Imaage Available.</span>';
                // } else {
                //     html = "";
                // }
                // for (var i = 0; i < serviceImages.length; i++) {
                //     html += '<img src="' + serviceImages[i].s3image +
                //         '" alt="" width="100" class="fw-bold text-gray-800 fs-6 ml-5" style="max-height: 100px;max-width: 100px;" id="infoImage' +
                //         [i + 1] + '">&nbsp&nbsp&nbsp'
                // }
                html3 = "";
                var proof = data.proof
                if (proof.length == 0) {
                    html3 +=
                        '<span id="proufImage" class="fw-bold text-gray-800 fs-6">No Imaage Available.</span>';
                } else {
                    html3 = "";
                }
                for (var i = 0; i < proof.length; i++) {
                    html3 += '<a href="'+proof[i].s3image+'" target="_blank" rel="noreferrer"><img src="' + proof[i].s3image +
                        '" alt="" width="100px" class="fw-bold text-gray-800 fs-6 ml-5" style="max-height: 100px;max-width: 100px; aspect-ratio: 3/2; object-fit: contain;" id="infoImage' +
                        [i + 1] + '"></a>&nbsp&nbsp&nbsp'
                }
                // for (let i = 0; i < serviceImages.length; i++) {
                //     if (i == 0 || i == 1 || i == 2) {
                //         html += '<img src="' + serviceImages[i].s3image +
                //             '" alt="" width="100" class="fw-bold text-gray-800 fs-6 ml-5" style="max-height: 100px;max-width: 100px;" id="infoImage' +
                //             [i + 1] + '">&nbsp&nbsp&nbsp'
                //     } else {
                //         html += '<img src="' + serviceImages[i].s3image +
                //             '" alt="" width="100" class="fw-bold text-gray-800 fs-6 ml-5 mt-12" style="max-height: 100px;max-width: 100px;" id="infoImage' +
                //             [i + 1] + '">&nbsp&nbsp&nbsp'
                //     }
                // }
                $('#productImages').append(html);
                // $('#servicetitle').append(html2);
                $('#proufImages').append(html3);
                $('#kt_modal_service_info').modal('toggle');
            },
            complete: function() {
                $('#loader').addClass('display-none')
            },
        });
        // console.log(html);
        // $('#kt_modal_user_info').modal('toggle');


    });
    /* Convert your date string to date object */

    $('#kt_modal_service_info_closes').click(function() {
        $('#kt_modal_service_infos').modal('toggle');
    })

    $(document).on('click', 'a[data-role=serviceInfopackage]', function() {
            event.preventDefault();
            var username = $(this).data('username');
            var image = $(this).data('image');
            var bookingid = $(this).data('bookingid');
            // console.log(bookingid);
            var servicetitle = $(this).data('servicetitle');
            var title = $(this).data('title');
            if (title == '') {
                title = "N/A";
            } else {
                title = $(this).data('title');
            }
            // var serviceImages = $(this).data('image');
            // if (image == "") {
            //     image = '{{ asset('assets/media/img/no-user.png') }}'
            // }
            $('#user_img').attr("src", image);
            // console.log(serviceImages);
            $('#productImages').empty();
            $('#servicetitle').empty();
            $("#info_username").empty();
            $("#info_date").empty();
            $("#info_address").empty();
            $("#info_note").empty();
            $("#info_total").empty();
            $("#info_tax").empty();
            $("#info_paymenttype").empty();
            $("#proufImages").empty();
            $("#info_servicetitle").empty();
            $("#info_freelancername").empty();
            $(".chek").show();
            $(".chekpayment").show();
            $(".chektransportation").show();

            var html = "";
            // debugger
            // if (serviceImages.length == 0) {
            //     html += '<span id="imageStatus" class="fw-bold text-gray-800 fs-6">No Imaage Available.</span>';
            // } else {
            //     html = "";
            // }
            // for (let i = 0; i < serviceImages.length; i++) {
            //     if (i == 0 || i == 1 || i == 2) {
            //         html += '<img src="' + serviceImages[i].s3image +
            //             '" alt="" width="100" class="fw-bold text-gray-800 fs-6 ml-5" style="max-height: 100px;max-width: 100px;" id="infoImage' +
            //             [i + 1] + '">&nbsp&nbsp&nbsp'
            //     } else {
            //         html += '<img src="' + serviceImages[i].s3image +
            //             '" alt="" width="100" class="fw-bold text-gray-800 fs-6 ml-5 mt-12" style="max-height: 100px;max-width: 100px;" id="infoImage' +
            //             [i + 1] + '">&nbsp&nbsp&nbsp'
            //     }
            // }
            // var html = "";
            // if (servicetitle.length == 0) {
            //     html += '<span id="info_servicetitle" class="fw-bold text-gray-800 fs-6">No</span>';
            // } else {
            //     html = "";
            // }
            // for (let x = 0; x < servicetitle.length; x++) {
            //     html += '<span id="info_servicetitle" class="fw-bold text-gray-800 fs-6">' + title + '</span>';
            // }
            var html2 = "";
            // $('#info_address').html(address);
            $.ajax({
                url: "{{ route('admin.bookingsdetails') }}",
                method: 'get',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: bookingid,
                    // status: status
                },
                beforeSend: function() {
                    $('#loader').removeClass('display-none')
                },
                success: function(data) {
                    // var document = data.get_document_data;
                    // console.log(data.services[0].service.title);
                    // console.log(data.services[1].service.title);
                    // console.log(data.services[2].service.title);
                    // console.log(Object.keys(data).length);
                    // console.log(getSettings());
                    // var symbol = {{ getSettings()->currency }}
                    // console.log({{ getSettings()->currency }})
                    console.log(data);
                    var strDate = data.booking_at;
                    var regex = /(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/;
                    var arrDate = regex.exec(strDate);
                    var objDate = new Date(
                        (+arrDate[1]),
                        (+arrDate[2]) - 1, // Month starts at 0!
                        (+arrDate[3]),
                        (+arrDate[4]),
                        (+arrDate[5]),
                        (+arrDate[6])
                    );
                    /* Convert the date object to string with format of your choice */
                    const month = ["January", "February", "March", "April", "May", "June", "July",
                        "August", "September", "October", "November", "December"
                    ];
                    var newDate = objDate.getDate() + ' ' + month[objDate.getMonth()] + " " + objDate
                        .getFullYear();

                    /* Get the time in your format */
                    var newTime = objDate.toLocaleString('en-US', {
                        hour: 'numeric',
                        minute: 'numeric',
                        second: 'numeric',
                        hour12: true
                    });
                    /* Concatenate new date and new time */
                    // alert(newDate + " " + newTime);
                    // console.log(data.booking_at);
                    $("#info_username").html(data.customer.name);
                    var customerImage = data.customer.profile_image;
                    if (customerImage == "") {
                        customerImage = '{{ asset('assets/media/img/no-user.png') }}'
                    }
                    $('#user_img').attr("src", customerImage);
                    $("#info_date").html(newDate + " " + newTime);
                    $("#info_address").html(data.address.address + ", " + data.address.cityName + ", " +
                        data.address.provinceName + ", " + data.address.countryName);
                    var note = data.note;
                    if (note == null) {
                        note = "N/A";
                        $(".chek").hide();
                    }
                    $("#info_note").html(note);
                    var transportationcharge = data.transportation_charge;
                    console.log(transportationcharge);
                    if(transportationcharge == "0.00"){
                        $(".chektransportation").hide();
                    }
                    // chektransportation
                    $("#transportation").html("{{ getSettings()->currency }}" + transportationcharge);
                    $("#info_tax").html("{{ getSettings()->currency }}" + data.tax);
                    $("#info_total").html("{{ getSettings()->currency }}" + data.total);
                    var chekpayment = data.payment_type;
                    console.log(chekpayment);
                    if(chekpayment == ""){
                        $(".chekpayment").hide();
                    }
                    $("#info_paymenttype").html(data.payment_type);
                    $("#info_freelancername").html(data.services[0].package.user_data.name);
                    var freelancerImage = data.services[0].package.user_data.profile_image;
                    if (freelancerImage == "") {
                        freelancerImage = '{{ asset('assets/media/img/no-user.png') }}'
                    }
                    $("#freelancer_img").attr("src", freelancerImage);
                    $("#info_email").html(data.services[0].package.user_data.email);
                    $("#info_phone").html(data.services[0].package.user_data.phone);
                    $("#info_experiance_year").html(data.services[0].package.user_data.experiance_year + " Year");
                    if(data.services[0].package.user_data.gender === "0"){
                        $("#info_gender").html("Male")
                    }else if(data.services[0].package.user_data.gender === "1"){
                        $("#info_gender").html("Female")
                    }else if(data.services[0].package.user_data.gender === "2"){
                        $("#info_gender").html("Other")
                    }
                    // $("#info_gender").html(data.services[0].service.user_data.gender);



                    console.log(data);
                    //----------------------------------------------------------------------------
                    html2 = "";
                    for (var y = 0; y < Object.keys(data.services).length; y++) {
                        if (y == 0) {
                            if(Object.keys(data.review).length != "0"){
                                var star =  data.review[y].star;
                                var reaview =  data.review[y].review;
                            }else{
                                star = "N/A";
                                reaview = "N/A";
                            }
                            // if(data.review[y].review != ""){
                            //     data.review[y].review = "N/A";
                            // }
                            // if(star == ""){
                            //     star = "N/A";
                            // }
                            // var str = star;
                            $("#info_servicetitle").append(
                                `<tr>
                                    <th class="pb-5" style="width:200px">No</th>
                                    <th class="pb-5" style="width:200px">Services Name</th>
                                    <th class="pb-5" style="width:200px;text-align:right;">Price</th>
                                </tr>
                                <br>
                                <tr>
                                    <td valign="top">` + [y + 1] + `</td>
                                    <td>
                                        <span` + '  [y + 1] ' + `class=fw-bold text-gray-800 fs-6>` + data.services[y].package.name + `&nbsp</span>
                                        <div id="str`+[y + 1]+`" style="">
                                            <span>
                                                <b>Review -></b>&nbsp
                                                <span>`+ reaview +`</span>
                                                <br><b>Star -></b>&nbsp
                                                <span>`+ star +`</span>
                                            </span>
                                        </div>
                                        <br>
                                    </td>
                                    <td valign="top" style="text-align:right;">
                                        <span id="info_servicetitle"` + ' [y + 2] ' + `class=fw-bold text-gray-800 fs-6>{{ getSettings()->currency }}` + data.services[y].package.price + `</span>
                                    </td>
                                </tr>
                                <br>`);

                            if(Object.keys(data.review).length != "0"){
                                $("#str" + [y + 1]).show();
                            }else{
                                $("#str" + [y + 1]).hide();
                            }
                        } else {
                            if(Object.keys(data.review).length != "0"){
                                var star =  data.review[y].star;
                                var reaview =  data.review[y].review;
                            }else{
                                star = "N/A";
                                reaview = "N/A";
                            }
                            // var star =  data.review[y].star

                            $("#info_servicetitle").append(
                                `<tr>
                                    <td valign="top">` + [y + 1] + `</td>
                                    <td>
                                        <span` + '  [y + 1] ' + `class=fw-bold text-gray-800 fs-6>` + data.services[y].package.name + `&nbsp</span>
                                        <div id="str`+[y + 1]+`" style="">
                                            <span>
                                                <b>Review -></b>&nbsp
                                                <span>`+ reaview +`</span>
                                                <br><b>Star -></b>&nbsp
                                                <span>`+ star +`</span>
                                            </span>
                                        </div>
                                        <br>
                                    </td>
                                    <td valign="top" style="text-align:right;">
                                        <span id="info_servicetitle"` + ' [y + 2] ' + `class=fw-bold text-gray-800 fs-6>
                                            {{ getSettings()->currency }}` + data.services[y].package.price + `&nbsp
                                        </span>
                                    </td>
                                </tr>
                                <br>`);
                            if(Object.keys(data.review).length != "0"){
                                $("#str" + [y + 1]).show();
                            }else{
                                $("#str" + [y + 1]).hide();
                            }
                        }
                    }
                    // -----------------------------------------------------------------------------

                    // html2 = "";
                    // for (var y = 0; y < Object.keys(data.services).length; y++) {
                    //     if (y == 0) {
                    //         $("#info_servicetitle").append(
                    //             `<tr><th class="pb-5" style="width:200px">No</th><th class="pb-5" style="width:200px">Package Name</th><th class="pb-5" style="width:200px;text-align: end;">Price</th></tr><br><tr><td>` +
                    //             [y + 1] + `</td><td><span` + '  [y + 1] ' +
                    //             `class=fw-bold text-gray-800 fs-6>` + data.services[y].package
                    //             .name +
                    //             `&nbsp</span></td><td style="text-align: end;"><span id="info_servicetitle"` + ' [y + 2] ' +
                    //             `class=fw-bold text-gray-800 fs-6>{{ getSettings()->currency }}` +
                    //             data.services[y].package.price +
                    //             `&nbsp</span></td></tr>`);

                    //     } else {

                    //         $("#info_servicetitle").append(`<tr><td>` + [y + 1] + `</td><td><span` +
                    //             '  [y + 1] ' +
                    //             `class=fw-bold text-gray-800 fs-6>` + data.services[y].package
                    //             .name +
                    //             `&nbsp</span></td><td style="text-align: end;"><span id="info_servicetitle"` + ' [y + 2] ' +
                    //             `class=fw-bold text-gray-800 fs-6>{{ getSettings()->currency }}` +
                    //             data.services[y].package.price +
                    //             `&nbsp</span></td></tr>`);
                    //     }
                    // }
                    // $('#servicetitle').append(html2);
                    // var html = "";
                    // // debugger
                    // // console.log(data.services);
                    // for (var a = 0; a < Object.keys(data.services).length; a++) {
                    //     var serviceImages = data.services[a].service.service_images;
                    // }
                    // console.log(serviceImages.length);
                    // if (serviceImages.length == 0) {
                    //     html +=
                    //         '<span id="imageStatus" class="fw-bold text-gray-800 fs-6">No Imaage Available.</span>';
                    // } else {
                    //     html = "";
                    // }
                    // for (var i = 0; i < serviceImages.length; i++) {
                    //     html += '<img src="' + serviceImages[i].s3image +
                    //         '" alt="" width="100" class="fw-bold text-gray-800 fs-6 ml-5" style="max-height: 100px;max-width: 100px;" id="infoImage' +
                    //         [i + 1] + '">&nbsp&nbsp&nbsp'
                    // }
                    html3 = "";
                    var proof = data.proof
                    if (proof.length == 0) {
                        html3 +=
                            '<span id="proufImage" class="fw-bold text-gray-800 fs-6">No Imaage Available.</span>';
                    } else {
                        html3 = "";
                    }
                    for (var i = 0; i < proof.length; i++) {
                        html3 += '<a href="'+proof[i].s3image+'" target="_blank" rel="noreferrer"><img src="' + proof[i].s3image +
                            '" alt="" width="100px" class="fw-bold text-gray-800 fs-6 ml-5" style="max-height: 100px;max-width: 100px; aspect-ratio: 3/2; object-fit: contain;" id="infoImage' +
                            [i + 1] + '"></a>&nbsp&nbsp&nbsp'
                    }
                    // for (let i = 0; i < serviceImages.length; i++) {
                    //     if (i == 0 || i == 1 || i == 2) {
                    //         html += '<img src="' + serviceImages[i].s3image +
                    //             '" alt="" width="100" class="fw-bold text-gray-800 fs-6 ml-5" style="max-height: 100px;max-width: 100px;" id="infoImage' +
                    //             [i + 1] + '">&nbsp&nbsp&nbsp'
                    //     } else {
                    //         html += '<img src="' + serviceImages[i].s3image +
                    //             '" alt="" width="100" class="fw-bold text-gray-800 fs-6 ml-5 mt-12" style="max-height: 100px;max-width: 100px;" id="infoImage' +
                    //             [i + 1] + '">&nbsp&nbsp&nbsp'
                    //     }
                    // }
                    $('#productImages').append(html);
                    // $('#servicetitle').append(html2);
                    $('#proufImages').append(html3);
                    $('#kt_modal_service_info').modal('toggle');
                },
                complete: function() {
                    $('#loader').addClass('display-none')
                },
            });
            // console.log(html);
            // $('#kt_modal_user_info').modal('toggle');


        });
</script>
@endsection
