@extends('layouts.app_corona')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $title }}</h5>
                {!! Form::model($model, [
                    'route' => $route, 
                    'method' => $method
                    ]) !!}
                
                <div class="form-group mt-1">
                    <label for="bank_id">Nama Bank</label>
                    @if($method === 'POST')
                        {!! Form::select('bank_id', $listBank, null, ['class' => 'form-control select2']) !!}
                    @else
                        {!! Form::select('bank_id', [$model->bank_id => $model->nama_bank], $model->bank_id, ['class' => 'form-control', 'readonly']) !!}
                    @endif
                    <span class="text-danger">{{ $errors->first('bank_id') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="nama_rekening">Nama Pemilik Rekening</label>
                    {!! Form::text('nama_rekening', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('nama_rekening') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="norek">Nomor Rekening</label>
                    {!! Form::text('norek', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('norek') }}</span>
                </div>

                {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
