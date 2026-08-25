<?php

namespace App;

enum RoleEnum :string
{
    //
    case Admin='admin';
    case User='user';
    case ResturantManager='resturant_manager';
    public static function values(){
        return array_column(self::cases(),'value');
    }
    public function getColor():string{
        return match($this){
            self::Admin=>'danger',
            self::User=>'success',
            self::ResturantManager=>'warning',
        };

    }
}
