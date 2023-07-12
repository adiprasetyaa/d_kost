@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>                        

<main id="main" class="main">

<div class="pagetitle">
    <nav>
        <ol class="breadcrumb">
        <!-- Vertically centered Modal -->
        <a href="{{ route('admin.room.create') }}" method="GET">
            <button type="button"  class="btn btn-primary m-2"><span class="bi bi-plus-lg me-2">  Add Kamar Baru</span></button>
        </a>
        <div class="modal fade" id="add_data" tabindex="-1" >
            <div class="modal-dialog modal-dialog-centered" style="width: 800px;">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- General Form Elements -->
                    <h5 class="card-title">Add kamar Baru</h5>
                    <form action="{{ route('admin.room.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="row mb-3 m-2">
                            <label for="room_number" class="col-sm-12 col-form-label">Nomor Kamar</label>
                            <div class="col-sm-12">
                                <input type="number" name="room_number" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3 m-2">
                            <label for="room_type" class="col-sm-12 col-form-label">Tipe Kamar</label>
                            <div class="col-sm-12">
                                <select name="room_type" id="room_type" class="form-select" aria-label="Default select example">
                                    <option selected>- Pilih Tipe Kamar -</option>
                                    @foreach ($roomTypes as $roomType)
                                    <option value="{{ $roomType }}">{{ $roomType }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 m-2">
                            <label for="room_floor" class="col-sm-12 col-form-label">Lantai Kamar</label>
                            <div class="col-sm-12">
                                <input type="number" name="room_floor" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3 m-2">
                            <label for="rental_price" class="col-sm-12 col-form-label">Harga Sewa</label>
                            <div class="col-sm-12">
                                <input type="number" name="rental_price" class="form-control" step="0.01">
                            </div>
                        </div>
                        <div class="row mb-3 m-2">
                            <label for="status" class="col-sm-12 col-form-label">Status Ketersediaan</label>
                            <div class="col-sm-12">
                                <select name="status" id="status" class="form-select" aria-label="Default select example">
                                    <option selected>- Pilih Status Ketersediaan -</option>
                                    @foreach ($statusRoom as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 m-2">
                            <label for="photo" class="col-md-12 col-lg-12 col-form-label">Unggah Foto Kamar</label>
                            <div class="col-md-12 col-lg-12">
                                <div class="pt-2">
                                    <input class="form-control" name="photo" type="file" id="photo">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form><!-- End General Form Elements -->
                </div>
            </div>
            </div>
        </div><!-- End Vertically centered Modal-->
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
    <div class="col-lg-12">

        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Kamar</h5>

            <!-- Table with stripped rows -->
            <table class="table datatable">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nomor Kamar</th>
                <th scope="col">Tipe Kamar</th>
                <th scope="col">Lantai Kamar</th>
                <th scope="col">Harga Sewa</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($data_room as $key => $item)
            <tr>
                <th scope="row">{{ $item->room_id }}</th>
                <td>{{ $item->room_number}}</td>
                <td>{{ $item->room_type}}</td>
                <td>{{ $item->room_floor}}</td>
                <td>Rp{{ number_format($item->rental_price, 0, ',', '.') }}</td>
                <td>
                    <span class="badge {{ $item->status === 'available' ? 'bg-success' : ($item->status === 'booked' ? 'bg-warning text-dark' : ($item->status === 'unavailable' ? 'bg-danger' : 'bg-dark')) }}">
                                    {{ $item->status }}
                    </span>                         
                </td>
                <td>
                <a type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#show_data-{{ $item->room_id}}">
                    <i class="bi bi bi-eye"></i>
                </a>
                <a type="button" href="{{ route('admin.room.edit',$item->room_id) }}" class="btn btn-success">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('admin.room.delete', $item->room_id) }}" method="POST" style="display: inline;">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
                
                </td>
            </tr>       
            @endforeach
            @foreach ($data_room as $data )
                <!-- Modal for Show Data -->
                <div class="modal fade" id="show_data-{{ $data->room_id }}" tabindex="-1">
                    @if ($data->photo)
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                    @else
                        <div class="modal-dialog modal-dialog-centered">
                    @endif
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- General Form Elements -->
                            <h5 class="card-title mx-3">Data Kamar</h5>
                            <form action="{{ route('admin.room.show', $data->room_id)}}" method="get">
                                @method('GET')
                                @csrf
                                <div class="row m-2">
                                    <label for="room_id" class="col-sm-12 col-form-label">ID Kamar</label>
                                    <div class="col-sm-12">
                                        <p>{{ $data->room_id }}</p>
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <label for="room_number" class="col-sm-12 col-form-label">Nomor Kamar</label>
                                    <div class="col-sm-12">
                                        <p> {{ $data->room_number}}</p>
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <label for="room_type" class="col-sm-12 col-form-label">Tipe Kamar</label>
                                    <div class="col-sm-12">
                                        <p> {{ $data->room_type }}</p>
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <label for="room_floor" class="col-sm-12 col-form-label">Lantai Kamar</label>
                                    <div class="col-sm-12">
                                        <p>{{ $data->room_floor }}</p>
                                    </div>
                                </div>  
                                <div class="row m-2">
                                    <label for="rental_price" class="col-sm-12 col-form-label">Harga Sewa</label>
                                    <div class="col-sm-12">
                                        <p>Rp{{ number_format($data->rental_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <label for="status" class="col-sm-12 col-form-label">Status Ketersediaan</label>
                                    <div class="col-sm-12">
                                        <p>{{ $data->status }}</p>
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <label for="status" class="col-sm-12 col-form-label">Foto Kamar Kos</label>
                                    <div class="col-sm-12">
                                        @if ($data->photo)
                                            <img src="{{ asset($data->photo) }}" alt="Foto Kamar" class="img-fluid">
                                        @else
                                            <p>Foto Kamar tidak tersedia</p>
                                        @endif
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