<?php


class SMSNotification{
    // private $id = "ACa418868e26c5239d998cc142b06a6535";
    private $id = "ACdf0a2c4b3dc3c7fd662d06760218f214";
    // private $token = "9e218b54ab0d266a088d9ce53cdb483c";
    private $token = "a86fa9dc87022532110691f1f00d3085";
    // private $from = "+15169733287";
    private $from = "+15642346501";
    
    // $body = text message content
    // $to = mobile number where sms will be sent
    // 
    public function send($body='' , $to ){
        $url = "https://api.twilio.com/2010-04-01/Accounts/$this->id/Messages.json";
        $data = array (
            'From' => $this->from,
            'To' => $to,
            'Body' => $body,
        );
        $post = http_build_query($data);
        $x = curl_init($url );
        curl_setopt($x, CURLOPT_POST, true);
        curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($x, CURLOPT_USERPWD, "$this->id:$this->token");
        curl_setopt($x, CURLOPT_POSTFIELDS, $post);
        $y = curl_exec($x);
        curl_close($x);
        return($y);
    }

}

// $smsnotif = new SMSNotification();
// $sent = json_decode($smsnotif->send('IKAW NA SUNOD.',"+639151525672"));
// json_decode($smsnotif->send('testing',"+639151525672"));
// $sent = json_decode($smsnotif->send('IKAW NA SUNOD.',"+639265305143"));
// json_decode($smsnotif->send('testing',"+639265305143"));
// if($sent->error_message != NULL){
//     echo 'an error has occured sending sms';
// }else{
//     echo 'sms sent success';
// }