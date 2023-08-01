@extends('layouts.app_corona')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $title }}</h5>
                {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                
                <div class="form-group">
                    <label for="client_id">Akun (optional)</label>
                    {!! Form::select('client_id', $client, null, [
                        'class' => 'form-control select2', 
                        'placeholder' => 'Pilih Akun Pelanggan',
                        ]) !!}
                    <span class="text-danger">{{ $errors->first('client_id') }}</span>
                </div>
                
                <div class="form-group mt-3">
                    <label for="nama">Nama</label>
                    {!! Form::text('nama', null, ['class' => 'form-control', 'autofocus']) !!}
                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="biaya_id">Paket Internet</label>
                    {!! Form::select('biaya_id', $listBiaya, null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('biaya_id') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="nohp">No HP | <small class="text-muted">Contoh : 6285712345678</small></label>
                    {!! Form::text('nohp', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('nohp') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="desa">Desa</label>
                    {!! Form::text('desa', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('desa') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="kecamatan">Kecamatan</label>
                    {!! Form::text('kecamatan', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('kecamatan') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="alamat_lengkap">Alamat Lengkap</label>
                    {!! Form::text('alamat_lengkap', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('alamat_lengkap') }}</span>
                </div>

                {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
