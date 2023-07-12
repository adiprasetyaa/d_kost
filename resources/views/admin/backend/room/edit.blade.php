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

                    <h5 class="card-title">Edit Data Kamar</h5>
                    <form class="row g-3" action="{{ route('admin.room.update',$data_room->room_id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="col-12">
                            <label for="room_number" class="col-sm-12 col-form-label">Nomor Kamar</label>
                            <input type="number" name="room_number" class="form-control @error('room_number') is-invalid @enderror" value="{{ $data_room->room_number }}">
                            @error('room_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="room_type" class="col-sm-12 col-form-label">Tipe Kamar</label>
                            <select name="room_type" id="room_type" class="form-select" aria-label="Default select example">
                                <option value="">- Pilih Tipe Kamar -</option>
                                @foreach ($roomTypes as $roomType)
                                <option value="{{ $roomType }}" {{ $roomType == $data_room->room_type ? 'selected' : '' }}>{{ $roomType }}</option>
                                @endforeach
                            </select>                            
                            @error('room_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="room_floor" class="col-sm-12 col-form-label">Lantai Kamar</label>
                            <input type="number" name="room_floor" class="form-control @error('room_floor') is-invalid @enderror" value="{{ $data_room->room_floor }}">
                            @error('room_floor')
                            <div class="invalid-feedback"> {{  $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="rental_price" class="col-sm-12 col-form-label">Harga Sewa</label>
                            <input type="number" name="rental_price" class="form-control @error('rental_price') is-invalid @enderror" step="0.01" value="{{ $data_room->rental_price }}">
                            @error('rental_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="status" class="col-sm-12 col-form-label">Status Ketersediaan</label>
                            <select name="status" id="status" class="form-select" aria-label="Default select example">
                                <option selected>- Pilih Status Ketersediaan -</option>
                                @foreach ($statusRoom as $status)
                                <option value="{{ $status }}" {{ $status == $data_room->status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                                <label for="photo" class="col-md-12 col-lg-12 col-form-label">Unggah Foto Kamar</label>
                                <div class="pt-2">
                                    <input class="form-control" name="photo" type="file" id="photo">
                                </div>
                        </div>
                        <div class="text-center m-3">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection