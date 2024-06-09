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

    $('#kt_modal_service_info_closes').click(function() {
        $('#kt_modal_service_infos').modal('toggle');
    })
</script>
@endsection
