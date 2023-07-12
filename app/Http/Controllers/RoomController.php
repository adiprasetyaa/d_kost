<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;

class RoomController extends Controller
{

    public function listRoom(){
        $data_room = Room::latest()->get();
        
        return view('user.backend.room.index', compact('data_room'));
    }

    public function createRoom($room_id){

        $data_user = Auth::user();

        $data_room = Room::where('room_id', $room_id)
            ->first();

        return view('user.backend.room.create', compact('data_room', 'data_user'));
    }

    public function index()
    {
        $roomTypes = ['Small', 'Medium', 'Large'];
        $statusRoom = ['available', 'booked', 'unavailable'];
        $data_room = Room::latest()->get();

        return view('admin.backend.room.index', compact('data_room', 'roomTypes', 'statusRoom'));
    }


    public function create()
    {

        $roomTypes = ['Small', 'Medium', 'Large'];
        $statusRoom = ['available', 'booked', 'unavailable'];
        $data_room = Room::latest()->get();

        return view('admin.backend.room.create', compact('data_room', 'roomTypes', 'statusRoom'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required',
            'room_type' => 'required|not_in:- Pilih Tipe Kamar -',
            'room_floor' => 'required',
            'rental_price' => 'required',
            'status' => 'required|not_in:- Pilih Status Ketersediaan -'
        ]);

        $room = new Room();
        $room->room_id = $request-> room_id;
        $room->room_number = $request->room_number;
        $room->room_type = $request->room_type;
        $room->room_floor = $request->room_floor;
        $room->rental_price = $request->rental_price;
        $room -> status = $request->status;
        
        if ($request->hasFile('photo')) {
            $uploadedFile = $request->file('photo');
            $file_name = time() . rand(100, 999) . "." . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move('upload/foto_kamar/', $file_name);
            $photo_path = 'upload/foto_kamar/' . $file_name;
            $room->photo = $photo_path;
        }

        $room->save();

        $notification_success = array(
            'message' => 'Data Kamar Baru berhasil ditambahkan!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.room.create')
            ->with($notification_success);
    }


    public function show($room_id)
    {
        //
        $data_room = Room::findOrFail($room_id);

        return view('admin.backend.room.index', compact('data_room'));
    }

    public function edit($room_id)
    {
        $data_room = Room::findOrFail($room_id);
        $roomTypes = ['Small', 'Medium', 'Large'];
        $statusRoom = ['available', 'booked', 'unavailable'];

        return view('admin.backend.room.edit', compact('data_room','roomTypes', 'statusRoom'));
    }

    public function update(Request $request, $room_id)
    {

        $room = Room::findOrFail($room_id);

        if ($request->hasFile('photo')) {
            $uploadedFile = $request->file('photo');
            $file_name = time() . rand(100, 999) . "." . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move('upload/foto_kamar/', $file_name);
            $photo_path = 'upload/foto_kamar/' . $file_name;
            $room->photo = $photo_path;
        }

        $room->room_id = $request-> room_id;
        $room->room_number = $request->room_number;
        $room->room_type = $request->room_type;
        $room->room_floor = $request->room_floor;
        $room->rental_price = $request->rental_price;
        $room -> status = $request->status;

        $room->save();

        $notification_success = array(
            'message' => 'Data Kamar berhasil diupdate!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.room.index')
            ->with($notification_success);
    }

    public function destroy($room_id)
    {
        $room = Room::findOrFail($room_id);
        $room->delete();

        $notification_success = array(
            'message' => 'Data Kamar berhasil dihapus!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.room.index')
            ->with($notification_success);
    }
}
