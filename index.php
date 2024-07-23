<?php
session_start();
require_once 'contact_def.php';
require_once 'formlib.php';
$_SESSION['nonce'] = getNonce();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム</title>
    <link rel="stylesheet" href="style/contactform.css">
</head>
<body>
<!-- ヘッダーファイル
<?php include_once ''; ?>
--> 
<main>
<section class="contactform">
    <h2><?php echo $text_form; ?></h2>
    <form id="contact-form" action="confirm.php" method="post">
        <dl>
            <div class="radio">
                <dt><label>お問い合わせ項目</label><span class="l_required">必須</span></dt>
                <dd>
                    <!-- inputのid属性とlabelのfor属性を同じにすることで、テキストを押してもチェックされる -->
                    <!-- 必須項目にはrequiredを追加 -->
                    <p><!-- 1つ目のラジオボタン -->
                        <label for="first-radio"><input type="radio" id="first-radio" name="details" value="サンプルについて" checked>サンプルについて</label>
                    </p>
                    <p><!-- 2つ目のラジオボタン -->
                        <label for="second-radio"><input type="radio" id="second-radio" name="details" value="サンプルサンプルについて" >サンプルサンプルについて</label>
                    </p>
                    <p><!-- 3つ目のラジオボタン -->
                        <label for="third-radio"><input type="radio" id="third-radio" name="details" value="その他" >その他</label>
                    </p>
                </dd>
            </div>
            <div>
                <dt>
                    <label for="name">お名前<span class="l_required">必須</span></label>
                </dt>
                <dd>
                    <input type="text" id="name" name="name" placeholder="例：山田太郎" required>
                </dd>
            </div>
            <div>
                <dt>
                    <label for="email">メールアドレス<span class="l_required">必須</span></label>
                </dt>
                <dd>
                    <input type="email" id="email" name="email" placeholder="例：sample@gmail.com" required>
                </dd>
            </div>
            <div>
                <dt>
                    <label for="tel">電話番号</label>
                </dt>
                <dd>
                    <input type="tel" id="tel" name="tel" placeholder="例：09012345678">
                </dd>
            </div>
            <div>
                <dt><label for="expiration">第1希望日</label></dt>
                <dd><input class="text_con" type="date" name="date1" id="date1"></input></dd>
            </div>
            <div>
                <dt><label for="expiration">第2希望日</label></dt>
                <dd><input class="text_con" type="date" name="date2" id="date2"></input></dd>
            </div>
            <div>
                <dt><label for="expiration">第3希望日</label></dt>
                <dd><input class="text_con" type="date" name="date3" id="date3"></input></dd>
            </div>
            <div class="checkbox">
                <dt><label>きっかけ（複数選択可）</label></dt>
                <dd>
                    <p>
                        <label for="check1"><input type="checkbox" id="check1" name="check[]" value="ホームページ" checked>ホームページ</label>
                    </p>
                    <p>
                        <label for="check2"><input type="checkbox" id="check2" name="check[]" value="紹介">紹介</label>
                    </p>
                </dd>
            </div>
            <div>
                <dt>折り返し連絡希望時間</dt>
                <dd>
                    <select name="time" id="time">
                        <option value="いつでも可">いつでも可</option>
                        <option value="9:00～10:00">9:00～10:00</option>
                        <option value="10:00～11:00">10:00～11:00</option>
                        <option value="11:00～12:00">11:00～12:00</option>
                        <option value="12:00～13:00">12:00～13:00</option>
                        <option value="13:00～14:00">13:00～14:00</option>
                        <option value="14:00～15:00">14:00～15:00</option>
                        <option value="15:00～16:00">15:00～16:00</option>
                        <option value="16:00～17:00">16:00～17:00</option>
                        <option value="17:00～18:00">17:00～18:00</option>
                    </select>
                </dd>
            </div>
            <div>
                <dt>
                    <label for="message">お問い合わせ内容<span class="l_required">必須</span></label>
                </dt>
                <dd>
                    <textarea name="message" id="message" maxlength="500" placeholder="ここにお問い合わせ内容の入力をお願いします。" required></textarea>
                </dd>
            </div>
        </dl>
        <input type="hidden" name="code" value="<?= $_SESSION['nonce'] ?>">
        <button type="submit">入力内容の確認</button>
    </form>
</section>
</main>
<!-- フッターファイル
<?php include_once ''; ?>
-->
</body>
</html>