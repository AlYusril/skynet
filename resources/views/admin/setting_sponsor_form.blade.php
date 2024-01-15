@extends('layouts.app_corona',['title' => 'Setting Sponsor | '])

@section('content')
@include('admin.header_setting_landingpage_index')
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'sponsor.store', 'method' => 'POST', 'files' => true]) !!}
                <h6 class="card-title">Input Sponsor</h6>

                <div class="form-group mt-3">
                    <label for="gambar">Logo Sponsor | <span class="text-muted">Format : png,jpg,jpeg,svg. Ukuran Maksimal 2MB | Lebih baik file png tanpa background</span></label>
                    {!! Form::file('gambar', ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('gambar') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="judul">Nama Sponsor</label>
                    {!! Form::text('judul', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('judul') }}</span>
                </div>
                {!! Form::submit('UPLOAD', ['class' => 'btn btn-primary mt-3']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    @foreach ($models as $item)
        <div class="col-md-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body mb-2">
                    <h6 class="card-title mt-n3">
                        @if ($item->judul == null)
                            sponsor
                        @endif
                        {{ $item->judul }}
                    </h6>
                    <div class="d-flex flex-row mt-n2">
                        <img src="{{ \Storage::url($item->gambar) }}" class="img-lg rounded bg-white img-fluid" style="width: 100%; height: auto" alt="image">
                    </div>
                </div>
                <div class="card-footer mt-n5 ml-n2">
                    {!! Form::open([
                        'route' => ['sponsor.destroy', $item->id], 
                        'method' => 'DELETE', 
                        'onsubmit' => 'Yakin ingin menghapus?'
                    ]) !!}
                    <button class="text-danger font-weight-bold btn" type="submit"><i class="fa fa-trash"></i> Delete</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
