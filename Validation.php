<?php


class Validation
{

    /* регулярное выражение на email*/
    private  $reg_email = "/^([a-zA-Z0-9_\.-]+)@([a-zA-Z0-9_\.-]+)\.([a-zA-Z\.]{2,6})$/";
    /* регулярное выражение на имя*/
    private  $reg_user_name = "/^[a-zA_Z]{2,20}$/i";
    /* регулярное выражение на device*/
    // private  $reg_device = "/^[a-zA_Z0-9]{8}[-]{1}[a-zA-Z0-9]{4}[-]{1}[a-zA-Z0-9]{4}[-]{1}[a-zA-Z0-9]{4}[-]{1}[a-zA-Z0-9]{12}$/i";
    /*example
                '97987bca-ae59-4c7d-94ba-ee4f19ab8c21';
                '6D92078A-8246-4BA4-AE5B-76104861E7DC';
                'fcb2a29c-315a-5e6b-bcfd-d889ba19aada';
    */
    /* регулярное выражение на device*/
    private  $reg_device = "/^[a-zA_Z0-9]{10}$/i";

    /**
     * валидация емейла с помощью регулярного выражения
     */
    public function ValidationEmail($email){

        if (!preg_match($this->reg_email, ($email))) {
            return false;
        }else{
            return true;
        }

    }

    /**
     * Валидация имени.
     * Имя должно быть из английских букв.
     * Длинной от 2 до 20 символов.
     * И в любом регистре
     */
    public function ValidationUserName($user_name){

        if (!preg_match($this->reg_user_name, ($user_name))) {
            return false;
        }else{
            return true;
        }

    }
    /**
     * Валидация device.
     * должно иметь 10 символов из английских букв.
     * возможны цифры  а также заглавные буквы в любом количестве
     */
    public function ValidationDevice($device){
        if (!preg_match($this->reg_device, ($device))) {
            return false;
        }else{
            return true;
        }

    }

}