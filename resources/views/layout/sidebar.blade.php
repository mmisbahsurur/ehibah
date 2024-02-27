<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
        E-<span>Hibah</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ active_class(['/']) }}">
                @if (Auth::user()->type == 'admin')
                    <a href="{{ url('/admin/home') }}" class="nav-link">
                @else
                <a href="{{ url('/bidang/home') }}" class="nav-link">
                @endif

                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Dashboard </span>
                </a>
            </li>
            @if (Auth::user()->type == 'admin')
            <li class="nav-item nav-category">Master Data</li>
            <li class="nav-item {{ active_class(['lokasi/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#lokasi" role="button" aria-expanded="{{ is_active_route(['lokasi/*']) }}" aria-controls="lokasi">
                <i class="link-icon" data-feather="map-pin"></i>
                <span class="link-title">Lokasi</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['lokasi/*']) }}" id="lokasi">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/lokasi/kota') }}" class="nav-link {{ active_class(['lokasi/kota']) }}">Kota</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/lokasi/kecamatan') }}" class="nav-link {{ active_class(['lokasi/kecamatan']) }}">Kecamatan</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/lokasi/kelurahan') }}" class="nav-link {{ active_class(['lokasi/kelurahan']) }}">Kelurahan</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['users/*']) }}">
                <a href="{{ route('users.index') }}" class="nav-link">
                <i class="link-icon" data-feather="users"></i>
                <span class="link-title">Management User</span>
                </a>
            </li>
            @else

            @endif

            <li class="nav-item nav-category">Data</li>
            <li class="nav-item {{ active_class(['kelompok-tani/*']) }}">
                <a href="{{ route('kelompok-tani.index') }}" class="nav-link">
                <i class="link-icon" data-feather="user-plus"></i>
                <span class="link-title">Kelompok Tani</span>
                </a>
            </li>
            <li class="nav-item {{ active_class(['jenis-hibah/*']) }}">
                <a href="{{ route('jenis-hibah.index') }}" class="nav-link">
                <i class="link-icon" data-feather="grid"></i>
                <span class="link-title">Jenis Hibah</span>
                </a>
            </li>
            <li class="nav-item {{ active_class(['data-hibah/*']) }}">
                <a href="{{ route('data-hibah.index') }}" class="nav-link">
                <i class="link-icon" data-feather="server"></i>
                <span class="link-title">Data Hibah</span>
                </a>
            </li>

            <li class="nav-item nav-category">Rekap</li>
            <li class="nav-item {{ active_class(['general/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#general" role="button" aria-expanded="{{ is_active_route(['general/*']) }}" aria-controls="general">
                <i class="link-icon" data-feather="book"></i>
                <span class="link-title">Rekap</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['general/*']) }}" id="general">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ active_class(['general/blank-page']) }}">Rekap Data</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ active_class(['general/faq']) }}">Rekap Data Provinsi</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ active_class(['general/invoice']) }}">Rekap Data Kabupaten</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ active_class(['general/profile']) }}">Rekap Data Kecamatan</a>
                        </li>

                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
        <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted mb-2">Sidebar:</h6>
        <div class="mb-3 pb-3 border-bottom">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
                Light
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
                Dark
                </label>
            </div>
        </div>

    </div>
</nav>
