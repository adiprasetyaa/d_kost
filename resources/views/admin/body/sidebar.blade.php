<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
    <a class="nav-link " href="{{ route('admin.index') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
    </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-heading">Pages</li>

    <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('admin.user.index')}}">
        <i class="bi bi-person"></i>
        <span>Mengelola Pelanggan</span>
    </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('admin.room.index') }}">
        <i class="bi bi-question-circle"></i>
        <span>Mengelola Kamar</span> 
    </a>
    </li><!-- End F.A.Q Page Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.reservation.index') }}">
            <i class="bi bi-question-circle"></i>
            <span>Mengelola Reservasi</span> 
        </a>
        </li><!-- End F.A.Q Page Nav -->

</ul>

</aside><!-- End Sidebar-->