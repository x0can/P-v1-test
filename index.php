<?php

class Equity {

        protected $auth_key;
        protected $merchant_code;
        protected $pass_word;
        protected $grant_type;
        protected $url;
        
    }       
            

    class PaymentToken extends  Equity {

      

        public function getToken() {

            $grant_type = $this->grant_type;
            $pass_word = $this->pass_word;
            $merchant_code = $this->merchant_code;
            $auth_key = $this->auth_key;
            $url = $this->url;
            $ch = curl_init();   
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER,array(
                "Authorization: ${auth_key}",
                'Content-Type: application/x-www-form-urlencoded'
            ));
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,"merchantCode=${merchant_code}&password=${pass_word}&grant_type=${grant_type}");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec ($ch);
            $token = json_decode($server_output, true);
            if($token['error']){
                echo "Invalid credentials";
            }else {
                echo $token['payment-token'];
            }
            
            curl_close ($ch);  

        }

        
    }
        
    $objtest = new PaymentToken ();
                 
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Djenga Api</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<script>



</script>



<body>


<form method='POST'>
 <input type="text" name="name">
 <input type="submit" value="Submit Name">
 </form>
<?php
//Retrieve name from query string and store to a local variable
$name = '';
echo $name ;

$name = $_POST['name'];
// echo $name;
?>


<form 
    id="eazzycheckout-payment-form"
    action=" https://api-test.equitybankgroup.com/v2/checkout/launch" method="POST">
    <input type="hidden" id="token" name="token" value="<?php echo $objtest->getToken();?>"/>
    <input type="hidden" id="amount" name="amount" value="10000">
    <input type="hidden" id="orderReference" name="orderReference" value="4345rt43">
    <input type="hidden" id="merchantCode" name="merchantCode" value="<?php echo $name;?>">
    <input type="hidden" id="merchant" name="merchant" value="Jumia">
    <input type="hidden" id="currency" name="currency" value="KES">
    <input type="hidden" id="custName" name="custName" value="Jumia">
    <input type="hidden" id="outletCode" name="outletCode" value="0000000000">
    <input type="hidden" id="extraData" name="extraData" value="N/A" >
    <input type="hidden" id="popupLogo" name="popupLogo" value="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQaWmE9OLh4KHerCwUehjx1ZWHMIRY6IapeLVCC_deFzbzYfL27">
    <input type="hidden" id="ez1_callbackurl" name="ez1_callbackurl" value="http://localhost/finshop/index.php/checkout/order-received/58/?key=wc_order_NLpxa7N6EPUPG">
    <input type="hidden" id="ez2_callbackurl" name="ez2_callbackurl" value="http://localhost/finshop/index.php/checkout/order-received/58/?key=wc_order_NLpxa7N6EPUPG">
    <input type="hidden" id="expiry" name="expiry" value="2025-02-17T19:00:00">
    <input type="submit" id="submit-cg" role="button" class="btn btn-primary col-md-4"
       value="Checkout"/>
 </form>








</body>
</html>   
   
   
   
   
   
   
   
    