	<?php 
		require 'bconfig.php';
		
		$connector = new mysqli($hostname,$username,$password);
			if ($connector->connect_error)
			{
				die("مشکل در اتصال به پایگاه داده: <br>" . $connector->connect_error);	
			}
			
		if (!mysqli_select_db($connector,"booknab")){die("مشکل در انتخاب جدول پایگاه داده !");}
		
		mysqli_set_charset($connector,"utf8");
		

		$sql="update Books set BName='$_POST[bookname]',Author='$_POST[author]',NumPage='$_POST[pagenumber]',BLang='$_POST[radiolang]'
							,PublicDate='$_POST[pubdate]',Translator='$_POST[translatorname]',BFormat='$_POST[bookformat]',BSize='$_POST[booksize]'
							,ISBN='$_POST[isbn]',Bpublisher='$_POST[publishername]',BPrice='$_POST[price]',BPrintNum='$_POST[printnumber]'
							,BSizeType='$_POST[sizetype]',BPriceType='$_POST[priceradio]' WHERE ID='$_POST[bookid]' ";
			
		
		if ($connector->query($sql) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $connector->error;
		}
		mysqli_close($connector);
				
		
		$updaterep="کتاب آپدیت شد";
		header("location: booklist.php?delsuccess=$updaterep");
	?>