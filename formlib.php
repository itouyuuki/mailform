<?php
/* フォーム共通ライブラリ */

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

// 文字列のエスケープ処理
function h($str) {
	return htmlspecialchars($str, ENT_HTML5 | ENT_QUOTES, 'UTF-8');
}

// POST送信でない場合、リダイレクト
function req() {
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		header('Location: index.php', true, 303);
		exit;
	}
}

// 改行コードの置換
function brReplace($text) {
	$pattern = '/\r(?!\n)|(?<!\r)\n/';
	$text = preg_replace($pattern, "\r\n", $text);
	return $text;
}

// ピリオドの置換
function periodReplace($text) {
	$pattern = '/^\.\r$/m';
	$text = preg_replace($pattern, "..\r", $text);
	return $text;
}

// input_list 内 nameキーに [] が付いたものを置換
function 	replaceBracket($str) {
	$pattern = '/\[([0-9]*)\]$/';
	$preg_name =  preg_replace($pattern, '', $str);
	return $preg_name;
}

// リプレイ攻撃の対策のためのnonce値の検証
function checkNonce($nonce) {
	$e = [];
	if(!isset($_SESSION['nonce'])) { // nonceが設定されていない場合エラー表示
		$e[] = 'システムエラーです';
	} else if ($nonce != $_SESSION['nonce']) { // hiddenフィールド上のnonceと生成したnonceのチェック
		$e[] = 'トークンエラーです。最初からやり直してください。';
	}
	return $e;
}

function getNonce() {
	// nonceの更新
	return 	random_int(1,999999999);
}

// 入力項目が正しいかどうかをチェック
function check_validity($params, $rules) {
  $e = [];
  foreach($rules as $r) {
    $normalized_name = replaceBracket($r['name']); // nameキーの正規化
    // requiredがtrueでかつPOSTの値が空ならエラー表示
    if ($r['required'] && empty($params[$normalized_name])) {
      $e[] = "必須入力項目の $normalized_name がありません。";
    }
  }
  return $e;
}