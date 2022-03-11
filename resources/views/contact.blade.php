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
        <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
        <script type="text/javascript">
            function checkedGender($value){
                console.log($value);
                if($value === 1){
                    document.getElementById("men").checked = true;
                }else if($value === 2){
                    document.getElementById("women").checked = true;
                }
            }

        function changePostcode() {
           //入力された文字列を適切なフォーマットに変換する
            var ts = document.getElementById("postcode").value;
            //全角英数字の場合
            if(ts.match(/[０-９Ａ-Ｚａ-ｚ]/)){
                ts = ts.replace( /ー/g, '-');
                ts = ts.replace( /－/g, '-');
                ts = ts.replace( /[０-９Ａ-Ｚａ-ｚ]/g, function(es) {
                return String.fromCharCode(es.charCodeAt(0) - 65248);
                });
            //日本語が含まれる場合
            }else if(ts.match(/[^\x01-\x7E]/)){
                ts = null;
            }

            document.getElementById("postcode").value = ts;

            //エラー処理
            if(!ts.match(/-/) || ts.length < 8){
                document.querySelector('.postcode__error').innerHTML = "-(ハイフン)を含めた8桁で記入してください";
                document.querySelector('.postcode__error').style.display='block';
            }else{
                document.querySelector('.postcode__error').style.display='none';
            }
        }

        function errorMessage(){
            var email_value = document.getElementById("email").value;
            if(!email_value.match(/@/) || email_value.match(/\./) == null){
                document.querySelector('.email__error').innerHTML = "メールアドレスの形式で入力してください";
                document.querySelector('.email__error').style.display='block';}
                else{
                    document.querySelector('.email__error').style.display='none';
                }
        }
</script>

    </head>
    <body>
        <h2>お問い合わせ</h2>
        <form action="/message-check" method="post" class="h-adr contact__form center-block">
            <span class="p-country-name" style="display:none;">Japan</span>
            @csrf
            <table class="contact__form__table">
                <tr>
                    <th>お名前<span class="red">※</span></th>
                    <td class="contactform__name">
                        <div class="lastname">
                            <input type="text" name="lastname" value="{{ old('lastname',$messages['lastname']) }}" class="contactform__input__name" >
                            @if($errors->has('lastname'))
                            <p class="red">{{$errors->first('lastname')}}</p>
                            @endif
                            <p class="example__text">例）山田</p>
                        </div>

                        <div class="firstname">
                            <input type="text" name="firstname" class="contactform__input__name" value="{{ old('firstname',$messages['firstname']) }}" >
                            @if($errors->has('firstname'))
                            <p class="red">{{$errors->first('firstname')}}</p>
                            @endif
                            <p class="example__text">例）太郎</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>性別<span class="red">※</span></th>
                    <td class="contactform__gender">
                        <div class="men">
                            <input type="radio" name="gender" value="1" id="men" class="contactform__input__gender visually-hidden"><label for="men">男性</label>
                        </div>
                        <div class="women">
                            <input type="radio" name="gender" value="2" id="women" class="contactform__input__gender visually-hidden"><label for="women">女性</label>
                        </div>
                        <script>checkedGender({{ old('gender',$messages['gender']) }});</script>
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス<span class="red">※</span></th>
                    <td>
                        <input type="text" name="email" value="{{ old('email',$messages['email']) }}" id="email" onBlur="errorMessage();">
                        <p class="red email__error" style="display:none;"></p>
                            @if($errors->has('email'))
                            <p class="red">{{$errors->first('email')}}</p>
                            @endif
                        <p class="example__text">例）test@example.com</p></td>
                </tr>
                <tr>
                    <th>郵便番号<span class="red">※</span></th>
                    <td class="contactform__postcode">
                        <div class="postmark__input">
                            <div class="postmark">〒</div>
                            <input type="tel" name="postcode" id="postcode" class="p-postal-code contactform__input__postcode" onBlur="changePostcode();" value="{{ old('postcode',$messages['postcode']) }}" >
                        </div>
                        <p class="red postcode__error" style="display:none;"></p>
                            @if($errors->has('postcode'))
                            <p class="red">{{$errors->first('postcode')}}</p>
                            @endif

            <p class="example__text">例）123-4567</p></td>
                </tr>
                <tr>
                    <th>住所<span class="red">※</span></th>
                    <td>
                        <input type="text" name="address" class="p-region p-locality p-street-address p-extended-address" value="{{ old('address',$messages['address']) }}" >
                            @if($errors->has('address'))
                            <p class="red">{{$errors->first('address')}}</p>
                            @endif
                        <p class="example__text">例）東京都渋谷区千駄ヶ谷1-2-3</p></td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td><input type="text" name="building_name" value="{{ old('building_name',$messages['building_name']) }}" >
            <p class="example__text">例）千駄ヶ谷マンション</p></td>
                </tr>
                <tr>
                    <th>ご意見<span class="red">※</span></th>
                    <td><textarea rows="10" cols="60" name="opinion" maxlength="120">{{ old('opinion',$messages['opinion']) }}</textarea>
                            @if($errors->has('opinion'))
                            <p class="red">{{$errors->first('opinion')}}</p>
                            @endif
                </td>
                </tr>
            </table>
            <input type="submit" value="確認" class="form__btn">
        </form>


    </body>
</html>
