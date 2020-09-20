<?php
include_once 'SendingData.php';
class Newsletter implements SendingData
{
    private $email;
    private $user_name;
    /*записываем device */
    public function setDevice($device)
    {
        // TODO: Implement setDevice() method.
    }
    /*записываем email */
    public function setEmail($email){
        $this->email=$email;
    }
    /*записываем имя */
    public function setUserName($user_name){
        $this->user_name=$user_name;
    }
    /*генерируем нужное нам шаблон сообщения*/
    public function generatedMessageToSend()
    {
         return  "Email ".$this->email. " has been sent to user ".$this->user_name;
    }
    /*отправка сообщения*/
    public function send():void
    {
        echo $this->generatedMessageToSend();

    }
}