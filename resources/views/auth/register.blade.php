<x-logout-layout>

    <div class="login-container">

        <div class="service-logo">
            <img src="{{ asset('images/atlas.png') }}" alt="Atlas" class="logo-image">
        </div>
        <h2 class="service-subtitle">Social Network Service</h2>


        <div class="login-form-wrapper">
            <!-- バリデードでエラー表示 -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {!! Form::open(['url' => 'register','class' => 'login-form']) !!}

            <p class="register-title">新規ユーザー登録</p>

            {{ Form::label('ユーザー名') }}
            {{ Form::text('username',null,['class' => 'input-field']) }}

            {{ Form::label('メールアドレス') }}
            {{ Form::email('email',null,['class' => 'input-field']) }}

            {{ Form::label('パスワード') }}
            {{ Form::password('password', ['class' => 'input-field']) }}

            {{ Form::label('パスワード確認') }}
            {{ Form::password('password_confirmation', ['class' => 'input-field']) }}

            {{ Form::submit('新規登録', ['class' => 'login-button']) }} {{-- ログインボタンと同じクラスを適用 --}}

            <p class="register-link-wrapper"><a href="login" class="register-link">ログイン画面へ戻る</a></p>

            {!! Form::close() !!}

        </div>
    </div>
</x-logout-layout>
