<?php
namespace OkutaniT\Tests;
use OkutaniT\NPHPMailer;

class NPHPMailerTest extends \PHPUnit_Framework_TestCase {

    public function setUp()
    {
        $this->from      = "noreply@example.com";
        $this->to        = [
            "myaddress@example.com"
        ];
        $this->reply     = "youraddress@example.com";

        $this->mySubject = "お問い合わせがありました";
        $this->myBody    = "テストメール";

        $this->toSubject = "[自動返信]お問い合わせありがとうございます";
        $this->toBody    = "以下の内容でメールを送信しました。\n\n" .
            "テストメール\n\n" .
            "今後ともよろしくお願いいたします。";

        $this->filepath = dirname(__DIR__) . "../../testimg.png";
    }

    public function testSimpleSend()
    {
        // 自分宛
        NPHPMailer::_()
            ->setFrom($this->from)
            ->addAddress($this->to)
            ->setSubject($this->mySubject)
            ->setBody($this->myBody)
            ->send();

        // 相手宛(自動返信用)
        NPHPMailer::_()
            ->setFrom($this->from)
            ->addAddress($this->reply)
            ->setSubject($this->toSubject)
            ->setBody($this->toBody)
            ->send();
    }

    public function testAttachImageSend()
    {
        NPHPMailer::_()
            ->setFrom($this->from)
            ->addAddress($this->to)
            ->setSubject($this->mySubject)
            ->setBody($this->myBody)
            ->addAttachment($this->filepath, "testimg.png")
            ->send();
    }

}
