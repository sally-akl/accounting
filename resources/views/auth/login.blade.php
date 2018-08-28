@extends('layouts.loginLayout')

@section('logincontent')

<div class="header">{{ __('Login') }}</div>

<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
    @csrf
<div class="body bg-gray">
    <div class="form-group">

      <div class="alert alert-danger" style="{{count($errors) > 0 ?'display:block':'display:none'}}">

          @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif

          @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif

      </div>

      <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required autofocus>

    </div>
    <div class="form-group">

      <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" name="password" required>


    </div>

    <div class="form-group">

            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
            </label>

    </div>




</div>
<div class="footer">

  <button type="submit" class="btn bg-bl2 btn-primary">
      {{ __('Login') }}
  </button>

  <a class="btn btn-link" href="{{ route('password.request') }}">
      {{ __('Forgot Your Password?') }}
  </a>
</div>

</form>
@endsection
