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

                    <h5 class="card-title">Add Data User</h5>
                    <form class="row g-3" action="{{ route('admin.user.store') }}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="col-12">
                            <label for="name" class="col-sm-12 col-form-label">Nama</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="email" class="col-sm-12 col-form-label">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="password" class="col-sm-12 col-form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <div class="text-center mb-3">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection