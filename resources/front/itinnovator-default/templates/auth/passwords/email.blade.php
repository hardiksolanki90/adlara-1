@extends('layouts.default')
@section('content')
<div class="container">
    <div class="ui middle aligned center aligned grid">
      <div class="column _column">
        <h2 class="mt-2">{{ t('Reset password') }}</h2>
        <form method="POST" @submit.prevent="passwordEmailSubmit" class="ui large form mb-3" action="{{ route('password.email') }}">
          <div class="ui segment">
            <div class="ui message transition" v-if="message">
              <p>@{{ message }}</p>
            </div>
            <div class="field">
              <div class="ui left icon input">
                <i class="user icon"></i>
                <input v-model="auth.email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ t('E-Mail address') }}" required>
              </div>
            </div>
            <div class="field">
              <button type="submit" v-if="passwordEmailSubmitLoading" class="ui fluid large teal submit button loading">
                {{ t('Send password') }}
              </button>
              <button type="submit" v-else class="ui fluid large teal submit button">
                {{ t('Send password') }}
              </button>
              <br>
              <a class="btn btn-link" href="{{ route('login') }}">
                {{ t('Back to login') }}
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection
