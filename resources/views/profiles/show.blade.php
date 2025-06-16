<x-login-layout :followingCount="$followingCount" :followerCount="$followerCount">

  <div id="row">
    <!-- メインコンテンツ -->
    <div id="container">
      <div class="follow-icon">
        <div class="profile-container">
          <!-- アイコン -->
          <div class="profile-icon">
            <img src="{{ $user->icon_image ? asset('storage/icons/' . $user->icon_image) : asset('images/icon1.png') }}" alt="アイコン">
          </div>

          <!-- ユーザー名とbio -->
          <div class="profile-info">
            <h4>ユーザー名　　　{{ $user->username }}</h4>
            <h4>自己紹介　　　　{{ $user->bio }}</h4>
          </div>

          <!-- フォローボタン -->
          @if (Auth::id() !== $user->id)
          <div class="profile-button">
            <form method="POST" action="{{ $isFollowing ? route('unfollow', $user->id) : route('follow', $user->id) }}">
              @csrf
              @if ($isFollowing)
              @method('DELETE')
              <button type="submit" class="unfollow-btn">フォロー解除</button>
              @else
              <button type="submit" class="follow-btn">フォローする</button>
              @endif
            </form>
          </div>
          @endif
        </div>
      </div>

      <hr>
      <!-- 投稿一覧 -->
      <div class="user-posts">
        @foreach ($posts as $post)
        <div class="follow-post">
          <div>
            <!-- アイコン -->
            <img src="{{ $user->icon_image ? asset('storage/icons/' . $user->icon_image) : asset('images/icon1.png') }}"
              alt="アイコン">
          </div>

          <!-- 投稿内容 -->
          <div class="follow-posts">
            <strong>{{ $user->username }}</strong>
            <p>{{ $post->post }}</p>
          </div>

          <!-- 投稿日時 -->
          <div class="post-date">
            {{ $post->created_at->format('Y-m-d H:i') }}
          </div>
        </div>
        <hr>
        @endforeach
      </div>

</x-login-layout>
