<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Room;
use App\Models\User;
use App\Models\Reservation;

class AdminController extends Controller
{

    public function index()
    {
        //
        $user_count = User::count();
        $room_count = Room::where('status','available' )->count();
        $total_room = Room::count();
        $reservation_count = Reservation::where('reservation_status', 'pending')->count();
        $total_reservation = Reservation::count();

        $data_user = User::latest()->get();
        $data_room = Room::where('status', 'available')->get();
        $data_reservation = Reservation::where('reservation_status', 'pending')
                            ->with('user','room')
                            ->get();

        return view('admin.index', compact('user_count', 'room_count', 'total_room','reservation_count','total_reservation','data_user', 'data_reservation', 'data_room'));

    }

    public function adminLogin(){

        return view('admin.admin_login');
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

}
