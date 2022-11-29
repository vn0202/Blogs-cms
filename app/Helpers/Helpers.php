<?php
namespace App\Helpers;
class Helpers{
    public static function get_role(int $role){
        if($role == 1){
            return "Admin";
        }
        elseif($role == 2){
            return "Editor";
        }
        else{
            return "User";
        }
    }
    public static function get_slug(string $string){
                  $string = str_replace(' ','-',$string);
                  $string =strtolower($string);
                  return $string;
    }


}
