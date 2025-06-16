        <div id="head">
            <h1>
                <a href="/top"><img src="{{ asset('images/atlas.png') }}"></a>
            </h1>
            <div class="user-menu">
                <section class="accordion">
                    <input id="block-01" type="checkbox" class="toggle">
                    <label class="Label" for="block-01">
                        <div class="user-info">
                            <img src="{{ Auth::user()->icon_image ? asset('storage/icons/' . Auth::user()->icon_image) : asset('images/icon1.png') }}" alt="アイコン" class="user-icon">
                            <p>{{ Auth::user()->username }} さん</p>
                        </div>
                    </label>
                    <div class="content">
                        <ul>
                            <li><a href="/top">HOME</a></li>
                            <li><a href="/profile">プロフィール編集</a></li>
                            <li><a href="/logout">ログアウト</a></li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
