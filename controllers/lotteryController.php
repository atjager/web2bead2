<?php
    class LotteryController{
            public function show(){
                
                require_once('views/lottery/show.php');

            }

            public function getUrl(){
                return "http://localhost/web2bead2/models/lottery.php";
            }

            public function lotteryGet(){
                $url = $this->getUrl();
                $curlGet = curl_init($url);
                curl_setopt($curlGet, CURLOPT_URL, $url);
                curl_setopt($curlGet, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($curlGet);
                curl_close($curlGet);
                return $result;
            }

            public function exchangeMonth($firstCurrency, $secondCurrency, $date){
                $this->date = $date;

                // Split the date and examines the month lenght.
                $dateSplitter = explode("-", $date);
                $monthDayCal = cal_days_in_month(CAL_GREGORIAN, $dateSplitter['1'], $dateSplitter['0']);

                $startDate = $dateSplitter['0']."-".$dateSplitter['1']."-01";
                $endDate = $dateSplitter['0']."-".$dateSplitter['1']."-".$monthDayCal;

                $firstExchange = [
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                   'currencyNames' => $firstCurrency
                ];

                $secondExchange = [
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                  'currencyNames' => $secondCurrency
                ];
                
                $checkfirstUnit = [
                    'currencyNames' => $firstCurrency
                ];

                $checksecondUnit = [
                    'currencyNames' => $secondCurrency
                ];

                try {
                    $client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL");

                    $firstExchangeResult = (array)simplexml_load_string($client->GetExchangeRates($firstExchange)->GetExchangeRatesResult);
                    
                } catch (SoapFault $e) {
                    $firstExchangeResult = $e;
                }

                try {

                    $secondExchangeResult = (array)simplexml_load_string($client->GetExchangeRates($secondExchange)->GetExchangeRatesResult);
                    
                } catch (SoapFault $e) {
                    $secondExchangeResult = $e;
                }

                try {

                    $checkfirstUnitResult = (array)simplexml_load_string($client->GetCurrencyUnits($checkfirstUnit)->GetCurrencyUnitsResult);
                    
                } catch (SoapFault $e) {
                    $checkfirstUnitResult  = $e;
                }

                try {

                    $checksecondUnitResult = (array)simplexml_load_string($client->GetCurrencyUnits($checksecondUnit)->GetCurrencyUnitsResult);
                    
                } catch (SoapFault $e) {
                    $checksecondUnitResult  = $e;
                }

                $dateArray = [];
                $firstRate = [];
                $secondRate = [];
                $exchangeRate = [];
                $passBack = [];

                $arrLenght1 = count($firstExchangeResult['Day']);
                // GET THE DATES AND THE VALUES
                for( $i=0; $i<$arrLenght1; $i++ ){
                    $dateArray[$i] = trim($firstExchangeResult['Day'][$i]['date']);
                    $firstRate[$i] = (float)end($firstExchangeResult['Day'][$i])/(float)end($checkfirstUnitResult['Units']);
                    $secondRate[$i] = (float)end($secondExchangeResult['Day'][$i])/(float)end($checkfirstUnitResult['Units']);
                    $exchangeRate[$i] = $firstRate[$i]/$secondRate[$i];

                    $passBack[$i] = [$dateArray[$i] => $exchangeRate[$i]];
                }
                
                return $passBack;
            }

        
    }
?>