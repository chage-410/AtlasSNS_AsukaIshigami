<x-login-layout :followingCount="$followingCount" :followerCount="$followerCount">

  <div id="row">
    <!-- メインコンテンツ -->
    <div id="container">
      <form action="/top" method="post">
        <p class="error">{{$errors->first('post')}}</p>
        {{ csrf_field() }}
        <!-- 投稿画面全体 -->
        <div class="post-action">
          <!-- アイコン -->
          <img src=" {{ $user->icon_image ? asset('storage/icons/' . $user->icon_image) : asset('images/icon1.png') }}"
            alt="アイコン">
          <!-- 投稿フォーム -->
          <input class="post-form" type="text" name="post"
            placeholder="投稿内容を入力してください。">
          <!-- 投稿ボタン -->
          <button type="submit">
            <img src="../../../images/post.png" alt="投稿">
          </button>
        </div>

        @if($errors->first('post'))
        @endif
      </form>

      <!-- ポストタイムライン -->
      <div class="post-wrapper">
        <ul>
          <!-- 投稿ループ部分 -->
          @foreach($posts as $post)
          <li class="post-block">
            <a class="post-icon" href="{{ route('user.profile', ['id' => $post->user->id]) }}">
              <img src="{{ $post->user->icon_image ? asset('storage/icons/' . $post->user->icon_image) : asset('images/icon1.png') }}" alt="ユーザーアイコン">
            </a>
            <div class="post-content">
              <div class="post-header">
                <div class="post-name">{{ $post->user->username }}</div>
                <div>{{ $post->created_at }}</div>
              </div>

              <!-- 編集ボタンと削除ボタン：自分の投稿のみ表示 -->
              @if (Auth::id() === $post->user_id)
              <!-- 編集ボタン -->
              <a class="modal-open" href="javascript:void(0);"
                onclick="openModal({{ $post->id }}, '{{ addslashes($post->post) }}')">
                <img src="../../../images/edit.png" alt="更新">
                <img src="../../../images/edit_h.png" alt="更新">
              </a>

              <!-- 削除ボタン -->
              <a class="delete-btn" href="javascript:void(0);" onclick="openDeleteModal({{ $post->id }})">
                <img src="../../../images/trash.png" alt="削除">
                <img src="../../../images/trash-h.png" alt="削除">
              </a>
              @endif

              <div class="post-main">
                <div>{{ $post->post }}</div>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
        <!-- オーバーレイ -->
        <div class="modal-overlay" id="overlay"></div>

        <!-- 更新モーダル本体（ループ外） -->
        <div class="modal-overlay" id="overlay" onclick="closeModal()"></div>
        <div class="modal-container" id="modal">
          <div class="modal-body">
            <div class="modal-close" onclick="closeModal()"></div>
            <form id="edit-form" method="POST">
              @csrf
              @method('PUT')
              <textarea name="post" id="edit-textarea" rows="4" maxlength="150"></textarea>
              <button type="submit">
                <img src="../../../images/edit.png" alt="更新">
              </button>
            </form>
          </div>
        </div>

        <!-- 削除モーダル本体（ループ外） -->
        <div class="delete-modal-overlay" id="delete-overlay" onclick="closeDeleteModal()"></div>

        <div class="delete-modal-container" id="delete-modal">
          <div class="delete-modal-body">
            <p>この投稿を削除します。よろしいでしょうか？</p>
            <form id="delete-form" method="POST">
              @csrf
              @method('DELETE')
              <div class="delete-modal-buttons">
                <button type="submit" class="ok-button">OK</button>
                <button type="button" class="cancel-button" onclick="closeDeleteModal()">キャンセル</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.modal-open').forEach(function(btn) {
        btn.addEventListener('click', function() {
          const id = this.getAttribute('data-id');
          const modal = document.getElementById('modal-' + id);
          modal.style.display = 'block';
        });
      });

      document.querySelectorAll('.modal-close').forEach(function(btn) {
        btn.addEventListener('click', function() {
          this.closest('.modal-container').style.display = 'none';
        });
      });
    });
  </script>

</x-login-layout>
