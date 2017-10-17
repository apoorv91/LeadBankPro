<?php
//phpinfo();

$ch = curl_init();

$domain = $_SERVER['SERVER_NAME'];;
$license_domain = 'http://licensemanager.stpi.com/demowebsite/index.php';
$product_id = $_REQUEST['product_id'];
$uuid = "";

$Url = $domain.'/api/?licensekey=PML-UB77-S270-8W56-H9O1&product_id='.$product_id.'&uuid=';

curl_setopt($ch, CURLOPT_URL, $Url);
    // User agent
curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
    // Should cURL return or print out the data? (true = return, false = print)
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Timeout in seconds
    // curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    // Download the given URL, and return output
$output = curl_exec($ch);
$result= json_decode(curl_exec($ch), true);
    // Close the cURL resource, and free system resources
curl_close($ch);

if($result['status'] != 200) {

    $search = '<%returnmessage%>';
    $replace = $result['message'];

    $html = str_replace($search, $replace, $html);
    $html = "<div align='center'>
    <table width='100%' border='0' style='padding:15px; border-color:#F00; border-style:solid; background-color:#FF6C70; font-family:Tahoma, Geneva, sans-serif; font-size:22px; color:white;'>
    <tr>
    <td><b>You don't have permission to use this product. <br>The message from server is: <%returnmessage%> <br > Contact the product developer.</b></td >
    </tr>
    </table>
    </div>";
    $search = '<%returnmessage%>';
    $replace = $result['message'];
    $html = str_replace($search, $replace, $html);

    die( $html );

}

?>
