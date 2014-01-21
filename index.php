<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Simple Minecraft Dynamic Serverbanner Creator">
    <meta name="author" content="">

    <title>Ten's Banners</title>

	<!-- jQuery Plugin -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>

<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen, print"/>
	
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	
    <!-- Custom font -->
    <link href='http://fonts.googleapis.com/css?family=Exo+2:500' rel='stylesheet' type='text/css'>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    </style>
    </head>
  <body onload="if (document.getElementById('srvcheckbox').checked) {AddInfoForm()}">
	<div id="preloader">
	<div id="status">&nbsp;</div>
	</div>
  
  
    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1 style="margin-bottom:0;font-family: 'Exo 2', sans-serif;">Dynamic Banner Generator <span class="label label-primary">Beta</span></h1>
		  <p><?php echo file_get_contents('hits.txt') ?> Banners generated so far...</p>
        </div>
		
		<div class="panel panel-default">
  			<div class="panel-body">
				<form class="form-horizontal" role="form" action="index.php" method="post">
  				<div class="form-group">
    				<label for="inputUsername" class="col-sm-1 control-label" >Server Name</label>
    				<div class="col-sm-offset-1 col-sm-5">
      					<input value="<?php if(isset($_POST['inputServername'])) { echo $_POST['inputServername']; } ?>" type="username" class="form-control" id="inputServername" placeholder="Server Name (Defaults to Minecraft Server)" name="inputServername">
    				</div>
  				</div>

  				<div class="form-group">
    				<label for="inputUsername" class="col-sm-1 control-label">Server IP</label>
    				<div class="col-sm-offset-1 col-sm-5">
      					<input value="<?php if(isset($_POST['inputServerip'])) { echo $_POST['inputServerip']; } ?>" type="username" class="form-control" id="inputServerip" placeholder="Server IP (Required)" name="inputServerip">
    				</div>
  				</div>

  				<div class="form-group">
    				<label for="inputUsername" class="col-sm-1 control-label">Server Port</label>
    				<div class="col-sm-offset-1 col-sm-5">
      					<input value="<?php if(isset($_POST['inputServerport'])) { echo $_POST['inputServerport']; } ?>" type="username" class="form-control" placeholder="Server Port (Required)" name="inputServerport">
    				</div>
  				</div>

				
				<div class="form-group">
    				<label for="inputUsername" class="col-sm-1 control-label">Generator</label>
    				<div class="col-sm-offset-1 col-sm-5">
      					<input <?php if(isset($_POST['generator']) and $_POST['generator'] == ("new")) { echo "checked"; } if(!isset($_POST['generator'])) { echo "checked"; } ?> type="radio" name="generator" value="new"> Modern Style<br>
						<input <?php if(isset($_POST['generator']) and $_POST['generator'] == ("old")) { echo "checked"; } ?> type="radio" name="generator" value="old"> Minecraft Style<br>
    				</div>
  				</div>
				
				<div class="form-group">
    				<label for="inputUsername" class="col-sm-1 control-label">SRV</label>
    				<div class="col-sm-offset-1 col-sm-5">
      					<input <?php if ($_POST['srvcheckbox'] == ("true")) { echo "checked"; } ?> onclick="if(this.checked){AddInfoForm()} else {DelInfoForm()}" type="checkbox" name="srvcheckbox" id="srvcheckbox" value="true"> I have SRV Records<br>
    				</div>
  				</div>
				<script>
				function AddInfoForm()
				{
				document.getElementById("srvinfo").innerHTML = "<div class='form-group'><label for='inputUsername' class='col-sm-1 control-label'>Display IP</label><div class='col-sm-offset-1 col-sm-5'><input type='username' class='form-control' placeholder='Display IP' value='<?php if(isset($_POST['srv']) and ($_POST['srv'] != (""))) { echo $_POST['srv']; } ?>' name='srv'></div></div>";
				}
				function DelInfoForm()
				{
				document.getElementById("srvinfo").innerHTML = "";
				}
				</script>

				<div id="srvinfo"></div>
				
  				<div class="form-group">
    				<div class="col-sm-offset-3">
      				<button type="submit" class="btn btn-default">Generate</button>
    				</div>
  				</div>
				
				
				</form>
				
				<?php
				if (isset($_POST['inputServerip'])) {
				if ($_POST['inputServerip'] == ("")) {
				?>
				<div class="alert alert-danger">Please enter a server IP!</div>
				<?php
				} else {
				$hits = file_get_contents('hits.txt');

				$views = $hits + 1;

				$file = 'hits.txt';

				file_put_contents($file, $views);

				if ($_POST['inputServerport'] == ("")) {
				$port = "25565";
				} else {
				$port = "".$_POST['inputServerport']."";
				}
				if ($_POST['inputServername'] == ("")) {
				$name = "Minecraft Server";
				} else {
				$name = $_POST['inputServername'];
				}
				if(isset($_POST['srvcheckbox']) and ($_POST['srvcheckbox'] == ("true"))) {
				$srv = "true";
				$srvaddress = $_POST['srv'];
				} else {
				$srv = "false";
				$srvaddress = "";
				}
				if ($_POST['generator'] == ("new")) {
				$baseurl = "http://tcbanner.zapto.org/Bannerz/?server=";
				} else {
				if ($_POST['generator'] == ("old")) {
				$baseurl = "http://tcbanner.zapto.org:8907/ping?server=";
				} else {
				}
				}
				?>
				<div class="panel panel-default">
				<div class="panel-heading">Generated banner for <?php echo $name ?>:</div>
				<div class="panel-body">
				<img src="<?= $baseurl ?><?= $_POST['inputServerip'] ?><?php if(isset($_POST['generator']) and ($_POST['generator'] == ("old"))) { echo ":".$port.""; } else { echo "&port=".$port.""; } ?>&name=<?= $name ?>&srv=<?= $srv ?>&srvaddress=<?= $srvaddress ?>"></img>
				<br>
				<br>
				<p>Direct Image URL: <code><?= $baseurl ?><?= $_POST['inputServerip'] ?><?php if(isset($_POST['generator']) and ($_POST['generator'] == ("old"))) { echo ":".$port.""; } else { echo "&port=".$port.""; } ?>&name=<?= $name ?>&srv=<?= $srv ?>&srvaddress=<?= $srvaddress ?></code></p>
				<br>
				<p>BB Code: <code>[IMG]<?= $baseurl ?><?= $_POST['inputServerip'] ?><?php if(isset($_POST['generator']) and ($_POST['generator'] == ("old"))) { echo ":".$port.""; } else { echo "&port=".$port.""; } ?>&name=<?= $name ?>&srv=<?= $srv ?>&srvaddress=<?= $srvaddress ?>[/IMG]</code></p>
				<br>
				<?php if(isset($_POST['generator']) and ($_POST['generator'] == ("old"))) { 
				$port1 = ":".$port."";
				} else { 
				$port1 = "&port=".$port."";
				}
				$html = "<img src='".$baseurl."".$_POST['inputServerip']."".$port1."&name=".$name."&srv=".$srv."&srvaddress=".$srvaddress."'></img>";
				?>
				<p>HTML Code: <code><?php echo htmlspecialchars($html) ?></code></p>
				</div>
				</div>
				<?php
				}
				}
				?>
				
  			</div>
		</div>

    <div id="footer">
      <div class="container">
        <p class="text-muted">Welcome to the world of PHP!</p>
      </div>
    </div>
	<script type="text/javascript">
	//<![CDATA[
		$(window).load(function() { // makes sure the whole site is loaded
			$('#status').fadeOut(); // will first fade out the loading animation
			$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
			$('body').delay(350).css({'overflow':'visible'});
		})
	//]]>
</script> 
  </body>
</html>
