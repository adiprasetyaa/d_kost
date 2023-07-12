@extends('user.user_dashboard')
@section('user')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<main id="main" class="main">

    <section class="section profile">
        <div class="row">
        

            <div class="col-xl-6">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">

                        <h5 class="card-title">Detail Kamar</h5>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Nomor Kamar</div>
                            <div class="col-lg-9 col-md-8">{{ $data_room->room_number }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Tipe Kamar</div>
                            <div class="col-lg-9 col-md-8">{{ $data_room->room_type }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Lantai Kamar </div>
                            <div class="col-lg-9 col-md-8">{{ $data_room->room_floor }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Harga Sewa</div>
                            <div class="col-lg-9 col-md-8">Rp{{ number_format($data_room->rental_price, 0, ',', '.') }} /month</div>
                        </div>
                        <h5 class="card-title">Detail User</h5>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">ID user</div>
                            <div class="col-lg-9 col-md-8">{{ $data_user->user_id}}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Nama</div>
                            <div class="col-lg-9 col-md-8">{{ $data_user->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Email</div>
                            <div class="col-lg-9 col-md-8">{{ $data_user->email }}</div>
                        </div>
                        <h5 class="card-title">Detail Reservasi</h5>
                        <form action="{{ route('user.reservation.store', $data_room->room_id) }}" method="POST">
                            @method('POST')
                            @csrf
                            <div class="row">
                                <label class="col-lg-3 col-md-4 label" for="reservation_date">Tanggal Reservasi</label>
                                <input type="datetime-local" name="reservation_date" class="col-lg-9 col-md-8 form-control">
                            </div>
                            <div class="text-end mb-3 mx-3">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Pesan Kamar</button>
                            </div>
                        </form>
                        </div>


                    </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <h5 class="card-title">Foto Kamar</h5>
                        <div class="row">
                            <div class="col-lg-9 col-md-8">
                            @if ($data_room->photo)
                                <img src="{{ asset($data_room->photo) }}" alt="" class="card-img-top">
                                @else
                                <p>Foto tidak tersedia</p>
                            @endif
                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
<!-- JS Script for change images when user upload -->

@endsection