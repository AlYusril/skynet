<div class="header">
    {{-- <h5 class="page-title">Pengaturan Website</h5> --}}
    <ul class="nav nav-pills flex-column flex-md-row mb-1">
        <li class="nav-item">
            <a href="{{ route('setting.index') }}" class="nav-link {{ \Route::is('setting.index') ? 'active' : '' }}">
                <i class="fa fa-gear me-1"></i> Setting Perusahaan
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('settingappform.create') }}" class="nav-link {{ \Route::is('settingappform.create') ? 'active' : '' }}">
                <i class="fa fa-gear me-1"></i> Setting Aplikasi
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('settingwhacenter.create') }}" class="nav-link {{ \Route::is('settingwhacenter.create') ? 'active' : '' }}">
                <i class="mdi mdi-whatsapp me-1"></i> WhaCenter
            </a>
        </li>
    </ul>
</div>