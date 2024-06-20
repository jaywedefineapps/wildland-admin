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
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                            <form action="#" method="get">
                            {{-- @csrf --}}
                            <div class="d-flex align-items-center position-relative my-1">
                                <input type="hidden" name="id" value="{{request()->id}}">
                                <input type="hidden" name="token" value="{{request()->token}}">
                                <input type="hidden" name="date_range" id="date_range" />
                                <input class="form-control" style="" placeholder="Pick date rage" id="date_picker" />

                                <div class="form-group mx-2">
                                    <button type="submit" class="btn btn-success pl-3">Search</button>
                                </div>
                                <div class="form-group mx-2">
                                    <a href="{{route('user.valve.history',['id'=>request()->id,'token'=>request()->token])}}" class="btn btn-dark pl-3">Reset</a>
                                </div>
                            </div>
                        </form>
                        <!--end::Search-->
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
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
                                    <th class="min-w-125px">Date</th>
                                    <th class="min-w-125px">Vavle Id</th>
                                    <th class="min-w-125px">Start time</th>
                                    <th class="min-w-100px">Duration (Seconds)</th>
                                </tr>
                            </thead>
                            <tbody class="fw-bold text-gray-600">
                                @foreach ($valveHistory['valveDayViews'] as $index => $item)
                                    @if ($item['valveQuickRunSummaries'])                                    
                                        <tr data-target="fullRow" id="">
                                            <td>
                                                <a href="javascript: void(0);" id="roleID" class="text-body fw-bold"></a>
                                                {{  $index + 1 }}
                                            </td>
                                            <td>
                                                {{$item['date']['day'].'/'.$item['date']['month'].'/'.$item['date']['year'] }}
                                            </td>
                                        
                                            <td>
                                                @if($item['valveQuickRunSummaries'] && $item['valveQuickRunSummaries'][0] ) {{ $item['valveQuickRunSummaries'][0]['valveRunSummaries'][0]['valveId']}}@endif
                                            </td>
                                            <td>
                                                @if($item['valveQuickRunSummaries'] && $item['valveQuickRunSummaries'][0] ) {{ date('h:i:s A', strtotime($item['valveQuickRunSummaries'][0]['valveRunSummaries'][0]['start']))}}@endif
                                            </td>
                                            <td>
                                                @if($item['valveQuickRunSummaries'] && $item['valveQuickRunSummaries'][0] ) {{ $item['valveQuickRunSummaries'][0]['valveRunSummaries'][0]['durationSeconds']}}@endif
                                            </td>
                                            
                                        </tr>
                                    @endif

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

</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#date_picker').on('keydown', function(e) {
            e.preventDefault(); // Prevent any key from being entered
        });
        
        var start_1 = moment().startOf('month');
        var end_1 = moment().endOf('month');
        
        $("#date_picker").daterangepicker({
            autoApply: true,
            startDate: start_1,
            endDate: end_1,
            ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")],
                "Yearly": [moment().startOf("year"), moment().endOf("year")]
            }
        }, function(start, end, label) {
            $('#date_range').val(start.format('YYYY-MM-DD') + '|' + end.format('YYYY-MM-DD'));
        });
        
        // Initialize the hidden input with the initial values
        $('#date_range').val(start_1.format('YYYY-MM-DD') + '|' + end_1.format('YYYY-MM-DD'));
    });
</script>

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
