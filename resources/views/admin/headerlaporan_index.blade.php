<div class="row justify-content-center align-items-center">
    <div class="d-flex col-md-2">
        {{-- <img src="{{ asset('corona') }}/assets/images/logo-bc.png" width="180" /> --}}
        <img src="{{ \Storage::url(settings()->get('app_logo')) }}" alt="logo" width="180"/>
    </div>
    <div class="col-md-8 text-center">
        <h4>LAPORAN {{ settings()->get('app_name', 'My APP') }}</h4>
        <small>{{ settings()->get('app_address') }} | Telepon {{ formatNomorHp(settings()->get('app_phone')) }} | Email {{ settings()->get('app_email') }}</small>
    </div>
    <div class="col-md-2"></div>
</div>
<hr class="bg-dark border-bold">
<hr class="bg-dark border-bold mt-n3">
<hr class="bg-dark border-bold mt-n2">
<hr class="bg-dark border-bold mt-n3">
<hr class="bg-dark border-bold mt-n3">
<hr class="bg-dark border-bold mt-n3">