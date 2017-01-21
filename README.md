# NPHPMAILER

PHPMailerを日本語で便利に使うラッパークラス

## 使い方

PHPMailerを導入しておく

> * [https://github.com/PHPMailer/PHPMailer](https://github.com/PHPMailer/PHPMailer)

以下の形で使う

```php
NPHPMailer::_()
    #->setSMTP() // サーバーで設定していたら不要
    ->setFrom(差出人)
    ->addAddress(宛先)
    ->isHTML(false)
    ->setSubject(件名)
    ->setBody(内容)
    ->send();
```

## 実装例

```php
// 差出人
$from    = "from@example.com";
// 送信先(自分用)
$to      = [
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
  ->setSMTP("smtp.gmail.com", "〇〇@gmail.com", "Gmailのパスワード") # gmailの場合
  ->setFrom($from)
  ->addAddress($to)
  ->isHTML(false)
  ->setSubject($mySubject)
  ->setBody($myBody)
  ->send();

// 相手宛(自動返信用)
NPHPMailer::_()
  ->setSMTP("smtp.gmail.com", "〇〇@gmail.com", "Gmailのパスワード")
  ->setFrom($from)
  ->addAddress($reply)
  ->isHTML(false)
  ->setSubject($toSubject)
  ->setBody($toBody)
  ->send();

```

author: okutani
