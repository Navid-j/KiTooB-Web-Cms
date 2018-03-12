	<?php 
		require 'bconfig.php';
		$imgfolder = "uploads/";
		$bookfilefolder = "books/";
		
		$bookimgfile = $imgfolder . basename($_FILES["uploadimage"]["name"]);
		$upload0k = 1;
		
		$bookfile=$bookfilefolder . basename($_FILES["bookfile"]["name"]);
		$fileup0k=1;
		
		$check = getimagesize($_FILES["uploadimage"]["tmp_name"]);
		if ($check !==false){
			echo "file is an image - " . $check["mime"] . ".";
			$upload0k =1;
		}else {
			echo "File is not an image.";
			$upload0k = 0;
		}
		if (file_exists($bookimgfile)){
			echo "sooory Book Image already exists.";
			$upload0k = 0;
		}
		
		if (file_exists($bookfile)){
			echo "soory Book File alreaty exists.";
			$fileup0k=0;
		}
		
		if ($_FILES["uploadimage"]["size"] > 500000){
			echo  "sooory your file is too large";
			$upload0k=0;
		}
				
			if ($upload0k == 0) {
			    echo "Sorry, your BOOK IMAGE FILE was not uploaded.";
			} else {
			    if (move_uploaded_file($_FILES["uploadimage"]["tmp_name"], $bookimgfile)) {
			        echo "The book image ". basename( $_FILES["uploadimage"]["name"]). " has been uploaded.";
			    } else {
			        echo "Sorry, your book image an error uploading !";
			    }
			}
			
			if ($fileup0k==0){
				echo "soory , your BOOK FILE was not uploaded";
			}else {
				if (move_uploaded_file($_FILES["bookfile"]["tmp_name"], $bookfile)){
					echo "the book file ". basename($_FILES["bookfile"]["name"]) . "has been uploaded.";
				}else {
					echo "Soory , your book file was an error uploading !";
				}
			}
		
		$image = basename($_FILES["uploadimage"]["name"]);
		$bookfileinsert = basename($_FILES["bookfile"]["name"]);
		
		$connector = new mysqli($hostname,$username,$password);
			if ($connector->connect_error)
			{
				die("مشکل در اتصال به پایگاه داده: <br>" . $connector->connect_error);	
			}
			
		if (!mysqli_select_db($connector,"booknab")){die("مشکل در انتخاب جدول پایگاه داده !");}
		
		mysqli_set_charset($connector,"utf8");

		$sql="insert into Books(BName,Author,NumPage,BLang,PublicDate,Translator,BFormat,BSize,ISBN
								,Bpublisher,BPrice,BPrintNum,BSizeType,BPriceType,BImageLink,BFileLink) 
				values('$_POST[bookname]','$_POST[author]','$_POST[pagenumber]','$_POST[radiolang]','$_POST[pubdate]','$_POST[translatorname]'
						,'$_POST[bookformat]','$_POST[booksize]','$_POST[isbn]','$_POST[publishername]','$_POST[price]','$_POST[printnumber]'
						,'$_POST[sizetype]','$_POST[priceradio]','$image','$bookfileinsert')";
			
		if ($connector->query($sql)===true){
			echo "اطلاعات ثبت شد.";
		} else {
			echo "خطا: " . $sql . $connector->error;
		}
		mysqli_close($connector);
		
	?>