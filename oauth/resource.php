<?php

// include our OAuth2 Server object
require_once __DIR__.'/server.php';

// Handle a request to a resource and authenticate the access token
if (!$server->verifyResourceRequest(OAuth2\Request::createFromGlobals())) {
    $server->getResponse()->send();
    die;
}


// can get client ID here
//$token = $server->getAccessTokenData(OAuth2\Request::createFromGlobals());
//echo json_encode($token);
//exit;


	// Do the add product functionality here
	// send back json message with whatever data they need

	$conn = new \PDO($dsn, $username, $password, array());
	$query = $conn->prepare("INSERT INTO products (title, slug, price) VALUES (?, ?, ?)");
	$query->execute(array($_POST['title'], $_POST['slug'], $_POST['price']));
	$product_id = $conn->lastInsertId();
	
	$query = $conn->prepare('SELECT * FROM `products` WHERE BINARY id = ?  ');
	$query->execute(array($product_id));
	$row = $query->fetch(PDO::FETCH_ASSOC);
	
	$products_arr=array();
	$products_arr["product"] = array();
	
	array_push($products_arr["product"], $row);
	
	print json_encode($products_arr);  exit;