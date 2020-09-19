<?php

/**
    Необходимо доработать класс рассылки Newsletter, что бы он отправлял письма
    и пуш нотификации для юзеров из UserRepository.

    За отправку имейла мы считаем вывод в консоль строки: "Email {email} has been sent to user {name}"
    За отправку пуш нотификации: "Push notification has been sent to user {name} with device_id {device_id}"

    Так же необходимо реализовать функциональность для валидации имейлов/пушей:
    1) Нельзя отправлять письма юзерам с невалидными имейлами
    2) Нельзя отправлять пуши юзерам с невалидными device_id. Правила валидации можете придумать сами.
    3) Ничего не отправляем юзерам у которых нет имен
    4) На одно и то же мыло/device_id - можно отправить письмо/пуш только один раз

    Для обеспечения возможности масштабирования системы (добавление новых типов отправок и новых валидаторов),
    можно добавлять и использовать новые классы и другие языковые конструкции php в любом количестве
*/

include_once 'UserRepository.php';
include_once 'Validation.php';
include_once 'Newsletter.php';
include_once 'Notification.php';

/**
Тут релизовать получение объекта(ов) рассылки Newsletter и вызов(ы) метода send()
$newsletter = //... TODO
$newsletter->send();
...
 */
session_start();
/*входной класс юзера с его данными */
$users = new UserRepository();

/*класс которы будет отвечать за всю валидацию данных*/
$Validation =new Validation();

$Newsletter = new Newsletter();

$Notification = new Notification();

function checkSendWeMassage($name,$value){
    $data=$_SESSION[$name];
    foreach ($data as  $item){
        if ($item == $value){
            return  true;
        }

    }
}

$user =$users->getUsers();
foreach ($user as  $value ){

    if ( $Validation->ValidationEmail($value['email'])&&  $Validation->ValidationUserName($value['name']) ) {

       $check= checkSendWeMassage('send_email',$value['email']);
        if ($check!=true){
           $_SESSION["send_email"][]=$value['email'];
           $Newsletter->setEmail($value['email']);
           $Newsletter->setUserName($value['name']);
           $Newsletter->send();
       }

    }

    if ( $Validation->ValidationDevice($value['device_id'])&&  $Validation->ValidationUserName($value['name']) ) {
        $check= checkSendWeMassage('send_notification',$value['email']);
        if ($check!=true){
            $_SESSION["send_notification"][]=$value['email'];
            $Notification->setDevice($value['device_id']);
            $Notification->setUserName($value['name']);
            $Notification->send();
        }
    }

}
