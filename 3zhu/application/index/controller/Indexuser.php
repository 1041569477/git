<?php
/**
 * 用户中心
 * 2017-8-23 21:22:22  吕书径
 */
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\index\model\User;
use Illuminate\Contracts\Mail;

class Indexuser extends \think\Controller
{

    /*
     * 用户信息展示
     * 2017-8-23 22:06:18  吕书径
     */
    public function index()
    {
        $indexuser = new \app\index\model\IndexUser();
        $list = $indexuser->userinfo_list();
        return view('user_list',['list'=>$list]);
    }
    /*
     * 用户信息详情展示
     * 2017-8-23 22:06:18  吕书径
     */
    public function details()
    {
        $userid = Request::instance()->get('userid');
        $indexuser = new \app\index\model\IndexUser();
        $details = $indexuser->userinfo_details($userid);
        //print_r($details);die;
        return view('details',['details'=>$details]);
    }
    /*
     * 未认证列表展示
     * 2017-8-24 16:29:53  吕书径
     */
    public function authstatus()
    {
        $indexuser = new \app\index\model\IndexUser();
        $authstatus = $indexuser->userinfo_authstatus();
        return view('authstatus',['list'=>$authstatus]);
    }
    /*
     * 邮箱提示
     * 2017-8-24 16:29:53  吕书径
     */
    public function email()
    {
        $email = Request::instance()->post('email');
        $name='RRD';
        $subject='【RRD】提醒您';
        $content='赶紧滚过来实名认证。';
        echo $this->send_mail($email,$name,$subject,$content);

    }
    /*
     * 站内信提示
     * 2017-8-24 16:29:53  吕书径
     */
    public function message()
    {
        $data['userid'] = Request::instance()->post('userid');
        $data['message_time'] = time();
        $indexuser = new \app\index\model\IndexUser();
        $data['content'] = '请实名认证后享受本产品的服务';
        $data['title'] = '请实名认证';
        $message = $indexuser->message($data);
        if($message){
            echo 1;
        }else{
            echo 2;
        }
    }
    /*
     * 短信提示
     * 2017-8-24 16:29:53  吕书径
     */
    public function code()
    {

        $phone = Request::instance()->post('tel');

        $this->code_pro($phone);
        echo 1;
    }
    /*
     * 短信接口
     * 2017-8-24 16:29:53  吕书径
     */
    public function code_pro($tel)
    {
        $rand='RRD提醒您,实名认证后可使用平台的理财功能';
        $url="http://api.k780.com/?app=sms.sendu&app=sms.send&tempid=51107&param=code%3d$rand&phone=$tel&appkey=23375&sign=2fa28dd5888f5e0622fd2b0732ee392e&format=json";

        file_get_contents($url);

        return $rand;
    }
    /**
     * 系统邮件发送函数
     * @param string $tomail 接收邮件者邮箱
     * @param string $name 接收邮件者名称
     * @param string $subject 邮件主题
     * @param string $body 邮件内容
     * @param string $attachment 附件列表
     * @return boolean
     * @author static7 <static7@qq.com>
     */
    function send_mail($tomail, $name, $subject = '', $body = '', $attachment = null) {
        $mail = new \PHPMailer();           //实例化PHPMailer对象
        $mail->CharSet = 'UTF-8';           //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
        $mail->IsSMTP();                    // 设定使用SMTP服务
        $mail->SMTPDebug = 0;               // SMTP调试功能 0=关闭 1 = 错误和消息 2 = 消息
        $mail->SMTPAuth = true;             // 启用 SMTP 验证功能
        $mail->SMTPSecure = 'ssl';          // 使用安全协议
        $mail->Host = "smtp.qq.com"; // SMTP 服务器
        $mail->Port = 465;                  // SMTP服务器的端口号
        $mail->Username = "353586258@qq.com";    // SMTP服务器用户名
        $mail->Password = "bjrjvkmrfqzcbifd";     // SMTP服务器密码
        $mail->SetFrom('353586258@qq.com', 'RRD客服');
        $replyEmail = '';                   //留空则为发件人EMAIL
        $replyName = '';                    //回复名称（留空则为发件人名称）
        $mail->AddReplyTo($replyEmail, $replyName);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($tomail, $name);
        if (is_array($attachment)) { // 添加附件
            foreach ($attachment as $file) {
                is_file($file) && $mail->AddAttachment($file);
            }
        }
        return $mail->Send() ? true : $mail->ErrorInfo;
    }
}
