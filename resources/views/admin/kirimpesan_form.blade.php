@extends('layouts.app_corona',['title' => 'Setting Web | '])

@section('content')
{{-- @include('admin.headersetting_index') --}}
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'kirimpesan.store', 'method' => 'POST']) !!}
                <h6 class="card-title">Broadcast Whatsapp</h6>
                <div class="form-group">
                    <label for="member_id">Pilih pelanggan / broadcast pesan: </label>
                    {!! Form::select('client_id', $clientList, null, [
                        'class' => 'form-control select2',
                        'placeholder' => 'Pilih Client',
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
