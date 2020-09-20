<?php
include_once 'SendingData.php';
class Notification implements SendingData
{
    private $device;
    private $user_name;
    /*записываем device */
    public function setDevice($device)
    {
        $this->device=$device;
    }
    /*записываем email */
    public function setEmail($email)
    {

        // TODO: Implement setEmail() method.
    }
    /*записываем имя */
    public function setUserName($user_name)
    {
     $this->user_name=$user_name;
        // TODO: Implement setName() method.
    }
    /*генерируем нужное нам шаблон сообщения*/
    public function generatedMessageToSend()
    {
        return  "Push notification has been sent to user ".$this->user_name." with device_id ".$this->device;
    }
    /*отправка сообщения*/
    public  function send():void {
        echo $this->generatedMessageToSend();

    }
}