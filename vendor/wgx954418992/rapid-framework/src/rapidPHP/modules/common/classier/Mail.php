<?php

namespace rapidPHP\modules\common\classier;

use Exception;
use function rapidPHP\B;

class Mail
{
    /**
     * @var string 邮件传输代理用户名
     */
    protected $userName;

    /**
     * @var string 邮件传输代理密码
     */
    protected $password;

    /**
     * @var string 邮件传输代理服务器地址
     */
    protected $sendServer;

    /**
     * @var int 邮件传输代理服务器端口
     */
    protected $port;

    /**
     * @var string 发件人
     */
    protected $from;

    /**
     * @var array 收件人
     */
    protected $to = [];

    /**
     * @var array 抄送
     */
    protected $cc = [];

    /**
     * @var array 秘密抄送
     */
    protected $bcc = [];

    /**
     * @var string 主题
     */
    protected $subject;

    /**
     * @var string 邮件正文
     */
    protected $body;


    /**
     * @var array 附件
     */
    protected $attachment = [];


    /**
     * @var resource socket资源
     */
    protected $socket;

    /**
     * @var resource 是否是安全连接
     */
    protected $isSecurity;

    /**
     * @var string 错误信息
     */
    protected $errorMessage;

    /**
     * mime 类型
     * @var array
     */
    protected $mimeTypes = array(
        'txt' => 'text/plain',
        'htm' => 'text/html',
        'html' => 'text/html',
        'php' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'swf' => 'application/x-shockwave-flash',
        'flv' => 'videoView/x-flv',
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'ico' => 'image/vnd.microsoft.icon',
        'tiff' => 'image/tiff',
        'tif' => 'image/tiff',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'exe' => 'application/x-msdownload',
        'msi' => 'application/x-msdownload',
        'cab' => 'application/vnd.ms-cab-compressed',
        'mp3' => 'audio/mpeg',
        'qt' => 'videoView/quicktime',
        'mov' => 'videoView/quicktime',
        'pdf' => 'application/pdf',
        'psd' => 'image/vnd.adobe.photoshop',
        'ai' => 'application/postscript',
        'eps' => 'application/postscript',
        'ps' => 'application/postscript',
        'doc' => 'application/msword',
        'rtf' => 'application/rtf',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    );

    /**
     * 设置邮件传输代理，如果是可以匿名发送有邮件的服务器，只需传递代理服务器地址就行
     * @param string $server 代理服务器的ip或者域名
     * @param string $username 认证账号
     * @param string $password 认证密码
     * @param int $port 代理服务器的端口，smtp默认25号端口
     * @param boolean $isSecurity 到服务器的连接是否为安全连接，默认false
     */
    public function setServer(string $server, string $username = '', string $password = '', int $port = 25, bool $isSecurity = false)
    {
        $this->sendServer = $server;

        $this->port = $port;

        $this->isSecurity = $isSecurity;

        $this->userName = empty($username) ? '' : base64_encode($username);

        $this->password = empty($password) ? '' : base64_encode($password);
    }

    /**
     * 设置发件人
     * @param string $from 发件人地址
     */
    public function setFrom(string $from)
    {
        $this->from = $from;
    }


    /**
     * 设置收件人，多个收件人，连续调用多次.
     * @param string $to 收件人地址
     */
    public function setReceiver(string $to)
    {
        if (isset($this->to)) {
            if (is_string($this->to)) {
                $this->to = array($this->to);
                $this->to[] = $to;
            } else if (is_array($this->to)) {
                $this->to[] = $to;
            }
        } else {
            $this->to = $to;
        }

    }

    /**
     * 设置抄送，多个抄送，连续调用多次.
     * @param string $cc 抄送地址
     */
    public function setCc(string $cc)
    {
        if (isset($this->cc)) {
            if (is_string($this->cc)) {
                $this->cc = array($this->cc);
                $this->cc[] = $cc;
            } elseif (is_array($this->cc)) {
                $this->cc[] = $cc;
            }
        } else {
            $this->cc = $cc;
        }

    }

    /**
     * 设置秘密抄送，多个秘密抄送，连续调用多次
     * @param string $bcc 秘密抄送地址
     */
    public function setBcc(string $bcc)
    {
        if (isset($this->bcc)) {
            if (is_string($this->bcc)) {
                $this->bcc = array($this->bcc);
                $this->bcc[] = $bcc;
            } elseif (is_array($this->bcc)) {
                $this->bcc[] = $bcc;
            }
        } else {
            $this->bcc = $bcc;
        }

    }


    /**
     * 设置邮件信息
     * @access public
     * @param string $body 邮件主题
     * @param string $subject 邮件主体内容，可以是纯文本，也可是是HTML文本
     */
    public function setMail(string $subject, string $body)
    {
        $this->subject = base64_encode($subject);
        $this->body = base64_encode($body);

    }

    /**
     * 设置邮件附件，多个附件，调用多次
     * @param $file
     * @param string $name
     */
    public function addAttachment($file, string $name = '')
    {
        if (!file_exists($file)) {
            $this->errorMessage = "file " . $file . " does not exist.";
        } else {
            $this->attachment[] = array('file' => $file, 'name' => $name);
        }

    }


    /**
     * 发送邮件
     * @return boolean
     */
    public function sendMail(): bool
    {
        $command = $this->getCommand();
        if ($this->isSecurity ? $this->socketSecurity() : $this->socket()) {
            foreach ($command as $value) {
                $result = $this->isSecurity ? $this->sendCommandSecurity($value[0], $value[1]) : $this->sendCommand($value[0], $value[1]);
                if ($result) {
                    continue;
                } else {
                    return false;
                }
            }
            $this->isSecurity ? $this->closeSafety() : $this->close();
            return true;
        }
        return false;
    }

    /**
     * 返回错误信息
     * @return string
     */
    public function getError(): string
    {
        return $this->errorMessage;
    }

    /**
     * 返回mail命令
     * @return array
     */
    protected function getCommand(): array
    {
        $separator = "----=_Part_" . md5($this->from . time()) . uniqid();

        $command = array(
            array("HELO sendmail\r\n", 250)
        );
        if (!empty($this->userName)) {
            $command[] = array("AUTH LOGIN\r\n", 334);
            $command[] = array($this->userName . "\r\n", 334);
            $command[] = array($this->password . "\r\n", 235);
        }


        $command[] = array("MAIL FROM: <" . $this->from . ">\r\n", 250);
        $header = "FROM: <" . $this->from . ">\r\n";


        if (!empty($this->to)) {
            $count = count($this->to);
            if ($count == 1) {
                $command[] = array("RCPT TO: <" . $this->to[0] . ">\r\n", 250);
                $header .= "TO: <" . $this->to[0] . ">\r\n";
            } else {
                for ($i = 0; $i < $count; $i++) {
                    $command[] = array("RCPT TO: <" . $this->to[$i] . ">\r\n", 250);
                    if ($i == 0) {
                        $header .= "TO: <" . $this->to[$i] . ">";
                    } elseif ($i + 1 == $count) {
                        $header .= ",<" . $this->to[$i] . ">\r\n";
                    } else {
                        $header .= ",<" . $this->to[$i] . ">";
                    }
                }
            }
        }


        if (!empty($this->cc)) {
            $count = count($this->cc);
            if ($count == 1) {
                $command[] = array("RCPT TO: <" . $this->cc[0] . ">\r\n", 250);
                $header .= "CC: <" . $this->cc[0] . ">\r\n";
            } else {
                for ($i = 0; $i < $count; $i++) {
                    $command[] = array("RCPT TO: <" . $this->cc[$i] . ">\r\n", 250);
                    if ($i == 0) {
                        $header .= "CC: <" . $this->cc[$i] . ">";
                    } elseif ($i + 1 == $count) {
                        $header .= ",<" . $this->cc[$i] . ">\r\n";
                    } else {
                        $header .= ",<" . $this->cc[$i] . ">";
                    }
                }
            }
        }


        if (!empty($this->bcc)) {
            $count = count($this->bcc);
            if ($count == 1) {
                $command[] = array("RCPT TO: <" . $this->bcc[0] . ">\r\n", 250);
                $header .= "BCC: <" . $this->bcc[0] . ">\r\n";
            } else {
                for ($i = 0; $i < $count; $i++) {
                    $command[] = array("RCPT TO: <" . $this->bcc[$i] . ">\r\n", 250);
                    if ($i == 0) {
                        $header .= "BCC: <" . $this->bcc[$i] . ">";
                    } elseif ($i + 1 == $count) {
                        $header .= ",<" . $this->bcc[$i] . ">\r\n";
                    } else {
                        $header .= ",<" . $this->bcc[$i] . ">";
                    }
                }
            }
        }


        $header .= "Subject: =?UTF-8?B?" . $this->subject . "?=\r\n";
        if (isset($this->attachment)) {
            $header .= "Content-Type: multipart/mixed;\r\n";
        } else {
            $header .= "Content-Type: multipart/alternative;\r\n";
        }

        $header .= "\t" . 'boundary="' . $separator . '"';

        $header .= "\r\nMIME-Version: 1.0\r\n";

        $header .= "\r\n--" . $separator . "\r\n";
        $header .= "Content-Type:text/html; charset=utf-8\r\n";
        $header .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $header .= $this->body . "\r\n";
        $header .= "--" . $separator . "\r\n";

        if (!empty($this->attachment)) {
            foreach ($this->attachment as $value) {
                $file = B()->getData($value, 'file');
                $name = B()->getData($value, 'name');
                if (!$name) {
                    $fileInfo = Path::getInstance()->getPathInfo($file);
                    $name = B()->getData($fileInfo, 'filename');
                }
                $header .= "\r\n--" . $separator . "\r\n";
                $header .= "Content-Type: " . $this->getMIMEType($file) . '; name="=?UTF-8?B?' . base64_encode(basename($name)) . '?="' . "\r\n";
                $header .= "Content-Transfer-Encoding: base64\r\n";
                $header .= 'Content-Disposition: attachment; filename="=?UTF-8?B?' . base64_encode(basename($name)) . '?="' . "\r\n";
                $header .= "\r\n";
                $header .= $this->readFile($file);
                $header .= "\r\n--" . $separator . "\r\n";
            }
        }

        $header .= "\r\n.\r\n";

        $command[] = array("DATA\r\n", 354);
        $command[] = array($header, 250);
        $command[] = array("QUIT\r\n", 221);

        return $command;
    }

    /**
     * 发送命令
     * @param string $command 发送到服务器的smtp命令
     * @param int $code 期望服务器返回的响应吗
     * @return bool
     */
    protected function sendCommand(string $command, int $code): bool
    {
        if (!empty($code)) {
            try {
                if (socket_write($this->socket, $command, strlen($command))) {
                    if ($data = trim(socket_read($this->socket, 1024))) {
                        $pattern = "/^" . $code . "+?/";
                        if (preg_match($pattern, $data)) {
                            return true;
                        } else {
                            $this->errorMessage = "Error:" . $data . "|**| command:";
                            return false;
                        }
                    } else {
                        $this->errorMessage = "Error:" . socket_strerror(socket_last_error());
                        return false;
                    }
                } else {
                    $this->errorMessage = "Error:" . socket_strerror(socket_last_error());
                    return false;
                }
            } catch (Exception $e) {
                $this->errorMessage = "Error:" . $e->getMessage();
            }
        }
        return false;
    }

    /**
     * 安全连接发送命令
     * @param string $command 发送到服务器的smtp命令
     * @param int $code 期望服务器返回的响应吗
     * @return boolean
     */
    protected function sendCommandSecurity(string $command, int $code): bool
    {
        if (!empty($code)) {
            try {
                if (fwrite($this->socket, $command)) {
                    if ($data = trim(fread($this->socket, 1024))) {
                        $pattern = "/^" . $code . "+?/";
                        if (preg_match($pattern, $data)) {
                            return true;
                        } else {
                            $this->errorMessage = "Error:" . $data . "|**| command:";
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    $this->errorMessage = "Error: " . $command . " send failed";
                    return false;
                }
            } catch (Exception $e) {
                $this->errorMessage = "Error:" . $e->getMessage();
            }
        }
        return false;
    }

    /**
     * 读取附件文件内容，返回base64编码后的文件内容
     * @param string $file 文件
     * @return false|string
     */
    protected function readFile(string $file)
    {
        if (file_exists($file)) {
            $fileObj = file_get_contents($file);
            return base64_encode($fileObj);
        } else {
            $this->errorMessage = "file " . $file . " dose not exist";
            return false;
        }
    }


    /**
     * 获取文件类型
     * @param $file
     * @return false|string
     */
    protected function getMimeContentType($file)
    {
        if (function_exists('mime_content_type')) {
            return mime_content_type($file);
        } elseif (function_exists('finfo_open')) {
            $info = finfo_open(FILEINFO_MIME);

            $mimetype = finfo_file($info, $file);

            finfo_close($info);

            return $mimetype;
        } else {
            return 'application/octet-stream';
        }
    }

    /**
     * 获取附件MIME类型
     * @param string $file 文件
     * @return false|string
     */
    protected function getMIMEType(string $file)
    {
        if (file_exists($file)) {
            return $this->getMimeContentType($file);
        } else {
            return false;
        }
    }

    /**
     * 建立到服务器的网络连接
     * @return boolean
     */
    protected function socket(): bool
    {
        if (!$this->socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'))) {
            $this->errorMessage = socket_strerror(socket_last_error());
        } else {
            socket_set_block($this->socket);

            if (!socket_connect($this->socket, $this->sendServer, $this->port)) {
                $this->errorMessage = socket_strerror(socket_last_error());
            } else {
                $str = socket_read($this->socket, 1024);

                if (!preg_match("/220+?/", $str)) {
                    $this->errorMessage = $str;
                } else {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 建立到服务器的SSL网络连接
     * @return boolean
     */
    protected function socketSecurity(): bool
    {
        $address = "tcp://" . $this->sendServer . ":" . $this->port;

        if (!$this->socket = stream_socket_client($address, $errorOn, $error, 30)) {
            $this->errorMessage = $error;
        } else {
            stream_socket_enable_crypto($this->socket, true, STREAM_CRYPTO_METHOD_SSLv23_CLIENT);

            stream_set_blocking($this->socket, 1);

            $str = fread($this->socket, 1024);

            if (!preg_match("/220+?/", $str)) {
                $this->errorMessage = $str;
            } else {
                return true;
            }
        }
        return false;
    }

    /**
     * 关闭socket
     * @return boolean
     */
    protected function close(): bool
    {
        if (isset($this->socket) && is_object($this->socket)) {
            socket_close($this->socket);
            return true;
        } else {
            $this->errorMessage = "No resource can to be close";
        }
        return false;
    }

    /**
     * 关闭安全socket
     * @return boolean
     */
    protected function closeSafety(): bool
    {
        if (isset($this->socket) && is_resource($this->socket)) {
            stream_socket_shutdown($this->socket, STREAM_SHUT_WR);
            return true;
        } else {
            $this->errorMessage = "No resource can to be close";
        }
        return false;
    }
}

