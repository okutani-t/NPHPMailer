<?php
/**
 * PHPMailerのテスト
 *
 * @author okutani
 */
// CustomPHPMailer読み込み
require_once './NPHPMailer.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /****************************
     * 送信情報設定
     ****************************/
    $from    = 'from@test.com';
    $to      = array(
        'okutani.nt@gmail.com'
    );
    $reply   = $_POST["email"];

    // 内容
    $mySubject = 'お問い合わせがありました';
    $myBody    = '名前: ' . $_POST["name"] .
                 "\nメールアドレス: " . $_POST["email"];

    $toSubject =  '[自動返信]お問い合わせありがとうございます';
    $toBody    =  "以下の内容でメールを送信しました。\n\n" .
                  "名前: " . $_POST["name"] .
                  "\nメールアドレス: " . $_POST["email"] .
                  "\n\n今後ともよろしくお願いいたします。";

    // 自分宛
    NPHPMailer::_()
        #->setSMTP          // サーバーで設定していたら不要
        ->setForm($from)
        ->addAddress($to)
        ->isHTML(false)
        ->setSubject($mySubject)
        ->setBody($myBody)
        ->send();

    // 相手宛
    NPHPMailer::_()
        #->setSMTP          // サーバーで設定していたら不要
        ->setForm($from)
        ->addAddress($reply)
        ->isHTML(false)
        ->setSubject($toSubject)
        ->setBody($toBody)
        ->send();

    echo 'メールが送信されました！';

    unset($_POST);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>NPHPMailer test</title>
</head>
<body>
    <h1>NPHPMailerのテスト</h1>
    <form action="" method="post">
        <p>
            名前: <input type="text" name="name" value="">
        </p>
        <p>
            EMAIL: <input type="text" name="email" value="">
        </p>
        <input type="submit" value="送信">
    </form>
</body>
</html>
