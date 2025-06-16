<x-login-layout :followingCount="$followingCount" :followerCount="$followerCount">
  <div id="clear">

    <form action="{{ route('user.search') }}" method="GET">
      {{ csrf_field() }}
      <div class="search">
        <input class="search-form" type="text" name="keyword" placeholder="ユーザー名を検索" value="{{ $keyword ?? '' }}">
        <button type="submit">
          <img src="../../../images/search.png" alt="検索">
        </button>

        <!-- 検索キーワード表示（検索したときだけ表示） -->
        @if(request('keyword'))
        <p class="search-word">検索ワード：{{ request('keyword') }}</p>
        @endif
      </div>
    </form>

    <ul>
      @foreach($users as $user)
      <div class="user-card">
        <!-- アイコン -->
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <img src="{{ $user->icon_image ? asset('storage/icons/' . $user->icon_image) : asset('images/icon1.png') }}" alt="アイコン">
        </a>

        <!-- ユーザー名 -->
        <p>{{ $user->username }}</p>

        <!-- フォローボタン -->
        @if (Auth::id() !== $user->id)
        @if (Auth::user()->followings->contains($user->id))
        <!-- フォロー済み -->
        <form action="{{ route('unfollow', $user->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button class="unfollow-btn" type="submit">フォロー解除</button>
        </form>
        @else
        <!-- 未フォロー -->
        <form action="{{ route('follow', $user->id) }}" method="POST">
          @csrf
          <button class="follow-btn" type="submit">フォローする</button>
        </form>
        @endif
        @endif
      </div>
      @endforeach
    </ul>

  </div>
</x-login-layout>
