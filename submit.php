<?php
session_start();
require_once 'contact_def.php';
require_once 'formlib.php';

// POST送信でない場合、リダイレクト
req();

// nonce のチェック
$checkNonce = checkNonce($_POST['code']);
$err = array_merge($err, $checkNonce);
unset($_SESSION['nonce']);

// 入力項目の基本的なエラーチェック
$err = check_validity($_POST, $input_list);

// エラーがあった場合はエラー表示
if (count($err) > 0) {
    foreach ($err as $e) {
    echo "$e\n";
    exit;
    }
}

// メール送信
mb_language('Japanese');
mb_internal_encoding('utf-8');

$result = [];

// フォーム部分のメールを作成
$form_body = "-----\r\n";
foreach ($input_list as $rule) {
    $normalized_name = replaceBracket($rule['name']);
    $v = $_POST[$normalized_name];
    if (is_array($v)) {
        $v = implode("\r\n", $v);
    }
    $form_body .= "【{$rule['label']}】\r\n{$v}\r\n";
}

// サイト→顧客会社のメールを作成
$mime_sender_name = mb_encode_mimeheader($company_name, 'iso-2022-jp');
$from = "@{$domain}";
$to = $company_mail;
$reply = @$_POST['email'] ?? '';
$bcc = ''; // form@nextreservation.jp
$options = "-f $from";

// ヘッダー
$header =<<< EOM
From: {$mime_sender_name} <{$from}>
BCC: {$bcc}
EOM;

// Subject
$subject = "【{$company_name}お問い合わせ】";

// メール本文
$message = <<<EOM
下記のようにお問い合わせがありました。
内容をご確認の上、ご対応をよろしくお願いいたします。

{$form_body}
EOM;
$message = brReplace(periodReplace($message));

// メールの送信処理
if (! DEBUG) {
    // メールを送信
    $res1 = mb_send_mail($to, $subject, $message, $header, $options);
} else {
    // デバッグ時はメールを送信せずに保存
    $mail1 =<<< EOM
Subject: {$subject}
To: {$to}
{$header}

{$message}
EOM;
    $res1 = true;
}

if ($res1) {
    $result[] = <<<EOM
お問い合わせありがとうございました。
後ほど、担当者からご連絡させていただきます。
EOM;
} else {
    $result[] = <<<EOM
お問い合わせメールの送信に失敗しました。
お手数ですが、ーまでお電話にてお問い合わせをお願いいたします。
EOM;
}

/* サイト→お問い合わせ者のメール */
$to = @$_POST['email'];
$reply = $company_mail;
$header =<<< EOM
From: {$mime_sender_name} <{$from}>
BCC: {$bcc}
EOM;

if ($to != '（入力なし）') {
    // メール本文
$message = <<<EOM
この度はお問い合わせをいただき、ありがとうございます。
下記の通り承りましたので、今一度ご確認ください。

{$form_body}

このメールアドレスは送信専用です。返信はできませんのでご了承ください。
EOM;

    $message = brReplace(periodReplace($message));

    if (! DEBUG) {
        // メールを送信
        $res2 = mb_send_mail($to, $subject, $message, $header, $options);
    } else {
        // デバッグ時はメールを送信せずに保存
        $mail2 =<<< EOM
Subject: {$subject}
To: {$to}
{$header}

{$message}
EOM;

        $res2 = true;
    }
    if ($res2) {
        $result[] = 'お問い合わせをご指定のメールアドレスに送付いたしました。ご確認ください。';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>予約完了</title>
<link rel="stylesheet" href="style/contactform.css">
</head>
<body>
<main>
<!-- ヘッダーファイル
<?php include_once ''; ?>
-->  
<section id="submit">
    <h2><?php echo $text_submit; ?></h2>
    <div class="">
        <?php
        foreach ($result as $m) {
            ?><p><?= nl2br($m) ?></p><?php
        }
        if (DEBUG) {
            if (isset($mail1)) {
        ?>
            <h3>デバッグ: 送信したメール1</h3>
            <pre><?= h($mail1) ?></pre>
        <?php
        }
            if (isset($mail2)) {
        ?>
            <h3>デバッグ: 送信したメール2</h3>
            <pre><?= h($mail2) ?></pre>
        <?php
        }
        }
        ?>
        <div class="submit-btn">
            <a href="./" class="to-contact">お問い合わせページへ</a>
            <a href="<?= $base ?>" class="to-top">トップページへ</a>
        </div>
	</div>
</section>
</main>
<!-- フッターファイル
<?php include_once ''; ?>
-->
</body>
</html>