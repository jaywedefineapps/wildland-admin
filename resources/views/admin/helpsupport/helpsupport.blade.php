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
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{ $title }}</h1>
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
                    <li class="breadcrumb-item text-dark">{{ $page }}</li>
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
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <!--begin::Add customer-->
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
                                    <th style="width: 5%">No.</th>
                                    <th class="min-w-125px">Email</th>
                                    <th class="min-w-125px">Message</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <tbody class="fw-bold text-gray-600">
                                @if (count($list) > 0)
                                    @foreach ($list as $index => $item)
                                        <tr data-target="fullRow" id="{{ $item->id }}">
                                            <td><a href="javascript: void(0);" id="roleID"
                                                    class="text-body fw-bold"></a>{{ $index + 1 }}</td>
                                            <input class="text-gray-800 text-hover-primary mb-1" type="hidden"
                                                value="{{ $item->id }}" />
                                            </td>

                                            <td>{{ $item->email }}</td>

                                            <td> <?php echo stringReadMoreInline($item->message, 30); ?></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td align="center" colspan="3">{{ 'No data found' }}</td>
                                    </tr>
                                @endif
                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>
                    <div class="row">
                        <div
                            class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                            <div class="paginationDiv">
                                Showing {{ $list->firstItem() }} to {{ $list->lastItem() }} of
                                {{ $list->total() }} records
                            </div>
                        </div>
                        <div
                            class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                            <div>
                                {{ $list->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection

@section('script')
@endsection
