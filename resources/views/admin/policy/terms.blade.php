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
                            
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
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
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4"
                                id="kt_datatable">
                                <!--begin::Table head-->
                                <form class="form-horizontal" method="post" action="{{ route('admin.update.terms') }}">
                                    @csrf
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        @foreach ($list as $index => $item)
                                            <div class="form-group row mb-4">
                                                <label for="billing-name" class="col-md-2 col-form-label">Header</label>
                                                <div class="col-md-10">
                                                    <input type="text" placeholder="Header" name="header" id="header" value="{{$item->title}}" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label for="billing-address" class="col-md-2 col-form-label">Content</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" name="content"  id="content" cols="30" rows="5" placeholder="Email Content Title">{!! $item->content!!}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="text-end">
                                        <input type="submit" name="btnTermsSave" Value="Save" class="btn btn-primary">
                                    </div>
                                </form>
                            </table>
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->



<!--end::Modal - New Address-->
@endsection
@section('script')

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    editor = CKEDITOR.replace('content')

    editor.addCommand("mySimpleCommand", {
        exec: function(edt) {
            alert(edt.getData());
        }
    });
    editor.ui.addButton('SuperButton', {
        label: "Click me",
        command: 'mySimpleCommand',
        toolbar: 'insert',
        icon: 'https://avatars1.githubusercontent.com/u/5500999?v=2&s=16'
    });
    editor.on('change', function() {
            var val = editor.getData(); // Get the CKEditor content
            $("#content").val(val);
            // console.log(val);
        });
</script>
@endsection
