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
    </head>
    <body>
        <h2>内容確認</h2>
        <section class="contact__check center-block">
        <table class="contact__form__table center-block">
            <tr>
                <th>お名前</th>
                <td>{{$messages['lastname']}} {{$messages['firstname']}}</td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    @if($messages['gender'] == 1)
                    男性
                @elseif($messages['gender'] == 2)
                女性
                @endif
            </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>{{$messages['email']}}</td>
            </tr>
            <tr>
                <th>郵便番号</th>
                <td>{{$messages['postcode']}}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{$messages['address']}}</td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>
                    @if($messages['building_name'] === 'NULL')
                    　　
                    @else
                    {{$messages['building_name']}}
                @endif</td>
            </tr>
            <tr>
                <th>ご意見</th>
                <td>{{$messages['opinion']}}</td>
            </tr>
        </table>
        <form action="/message-send" method="post">
            @csrf
            <input type="submit" value="送信" class="form__btn" name="send">
        </form>
        <form action="/" method="post">
            @csrf
            <button class="message__fix center-block" name="fix">修正する</button>
        </form>
        </section>

    </body>
</html>
