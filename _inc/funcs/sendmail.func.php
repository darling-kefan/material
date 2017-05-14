<?php
/**
 * 该文件定义了phpmailer发送邮件函数
 */
if(!defined('MATERIAL')){
	exit('Include Permission Denied!');
}
/**
 * 使用phpmailer发送邮件
 * @param strint $sendto_email  email地址
 * @param string $subject       邮件标题
 * @param string $body          邮件内容
 * @return bool
 */
function sendmail( $sendto_email, $subject, $body )
{
    //包含phpmailer类库
	include_once(ROOT_PATH.'/_inc/_libs/PHPMailer_v5.1/class.phpmailer.php');
	include_once(ROOT_PATH.'/_inc/_libs/PHPMailer_v5.1/class.smtp.php');
	$mail = new PHPMailer();
    //服务器类型
	$mail->Mailer = "smtp";
	//设置SMTP服务器
	$mail->Host	= 'smtp.163.com';	
	// 设置SMTP端口
	$mail->Port	= 25;	
    // 设置服务器前缀tls,ssl
	//$mail->SMTPSecure	=	"ssl";	
    // 开启SMTP验证
	$mail->SMTPAuth = true;						 
	// SMTP 账号
	$mail->Username = 'hrbobo123@163.com';	 
	//SMTP 密码
	$mail->Password = 'mowenwei'; 
    //发件人姓名
	$mail->FromName	= '物联网开放式平台';  
	// 发件人邮箱
	$mail->From		= 'hrbobo123@163.com'; 
    //这里指定字符集
	$mail->CharSet	= "UTF-8"; 
	$mail->Encoding	= "base64";

    //发送到的地址
	$mail->AddAddress($sendto_email); 		

	//以HTML方式发送
	$mail->IsHTML(true); // 以HTML格式发送邮件
	// 邮件主题
	$mail->Subject	 = $subject;
	// 邮件内容
	$mail->Body		 =	$body;
	$mail->AltBody	 =	"text/html";
	$mail->SMTPDebug =	false;
	return $mail->Send();
}
?>