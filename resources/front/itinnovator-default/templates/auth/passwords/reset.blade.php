@extends('layouts.default')
@section('content')
<div class="container">
    <div class="ui middle aligned center aligned grid">
      <div class="column _column">
        <h2 class="mt-2">{{ t('Set new password') }}</h2>
        <form method="POST" @submit.prevent="resetPasswordSubmit" class="ui large form mb-3" action="{{ route('password.email') }}">
          <input type="hidden" id="_sec_token" name="token" value="{{ $token }}">
          <div class="ui segment">
            <div class="ui message transition" v-if="message">
              <p>@{{ message }}</p>
            </div>
            <div class="field ui input full">
              <input id="email" type="email" name="email" placeholder="{{ t('Email address') }}" v-model="auth.email">
            </div>

            <div class="field ui input full">
              <input v-model="auth.password" id="password" type="password" placeholder="{{ t('Password') }}" name="password" required>
            </div>

            <div class="field ui input full">
                <input v-model="auth.password_confirmation" id="password-confirm" type="password" name="password_confirmation" required placeholder="{{ t('Password confirmation') }}">
            </div>

            <div class="field ui input full mb-0">
              <button type="submit" v-if="resetPasswordSubmitLoading" class="ui fluid large teal submit button loading">
                Reset password
              </button>
              <button type="submit" v-else class="ui fluid large teal submit button">
                Reset password
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection
