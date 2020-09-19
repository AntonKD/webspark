<?php
include_once 'SendingData.php';
class Newsletter implements SendingData
{
    private $email;
    private $user_name;

    public function setDevice($device)
    {
        // TODO: Implement setDevice() method.
    }
    public function setEmail($email){
        $this->email=$email;
    }

    public function setUserName($user_name){
        $this->user_name=$user_name;
    }
    public function generatedMessageToSend()
    {
         return  "Email ".$this->email. " has been sent to user ".$this->user_name;
    }

    public function send():void
    {
        echo $this->generatedMessageToSend();

    }
}