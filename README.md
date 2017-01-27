# NPHPMAILER

[PHPMailer](https://github.com/PHPMailer/PHPMailer)を日本語で便利に使うラッパークラス

## Description

**NPHPMailer**は、日本語メールをPHPMailerで送信する際に設定するべき「内部エンコーディング」や「文字コードの指定」を内部で設定してくれるラッパークラスです。また、チェーンメソッドを利用して送信できるので、コード量を少なくしてくれます。

## Usage

以下の形でメールを送信する。

```php
use OkutaniT\NPHPMailer;

NPHPMailer::_()
    #->setSMTP(ホスト, ユーザー, パスワード) // サーバーで設定していたら不要
    ->setFrom(差出人)
    ->addAddress(宛先)
    ->setSubject(件名)
    ->setBody(内容)
    ->send();
```

具体的には、次のように利用する。

```php
use OkutaniT\NPHPMailer;

$from      = "from@example.com";
$to        = [
  "myaddress@example.com"
];
$reply     = $_POST["email"];

$mySubject = "お問い合わせがありました";
$myBody    = "名前: " . $_POST["name"] . "\n" .
"メールアドレス: " . $_POST["email"];
$toSubject =  "[自動返信]お問い合わせありがとうございます";
$toBody    =  "以下の内容でメールを送信しました。\n\n" .
"名前: " . $_POST["name"] . "\n" .
"メールアドレス: " . $_POST["email"] . "\n" .
"今後ともよろしくお願いいたします。";

// 自分宛
NPHPMailer::_()
  ->setSMTP("smtp.gmail.com", "〇〇@gmail.com", "Gmailのパスワード") # gmailの場合
  ->setFrom($from)
  ->addAddress($to)
  ->setSubject($mySubject)
  ->setBody($myBody)
  ->send();

// 相手宛(自動返信用)
NPHPMailer::_()
  ->setSMTP("smtp.gmail.com", "〇〇@gmail.com", "Gmailのパスワード")
  ->setFrom($from)
  ->addAddress($reply)
  ->setSubject($toSubject)
  ->setBody($toBody)
  ->send();

```

### HTMLメール

HTMLメールを利用する場合は以下のメソッドを利用します。

```
->isHTML(true)
```

### 添付ファイル

添付ファイルは以下のメソッドを使います。

```
->addAttachment(ファイルパス, ファイル名, エンコーディング, MIMEタイプ)
```

### CC, BCC

CC, BCCは以下。

```
->addCC(アドレス, 名前)
->addBCC(アドレス, 名前)
```

### 文字コード

文字コードを変更する場合は以下。デフォルトはUTF-8。

```
->setCharSet("ISO-8859-1")
```

### エンコード

エンコードを変更する場合は以下。デフォルトはbase64。

```
->setEncoding("8bit")
```

### SMTPデバッグモード

SMTPデバッグモードを利用したい場合は以下。

```
->setSMTPDebug(true)
```

## Install

composerを使って導入する。ちなみに、NPHPMailer導入時に最新版のPHPMailerが導入されるので、PHPMailerの記述はいらない。

composer.jsonに以下を記述。

```javascript
{
    "require": {
        "okutani-t/nphpmailer": "~1.0"
    }
}

```

composer installで導入。

```
$ composer install
```

あとは使いたい場所でrequire＆useしてあげればOK。

```php
<?php
require __DIR__ . "/vendor/autoload.php";
use OkutaniT\NPHPMailer;

// code...
```

## Contribution

バグを見つけた場合や追加実装をおこなう場合、以下の手順でプルリクエストを送ってください。

１. フォーク＆クローン

２. ブランチを切る

```
$ git checkout -b my-new-feature
```

３. 変更をコミット

```
$ git add .
$ git commit -m "修正内容"
```

４. テスト

```
$ composer test tests
```

なお、テスト内容は ```tests/``` 以下に記述してください。

５. プルリクエストを作成

## LICENCE

LGPL-2.1

## Author

[http://okutani.net](http://okutani.net)
