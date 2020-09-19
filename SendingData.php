<?php

interface SendingData
{

    public function setUserName($user_name);
    public function setEmail($email);
    public function setDevice($device);
    public function generatedMessageToSend();
    public function send():void;
}