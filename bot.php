<?php
ob_start();
include "lib.php";

//Bot Token
define('API_KEY', 'ENTER_YOUR_BOT_TOKEN');
//!Bot Admin Id
$admin = "ENTER_YOUR_TELEGRAM_USERID";
function bot($method, $datas = [])
{
	$url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
	$res = curl_exec($ch);var_dump($res);


	if (curl_error($ch)) {
		var_dump(curl_error($ch));
	} else {
		return json_decode($res);
	}
}

$replyc = json_encode([
	'resize_keyboard' => false,
	'force_reply' => true,
	'selective' => true
]);

$update = json_decode(file_get_contents('php://input'));
$efede = json_decode(file_get_contents('php://input'), true);
$message = $update->message;

//text
$text = $message->text;
	//JOIN : @ANUJ_BOTS
//user
$fname = $update->message->from->first_name;
$lname = $update->message->from->last_name;
$ulogin = $update->message->from->username;
$user_id = $update->message->from->id;

$come = file_get_contents("https://api.telegram.org/bot" . API_KEY . "/getMe");
$deco = json_decode($come, true);
$botid = $deco["result"]["id"];
$botusername = $deco["result"]["username"];
//Coded By Arman idrisi
if ($text == "/start") { if(file_exists("admin/users/$user_id.json")){}else{
    Message($admin,"<b>🚀 New User Joined The Bot\n\nUser Id : $user_id\n\nFirst Name: $fname\n\nLast name: $lname</b>");
file_put_contents("admin/users/$user_id.json","");
  $hi=file_get_contents("admin/total.txt");
  if(!$hi){

file_put_contents("admin/total.txt",1);
  }else{
    file_put_contents("admin/total.txt",$hi+1);
  }
}
 $mess="<b>😀 Hey $fname Welcome To the @$botusername\n\nBot Created By : @ANUJ_FF_ID_SELLER</b>";                      keyboard($user_id,$mess, [[["text"=>"🚀 My Email"]],[["text"=>"📧 Generate New Email"],["text"=>"📨 Inbox"]],[["text"=>"📊  Status"]]]);
}
  if($text=='📧 Generate New Email'){

$url = "https://api.internal.temp-mail.io/api/v3/email/new";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = '{"min_name_length":10,"max_name_length":10}';

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
   $em=json_decode($resp,1);
    $email=$em['email'];
Message($user_id,"<b>Your Email Successfully Generated \n$email</b>");
$js='{"email":"'.$email.'"}'; file_put_contents("admin/mail$user_id.json",$js);
    $h=file_get_contents("admin/mail.txt");
    file_put_contents("admin/mail.txt",$h+1);
curl_close($curl);
  }
    if($text=='🚀 My Email'){
      $file="admin/mail$user_id.json";
      if(file_exists($file)){
$mail=json_decode(file_get_contents ($file),1)['email'];
        Message($user_id,"<b>Your Email Is \n\n$mail</b>");

    }else{
        Message($user_id,"<b>❌️ No Email created</b>");
    }
    }
if($text=='📨 Inbox'){
  $file="admin/mail$user_id.json";
      if(file_exists($file)){
        $mail=json_decode(file_get_contents ($file),1)['email'];
        $filee=file_get_contents("https://api.internal.temp-mail.io/api/v3/email/$mail/messages");
$f=strlen($filee);
        if($f < 8){
          Message($user_id,"❌️ No Mail Received");
        }else{
       $js=json_decode($filee);
        foreach($js as $data){
        $id = $data->id;
        $from=$data->from;
        $subject=$data->subject;
        $body=$data->body_text;
        Message($user_id,"<b>Mail Received\n\nId: $id\n\nSubject: $subject\n\nText: $body</b>");

        }
        }
      }else{
        Message($user_id,"<b>⛔️ Please Generate an email first</b>");
}
}
  if($text=="📊  Status"){
    $tmail=file_get_contents ("admin/mail.txt");
$usr=file_get_contents ("admin/total.txt");
//Created By Arman Idrisi
    $img="https://quickchart.io/chart?bkg=white&c={type:%27bar%27,data:{labels:[''],datasets:[{label:%27Total-Users%27,data:[$usr]},{label:%27Total-Mail Created%27,data:[$tmail]}]}}";
    photo($user_id, $img,"📊 Bot Live Stats 📊\n\n⚙ Total Email Generated : $tmail
\n✅️ Total Users : $usr\n\n🔥 By: @ANUJ_BOTS");
  }
?>