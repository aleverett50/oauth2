<?php

session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

if(!isset($_POST['title'])){
	header("Location: index.php");
	die;
}


$accessToken = $_POST['access_token'];

$ch = curl_init();
$url = 'http://localhost/demo/oauth/resource.php';

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$headers = array(
    "Accept: application/json",
    "Content-Type: application/x-www-form-urlencoded",
    "Authorization: Bearer $accessToken"
);
curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$vars['title'] = $_POST['title'];
$vars['slug'] = $_POST['slug'];
$vars['price'] = $_POST['price'];

$req = http_build_query($vars);

$json = json_encode($vars);

curl_setopt($ch, CURLOPT_POSTFIELDS, $req);

$response = curl_exec($ch);

$outArray = json_decode($response, true);

curl_close($ch);

if(isset($outArray['error'])){

	print $response;
	die;

}else{

	$_SESSION = array();
	$_SESSION['product'] = $response;
	header("Location: index.php");
	die;

}



