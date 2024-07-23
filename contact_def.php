<?php
// 投稿フォームで入力してもらう要素のname属性、labelタグの内容、require属性を全件登録します
// 下記のようにinput_listの[]内に登録していきます
/*例
「=>」の右側を''で挟んで登録します
required属性のみ''を使わないでください
required属性をつけた場合は「true」、つけなかったものには「false」と記入
必ず下記のように最後にコンマをつけてください
['name' => 'name属性', 'label' => 'label要素の内容', 'required' => true],
上から順に表示されます
*/
$input_list = [
	['name' => 'details', 'label' => 'お問い合わせ項目', 'required' => true],
	['name' => 'name', 'label' => 'お名前', 'required' => true],
	['name' => 'email', 'label' => 'メールアドレス', 'required' => true],
	['name' => 'tel', 'label' => '電話番号', 'required' => false],
    ['name' => 'date1', 'label' => '第1希望日', 'required' => false],
    ['name' => 'date2', 'label' => '第2希望日', 'required' => false],
    ['name' => 'date3', 'label' => '第3希望日', 'required' => false],
    ['name' => 'time', 'label' => '折り返し希望時間', 'required' => false],
    ['name' => 'check', 'label' => 'きっかけ（複数選択可）', 'required' => false],
    ['name' => 'message', 'label' => 'お問い合わせ内容', 'required' => true],
];

// テキスト
$text_form = "お問い合わせフォーム";
$text_confirm = "確認画面";
$text_submit = "予約完了";

$confirm_p = "以下の内容でよろしければ『送信する』を押してください。変更する場合は『入力内容を修正する』を押してください。";


// 変数
$err = [];


// メール送信時に必要なデータ群
// 内部エラーが表示された際はかっこ内の数字とエラーコードが対応しています。
/*↓必須項目*/
$company_name = '';	// 顧客会社名(1)
$company_mail = '';	// 顧客メールアドレス(2)
$domain = ''; // ホームページのドメイン(3)
/* ↑必須項目 */

// デバッグモードの場合は true にする。リリース時は必ず false にすること
const DEBUG = true;