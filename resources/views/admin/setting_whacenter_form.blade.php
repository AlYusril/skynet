@extends('layouts.app_corona',['title' => 'Setting Web | '])

@section('content')
@include('admin.headersetting_index')
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'setting.store', 'method' => 'POST']) !!}
                <h6 class="card-title">Pengaturan Whacenter</h6>
                <div class="form-group mt-3">Device ID : {{ \Str::mask(settings('wha_device_id'), '*',0 , 10) }}</div>
                <div class="form-group mt-1 mb-0">
                    <label for="wha_device_id">Device ID Whacenter</label>
                    {!! Form::text('wha_device_id', null, [
                        'class' => 'form-control',
                        'autocomplete' => 'off',
                        'placeholder' => 'Masukkan ID Device Whacenter'
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('wha_device_id') }}</span>
                </div>
                <div class="form-group mt-3 mb-0">
                    <label for="tes_wa">
                        Status Device : <span class="badge bg-{{ $statusKoneksiWa ? 'primary' : 'danger' }}">
                        {{ $statusKoneksiWa ? 'Connected' : 'Not Connected' }}</span>
                    </label>
                </div>
                <div class="form-group">
                    <label for="tes_wa">Tes Kirim Whatsapp ke Nomor berikut: </label>
                    {!! Form::number('tes_wa', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan nomor hp cth: 6285712345678'
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('tes_wa') }}</span>
                </div>
                {{ Form::submit('KIRIM', ['class' => 'btn btn-sm btn-success mt-1']) }}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
