@extends('layouts.app_corona')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $title }}</h5>
                {!! Form::model($model, ['route' => $route, 'method' => $method, 'files' => true]) !!}
                <div class="form-group">
                    <label for="name">Nama</label>
                    {!! Form::text('name', null, ['class' => 'form-control', 'autofocus']) !!}
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="email">Email</label>
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="nohp">No HP | <small class="text-muted">Contoh : 6285712345678</small></label>
                    {!! Form::text('nohp', null, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('nohp') }}</span>
                </div>

                <div class="form-group mt-3">
                    <label for="foto">Foto | <small class="text-muted">Format : jpg, jpeg, png | max: 2MB</small></label>
                    {!! Form::file('foto', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                    <img src="{{ \Storage::url($model->foto ?? 'assets\no-images.jpeg') }}" width="100" class="mt-2 ml-3">
                    <span class="text-danger">{{ $errors->first('foto') }}</span>
                </div>

                @if(\Route::is('user.create'))
                    <div class="form-group mt-3">
                        <label for="akses">Hak Akses</label>
                        {!! Form::select(
                            'akses',
                            [
                                'admin' => 'Admin',
                            ],
                            'admin',//null untuk tanpa saran
                            ['class' => 'form-control'],
                        ) !!}
                        <span class="text-danger">{{ $errors->first('akses') }}</span>
                    </div>
                @endif

                <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password-field" class="form-control">
                        <button id="toggle-password" type="button" class="btn btn-outline-secondary">
                        <i id="password-icon" class="fa fa-eye"></i>
                        </button>
                    </div>
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                </div>

                {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script>
    var passwordField = document.getElementById('password-field');
    var togglePassword = document.getElementById('toggle-password');
    var passwordIcon = document.getElementById('password-icon');
  
    togglePassword.addEventListener('click', function() {
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
      } else {
        passwordField.type = 'password';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
      }
    });
</script>
@endsection
