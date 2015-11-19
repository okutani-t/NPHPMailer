<?php
/**
 * PHPMailerを日本語用に拡張するラッパークラス
 *
 * @author okutani
 * @package PHPMailer
 */
// PHPMailer読み込み
require_once './PHPMailer/PHPMailerAutoload.php';

class NPHPMailer extends PHPMailer
{
    function __construct()
    {
        parent::__construct();

        // タイムゾーン設定
        date_default_timezone_set('Asia/Tokyo');

        // 文字エンコーディングの設定
        $this->CharSet  = "UTF-8";    // 文字セット(デフォルトは'ISO-8859-1')
        $this->Encoding = "base64";  // エンコーディング(デフォルトは'8bit')
    }

    /**
     * 自身のインスタンスを生成
     *
     * @access public
     * @return object new self
     */
    public static function _()
    {
        return new self;
    }

    /**
     * SMTP情報のセッター
     *
     * @access public
     * @param string $host SMTPのホスト名 Gmail->'smtp.gmail.com'
     * @param string $usrName ユーザー名 Gmail->'〇〇@gmail.com'
     * @param string $pass パスワード
     * @param string $type 通信方法 ssl|tls
     * @param int    $port ポート番号
     * @return object $this
     */
    public function setSMTP($host, $usrName, $pass, $type='tls', $port=587)
    {
        $this->isSMTP();
        $this->Host = $host;
        $this->SMTPAuth = true;
        $this->Username = $usrName;
        $this->Password = $pass;
        $this->SMTPSecure = $type;
        $this->Port = $port;

        return $this;
    }

    /**
     * 差出人のセッター
     *
     * @access public
     * @param string $from
     * @param string $name
     * @return object $this
     */
    public function setForm($from, $name="")
    {
        parent::setFrom($from, $name);

        return $this;
    }

    /**
     * 送信先アドレスのセッター
     *
     * @access public
     * @param string|array $to
     * @param string $name
     * @return object $this
     */
    public function addAddress($to, $name="")
    {
        // 配列なら$nameを無視してforeachでセット
        if (is_array($to)) {
            foreach ($to as $value) {
                parent::addAddress($value);
            }
        } else {
            parent::addAddress($to, $name);
        }

        return $this;
    }

    /**
     * 返信先のセッター
     *
     * @access public
     * @param string $reply
     * @param string $name
     * @return object $this
     */
    public function addReplyTo($reply, $name="")
    {
        parent::addReplyTo($reply, $name);

        return $this;
    }

    /**
     * CCのセッター
     *
     * @access public
     * @param string $cc
     * @return object $this
     */
    public function addCC($cc)
    {
        parent::addCC($cc);

        return $this;
    }

    /**
     * BCCのセッター
     *
     * @access public
     * @param string $cc
     * @return object $this
     */
    public function addBCC($bcc)
    {
        parent::addBCC($bcc);

        return $this;
    }

    /**
     * ファイルの添付
     *
     * @access public
     * @param string $src
     * @param string $name
     * @return object $this
     */
    public function addAttachment($src, $name="")
    {
        parent::addAttachment($src, $name);

        return $this;
    }

    /**
     * HTMLメールにするかどうか
     *
     * @access public
     * @param bool $isHTML
     * @return object $this
     */
    public function isHTML($isHTML=true)
    {
        parent::isHTML($isHTML);

        return $this;
    }

    /**
     * 件名のセッター
     *
     * @access public
     * @param string $subject
     * @return object $this
     */
    public function setSubject($subject="")
    {
        $this->Subject = $subject;

        return $this;
    }

    /**
     * 本文のセッター(HTML)
     *
     * @access public
     * @param string $body
     * @return object $this
     */
    public function setBody($body="")
    {
        $this->Body = $body;

        return $this;
    }

    /**
     * 本文のセッター(non-HTML)
     *
     * @access public
     * @param string $body
     * @return object $this
     */
    public function setAltBody($body="")
    {
        $this->AltBody = $body;

        return $this;
    }

    /**
     * 送信
     *
     * @access public
     */
    public function send()
    {
        if(!parent::send()) {
            trigger_error('Mailer Error: ' . $this->ErrorInfo, E_USER_NOTICE);
        }
    }

}
