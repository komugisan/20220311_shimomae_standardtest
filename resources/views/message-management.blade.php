<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>お問い合わせ</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <!-- Script -->
        <script>
            function cutText(cutText,id) {
                if(cutText.length > 25){
                cutText = cutText.substr(0,25) + '…';
                }
                document.getElementById("cut"+id).innerHTML = cutText;

            };

            function opinionOver(id){
                var length_check = document.getElementById("cut"+id).innerHTML;
                if(length_check.match(/…/)){
                document.getElementById("opinion"+id).style.display = "block";
                }

            }

            function opinionOut(id){
                document.getElementById("opinion"+id).style.display = "none";
            }

            function saerchReset(){
                document.searchform.reset();
            }

            </script>

    </head>
    <body>
        <h2>管理システム</h2>
        <form action="/message-search" method="get" class="h-adr management__search__form center-block" name="searchform">
            @csrf
            <div class="management__searchform__table">
                <div class="management__searchform__raw1">
                    <div class="management__searchform__name">
                        <span class="title">お名前</span><input type="text" name="name" class="searchform__input__name">
                        </div>
                    <div class="management__searchform__gender">
                        <span class="title shortmargin">性別</span>
                        <div class="all">
                            <input type="radio" name="gender" value="0" id="all" checked class="contactform__input__gender visually-hidden"><label for="all">全て</label>
                        </div>
                        <div class="men">
                            <input type="radio" name="gender" value="1" id="men" class="contactform__input__gender visually-hidden"><label for="men">男性</label>
                        </div>
                        <div class="women">
                            <input type="radio" name="gender" value="2" id="women" class="contactform__input__gender visually-hidden"><label for="women">女性</label>
                        </div>
                    </div>
                </div>
                <div class="management__searchform__raw2">
                    <div class="management__searchform__created">
                        <span class="title">登録日</span>
                        <div class="searchdate__input">
                            <input type="date" name="startDate" id="created" class="created">
                            <div class="postmark">～</div>
                            <input type="date" name="endDate" class="created">
                        </div>
                    </div>
                </div>
                <div class="management__searchform__raw3">
                    <div class="management__searchform__email">
                        <span class="title shortmargin">メールアドレス</span>
                        <input type="text" name="email" class="searchform__input__email">
                    </div>
        </div>
        </div>
            <input type="submit" value="検索" class="form__btn" name="search">
            <button type="button" class="message__fix center-block" onclick="saerchReset();">リセット</button>
        </form>

        <section class="contacts__check__contents center-block">

        {{ $contacts->appends($params)->links('pagination::default') }}

        <ul class="management__list__title__line">
            <li class="management__list__title">
                <div class="id">ID</div>
                <div class="name">お名前</div>
                <div class="gender">性別</div>
                <div class="email">メールアドレス</div>
                <div class="opinion">ご意見</div>
            </li>
        </ul>

        <ul class="management__message__view">
            @foreach($contacts as $contact)
            <li class="management___message__list">
                <div class="id">{{$contact->id}}</div>
                <div class="name">{{$contact->fullname}}</div>
                <div class="gender">
                    @if($contact->gender == 1)
                    男性
                    @elseif($contact->gender == 2)
                    女性
                    @endif</div>
                <div class="email">{{$contact->email}}</div>
                <div class="opinion" id="cut{{$contact->id}}" onmouseenter="opinionOver({{$contact->id}})" onmouseout="opinionOut({{$contact->id}})"><script>cutText('{!! $contact->opinion !!}',{{$contact->id}});</script></div>
                <div id="opinion{{$contact->id}}" class="all_opinion" style="display:none;">{{$contact->opinion}}</div>
                <form action="/message-management" method="post" class="delete">
            @csrf
            <input type="hidden" value="{{$contact->id}}" name="id">
            <input type="submit" value="削除" class="form__btn" name="delete">
                </form>
            </li>
            @endforeach
        </ul>

        </section>




    </body>
</html>
