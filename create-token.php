<?php

session_start();
$_SESSION = array();

error_reporting(E_ALL);
ini_set("display_errors", 1);

if(!isset($_POST['client_id'])){
	header("Location: index.php");
	die;
}

$client_id = $_POST['client_id'];
$client_secret = $_POST['client_secret'];

$ch = curl_init();
$url = 'http://localhost/oauth-demo/oauth/token.php';
curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

curl_setopt($ch, CURLOPT_USERPWD, $client_id.':'.$client_secret);

$headers = array(
		'Accept: application/json',
		'Content-Type: application/x-www-form-urlencoded',
		'Accept-Language: en_US'		
);

curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$vars['grant_type'] = 'client_credentials';

$req = http_build_query($vars);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);

$response = curl_exec($ch);

curl_close($ch);

$outArray = json_decode($response, true);

if(isset( $outArray['error'] )){

	$_SESSION['error'] = $response;
	header("Location: index.php");
	die;

}

$accessToken = $outArray['access_token'];

$_SESSION['access_token'] = $accessToken;
$_SESSION['success'] = $response;

	header("Location: index.php");
	die;




