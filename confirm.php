<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$details = $_POST["details"];
$name = $_POST["name"];
$email = $_POST["email"];
$tel = $_POST["tel"];
$message = $_POST["message"];
} else { 
header("Location: contactform.php");
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style/common.css">
<link rel="stylesheet" href="style/confirm.css">
<title>お問い合わせフォーム確認画面</title>
</head>
<body>
<main>
<section id="confirm">
    <h2>確認画面</h2>
    <p>以下の内容でよろしければ『送信』をクリック、変更する場合は『戻る』をクリックしてください。</p>
    <dl>
        <div>
            <dt>お問い合わせ項目:</dt>
            <dd><?php echo $details; ?></dd>
        </div>
        <div>
            <dt>お名前:</dt>
            <dd><?php echo $name; ?></dd>
        </div>
        <div>
            <dt>メールアドレス:</dt>
            <dd><?php echo $email; ?></dd>
        </div>
        <div>
            <dt>電話番号:</dt>
            <dd><?php echo $tel; ?></dd>
        </div>
        <div>
            <dt>お問い合わせ内容:</dt>
            <dd><?php echo $message; ?></dd>
        </div>
    </dl>
    <form action="send.php" method="post">
        <input type="hidden" name="details" value="<?php echo $details; ?>">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <input type="hidden" name="tel" value="<?php echo $tel; ?>">
        <input type="hidden" name="message" value="<?php echo $message; ?>">
        <button type="button" onclick="history.back(-1)" value="戻る">戻る</button>
        <button type="submit" value="送信">送信</button>
    </form>
</section>
</main>
</body>
</html>