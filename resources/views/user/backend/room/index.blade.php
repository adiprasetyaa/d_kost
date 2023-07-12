@extends('user.user_dashboard')
@section('user')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>   


<main id="main" class="main">
    <section class="section">
        <div class="row align-items-top">
            @foreach ($data_room as $room)
                <div class="col-lg-3">
                    <div class="card">
                        @if ($room->photo)
                            <div class="image-frame">
                                <img src="{{ asset($room->photo) }}" alt="" class="card-img-top">
                            </div>
                        @else
                            <p>Foto tidak tersedia</p>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">Room {{ $room->room_number }} <span>| {{  $room->room_type  }}| Room on the Floor {{ $room->room_floor }}</span></h5>
                            <span class="badge bg-info">
                                Rp{{ number_format($room->rental_price, 0, ',', '.') }} /month
                            </span>
                            <span class="badge {{ $room->status === 'available' ? 'bg-success' : ($room->status === 'booked' ? 'bg-warning text-dark' : ($room->status === 'unavailable' ? 'bg-danger' : 'bg-dark')) }}">
                                {{ $room->status }}
                            </span>
                            @if ($room->status === 'available')
                            <a href="{{ route('user.create.room', $room->room_id) }}" method="GET" class="d-grid gap-2 mt-3">
                                <button type="button"  class="btn btn-primary m-2">Pesan Kamar</button>
                            </a>
                            @else
                            <a href="" class="d-grid gap-2 mt-4 mb-2">
                                <button type="button" class="btn btn-primary" disabled>Pesan Kamar</button>
                            </a>
                            @endif
                        </div>
                    </div><!-- End Card with an image on top -->
                </div>
            @endforeach
        </div>
    </section>
</main>

@endsection
