<?php
namespace App\classes;
use Auth;
class Common
{

  public static function GenerateCode($length = 10,$type,$column_name)
  {
       $is_exist = true;
       $code ="";

       while($is_exist)
       {
          $code = Common::getCode($length);
          $class=  'App\\' .$type;
          $is_exist = $class::where($column_name,$code)->exists();
       }
     return $code;
  }

  private static function getCode($length = 10)
  {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;

  }

  public static function CommonList($type,$page_num)
  {
       $class=  'App\\' .$type;
       $list =  $class::whereRaw('1 = 1');
       if(!Auth::user()->IsAdmin())
         $list = $list->where("user_id",Auth::user()->id);

       $list = $list->orderBy("id","desc")->paginate($page_num);
       return $list;

  }



}
?>
