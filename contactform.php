<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style/common.css">
<link rel="stylesheet" href="style/contactform.css">
<title>お問い合わせフォーム</title>
</head>
<body>
<main>
<section id="contactform">
    <h2>お問い合わせフォーム</h2>
    <form action="confirm.php" method="post">
        <dl>
            <div class="radio">
                <dt><label>お問い合わせ項目</label><span>必須</span></dt>
                <dd>
                    <!-- inputのid属性とlabelのfor属性を同じにすることで、テキストを押してもチェックされる -->
                    <!-- 1つ目のラジオボタン -->
                    <p>
                        <input type="radio" id="first-radio" name="details" value="サンプルについて" checked>
                        <label for="first-radio">サンプルについて</label>
                    </p>

                    <!-- 2つ目のラジオボタン -->
                    <p>
                        <input type="radio" id="second-radio" name="details" value="サンプルサンプルについて" >
                        <label for="second-radio">サンプルサンプルについて</label>
                    </p>

                    <!-- 3つ目のラジオボタン -->
                    <p>
                        <input type="radio" id="third-radio" name="details" value="その他" >
                        <label for="third-radio">その他</label>
                    </p>
                </dd>
            </div>
            <div>
                <dt>
                    <label for="name">お名前<span>必須</span></label>
                </dt>
                <dd>
                    <input type="text" id="name" name="name" placeholder="例）山田太郎" required>
                    <!-- 必須項目にはrequiredを追加 -->
                </dd>
            </div>
            <div>
                <dt>
                    <label for="email">メールアドレス<span>必須</span></label>
                </dt>
                <dd>
                    <input type="email" id="email" name="email" placeholder="例）sample@gmail.com" required>
                </dd>
            </div>
            <div>
                <dt>
                    <label for="tel">電話番号<span>任意</span></label>
                </dt>
                <dd>
                    <input type="tel" id="tel" name="tel" placeholder="例）09012345678">
                </dd>
            </div>
            <div>
                <dt>
                    <label for="message">お問い合わせ内容<span>必須</span></label>
                </dt>
                <dd>
                    <textarea name="message" id="message" maxlength="500" placeholder="ここにお問い合わせ内容の入力をお願いします。" required></textarea>
                </dd>
            </div>
        </dl>
        <button type="submit">入力内容の確認</button>
    </form>
</section>
</main>
</body>
</html>