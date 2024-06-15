<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../">
		<title>Wildland- Login</title>
		<meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/asset-1.png')}}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
        <style>
            /* Start Loader Process */
            #preloader{
                background: rgba(255,255,255,0.5) url("{{ asset('assets/media/img/loader.gif') }}") no-repeat center center;
                backdrop-filter: blur(1px);
                background-size: 5%;
                height: 100vh;
                width: 100%;
                position: fixed;
                z-index: 100;
            }
            /* End Loader Process */
            label.error {
                font-size: .925rem;
                color: #f1416c;
            }
        </style>
        <div id="preloader">

        </div>
        @yield('css')
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">

                @yield('content')

			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<script>var hostUrl = "{{ asset('assets/')}}";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{ asset('assets/js/custom/authentication/sign-in/general.js')}}"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->

        {{-- Start Success Message --}}
        @if(\Session::has('success'))
            <div>
                <script>
                    toastr.success("{{ Session::get('success') }}");
                </script>
            </div>
        @endif
        {{-- End Success Message --}}
        {{-- Start Error Message --}}
        @if(\Session::has('error'))
            <div>
                <script>
                    toastr.error("{{ Session::get('error') }}");
                </script>
            </div>
        @endif
        {{-- End Error Message --}}

        {{-- Start::Loader End Process --}}
		<script>
            var loader = document.getElementById("preloader");
            window.addEventListener("load", function(){
                loader.style.display = "none";
            })
        </script>
        {{-- End::Loader End Process --}}
        @yield('script')
	</body>
	<!--end::Body-->
</html>
