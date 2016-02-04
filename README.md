# N PHP MAILER

PHPMailerを日本語で便利に使うラッパークラス

## 使い方

PHPMailerをダウンロードして設置しておく(現在PHPMailer5.2.14設置済み)

> * [https://github.com/PHPMailer/PHPMailer](https://github.com/PHPMailer/PHPMailer)

以下の形で使う

```php
require_once "./NPHPMailer.class.php";

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

test.phpに記載

author: okutani
