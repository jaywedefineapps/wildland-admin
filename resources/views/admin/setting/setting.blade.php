@extends('layouts.master')
@section('css')
@endsection
@section('content')
    <!--begin::Toolbar-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">{{ $title }}</li>
                    <!--end::Item-->
                </ul>
                <!--end::Title-->
            </div>
        </div>
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
                        <div class="d-flex align-items-center position-relative my-1">

                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->

                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <form action="{{ route('setting.update') }}" id="settings_form" method="POST">
                    @csrf
                    <div class="card-body pt-0">
                        <input type="hidden" name="setting_id" value="{{ $setting['id'] }}">
                        <h2 class="mb-10">Company Info</h2>
                        <div id="kt_modal_add_customer_billing_info" class="collapse show">
                            <!--begin::Input group-->
                            <div class="row g-9 mb-7">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">App Name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control " placeholder="App Name" name="app_name"
                                        value="{{ $setting['app_name'] }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">Support Email</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control " placeholder="Email" name="support_email"
                                        value="{{ $setting['support_email'] }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <h2 class="mb-10 mt-10">SMTP </h2>
                        <div id="kt_modal_add_customer_billing_info" class="collapse show">
                            <!--begin::Input group-->
                            <div class="row g-9 mb-7">
                                <!--begin::Col-->
                                <div class="col-md-3 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">SMTP Host</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control " placeholder="Host" name="smtp_host"
                                        value="{{ $setting['smtp_host'] }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-3 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">SMTP Username</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control " placeholder="Username" name="smtp_username"
                                        value="{{ $setting['smtp_username'] }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-3 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">SMTP Password</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control " placeholder="Password" name="smtp_password"
                                        value="{{ $setting['smtp_password'] }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-3 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">SMTP Port</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control " placeholder="Port" name="smtp_port"
                                        value="{{ $setting['smtp_port'] }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <h2 class="mb-10 mt-10">Pagination </h2>
                        <div id="kt_modal_add_customer_billing_info" class="collapse show">
                            <!--begin::Input group-->
                            <div class="row g-9 mb-7">
                                <!--begin::Col-->
                                <div class="col-md-4 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">App Pagination Size</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control " placeholder="Size" name="pagination_size"
                                        value="{{ $setting['pagination_size'] }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-4 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">Home Page Size</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control " placeholder="Size" name="home_page_size"
                                        value="{{ $setting['home_page_size'] }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>

                        <h2 class="mb-10 mt-10">Currency </h2>
                        <div id="kt_modal_add_customer_billing_info" class="collapse show">
                            <!--begin::Input group-->
                            <div class="row g-9 mb-7">
                                <div class="col-md-4 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">Currency</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control " placeholder="Currency" name="currency"
                                        value="{{ $setting['currency'] }}" />
                                    <!--end::Input-->
                                </div>
                            </div>

                            <!--end::Input group-->
                        </div>
                        <h2 class="mb-10 mt-10">App Version</h2>
                        <div id="kt_modal_add_customer_billing_info" class="collapse show">
                            <!--begin::Input group-->
                            <div class="row g-9 mb-7">
                                <!--begin::Col-->
                                <div class="col-md-4 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">Android App Version</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control " placeholder="App Version" name="app_version"
                                        value="{{ $setting['app_version'] }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-4 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">Ios App Version</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control " placeholder="Ios App Version" name="ios_app_version"
                                        value="{{ $setting['ios_app_version'] }}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <div class="modal-footer flex-right">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('form[id="settings_form"]').validate({
            rules: {
                app_name: 'required',
                support_email: {
                    required: true,
                    email: true,
                },
                smtp_host: 'required',
                smtp_username: 'required',
                smtp_password: 'required',
                smtp_port: 'required',
                pagination_size: {
                    required: true,
                    number: true,
                },
                home_page_size: {
                    required: true,
                    number: true,
                },
                currency: 'required',

                app_version: {
                    required: true,
                    number: true,
                },
                ios_app_version: {
                    required: true,
                },
                aws_access_key: 'required',

            },
            messages: {
                app_name: 'App Name is required',
                lname: 'This field is required',
                user_email: 'Enter a valid email',
                psword: {
                    minlength: 'Password must be at least 8 characters long'
                }
            },

            submitHandler: function(form) {
                form.submit();
            }
        });

        function changeTaxSetting() {
            if ($('.taxSetting').is(":checked")) {
                var taxSetting = 1;
            } else {
                var taxSetting = 0;
            }
            $.ajax({
                url: "{{ route('change.taxsetting') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    taxSetting: taxSetting
                },
                success: function(data) {
                    // if(data == 1) {
                    //     swal.fire({
                    //         text: "category succesfully added!",
                    //         icon: "success",
                    //         buttonsStyling: !1,
                    //         confirmButtonText: "Ok, got It!",
                    //         customClass: {
                    //             confirmButton: "btn btn-primary"
                    //         }
                    //     }).then((function(e) {
                    //         location.reload();
                    //     }));
                    // } else {
                    //     location.reload();
                    // }
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

        function setInputFilter(textbox, inputFilter, errMsg) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"].forEach(
                function(event) {
                    textbox.addEventListener(event, function(e) {
                        if (inputFilter(this.value)) {
                            // Accepted value
                            if (["keydown", "mousedown", "focusout"].indexOf(e.type) >= 0) {
                                this.classList.remove("input-error");
                                this.setCustomValidity("");
                            }
                            this.oldValue = this.value;
                            this.oldSelectionStart = this.selectionStart;
                            this.oldSelectionEnd = this.selectionEnd;
                        } else if (this.hasOwnProperty("oldValue")) {
                            // Rejected value - restore the previous one
                            this.classList.add("input-error");
                            this.setCustomValidity(errMsg);
                            this.reportValidity();
                            this.value = this.oldValue;
                            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                        } else {
                            // Rejected value - nothing to restore
                            this.value = "";
                        }
                    });
                });
        }

        setInputFilter(document.getElementById("intLimitTextBox"), function(value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 500);
        }, "Must be between 0 and 500");
    </script>
@endsection
