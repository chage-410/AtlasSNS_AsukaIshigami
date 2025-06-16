<x-login-layout :followingCount="$followingCount" :followerCount="$followerCount">
  <div class="profile-page-wrapper">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
      @csrf
      @method('PUT')

      <div class="profile-form-container">

        @if ($errors->any())
        <div class="form-errors">
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
        @endif

        <!-- アイコンと項目を並べる -->
        <div class="profile-main">
          <div class="profile-icon">
            <img src="{{ $user->icon_image ? asset('storage/icons/' . $user->icon_image) : asset('images/icon1.png') }}" alt="アイコン">
          </div>

          <div class="form-fields">
            <!-- 各フォーム項目 -->
            <div class="form-group">
              <label>ユーザー名</label>
              <input type="text" name="username" value="{{ old('username', $user->username) }}">
            </div>

            <div class="form-group">
              <label>メールアドレス</label>
              <input type="email" name="email" value="{{ old('email', $user->email) }}">
            </div>

            <div class="form-group">
              <label>パスワード</label>
              <input type="password" name="password">
            </div>

            <div class="form-group">
              <label>パスワード確認</label>
              <input type="password" name="password_confirmation">
            </div>

            <div class="form-group">
              <label>自己紹介</label>
              <textarea name="bio">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <div class="form-group">
              <label>アイコン画像</label>
              <input type="file" name="images">
            </div>

            <div class="form-submit">
              <button type="submit">更新</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</x-login-layout>
