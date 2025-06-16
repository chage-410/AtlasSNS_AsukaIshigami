<x-login-layout :followingCount="$followingCount" :followerCount="$followerCount">

  <!-- フォロワーアイコン一覧 -->
  <div class="follow-icon">
    <div class="follow-header">
      <h2>フォロワーリスト</h2>

      <div class="follow-icon-grid">
        @foreach ($followers as $follower)
        <a href="{{ route('user.profile', ['id' => $follower->id]) }}">
          <img src="{{ $follower->icon_image ? asset('storage/icons/' . $follower->icon_image) : asset('images/icon1.png') }}" alt="アイコン">
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
        <img src="{{$post->user->icon_image ? asset('storage/icons/' . $post->user->icon_image) : asset('images/icon1.png') }}" alt="アイコン">
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
