<?php
$to = 'sato@nextreservation.jp';// 送る先のメールアドレス
$subject = 'お問い合わせがありました';// 送信されるメールの題名
// 以下は、送信するメールの本文
$message = "お問い合わせがありました。\n";
$message .= "\n";
$message .= "入力された内容は以下の通りです。\n";
$message .= "---\n";
$message .= "\n";
$message .= "お問い合わせ内容:\n";
$message .= $_POST["details"];
$message .= "\n";
$message .= "お名前:\n";
$message .= $_POST["name"];
$message .= "\n";
$message .= "メールアドレス:\n";
$message .= $_POST["email"];
$message .= "\n";
$message .= "電話番号:\n";
$message .= $_POST["tel"];
$message .= "\n";
$message .= "お問い合わせ本文:\n";
$message .= $_POST["message"];

// 設定した内容でメールを送る命令
mb_language("Japanese");
mb_internal_encoding("UTF-8");
if(mb_send_mail(string $to, $subject, $message)) {
    echo "メールが送信されました。";
} else {
    echo "メールの送信に失敗しました。";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ完了画面</title>
</head>
<body>
    <p>お問い合わせありがとうございました。</p>
    <a href="contactform.php">お問い合わせフォームへ戻る</a>
</body>
</html>