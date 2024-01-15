@extends('layouts.app_corona',['title' => 'Broadcast Pesan | '])

@section('content')
{{-- @include('admin.headersetting_index') --}}
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'kirimpesan.store', 'method' => 'POST']) !!}
                <h6 class="card-title">Broadcast Whatsapp</h6>
                <div class="alert alert-info">
                    <p>Jika tidak dipilih maka dikirim kesemua akun (nomor akun), dan jika dipilih desa tertentu 
                        maka akan di broadcast ke semua pelanggan di desa tersebut (nomor pelanggan).</p>
                </div>
                <div class="form-group">
                    <label for="member_id">Pilih akun pelanggan: </label>
                    {!! Form::select('client_id', $clientList, null, [
                        'class' => 'form-control select2',
                        'placeholder' => 'Pilih Client',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('member_id') }}</span>
                </div>
                <div class="form-group">
                    <label for="member_id">Pilih Daerah: </label>
                    {!! Form::select('desa_id', $desaList, null, [
                        'class' => 'form-control select2',
                        'placeholder' => 'Pilih Desa',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('member_id') }}</span>
                </div>
                <div class="form-group">
                    <label for="pesan">Kirim pesan: </label>
                    {!! Form::textarea('pesan', null, [
                        'class' => 'form-control', 
                        'rows' => 3,
                        'id' => 'my-textarea',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('pesan') }}</span>
                </div>
                <div class="form-check form-check-primary">
                    <label class="form-check-label">
                        <input name="channels[]" type="checkbox" class="form-check-input" value="whatsapp">Whatsapp<i class="input-helper"></i>
                    </label>
                </div>
                <div class="form-check form-check-primary">
                    <label class="form-check-label">
                        <input name="channels[]" type="checkbox" class="form-check-input" value="mail">Email<i class="input-helper"></i>
                    </label>
                </div>
                {{ Form::submit('KIRIM', ['class' => 'btn btn-sm btn-primary mt-1']) }}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
