<html>
<head>
<title> Iframe</title>
</head>
<body>
<center>
<?php include('Crypto.php')?>
<?php 
	//print_r($_POST);exit;
	error_reporting(1);

	$working_key='14FED4AD09328DD6AC8A2750D48932C9';//Shared by CCAVENUES
	$access_code='AVNN64DB11BP52NNPB';//Shared by CCAVENUES
	$merchant_data='91309';
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}
	echo $merchant_data;exit;
	//echo "<pre>";print_r($_POST);exit;
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

	$production_url='https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
?>
<iframe src="<?php echo $production_url?>" id="paymentFrame" width="482" height="450" frameborder="0" scrolling="No" ></iframe>

<script type="text/javascript" src="jquery-1.7.2.js"></script>
<script type="text/javascript">
    	$(document).ready(function(){
    		 window.addEventListener('message', function(e) {
		    	 $("#paymentFrame").css("height",e.data['newHeight']+'px'); 	 
		 	 }, false);
	 	 	
		});
</script>
</center>
</body>
</html>

