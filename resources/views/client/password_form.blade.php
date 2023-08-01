@extends('layouts.app_corona_client')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">{{ $title }}</h5>
                {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                {!! Form::hidden('name', null, ['class' => 'form-control', 'autofocus']) !!}
                {!! Form::hidden('email', null, ['class' => 'form-control']) !!}
                {!! Form::hidden('nohp', null, ['class' => 'form-control']) !!}

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
