
@php
    $roleAccessesArray = session('roleAccesses', []);
@endphp
@if (in_array('dashboard', $roleAccessesArray))
<div class="menu-item">
    <a class="menu-link @if (Route::currentRouteName() == 'admin.dashboard') active @endif" href="{{ route('admin.dashboard') }}"
        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
        <span class="menu-icon">
            <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor">
                    </rect>
                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor">
                    </rect>
                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor">
                    </rect>
                </svg>
            </span>
            <!--end::Svg Icon-->
        </span>
        <span class="menu-title">Dashboard</span>
    </a>
</div>
@endif
@if (in_array('user_managment', $roleAccessesArray))
<div data-kt-menu-trigger="click" class="menu-item menu-accordion @if (in_array(Route::currentRouteName(), ['accessindex', 'admin.userrole.index', 'roleindex'])) show @endif">
    <span class="menu-link">
        <span class="menu-icon">
            <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-globe" viewBox="0 0 16 16">
                    <path
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </span>
        <span class="menu-title">User Management</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">
        <div class="menu-item">
            <a class="menu-link @if (Route::currentRouteName() == 'roleindex') active @endif" href="{{ route('roleindex') }}"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Roles</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link @if (Route::currentRouteName() == 'admin.userrole.index') active @endif"
                href="{{ route('admin.userrole.index') }}" data-bs-toggle="tooltip" data-bs-trigger="hover"
                data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Users</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link @if (Route::currentRouteName() == 'accessindex') active @endif" href="{{ route('accessindex') }}"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                </span>
                <span class="menu-title">Access</span>
            </a>
        </div>
    </div>
</div>
@endif
@if (in_array('users', $roleAccessesArray))
<div data-kt-menu-trigger="click" class="menu-item menu-accordion @if (in_array(Route::currentRouteName(), ['user.active', 'admin.user.camera', 'admin.user.address','user.deactive', 'user.banned','admin.addUsers','admin.users.edit'])) show @endif">
    <span class="menu-link" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
        data-bs-placement="right">
        <span class="menu-icon">
            <!--begin::Svg Icon | path: assets/media/icons/duotune/text/txt009.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                        fill="currentColor"></path>
                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor">
                    </rect>
                </svg>
            </span>
            <!--end::Svg Icon-->
        </span>
        <span class="menu-title">Users</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">
        <div class="menu-item">
            <a class="menu-link @if (in_array(Route::currentRouteName(),['user.active','admin.user.camera','admin.addUsers','admin.users.edit','admin.user.address'])) active @endif" href="{{ route('user.active') }}"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                </span>
                <span class="menu-title">Active & Deactive</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link @if (Route::currentRouteName() == 'user.banned') active @endif" href="{{ route('user.banned') }}"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                </span>
                <span class="menu-title">Deleted Account</span>
            </a>
        </div>
    </div>
</div>
@endif
@if (in_array('technician', $roleAccessesArray))
<div data-kt-menu-trigger="click" class="menu-item menu-accordion @if (in_array(Route::currentRouteName(), ['technician.active', 'user.deactive', 'technician.banned','admin.addTechnician','admin.technician.edit'])) show @endif">
    <span class="menu-link" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
        data-bs-placement="right">
        <span class="menu-icon">
            <!--begin::Svg Icon | path: assets/media/icons/duotune/text/txt009.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                        fill="currentColor"></path>
                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor">
                    </rect>
                </svg>
            </span>
            <!--end::Svg Icon-->
        </span>
        <span class="menu-title">Technician</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">
        <div class="menu-item">
            <a class="menu-link @if (in_array(Route::currentRouteName(),['technician.active','admin.addTechnician','admin.technician.edit'])) active @endif" href="{{ route('technician.active') }}"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                </span>
                <span class="menu-title">Active & Deactive</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link @if (Route::currentRouteName() == 'technician.banned') active @endif" href="{{ route('technician.banned') }}"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                </span>
                <span class="menu-title">Deleted Account</span>
            </a>
        </div>
    </div>
</div>
@endif
@if (in_array('technician_request', $roleAccessesArray))
<div data-kt-menu-trigger="click" class="menu-item menu-accordion @if (in_array(Route::currentRouteName(), ['admin.pending.techreq', 'admin.completed.techreq'])) show @endif">
    <span class="menu-link" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
        data-bs-placement="right">
        <span class="menu-icon">
            <!--begin::Svg Icon | path: assets/media/icons/duotune/text/txt009.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                        fill="currentColor"></path>
                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor">
                    </rect>
                </svg>
            </span>
            <!--end::Svg Icon-->
        </span>
        <span class="menu-title">Technician request</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">
        <div class="menu-item">
            <a class="menu-link @if (in_array(Route::currentRouteName(),['admin.pending.techreq'])) active @endif" href="{{ route('admin.pending.techreq') }}"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                </span>
                <span class="menu-title">Pending</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link @if (Route::currentRouteName() == 'admin.completed.techreq') active @endif" href="{{ route('admin.completed.techreq') }}"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                </span>
                <span class="menu-title">Completed</span>
            </a>
        </div>
    </div>
</div>
@endif
@if (in_array('location_managment', $roleAccessesArray))
<div data-kt-menu-trigger="click" class="menu-item menu-accordion @if (in_array(Route::currentRouteName(), ['admin.country', 'provinces', 'cities'])) show @endif">
    <span class="menu-link">
        <span class="menu-icon">
            <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-globe" viewBox="0 0 16 16">
                    <path
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </span>
        <span class="menu-title">Location Management</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">
        <div class="menu-item">
            <a class="menu-link @if (Route::currentRouteName() == 'admin.country') active @endif" href="{{ route('admin.country') }}"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Country</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link @if (Route::currentRouteName() == 'provinces') active @endif" href="{{ route('provinces') }}"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Provinces</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link @if (Route::currentRouteName() == 'cities') active @endif" href="{{ route('cities') }}"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                </span>
                <span class="menu-title">City</span>
            </a>
        </div>
    </div>
</div>
@endif
@if (in_array('cms', $roleAccessesArray))
<div data-kt-menu-trigger="click" class="menu-item menu-accordion @if (in_array(Route::currentRouteName(), ['admin.policy', 'admin.terms_condition','deactivereasons','admin.faq'])) show @endif">
    <span class="menu-link">
        <span class="menu-icon">
            <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-globe" viewBox="0 0 16 16">
                    <path
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </span>
        <span class="menu-title">CMS</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion menu-active-bg">
        <div class="menu-item">
            <a class="menu-link @if (Route::currentRouteName() == 'admin.policy') active @endif" href="{{ route('admin.policy') }}"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                </span>
                <span class="menu-title">Privacy Policy</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link @if (Route::currentRouteName() == 'admin.terms_condition') active @endif"
                href="{{ route('admin.terms_condition') }}" data-bs-toggle="tooltip" data-bs-trigger="hover"
                data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                </span>
                <span class="menu-title">Terms & Conditions</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link @if (Route::currentRouteName() == 'admin.faq') active @endif"
                href="{{ route('admin.faq') }}" data-bs-toggle="tooltip" data-bs-trigger="hover"
                data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                </span>
                <span class="menu-title">FAQ</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link @if (Route::currentRouteName() == 'deactivereasons') active @endif"
                href="{{ route('deactivereasons') }}" data-bs-toggle="tooltip" data-bs-trigger="hover"
                data-bs-dismiss="click" data-bs-placement="right">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                </span>
                <span class="menu-title">Account Deactivate Reasons</span>
            </a>
        </div>
    </div>
</div>
@endif
@if (in_array('settings', $roleAccessesArray))
<div class="menu-item">
    <a class="menu-link @if (Route::currentRouteName() == 'settings') active @endif" href="{{ route('settings') }}"
        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
        <span class="menu-icon">
            <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-gear" viewBox="0 0 16 16">
                    <path
                        d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                    <path
                        d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </span>
        <span class="menu-title">Setting</span>
    </a>
</div>
@endif