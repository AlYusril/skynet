<div class="header">
    {{-- <h5 class="page-title">Pengaturan Website</h5> --}}
    <ul class="nav nav-pills flex-column flex-md-row mb-1">
        <li class="nav-item">
            <a href="{{ route('sponsor.index') }}" class="nav-link {{ \Route::is('sponsor.*') ? 'active' : '' }}">
                <i class="fa fa-gear me-1"></i> Setting Sponsor
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('services.index') }}" class="nav-link {{ \Route::is('services.*') ? 'active' : '' }}">
                <i class="fa fa-gear me-1"></i> Setting Services
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('berita.index') }}" class="nav-link {{ \Route::is('berita.*') ? 'active' : '' }}">
                <i class="fa fa-gear me-1"></i> Setting Berita
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('slider.index') }}" class="nav-link {{ \Route::is('slider.*') ? 'active' : '' }}">
                <i class="fa fa-gear me-1"></i> Setting Slider Header
            </a>
        </li>
    </ul>
</div>