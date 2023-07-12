@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>                        

<main id="main" class="main">

<div class="pagetitle">
    <nav>
        <ol class="breadcrumb">
        <!-- Vertically centered Modal -->
        <a href="{{ route('admin.reservation.create') }}" method="GET">
            <button type="button"  class="btn btn-primary m-2"><span class="bi bi-plus-lg me-2">  Add Reservasi Baru</span></button>
        </a>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
    <div class="col-lg-12">

        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Reservasi</h5>

            <!-- Table with stripped rows -->
            <table class="table datatable">
            <thead>
                <tr>
                <th scope="col">ID Reservasi</th>
                <th scope="col">Nama</th>
                <th scope="col">Nomor Kamar</th>
                <th scope="col">Tanggal Reservasi</th>
                <th scope="col">Status Reservasi</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($data_reservation as $key => $item)
            <tr>
                <th scope="row">{{ $item->reservation_id }}</th>
                <td>{{ $item->user->name}}</td>
                <td>{{ $item->room->room_number}}</td>
                <td>{{ $item->reservation_date}}</td>
                <td>
                    <span class="badge {{ $item->reservation_status === 'accepted' ? 'bg-success' : ($item->reservation_status === 'pending' ? 'bg-warning text-dark' : ($item->reservation_status === 'rejected' ? 'bg-danger' : 'bg-dark')) }}">
                        {{ $item->reservation_status }}
                    </span>    
                </td>
                <td>
                <a type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#show_data-{{ $item->reservation_id}}">
                    <i class="bi bi bi-eye"></i>
                </a>
                <a type="button" href="{{ route('admin.reservation.edit',$item->reservation_id) }}" class="btn btn-success">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('admin.reservation.delete', $item->reservation_id) }}" method="POST" style="display: inline;">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
                
                </td>
            </tr>       
            @endforeach
            @foreach ($data_reservation as $data )
                <!-- Modal for Show Data -->
                <div class="modal fade" id="show_data-{{ $data->reservation_id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- General Form Elements -->
                            <h5 class="card-title mx-3">Data Reservasi</h5>
                            <form action="{{ route('admin.reservation.show', $data->reservation_id)}}" method="get">
                                @method('GET')
                                @csrf
                                <div class="row m-2">
                                    <label for="reservation_id" class="col-sm-12 col-form-label">ID Reservasi</label>
                                    <div class="col-sm-12">
                                        <p>{{ $data->reservation_id }}</p>
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <label for="name" class="col-sm-12 col-form-label">Nama</label>
                                    <div class="col-sm-12">
                                        <p> {{ $data->user->name}}</p>
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <label for="room_number" class="col-sm-12 col-form-label">Nomor Kamar</label>
                                    <div class="col-sm-12">
                                        <p> {{ $data->room->room_number }}</p>
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <label for="room_floor" class="col-sm-12 col-form-label">Tanggal Reservasi</label>
                                    <div class="col-sm-12">
                                        <p>{{ $data->reservation_date }}</p>
                                    </div>
                                </div>  
                                <div class="row m-2">
                                    <label for="rental_price" class="col-sm-12 col-form-label">Status Reservasi</label>
                                    <div class="col-sm-12">
                                        <p>{{ $data->reservation_status}}</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form><!-- End General Form Elements -->
                        </div>
                        </div>
                    </div>
                </div> <!-- End Modal for Show Data -->          
            @endforeach

            </tbody>
            </table>
            <!-- End Table with stripped rows -->

        </div>
        </div>

    </div>
    </div>
</section>

</main><!-- End #main -->
@endsection`