<?php
use Illuminate\Support\Facades\Cookie;
function formatPrice($amount){
  return  sprintf("%.2f",$amount);
}
function getCountryNameFromISO($ISO = null){
  if($ISO){
    $CountrCodeName= [
      "GB" =>' United Kingdom',"GE" => "Georgia",
      "AL" => 'Albania',"AD" => 'Andorra',
      "AT" => 'Austria',"BY" => 'Belarus',
      "BE" => 'Belgium',"BA" => 'Bosnia and Herzegovina',
      "BG" => 'Bulgaria',"HR" => 'Croatia',
      "CY" => 'Cyprus',"CZ" => 'Czech Republic',
      "FR" => 'France',"GI" => 'Gibraltar',
      "DE" => 'Germany',"GR" => 'Greece',
      "VA" => 'Holy See (Vatican City State)',"HU" => 'Hungary',
      "IT" => 'Italy',"LI" => 'Liechtenstein',
      "LU" => 'Luxembourg',"MK" => 'Macedonia',
      "MT" => 'Malta',"MD" => 'Moldova',
      "MC" => 'Monaco',"ME" => 'Montenegro',"NL" => 'Netherlands',"PL" => 'Poland',"PT" => 'Portugal',"RO" => 'Romania',"SM" => 'San Marino',"RS" => 'Serbia',"SK" => 'Slovakia',"SI" => 'Slovenia',"ES" => "Spain","UA" => "Ukraine","DK" => "Denmark","EE" => "Estonia","FO" => "Faroe Islands","FI" => "Finland","GL" => "Greenland","IS" => "Iceland","IE" => "Ireland","LV" => "Latvia","LT" => "Lithuania","NO" => "Norway","SJ" => "Svalbard and Jan Mayen Islands","SE" => "Sweden","CH" => "Switzerland","TR" => "Turkey"];
    return $CountrCodeName[$ISO];
  }else{
    return null;
  }

}
function getCurrency(){
  if(session()->has('currency')){
    if(session()->get('currency') == 'EUR'){
      $CurrencySymbole = '€';
      $CurrencyCode = 'EUR';
    }elseif(session()->get('currency') == 'SEK'){
      $CurrencySymbole = 'öre';
      $CurrencyCode = 'SEK';
    }elseif(session()->get('currency') == 'DKK'){
      $CurrencySymbole = 'kr';
      $CurrencyCode = 'DKK';
    }
  }else{
    $CurrencySymbole = 'kr';
    $CurrencyCode = 'DKK';
  }
  return ['symbole' => $CurrencySymbole,'code' => $CurrencyCode];
}
function convertCurrency($amount , $from , $to){
  // dd($amount.'-'.$from.'-'.$to);
  //Check Old Data
    if($to == 'DKK'){
      return $amount;
    }
    $client = new GuzzleHttp\Client();
    $res = $client->get('http://api.exchangeratesapi.io/latest?base='.$from.'&symbols='.$to);
    if($res->getStatusCode() != 200){
      return "Error !" . $res->getStatusCode();
    }
    $ResponseAsArray = json_decode($res->getBody(), true);
    return sprintf("%.2f",$amount *  $ResponseAsArray['rates'][$to]);
}
function changeDateFormate($date,$date_format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);
}
function productImagePath($image_name){
    return public_path('images/products/'.$image_name);
}
function getPaymentMethods($PickUpStore = null , $order_payment = null){
  if($PickUpStore == 'yes'){
    $PaymentMethods = App\Payment_Method::where('code_name' ,'!=' , 'paymentoncollection')->latest()->get();
  }else{
    $PaymentMethods = App\Payment_Method::latest()->get();
  }
  foreach($PaymentMethods as $Single){
    $PercentagFee = ($Single->percentage_fee == 1) ? '-' : $Single->percentage_fee;
    $FixedFee = ($Single->fixed_fee == 0) ? '-' : $Single->fixed_fee;
    echo '<option'; ?> <?php if($order_payment == $Single->code_name){echo 'selected';} echo' value="'.$Single->code_name.'">'.$Single->name.' ('.$PercentagFee.'%) + ('.$FixedFee.'€)</option>';
  }
}
