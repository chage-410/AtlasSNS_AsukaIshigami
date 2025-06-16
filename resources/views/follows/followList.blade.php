<x-login-layout :followingCount="$followingCount" :followerCount="$followerCount">

  <!-- フォローアイコン一覧 -->
  <div class="follow-icon">
    <div class="follow-header">
      <h2>フォローリスト</h2>

      <div class="follow-icon-grid">
        @foreach ($followings as $following)
        <a href="{{ route('user.profile', ['id' => $following->id]) }}">
          <img src="{{ $following->icon_image ? asset('storage/icons/' . $following->icon_image) : asset('images/icon1.png') }}" alt="アイコン">
        </a>
        @endforeach
      </div>
    </div>
  </div>

  <!-- 投稿一覧 -->
  @foreach ($posts as $post)
  <div class="follow-post">
    <!-- アイコン -->
    <div>
      <a href="{{ route('user.profile', ['id' => $post->user->id]) }}">
        <img src="{{ $post->user->icon_image ? asset('storage/icons/' . $post->user->icon_image) : asset('images/icon1.png') }}" alt=" アイコン">
      </a>
    </div>

    <!-- 投稿内容 -->
    <div class="follow-posts">
      <strong>{{ $post->user->username }}</strong>
      <p>{!! nl2br(e($post->post)) !!}</p>
    </div>

    <!-- 投稿日時 -->
    <div class="post-date">
      {{ $post->created_at->format('Y-m-d H:i') }}
    </div>
  </div>
  @endforeach

</x-login-layout>
