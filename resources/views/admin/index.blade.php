@extends('admin.admin_dashboard')
@section('admin')

<main id="main" class="main">

    <section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
        <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                
                <div class="card-body">
                <h5 class="card-title">User<span></span></h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    <h6>{{ $user_count }}</h6>
                    <span class="text-success small pt-1 fw-bold">%</span>
                    <span class="text-muted small pt-2 ps-1">of User Account</span>
                </div>
                </div>
                </div>

            </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

                <div class="card-body">
                <h5 class="card-title">Kamar yang tersedia<span>| Available</span></h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    @php
                        $percentage = round(($room_count  / $total_room) * 100);
                    @endphp
                    <h6>{{ $room_count }}</h6>
                    <span class="text-success small pt-1 fw-bold">{{ $percentage }}% kamar tersedia</span>
                    <span class="text-muted small pt-2 ps-1">dari total kamar</span>
                </div>
                </div>
                </div>

            </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

                <div class="card-body">
                <h5 class="card-title">Reservasi<span>| Pending</span></h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    @php
                        $percentage = round(($reservation_count / $total_reservation) * 100);
                    @endphp
                    <h6>{{ $reservation_count }}</h6>
                    <span class="text-success small pt-1 fw-bold">{{ $percentage }}%</span>
                    <span class="text-muted small pt-2 ps-1">dari total </span>
                </div>
                </div>

                </div>
            </div>

            </div><!-- End Customers Card -->

        </div>
        </div><!-- End Left side columns -->

        <!-- Data User -->
        <div class="col-lg-12">
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data User</h5>

            <!-- Table with stripped rows -->
            <table class="table datatable">
            <thead>
                <tr>
                <th scope="col">ID User</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($data_user as $key => $item)
            <tr>
                <th scope="row">{{ $item->user_id }}</th>
                <td>{{ $item->name}}</td>
                <td>{{ $item->email }}</td>
                <td>
                <a type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#show_data_user-{{ $item->user_id}}">
                    <i class="bi bi bi-eye"></i>
                </a>
                </td>
            </tr>       
            @endforeach
            @foreach ($data_user as $data )
                <!-- Modal for Show Data -->
                <div class="modal fade" id="show_data_user-{{ $data->user_id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- General Form Elements -->
                            <h5 class="card-title mx-3">Data User </h5>
                            <form action="{{ route('admin.user.show', $data->user_id)}}" method="get">
                                @method('GET')
                                @csrf
                                <div class="row m-2">
                                    <label for="name" class="col-sm-12 col-form-label">ID User</label>
                                    <div class="col-sm-12">
                                        <p>{{ $data->user_id }}</p>
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <label for="id_pelanggan" class="col-sm-12 col-form-label">Nama</label>
                                    <div class="col-sm-12">
                                        <p> {{ $data->name }}</p>
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <label for="status" class="col-sm-12 col-form-label">Email</label>
                                    <div class="col-sm-12">
                                        <p> {{ $data->email }}</p>
                                    </div>
                                </div>
                                @if ($data->username !== null)
                                <div class="row m-2">
                                    <label for="bulan_penggunaan" class="col-sm-12 col-form-label">Username</label>
                                    <div class="col-sm-12">
                                        <p>{{ $data->username }}</p>
                                    </div>
                                </div>  
                                @endif
                                @if ($data->address !== null)
                                <div class="row m-2">
                                    <label for="bulan_penggunaan" class="col-sm-12 col-form-label">Alamat</label>
                                    <div class="col-sm-12">
                                        <p>{{ $data->address }}</p>
                                    </div>
                                </div>
                                @endif
                                @if ($data->phone_number !== null)
                                <div class="row m-2">
                                    <label for="bulan_penggunaan" class="col-sm-12 col-form-label">Nomor Handphone</label>
                                    <div class="col-sm-12">
                                        <p>{{ $data->phone_number }}</p>
                                    </div>
                                </div>
                                @endif
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form><!-- End General Form Elements -->
                        </div>
                        </div>
                    </div>
                </div> <!-- End Modal for Show Data --> 
                <!-- Modal for Edit Data -->    
            @endforeach
            </tbody>
            </table>
            <!-- End Table with stripped rows -->
        </div>
        </div>
        </div><!-- End of Data User -->

        <!-- Data Kamar -->
        <div class="col-lg-12">

        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Kamar yang Tersedia <span> | Available</span></h5>

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
                <td>{{ $item->rental_price }}</td>
                <td>{{ $item->status}}</td>
                <td>
                <a type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#show_data_room-{{ $item->room_id}}">
                    <i class="bi bi bi-eye"></i>
                </a>
                </td>
            </tr>       
            @endforeach
            @foreach ($data_room as $data )
                <!-- Modal for Show Data -->
                <div class="modal fade" id="show_data_room-{{ $data->room_id }}" tabindex="-1">
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
                                        <p>{{ $data->rental_price }}</p>
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

        </div><!-- End of Data Kamar -->

        <!-- Data Reservasi -->
        <div class="col-lg-12">
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Reservasi yang belum Ditinjau <span> | Pending</span></h5>
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
                <td>{{ $item->reservation_status }}</td>
                <td>
                <a type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#show_data_reservation-{{ $item->reservation_id}}">
                    <i class="bi bi bi-eye"></i>
                </a>
                </td>
            </tr>       
            @endforeach
            @foreach ($data_reservation as $data )
                <!-- Modal for Show Data -->
                <div class="modal fade" id="show_data_reservation-{{ $data->reservation_id }}" tabindex="-1">
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
        </div><!-- End of Data Reservasi -->

    </div>

    </div>
    </section>

</main><!-- End #main -->


@endsection