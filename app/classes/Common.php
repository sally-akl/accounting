<?php
namespace App\classes;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Auth;
use Lang;
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

  public static function getCurrencyText($currency)
  {
        $currency_text = "";
        if($currency == "SAR")
           $currency_text = Lang::get('app.sar_currency');
        else if($currency == "EGP")
           $currency_text = Lang::get('app.egp_currency');
        else if($currency == "USD")
           $currency_text = Lang::get('app.usd_currency');

         return $currency_text;
  }

   public static function user_filter_by_role($query,$is_join,$relation,$main_table)
   {
       if(empty($query))
         $query = $query::whereRaw('1 = 1');

         if(Auth::user()->hasChildRoles())
         {
                if($is_join)
                  $query = $query->join($relation[0],$relation[1],$relation[2]);


                $query = $query->whereRaw('( `user_id` = '.Auth::user()->id.' or `user_id` in (select `user_id` from `users_roles` where `role_id` in (select ro.`id` from `roles` as `ro` inner join `users_roles` as `ur` on `ur`.`role_id` = `ro`.`parent` where `user_id` = '.Auth::user()->id.')))');
                if(!empty($main_table))
                  $main_table = $main_table.".";

                $query = $query->whereRaw('('.$main_table.'`user_id` = '.Auth::user()->id.' or  '.$main_table.'`user_id` in (select `user_id` from `users_roles` where `role_id` in (select ro.`id` from `roles` as `ro` inner join `users_roles` as `ur` on `ur`.`role_id` = `ro`.`parent` where `user_id` = '.Auth::user()->id.')))');
                $query  = $query->whereIn("branch_id",Auth::user()->branches);
         }
        else {
                 if(!Auth::user()->IsAdmin())
                 {
                    $query = $query->where("user_id",Auth::user()->id);
                   if(!empty($main_table))
                   {
                       $main_table = $main_table.".";
                      $query = $query->where($main_table."user_id",Auth::user()->id);
                   }



                 }

                 else
                 {
                    if($is_join)
                      $query = $query->join($relation[0],$relation[1],$relation[2]);
                    $query  = $query->whereIn("branch_id",Auth::user()->branches);

                 }


         }


       return $query;

   }

   public static function convertCurrency($from,$to,$convert_val)
   {
        $convert_str = $from."_".$to;
        $val = Common::getCurrancyRate($convert_str);
        return  $convert_val * $val->$convert_str->val;
   }

   public static function getCurrancyRate($from_to)
   {
        $client = new Client();
        $res = $client->request('GET', 'http://free.currencyconverterapi.com/api/v5/convert?q='.$from_to.'&compact=y');
        $val = json_decode($res->getBody());
        return $val;
   }



}
?>
