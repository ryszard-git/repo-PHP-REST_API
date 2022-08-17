<?php
$currencies = null;
$currenciesArray = array();

$currency = (!empty($_GET['currency'])) ? $_GET['currency'] : 'EUR' ;
$currencies = (!empty($_GET['currencies'])) ? $_GET['currencies'] : 'EUR' ;

$twoCurrencies = ((!empty($currencies)) && (strpos($currencies, ":"))) ? true : false;

if ($twoCurrencies) {
    $currenciesArray = explode(":", $currencies);
} else {
    $currenciesArray[0] = $currency;
}

echo '<html><body style="background:gray;"><div style="width:50%;margin:0 auto;">';

foreach ($currenciesArray as $currArr) {
    $currencyRateServerURL = "https://api.nbp.pl/api/exchangerates/rates/A/" . $currArr . "/last/7/?format=json";

    $currencyObject = file_get_contents($currencyRateServerURL); 
    $jsonObject = json_decode($currencyObject);

    $rates = $jsonObject->rates; //assoc array
 
    foreach ($rates as $rateItem) {
        foreach ($rateItem as $key => $value) {
            if ($key == "mid") $dayRate[] = $value;
            if ($key == "effectiveDate") $dateOfRate[] = $value;
        }
    }

    $dayRateToChart = implode(",", $dayRate);
    $datesOfRateToChart = implode("|", $dateOfRate);

    $maxDayRateOnChart = round(max($dayRate) + 0.01, 4);
    $minDayRateOnChart = round(min($dayRate) - 0.005, 4);
    $rateInterval = round(($maxDayRateOnChart - $minDayRateOnChart) / 4, 4);

    // NIE zmieniac wciecia ponizszego fragmentu kodu *****************

    $chartGeneratorURL = "https://image-charts.com/chart?cht=lc
&chtt=$jsonObject->currency%20$jsonObject->code
&chxt=x,y
&chxl=0:|$datesOfRateToChart
&chs=900x400
&chd=t:$dayRateToChart
&chxr=1,$minDayRateOnChart,$maxDayRateOnChart,$rateInterval";

    // *****************************************************************

    echo '<div style="margin-bottom:50px;"><img src="' . $chartGeneratorURL . '" alt="chart" width="100%" ></div>';

    $dayRateToChart = null;
    $datesOfRateToChart = null;
    $dateOfRate = array();
    $dayRate = array();
}
echo '</div></body></html>';
?>