<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

final class Gospel_Service {

    /**
     * 邮件发送
     * @param type $mailtitle
     * @param type $mailcontent
     * @param type $getmailer
     * @return boolean 
     */
    public static function sendMail($mailtitle, $mailcontent, $getmailer) {
        include 'Gospel/Plugins/Mail/class.phpmailer.php';
        $mailer = new PHPMailer();
        $address = $getmailer;
        $mailer->IsSMTP();
        // 使用SMTP方式发送
        $mailer->Host = "smtp.exmail.qq.com";
        // 您的企业邮局域名
        $mailer->SMTPAuth = true;
        // 启用SMTP验证功能
        $mailer->Username = "webmaster@klsiol.com";
        // 邮局用户名(请填写完整的email地址)
        $mailer->Password = "klsiol_2012";
        // 邮局密码
        $mailer->Port = 25;
        $mailer->From = "webmaster@klsiol.com";
        //邮件发送者email地址
        $mailer->FromName = "凯勒斯网络";
        $mailer->AddAddress("$address", "a");
        $mailer->IsHTML(true);
        //是否使用HTML格式
        $mailer->Subject = $mailtitle;
        //邮件标题
        $mailer->Body = $mailcontent;
        //邮件内容
        $mailer->AltBody = "This is <font color='blue'>the</font> body in plain text for non-HTML mail clients"; //附加信息，可以省略
        if ($mailer->Send()) {
            return true;
        } else {
            return false;
        }
    }
    

}

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
