<?php
/**
 * PHPMailerのテスト
 *
 * @author okutani
 */
// NPHPMailer読み込み
require_once "./NPHPMailer.class.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /****************************
     * 送信情報設定
     ****************************/
    // 差出人
    $from    = "from@example.com";
    // 送信先(自分用)
    $to        = [
        "myaddress@example.com"
    ];
    // 送信先(相手用)
    $reply   = $_POST["email"];

    // 件名(自分用)
    $mySubject = "お問い合わせがありました";
    // 内容(自分用)
    $myBody    = "名前: " . $_POST["name"] . "\n" .
                 "メールアドレス: " . $_POST["email"];
    // 件名(相手用)
    $toSubject =  "[自動返信]お問い合わせありがとうございます";
    // 内容(相手用)
    $toBody    =  "以下の内容でメールを送信しました。\n\n" .
                  "名前: " . $_POST["name"] . "\n" .
                  "メールアドレス: " . $_POST["email"] . "\n" .
                  "今後ともよろしくお願いいたします。";

    // 自分宛
    NPHPMailer::_()
        #->setSMTP() // サーバーで設定していたら不要
        ->setFrom($from)
        ->addAddress($to)
        ->isHTML(false)
        ->setSubject($mySubject)
        ->setBody($myBody)
        ->send();

    // 相手宛(自動返信用)
    NPHPMailer::_()
        #->setSMTP() // サーバーで設定していたら不要
        ->setFrom($from)
        ->addAddress($reply)
        ->isHTML(false)
        ->setSubject($toSubject)
        ->setBody($toBody)
        ->send();

    echo "メールが送信されました！";

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
