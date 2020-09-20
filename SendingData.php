<?php
/*интерфейс который будет служить для расширения своего приложения в формате отправки сообщения еще на нужное нам сутройство */
interface SendingData
{
    /*метод для записи имени*/
    public function setUserName($user_name);
    /*метод для записи email*/
    public function setEmail($email);
    /*метод для записи device*/
    public function setDevice($device);
    /*метод для генерации нужного нам шаблона сообщения*/
    public function generatedMessageToSend();
    /*метод для отпраки сообщения*/
    public function send():void;
}