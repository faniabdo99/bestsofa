<?php
use Illuminate\Support\Facades\Cookie;
function getCountryNameFromISO($ISO){
    $CountrCodeName= ["GB" =>' United Kingdom',"AL" => 'Albania',"AD" => 'Andorra',"AT" => 'Austria',"BY" => 'Belarus',"BE" => 'Belgium',"BA" => 'Bosnia and Herzegovina',"BG" => 'Bulgaria',"HR" => 'Croatia',"CY" => 'Cyprus',"CZ" => 'Czech Republic',"FR" => 'France',"GI" => 'Gibraltar',"DE" => 'Germany',"GR" => 'Greece',"VA" => 'Holy See (Vatican City State)',"HU" => 'Hungary',"IT" => 'Italy',"LI" => 'Liechtenstein',"LU" => 'Luxembourg',"MK" => 'Macedonia',"MT" => 'Malta',"MD" => 'Moldova',"MC" => 'Monaco',"ME" => 'Montenegro',"NL" => 'Netherlands',"PL" => 'Poland',"PT" => 'Portugal',"RO" => 'Romania',"SM" => 'San Marino',"RS" => 'Serbia',"SK" => 'Slovakia',"SI" => 'Slovenia',"ES" => "Spain","UA" => "Ukraine","DK" => "Denmark","EE" => "Estonia","FO" => "Faroe Islands","FI" => "Finland","GL" => "Greenland","IS" => "Iceland","IE" => "Ireland","LV" => "Latvia","LT" => "Lithuania","NO" => "Norway","SJ" => "Svalbard and Jan Mayen Islands","SE" => "Sweden","CH" => "Switzerland","TR" => "Turkey"];
    return $CountrCodeName[$ISO];
}
function getCurrency(){
  if(session()->has('currency')){
    if(session()->get('currency') == 'EUR'){
      $CurrencySymbole = '€';
      $CurrencyCode = 'EUR';
    }elseif(session()->get('currency') == 'GBP'){
      $CurrencySymbole = '£';
      $CurrencyCode = 'GBP';
    }
  }else{
    $CurrencySymbole = '€';
    $CurrencyCode = 'EUR';
  }
  return ['symbole' => $CurrencySymbole,'code' => $CurrencyCode];
}
function convertCurrency($amount , $from , $to){
  //Check Old Data
  if($to == 'EUR'){
    return $amount;
  }
  if(Cookie::get('exchange_rate')){
    return sprintf("%.2f",$amount * Cookie::get('exchange_rate'));
  }else{
    $client = new GuzzleHttp\Client();
    $res = $client->get('https://free.currconv.com/api/v7/convert?q='.$from.'_'.$to.'&compact=ultra&apiKey=2a09d42c2cd34f077b6e');
    if($res->getStatusCode() != 200){
      return "Error !" . $res->getStatusCode();
    }
    $ResponseAsArray = json_decode($res->getBody(), true);
    cookie()->queue(cookie()->make('exchange_rate', reset($ResponseAsArray) , 60));
    return sprintf("%.2f",$amount *  reset($ResponseAsArray));
  }


}
function changeDateFormate($date,$date_format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);
}
function productImagePath($image_name){
    return public_path('images/products/'.$image_name);
}
