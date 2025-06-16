<x-logout-layout>

  <div class="login-container">

    <div class="service-logo">
      <img src="{{ asset('images/atlas.png') }}" alt="Atlas" class="logo-image">
    </div>
    <h2 class="service-subtitle">Social Network Service</h2>
    <div class="login-form-wrapper">
      <div id="clear">
        <p>{{session('username')}}さん</p>
        <p>ようこそ！AtlasSNSへ！</p>
        <br>
        <br>
        <p>ユーザー登録が完了しました。</p>
        <p>早速ログインをしてみましょう！</p>

        <a href="login" class="login-button register-complete-button">ログイン画面へ</a>
      </div>
    </div>
  </div>
</x-logout-layout>
