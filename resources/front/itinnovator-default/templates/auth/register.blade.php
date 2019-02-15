@extends('layouts.default')

@section('content')
<div class="container">
    <div class="ui middle aligned center aligned grid">
        <div class="column _column">
            <h2 class="mt-2">{{ t('Register your account') }}</h2>
            <form method="POST" @submit.prevent="registerUserSubmit" action="{{ route('register') }}" class="ui large form mb-3">
                <div class="ui segment">
                  <div class="ui message transition" v-if="message">
                    <p>@{{ message }}</p>
                  </div>
                  <div class="field ui input full">
                      <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" v-model="auth.name" required autofocus placeholder="{{ t('Name') }}">
                  </div>

                  <div class="field ui input full">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" v-model="auth.email" required placeholder="{{ t('E-Mail Address') }}">
                  </div>

                  <div class="field ui input full">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" v-model="auth.password" name="password" required placeholder="{{ t('Password') }}">
                  </div>

                  <div class="field ui input full">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="auth.password_confirm" required placeholder="{{ t('Confirm Password') }}">
                  </div>

                  <div class="field ui input full mb-0 flex-column">
                    <button type="submit" v-if="registerUserSubmitLoading" class="large ui fluid large teal submit button loading">
                      {{ t('Register') }}
                    </button>
                    <button type="submit" v-else class="large ui fluid large teal submit button">
                      {{ t('Register') }}
                    </button>
                    <br>
                    <a class="btn btn-link" href="{{ route('login') }}">
                      {{ t('Already registered? Login') }}
                    </a>
                  </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
