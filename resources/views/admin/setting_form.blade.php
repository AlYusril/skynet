@extends('layouts.app_corona',['title' => 'Setting Web | '])

@section('content')
@include('admin.headersetting_index')
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'setting.store', 'method' => 'POST', 'files' => true]) !!}
                <h6 class="card-title">Pengaturan Perusahaan</h6>
                <div class="form-group mt-3">
                    <label for="app_name">Nama Perusahaan</label>
                    {!! Form::text('app_name', settings()->get('app_name'), ['class' => 'form-control', 'autofocus']) !!}
                    <span class="text-danger">{{ $errors->first('app_name') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="app_slogan">Slogan Perusahaan</label>
                    {!! Form::text('app_slogan', settings()->get('app_slogan'), ['class' => 'form-control', 'autofocus']) !!}
                    <span class="text-danger">{{ $errors->first('app_slogan') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="app_email">Email Perusahaan</label>
                    {!! Form::text('app_email', settings()->get('app_email'), ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('app_email') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="app_phone">Nomor Telepon Perusahaan <small class="text-muted">Format : 6285712345678</small></label>
                    {!! Form::text('app_phone', settings()->get('app_phone'), ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('app_phone') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="app_address">Alamat Perusahaan</label>
                    {!! Form::textarea('app_address', settings()->get('app_address'), ['class' => 'form-control', 'rows' => '3']) !!}
                    <span class="text-danger">{{ $errors->first('app_address') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="app_maps">Koordinat MAP Perusahaan | <span class="text-muted">Masukan link embed dari google maps, <b>ambil linknya saja</b></span></label>
                    {!! Form::text('app_maps', settings()->get('app_maps'), ['class' => 'form-control', 'rows' => '3']) !!}
                    <span class="text-danger">{{ $errors->first('app_maps') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="app_logo">Logo Perusahaan</label>
                    {!! Form::file('app_logo', ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('app_logo') }}</span>
                    <img src="{{ \Storage::url(settings()->get('app_logo')) ?? 'assets\logo.png' }}" width="100" class="mt-2 ml-3">
                </div>
                {!! Form::submit('UPDATE', ['class' => 'btn btn-primary mt-3']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
