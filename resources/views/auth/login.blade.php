<x-logout-layout>

  <div class="login-container">

    <div class="service-logo">
      <img src="{{ asset('images/atlas.png') }}" alt="Atlas" class="logo-image">
    </div>
    <h2 class="service-subtitle">Social Network Service</h2>

    <div class="login-form-wrapper">
      <p class="welcome-message">AtlasSNSへようこそ</p>

      {!! Form::open(['url' => 'login', 'method' => 'POST', 'class' => 'login-form']) !!}

      {{ Form::label('email', 'メールアドレス') }}
      {{ Form::text('email',null,['class' => 'input-field']) }}
      {{ Form::label('password', 'パスワード') }}
      {{ Form::password('password',['class' => 'input-field']) }}

      {{ Form::submit('ログイン', ['class' => 'login-button']) }}

      {!! Form::close() !!}

      <p class="register-link-wrapper"><a href="register" class="register-link">新規ユーザーの方はこちら</a></p>
    </div>
  </div>

</x-logout-layout>
