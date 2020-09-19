<?php
include_once 'SendingData.php';
class Notification implements SendingData
{
    private $device;
    private $user_name;

    public function setDevice($device)
    {
        $this->device=$device;
    }

    public function setEmail($email)
    {

        // TODO: Implement setEmail() method.
    }

    public function setUserName($user_name)
    {
     $this->user_name=$user_name;
        // TODO: Implement setName() method.
    }
    public function generatedMessageToSend()
    {
        return  "Push notification has been sent to user ".$this->user_name." with device_id ".$this->device;
    }

    public  function send():void {
        echo $this->generatedMessageToSend();

    }
}