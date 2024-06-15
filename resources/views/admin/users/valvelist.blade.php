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
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4"
                        id="kt_datatable">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th>No.</th>
                                <th class="min-w-125px">Image</th>
                                <th class="min-w-125px">Name</th>
                                <th class="min-w-125px">Connection Id</th>
                                <th class="min-w-100px">Battery Status</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600">
                            @foreach ($valveList['valves'] as $index => $item)
                                <tr data-target="fullRow" id="{{ $item['id'] }}">
                                    <td>
                                        <a href="javascript: void(0);" id="roleID" class="text-body fw-bold"></a>
                                        {{  $index + 1 }}
                                    </td>
                                    <td>
                                        <img src="@if(!empty($item['photo'])){{'https://prod-media-photo.rach.io/'.$item['photo']['id']}}@else{{ asset('assets/media/img/no-user.png') }} @endif"
                                        class="w-45px h-45px me-3" alt="Valve image"
                                        onclick="toggleFullScreen(this)" loading="lazy" />
                                    </td>
                                    <td>
                                        {{ $item['name']}}
                                    </td>
                                    <td>
                                        {{ $item['connectionId']}}
                                    </td>
                                    <td>
                                        {{ $item['state']['reportedState']['batteryStatus']}}
                                    </td>
                                    {{-- <td class="text-end">
                                        <div class="d-flex gap-3">
                                            <a href="#" id="details" data-role="details"
                                                data-id="{{ $item['id'] }}"
                                                data-bs-toggle="tooltip" title="Details"
                                                data-bs-custom-class="tooltip-dark">
                                                <span class="svg-icon svg-icon-primary svg-icon-2hx">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black"></rect>
                                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black"></path>
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>
                                    </td> --}}
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
                            {{-- Showing {{ $list->firstItem() }} to {{ $list->lastItem() }} of {{ $list->total() }} records --}}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                        <div>
                            {{-- {{ $list->appends(request()->except('page'))->links('pagination::bootstrap-4') }} --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
@section('script')
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
