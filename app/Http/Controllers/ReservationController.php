<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    public function storeReservation(Request $request, $room_id){

        $data_user = Auth::user();
        $data_room = Room::findOrFail($room_id);

        $data_reservasi = new Reservation();
        $data_reservasi->reservation_date = $request->reservation_date;
        $data_reservasi->user_id  = $data_user->user_id;
        $data_reservasi->room_id = $data_room->room_id;
        $data_reservasi->save();

        $data_room->status = 'booked';
        $data_room->save();

        $notification = array(
            'message' => 'Reservasi berhasil terkirim!',
            'alert-type' => 'success'
        );

        return redirect()->route('user.list.room')
            ->with($notification);
    }

    public function index()
    {
        //
        $statusReservation = ['accepted', 'rejected', 'pending'];
        $data_user = User::latest()->get();
        $data_room = Room::latest()->get();
        $data_reservation = Reservation::with('user','room')->get();

        return view('admin.backend.reservation.index', compact('statusReservation', 'data_reservation', 'data_user', 'data_room'));
    }

    public function create()
    {;
        //
        $statusReservation = ['accepted', 'rejected', 'pending'];
        $data_user = User::latest()->get();
        $data_room = Room::latest()->get();
        $data_reservation = Reservation::with('user','room')->get();

        return view('admin.backend.reservation.create', compact('statusReservation', 'data_reservation', 'data_user', 'data_room'));

    }


    public function store(Request $request)
    {
        //

        $reservation = new Reservation();
        $reservation->user_id = $request->user_id;
        $reservation->room_id = $request->room_id;
        $reservation->reservation_date = $request->reservation_date;
        $reservation->reservation_status = $request->reservation_status;
        $reservation->save();

        $notification = array(
            'message' => 'Data Reservasi baru berhasil ditambahkan!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.reservation.create')
            ->with($notification);
    }


    public function show($id_reservation)
    {
        //
        $data_reservation = Reservation::findOrFail($reservation_id)
            ->with('user', 'room');

        return view('admin.backend.reservation.index', compact('data_reservation'));
    }


    public function edit($reservation_id)
    {
        //
        $data_reservation = Reservation::findOrFail($reservation_id);

        $data_room = Room::latest()->get();
        $data_user = User::latest()->get();
        $statusReservation = ['accepted', 'rejected', 'pending'];
                                            
        return view('admin.backend.reservation.edit', compact('statusReservation', 'data_reservation', 'data_user', 'data_room'));
    }

    public function update(Request $request, $reservation_id)
    {
        //
        $reservation = Reservation::findOrFail($reservation_id);

        $reservation->user_id = $request->user_id;
        $reservation->room_id = $request->room_id;
        $reservation->reservation_date = $request->reservation_date;
        $reservation->reservation_status = $request->reservation_status;
        $reservation->save();


        $notification_success = array(
            'message' => 'Data Reservasi berhasil diupdate!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.reservation.edit', $reservation_id)
            ->with($notification_success);
    }


    public function destroy($id_reservation)
    {
        //
        $data_reservation = Reservation::findOrFail($id_reservation);
        $data_reservation->delete();

        $notification_success = array(
            'message' => 'Data Reservasi berhasil dihapus!',
            'alert-type' => 'success'
        );

        return redirect()->back()
            ->with($notification_success);
    }
}
