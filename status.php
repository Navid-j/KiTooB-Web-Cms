<?php
include 'main.html';
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>مدیریت v1.0</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
</head>
  <body>
    <div class="cantainer" align="center">
<form>
<div class="form-group">
<h1>صفحه اصلی ، آمار ، وضعیت سرور و کتابها</h1>
<?php
//etesal va test database.
	require 'bconfig.php';
	
	$connector =new mysqli($hostname,$username,$password);
	
	if($connector->connect_error)
	{
		die('<p class="alert alert-error">مشکل در اتصال به دیتابیس رخ داده است.</div>' . $connector->connect_error);
	}
	echo '<p class="alert alert-success">اتصال به سرور کامل شد.</div>';
	//select db
	$selector = mysqli_select_db($connector,"booknab")
	or die("<br>Cant Sellect DB!");
	mysqli_set_charset($connector,"utf8");
	
	//entekhab mohtava
	$sql="select * from Books";
	$result=$connector->query($sql);
	$dbgetinfo=mysqli_fetch_assoc($result);
	
	echo "
		<br>
		
    		<table border=2 style='background-color:#B6A7A4; width:20%;'>
            	<tr>
            		<td>تعداد کتابها</td>
					<td>{$dbgetinfo["ID"]}</td>
           		</tr>
            	<tr>
            		<td>تعداد کتابهای فارسی</td>
					<td>0</td>
           		</tr>
				<tr>
					<td>تعداد کتابهای فروشی</td>
					<td>0</td>
           		</tr>
				<tr>
					<td>تعداد کتابهای PDF</td>
					<td>0</td>
           		</tr>
				<tr>
					<td>تعداد کتابهای EPub</td>
					<td>0</td>
           		</tr>
            </table>
		";
	
      ?>
      
<?php mysqli_close($connector);?>
</div>
</form>
	</div>

  </body>
</html>