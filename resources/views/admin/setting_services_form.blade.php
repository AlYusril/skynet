@extends('layouts.app_corona',['title' => 'Setting Web | '])

@section('content')
@include('admin.header_setting_landingpage_index')
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {{-- <textarea name="konten"></textarea> --}}

                <div class="card-body">
                    {!! Form::model($models, ['route' => $route, 'method' => $method, 'files' => true]) !!}
                    <h6 class="card-title">{{ $title }}</h6>

                    <div class="form-group mt-3">
                        <label for="judul">Judul Berita</label>
                        {!! Form::text('judul', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('judul') }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="konten">Nama Sponsor</label>
                        {!! Form::textarea('konten', null, ['class' => 'form-control', 'id' => 'content']) !!}
                        <span class="text-danger">{{ $errors->first('konten') }}</span>
                    </div>
    
                    <div class="form-group mt-3">
                        <label for="gambar">Logo Services | <span class="text-muted">Format : <a href="https://fontawesome.com/search">cari disini ambil kata objeknya</a> | contoh "whatsapp" tanpa petik</span></label>
                        {!! Form::text('gambar', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('gambar') }}</span>
                    </div>
                    {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>

<script src="/path/to/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#content',
        plugins: 'autolink lists charmap preview',
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent'
    });
</script>

  
@endsection
