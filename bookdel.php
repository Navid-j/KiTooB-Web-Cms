<?php
		require 'bconfig.php';
		
		$connector = new mysqli($hostname,$username,$password);
			if ($connector->connect_error)
			{
				die("مشکل در اتصال به پایگاه داده: <br>" . $connector->connect_error);	
			}
			
		if (!mysqli_select_db($connector,"booknab")){die("مشکل در انتخاب جدول پایگاه داده !");}
		
	$bid=$_REQUEST['bookid'];
	
	$sql="DELETE FROM Books WHERE ID='$bid'";
	mysqli_query($connector, $sql)
	or die(mysqli_error());
	mysqli_close($connector);
	
	$delrep="کتاب حذف شد.";
	header("location: booklist.php?delsuccess=$delrep");
?>