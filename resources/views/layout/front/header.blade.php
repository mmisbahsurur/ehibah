<div class="horizontal-menu">
    <nav class="navbar top-navbar">
        <div class="container">
            <div class="navbar-content">
                <a href="#" class="navbar-brand">
                E-<span>Hibah</span>
                </a>
                <form class="search-form">
                    <div class="input-group">
                        <div class="input-group-text">
                            <i data-feather="search"></i>
                        </div>
                        <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
                    </div>
                </form>
                <ul class="navbar-nav">



                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="wd-30 ht-30 rounded-circle" src="{{ url('https://via.placeholder.com/30x30') }}" alt="profile">
                        </a>
                        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">

                            <ul class="list-unstyled p-1">

                                <li class="dropdown-item py-2">
                                    <a href="{{url('login')}}" class="text-body ms-0">
                                    <i class="me-2 icon-md" data-feather="log-out"></i>
                                    <span>Login</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                <i data-feather="menu"></i>
                </button>
            </div>
        </div>
    </nav>
    <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
                <li class="nav-item {{ active_class(['/']) }}">
                    <a class="nav-link" href="{{ url('/') }}">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/') }}" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="book"></i>
                    <span class="menu-title">Report</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{url('prov')}}" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="book"></i>
                    <span class="menu-title">Rekap Provinsi</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{url('kota')}}" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="book"></i>
                    <span class="menu-title">Rekap Kota</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{url('kecamatan')}}" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="book"></i>
                    <span class="menu-title">Rekap Kecamatan</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/login')}}" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="log-in"></i>
                    <span class="menu-title">Login</span></a>
                </li>

            </ul>
        </div>
    </nav>
</div>
