@extends('layouts.default')

@section('content')
<div class="container">
    <div class="ui middle aligned center aligned grid">
        <div class="column _column">
          <h2 class="mt-2">Login to your account</h2>
          <form @submit.prevent="loginFormSubmit" method="POST" class="ui large form mb-3" action="{{ url('login') }}">
            <div class="ui segment">
              <div class="ui message transition" v-if="message">
                <p>@{{ message }}</p>
              </div>
              <div class="field">
                <div class="ui left icon input">
                  <i class="user icon"></i>
                  <input id="email" v-model="auth.email" placeholder="{{ t('E-Mail Address') }}" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                  @if ($errors->has('email'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="field">
                <div class="ui left icon input">
                  <i class="lock icon"></i>
                  <input placeholder="{{ t('Password') }}" id="password" type="password" v-model="auth.password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                  @if ($errors->has('password'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="field ui checkbox">
                <input id="_rem" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="pointer" for="_rem">Remember Me</label>
              </div>

              <div class="field">
                <button type="submit" v-if="loginFormSubmitLoading" class="ui fluid large teal submit button loading">
                  Login
                </button>
                <button type="submit" v-else class="ui fluid large teal submit button">
                  Login
                </button>
                <br>
                <a class="btn btn-link" href="{{ route('register') }}">
                  {{ t('Create a new account') }}
                </a>
                <hr>
                <a class="btn btn-link" href="{{ url('password/reset') }}">
                  Forgot Your Password?
                </a>
              </div>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection
