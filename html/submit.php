<?php
// 入力内容の取得・変数に格納
$name    = $_POST['name'];     // 氏名
$to      = $_POST['to'];       // メールアドレス
$subject = $_POST['subject'];  // 件名
$message = $_POST['message'];  // 本文

// メール日本語対応
mb_language("japanese");
mb_internal_encoding("UTF-8");

// PHPMailer クラスをネーム空間にインポート
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Composer の autoloader をロード
require 'vendor/autoload.php';


Valitron\Validator::lang('ja');

$v = new Valitron\Validator($_POST); // 検証する値を引数にインスタンスを生成します

$v->labels([
  'name' => '名前',
  'email' => 'メールアドレス'
]);

$v->rule('required', ['name', 'email']); // ルールを設定します
$v->rule('email', 'email');

if($v->validate()) { // 検証
  // インスタンス生成
  $mail = new PHPMailer(true);

  // .envを使用する
  Dotenv\Dotenv::createImmutable(__DIR__)->load();

  try {
      // SMTPの設定
      $mail->isSMTP();                       // SMTP 利用
      $mail->Host       = $_ENV['MAIL_HOST'];  // SMTP サーバー(Gmail の場合これ)
      $mail->SMTPAuth   = true;              // SMTP認証を有効にする
      $mail->Username   = $_ENV['MAIL_USERUNAME']; // ユーザ名 (Gmail ならメールアドレス)
      $mail->Password   = $_ENV['MAIL_PASSWORD'];      // パスワード
      $mail->SMTPSecure = 'tls';             // 暗号化通信 (Gmail では使えます)
      $mail->Port       = $_ENV['MAIL_PORT'];               // TCP ポート (TLS の場合 587)

      // メール本体
      $mail->setFrom($_ENV['MAIL_ADDRESS'], 'user');  // 送信元メールアドレスと名前
      $mail->addAddress($to, mb_encode_mimeheader($name, 'ISO-2022-JP'));  // 送信先メールアドレスと名前
      $mail->Subject = mb_encode_mimeheader($subject, 'ISO-2022-JP');  // 件名
      $mail->Body    = mb_convert_encoding($message, "JIS","UTF-8");  // 本文

  // 送信
      $mail->send();
      echo '送信済み';
  } catch (Exception $e) {
      echo "送信失敗: {$mail->ErrorInfo}";
  }

} else {
  // Errors
  print_r($v->errors());
}
