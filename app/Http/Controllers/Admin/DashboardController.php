<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\User;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct()
    {
    }
    public function dashboard(Request $request)
    {
        // // book model
        // $data['bookingCount'] = Book::withTrashed()->count();
        // $data['thisMonthBookingCount'] = Book::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
        // $data['LastMonthBookingCount'] = Book::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [now()->subMonthsNoOverflow(1)->format('Y-m')])->count();
        // // business model
        // $data['companies'] = Business::all()->count();
        // $data['thisMonthCompaniesCount'] = Business::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
        // $data['LastMonthCompaniesCount'] = Business::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [now()->subMonthsNoOverflow(1)->format('Y-m')])->count();
        // // user model
        // $data['freelancers'] = User::where('type', 'freelancer')->withTrashed()->count();
        // $data['pendingFreelancers'] = User::where('type', 'freelancer')->where('verified', '0')->count();
        // $data['activeFreelancers'] = User::where('type', 'freelancer')->where('verified', '1')->count();
        // $data['bannedFreelancers'] = DB::table('users')
        // ->where('type', 'freelancer')
        // ->whereNotNull('deleted_at')
        // ->count();

        // $data['client'] = User::where('type', 'user')->count();
        // $data['thisMonthclientCount'] = User::where('type', 'user')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
        // $data['LastMonthclientCount'] = User::where('type', 'user')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [now()->subMonthsNoOverflow(1)->format('Y-m')])->count();

        // $data['chek'] = "booking";
        // $data['businessBooking'] = $this->businessService->businessAll();
        // $data['freelancerslistBooking'] = $this->userService->bookingFreelancer("");
        // $data['freelancersBooking'] = $this->userService->bookingFilterTestdahsboard('',$request);

        // $data['freelancerspackage'] = $this->userService->bookingpackageFilterTestpackage($request);
        // // dd($data['freelancerslistBooking']);
        // return view('admin.dashboard', ['data' => $data]);
        return view('admin.dashboard');

    }



}
