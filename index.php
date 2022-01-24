<?php session_start();

if( isset($_GET['unset']) ){

	session_destroy();
	header("Location: index.php");
	die;

}

?>
<!DOCTYPE HTML>
<head>
<title></title>
<meta charset="utf-8">
<meta name="robots" content="nofollow, noindex, noimageindex, noarchive, nosnippet" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/padding.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<meta name="description" content="" />
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/jquery.matchHeight-min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<div class="row">

	<div class="col-md-6 col-md-offset-3">
	
	<?php if(isset($_SESSION['error'])){
	
		print '<br /><div class="alert alert-danger">'.$_SESSION['error'].'</div>';
	
	} ?>
	
	<?php if(isset($_SESSION['success'])){
	
		print '<br /><div class="alert alert-success" style="word-wrap:break-word">Success:<br />'.$_SESSION['success'].'</div>';
	
	} ?>
	
	<?php if(isset($_SESSION['product'])){
	
		print '<br /><div class="alert alert-success" style="word-wrap:break-word">Product Added Successfully:<br />'.$_SESSION['product'].'</div><br />
		<a href="index.php?unset=sessions">ADD ANOTHER PRODUCT</a>';
	
	} ?>
	
<?php if(!isset($_SESSION['success']) && !isset($_SESSION['product']) ){ ?>
	
<h2 class="text-center">Add Product Using OAuth</h2>

<br />
<p>Valid Client ID and Client Seret are:<br /><br /></p>
<p>CLIENT ID: alex123</p>
<p>CLIENT SECRET: password123</p>

<br />

<form action="create-token.php" method="post">
	<br /><br />
	<input type="text" required class="form-control" name="client_id" placeholder="CLIENT ID" value="alex123">
	
	<br />
	<input type="text" required class="form-control" name="client_secret" placeholder="CLIENT SECRET" value="password123">
	
	<br /><br />
	
	<button type="submit" class="btn btn-primary" style="width:100%">GET ACCESS TOKEN</button>

</form>

<?php } ?>


<?php if(isset($_SESSION['success'])){ ?>
	
<h2 class="text-center">Add Product Data Using Access Token</h2>

<br />
<p>Current Access Token Is:<br /></p>
<p><?= $_SESSION['access_token'] ?></p>

<form action="add-product.php" method="post">
	<br /><br />
	Title:<br />
	<input type="text"  class="form-control" name="title" placeholder="Product Title" value="">
	<br />
	Slug:<br />
	<input type="text"  class="form-control" name="slug" placeholder="Product Slug" value="">
	<br />
	Price:<br />
	<input type="text"  class="form-control" name="price" placeholder="Product Price" value="">
	<br />
	Access Token:<br />
	<input type="text" required class="form-control" name="access_token" placeholder="Access Token" value="<?= $_SESSION['access_token'] ?>">
	
	<br /><br />
	
	<button type="submit" class="btn btn-primary" style="width:100%">ADD PRODUCT</button>

</form>

<?php } ?>
	
	
	</div>

</div>






</div>




</body>
</html>