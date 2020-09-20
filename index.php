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

/*подключаем наши классы*/
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
/*Объявляем о начале сессии */
session_start();
/*входной класс юзера с его данными */
$users = new UserRepository();

/*класс который будет отвечать за всю валидацию данных*/
$Validation =new Validation();
/*класс отвечающий за отправку сообщения на емейл */
$Newsletter = new Newsletter();
/*класс отвечающий за отправку сообщения по натификации */
$Notification = new Notification();

/*проверяем через сессию отправляли ли мы сообщение */
function checkSendWeMassage($name,$value){
    $data=$_SESSION[$name];
    if($data!=null){
        foreach ($data as  $item){
            if ($item == $value){
                return  true;
            }

        }
    }

}
/*берем всех наших пользователей */
$user =$users->getUsers();
foreach ($user as  $value ){

    /*проверка  на валидность емейн и имя */
    if ( $Validation->ValidationEmail($value['email'])&&  $Validation->ValidationUserName($value['name']) ) {
        /*проверяем через сессию отправляли ли мы сообщение */
       $check= checkSendWeMassage('send_email',$value['email']);
        if ($check!=true){
            /*записываем в сессию email на который прислали сообщение */
           $_SESSION["send_email"][]=$value['email'];
            /*записываем имя и email для отправки  сообщения */
           $Newsletter->setEmail($value['email']);
           $Newsletter->setUserName($value['name']);
           $Newsletter->send();
       }

    }
    /*проверка  на валидность device_id и имя */
    if ( $Validation->ValidationDevice($value['device_id'])&&  $Validation->ValidationUserName($value['name']) ) {
        /*проверяем через сессию отправляли ли мы сообщение */
        $check= checkSendWeMassage('send_notification',$value['device_id']);
        if ($check!=true){
            /*записываем в сессию device id на который прислали сообщение */
            $_SESSION["send_notification"][]=$value['device_id'];
           /*записываем имя и device_id для отправки  сообщения */
            $Notification->setDevice($value['device_id']);
            $Notification->setUserName($value['name']);
            $Notification->send();
        }
    }

}
