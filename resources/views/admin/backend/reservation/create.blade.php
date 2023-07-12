@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
            <!-- Vertically centered Modal -->
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">                           

                <div class="card">
                    <div class="card-body">

                    <h5 class="card-title">Add Data Reservasi</h5>
                    <form action="{{ route('admin.reservation.store') }}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="col-sm-12">
                            <label for="user_id" class="col-sm-12 col-form-label">Nama Reservasi</label>
                            <select class="form-select" name="user_id" id="user_id" aria-label="Default select example">
                                <option selected>- Pilih Nama -</option>
                                @foreach ($data_user as $items )
                                <option value="{{ $items->user_id}}">{{ $items->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="room_id" class="col-sm-12 col-form-label">Nomor Kamar</label>
                            <select class="form-select" name="room_id" id="room_id" aria-label="Default select example">
                                <option selected>- Pilih Nomor Kamar -</option>
                                @foreach ($data_room as $items )
                                <option value="{{ $items->room_id }}">{{ $items->room_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="reservation_date" class="col-sm-12 col-form-label">Tanggal Reservasi</label>
                            <input type="datetime-local" name="reservation_date" class="form-control" value="">
                        </div>
                        <div class="col-sm-12">
                            <label for="reservation_status" class="col-sm-12 col-form-label">Status Reservasi</label>
                            <select name="reservation_status" id="reservation_status" class="form-select" aria-label="Default select example">
                                <option selected>- Pilih Status Reservasi -</option>
                                @foreach ($statusReservation as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center m-3">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection