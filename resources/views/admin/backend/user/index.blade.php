@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>                        

<main id="main" class="main">

<div class="pagetitle">
    <nav>
        <ol class="breadcrumb">
        <!-- Vertically centered Modal -->
        <a href="{{ route('admin.user.create') }}" method="GET">
            <button type="button"  class="btn btn-primary m-2"><span class="bi bi-plus-lg me-2">  Add User Baru</span></button>
        </a>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
    <div class="col-lg-12">

        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data User</h5>

            <!-- Table with stripped rows -->
            <table class="table datatable">
            <thead>
                <tr>
                <th scope="col">ID</th>
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
                <a type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#show_data-{{ $item->user_id}}">
                    <i class="bi bi bi-eye"></i>
                </a>
                <a type="button" href="{{ route('admin.user.edit',$item->user_id) }}" class="btn btn-success">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('admin.user.delete', $item->user_id) }}" method="POST" style="display: inline;">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
                
                </td>
            </tr>       
            @endforeach
            @foreach ($data_user as $data )
                <!-- Modal for Show Data -->
                <div class="modal fade" id="show_data-{{ $data->user_id }}" tabindex="-1">
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