<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

require("class.phpmailer.php");
$mail = new PHPMailer();
$address = "707207845@qq.com";
$mail->IsSMTP();
// 使用SMTP方式发送
$mail->Host = "smtp.163.com";
// 您的企业邮局域名
$mail->SMTPAuth = true;
// 启用SMTP验证功能
$mail->Username = "lenush@163.com";
// 邮局用户名(请填写完整的email地址)
$mail->Password = "****";
// 邮局密码
$mail->Port = 25;
$mail->From = "lenush@163.com";
//邮件发送者email地址
$mail->FromName = "lenush";
$mail->AddAddress("$address", "a");
//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
$mail->IsHTML(true);
//是否使用HTML格式
$mail->Subject = "PHPMailer测试邮件";
//邮件标题
$mail->Body = "<font color='blue'>Hello</font>,这是测试邮件";
//邮件内容
$mail->AltBody = "This is <font color='blue'>the</font> body in plain text for non-HTML mail clients"; //附加信息，可以省略
if (!$mail->Send()) {
    echo "邮件发送失败. <p>";
    echo "错误原因: " . $mail->ErrorInfo;
    exit;
}
echo "邮件发送成功";

/**
* // +----------------------------------------------------------------------------
* // | @ Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
* // +----------------------------------------------------------------------------
* // | @ author: lenush <jnicklasj@gmail.com> qq:707207845
* // +----------------------------------------------------------------------------
* Local variables:
* tab-width:4
* basic-offset:4
* indent-tabs-mode:t
* End:
*/