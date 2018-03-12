<?php
include 'main.html';
include 'panel.html';
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

<div class="container" style="background: #0088cc " >
	<form class="span10" action="bookedite.php" method="post">
		<div class="form-group">
						<div  class="alert alert-info " > 
			<h2>لیست کتاب های موجود</h2>
			<p >
			کتاب ها موجود در پایگاه داده فعلی
			</p>
			</div>
			
		<?php 
		//info report
		$reportpm=$_REQUEST['delsuccess'];
		if ($reportpm==NULL){
			echo "<p class='alert alert-success pagination pagination-centered'>لیست کتاب ها بروز رسانی شد.</p>";
		}else {
		echo "<p class='alert alert-warning pagination pagination-centered'>$reportpm</p>";
		}
		
		require 'bconfig.php';
		$connector =new mysqli($hostname,$username,$password);
		if ($connector->connect_error)
		{
			die('<p class="alert alert-error">خطا در اتصال به سرور</p>' . $connector->connect_error);
		}
			
			
		$selector = mysqli_select_db($connector,"booknab") or die("Error Select DB ");
		mysqli_set_charset($connector, utf8);
		$sql="select * from Books";
		$result=$connector->query($sql);
		
		
		
		while ($dbgetinfo=mysqli_fetch_assoc($result))
		{
			if (($dbgetinfo['Translator']==NULL)){
				$transname = '-';
			}else {
				$transname = $dbgetinfo['Translator'];
			}
			if (($dbgetinfo['BPrice']==NULL)){
				$bprice="-";
			}else {
				$bprice= $dbgetinfo['BPrice'];
			}
		 $bid=$dbgetinfo['ID'];
		echo "<br>
		
    		<table border=1 style='background-color:#B6A7A4; width:100%;'>
            	<tr>
            		<td>نام کتاب: {$dbgetinfo["BName"]}</td>
            		<td> تعداد صفحه: {$dbgetinfo["NumPage"]}</td>
            		<td>شابک: {$dbgetinfo["ISBN"]}</td>
            		<td><a href='books/{$dbgetinfo["BFileLink"]}'>دانلود </a></td>
            		<td  rowspan='3' class='pagination pagination-centered' width='130' height='100'><img width='130' height='100' src='uploads/{$dbgetinfo["BImageLink"]}'></img></td>

           		</tr>
           		
            	<tr>
            		<td>نویسنده: {$dbgetinfo["Author"]}</td>
            		<td>مترجم: $transname</td>
            		<td>ناشر: {$dbgetinfo["Bpublisher"]}</td>
            		<td>زبان: {$dbgetinfo["BLang"]}</td>
            		
           		</tr>
           		
            	<tr>
            		<td>تاریخ انتشار: {$dbgetinfo["PublicDate"]}</td>
            		<td>تعداد چاپ: {$dbgetinfo["BPrintNum"]}</td>
            		<td>قیمت: $bprice</td>
            		<td width='100px'><a href='bookdel.php?bookid=$bid'>حذف</a> | <a href='bookedite.php?bookid=$bid'>ویرایش</a></td>
            		
           		</tr>
            </table>
          ";
		}
		mysqli_close($connector);
		?>
			
		</div>
	</form>
</div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>  
  </body>
</html>