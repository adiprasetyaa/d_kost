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

                    <h5 class="card-title">Edit Data User</h5>
                    <form class="row g-3" action="{{ route('admin.user.update',$data_user->user_id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="col-12">
                            <label for="name" class="col-sm-12 col-form-label">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ $data_user->name }}">
                        </div>
                        <div class="col-12">
                            <label for="email" class="col-sm-12 col-form-label">Email</label>
                            <input type="text" name="email" class="form-control" value="{{ $data_user->email }}">
                        </div>
                        </div>
                        <div class="text-center mb-3">
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