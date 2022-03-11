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
        <section class="message__send center-block">
        <p class="thx__message">ご意見いただきありがとうございました。</p>


        <button class="form__btn"><a href="{{ route('contact') }}">トップページへ</a></button>
</section>

    </body>
</html>
