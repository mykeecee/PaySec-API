

<html>
<head>

</head>


<body>


<form method="post">

<!--<input name="hash" id="hash" placeholder ="signature data" size="30" type="text" required />   -->
merchantCode
<br>
<input name="merchantCode" id="merchantCode" placeholder ="merchantCode" size="30" type="text"  value="" required />
<br>
Key
<br>
<input name="merchantkey" id="merchantkey" placeholder ="hash " size="30" type="text" required value = ""/>
<br>
CartID
<br>
<input name="cartId" id="cartId" placeholder ="cartId" size="30" type="text" required value="" />
<br>
Currency
<br>
<input name="currency" id="currency" placeholder ="currency" size="30" type="text" required value="CNY" />
<br>
Amount
<br>
<input name="orderAmount" id="orderAmount" placeholder ="currency" size="30" type="text" required value="10.00" />
<br>
Version
<br>
<input name="version" id="version" placeholder ="version" size="30" type="text" required value="" />
<br>
<input name="status" id="status" placeholder ="status" size="30" type="text" required value="SUCCESS" />

<br><br>
<input name="submit" type="submit" value="send"/>

</form>

<?php
$hash = $_POST['hash'];
$merchantkey = $_POST['merchantkey'];
$hashdata = $_POST['cartId'].";". $_POST['orderAmount'].";". $_POST['currency'].";". $_POST['merchantCode'].";".$_POST['version'].";". $_POST['status'];

if (isset ($_POST['submit'])) {

$salt = str_replace ("$2a$12$","",$merchantkey);
$options = [ 'cost' => 12, 'salt' => $salt ]; 
$hashVal = hash('sha256', utf8_encode($hashdata));
$signature = password_hash($hashVal, PASSWORD_BCRYPT, $options); 
echo "Signature data: ".$hashdata;
echo "<br>";
//echo "Data encoded to utf8:". utf8_encode($hashdata);
//echo "<br>";
echo "Data after Hash to sha256 with utf8 encode: ".$hashVal;
echo "<br>";
echo "Merchant key:".$merchantkey;
echo "<br>";
$loc = strposX($signature, "$", 3);  //check the location of the 3rd $ in signature
echo $signature;
echo "<br>";
$sdata = str_replace($salt,"",substr($signature,$loc));
echo "Signature: ". $sdata;

}


function strposX($haystack, $needle, $n = 0)
{
    $offset = 0;

    for ($i = 0; $i < $n; $i++) {
        $pos = strpos($haystack, $needle, $offset);

        if ($pos !== false) {
            $offset = $pos + strlen($needle);
        } else {
            return false;
        }
    }

    return $offset;
}


?>

</body>

</html>
