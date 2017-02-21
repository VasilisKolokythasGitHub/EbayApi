<?php
			$response = "http://www.ebay.com/itm/New-Samsung-Galaxy-S7-Edge-SM-G935F-Octa-5-5-12MP-FACTORY-UNLOCKED-32GB-Phone-/281946599883?var=&hash=item41a553b1cb:m:moszRJUA-F0LxjqjFJnsX1A&rmvSB=true";
				$display = explode('/', $response);
				$iDvalue = $display[5];

				if( strpos( $iDvalue, "#" ) !== false ) {
					$display = explode('#', $iDvalue);
				}

				else{
					 $display = explode('?', $iDvalue);
				}

				$EbayIDValue = $display[0];
				$appID = 'YOUR-APP-ID-HERE';

$request = '<?xml version="1.0" encoding="utf-8"?>

            <GetSingleItemRequest xmlns="urn:ebay:apis:eBLBaseComponents" >

            <ItemID>'.$EbayIDValue.'</ItemID>
            <ConvertedCurrentPrice currencyID="EUR"></ConvertedCurrentPrice>

            <IncludeSelector>Price</IncludeSelector>

            </GetSingleItemRequest>';

 

$callName = 'GetSingleItem';

$compatibilityLevel = 647;

$endpoint = "http://open.api.ebay.com/shopping";

 

$headers[] = "X-EBAY-API-CALL-NAME: $callName";

$headers[] = "X-EBAY-API-APP-ID: $appID";

$headers[] = "X-EBAY-API-VERSION: $compatibilityLevel";

$headers[] = "X-EBAY-API-REQUEST-ENCODING: XML";

$headers[] = "X-EBAY-API-RESPONSE-ENCODING: XML";

$headers[] = "X-EBAY-API-SITE-ID: 0";

$headers[] = "Content-Type: text/xml";

 

$curl = curl_init($endpoint);

 

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($curl, CURLOPT_POST, 1);

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

curl_setopt($curl, CURLOPT_POSTFIELDS, $request);


$response = curl_exec($curl);

$data = new SimpleXMLElement($response);



 
$price_in_USD = $data->Item->ConvertedCurrentPrice;


$url = 'http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22USDEUR%22,%20%22USDJPY%22,%20%22USDBGN%22,%20%22USDCZK%22,%20%22USDDKK%22,%20%22USDGBP%22,%20%22USDHUF%22,%20%22USDLTL%22,%20%22USDLVL%22,%20%22USDPLN%22,%20%22USDRON%22,%20%22USDSEK%22,%20%22USDCHF%22,%20%22USDNOK%22,%20%22USDHRK%22,%20%22USDRUB%22,%20%22USDTRY%22,%20%22USDAUD%22,%20%22USDBRL%22,%20%22USDCAD%22,%20%22USDCNY%22,%20%22USDHKD%22,%20%22USDIDR%22,%20%22USDILS%22,%20%22USDINR%22,%20%22USDKRW%22,%20%22USDMXN%22,%20%22USDMYR%22,%20%22USDNZD%22,%20%22USDPHP%22,%20%22USDSGD%22,%20%22USDTHB%22,%20%22USDZAR%22,%20%22USDISK%22)&env=store://datatables.org/alltableswithkeys';
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, $url );
  curl_setopt( $ch, CURLOPT_POST, true );
  curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $ch, CURLOPT_POSTFIELDS, "<xml>here</xml>" );
  $result = curl_exec($ch);
  
   $euros = new SimpleXMLElement($result);
  $cur_in_EUR = $euros->results->rate[0]->Bid;
	 $cur_in_EUR = floatval($cur_in_EUR);

				 echo "Samsung Galaxy S7 edge price: ".round($price_in_USD * $cur_in_EUR,2)."€";   
				?>