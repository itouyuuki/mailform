<?php
session_start();
require_once 'contact_def.php';
require_once 'formlib.php';

// POST送信でない場合、リダイレクト
req();

// nonce のチェックと更新
$checkNonce = checkNonce($_POST['code']);
$err = array_merge($err, $checkNonce);
$_SESSION['nonce'] = getNonce();

// 入力項目の基本的なエラーチェック
$err = check_validity($_POST, $input_list);

// エラーがあった場合はエラー表示
if (count($err) > 0) {
    foreach ($err as $e) {
    echo "$e\n";
    exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>確認画面</title>
    <link rel="stylesheet" href="style/contactform.css">
</head>
<body>
<main>
<!-- ヘッダーファイル
<?php include_once ''; ?>
-->  
<section id="confirm">
    <h2><?php echo $text_confirm; ?></h2>
    <p><?php echo $confirm_p; ?></p>
    <form action="submit.php" method="post">
        <input type="hidden" name="code" value="<?= $_SESSION['nonce'] ?>">
	    <dl class="form_list">
            <?php foreach ($input_list as $rule) { ?>
                <div>
                    <dt><?= $rule['label'] ?></dt>
                    <dd>
                        <?php
                        $normalized_name = replaceBracket($rule['name']);  // name 属性の正規化
                        $value = empty($_POST[$normalized_name]) ? '（入力なし）' : $_POST[$normalized_name];
                        if (is_array($value)) {
                            // 配列の場合
                            foreach ($value as $v) {
                            ?><input type="hidden" name="<?= $rule['name'] ?>"  value="<?= h($v) ?>"><?php
                            }
                            echo nl2br(h(implode("\r\n", $value)));
                        } else {
                            // スカラー値の場合
                            ?><input type="hidden" name="<?= $rule['name'] ?>" value="<?= h($value) ?>"><?= nl2br(h($value)) ?><?php
                        }
                        ?>
                    </dd>
                </div>
            <?php } ?>
        </dl>
        <div class="btn_wrapper">
            <button class="btn" type="button" onclick="history.back();">入力内容を修正</button>
            <button class="submit_btn">送信する</button>
        </div>
    </form>
</section>
</main>
<!-- フッターファイル
<?php include_once ''; ?>
-->
</body>
</html>