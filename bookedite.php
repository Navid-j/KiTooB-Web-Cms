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
	<?php 
	require 'bconfig.php';
	$connector = new mysqli($hostname,$username,$password,$database);
	if ($connector->connect_error){
		die("خطا در اتصال به پایگاه داده: " . $connector_error);
	}
	if (!mysqli_select_db($connector, $database)){
		die("خطادر انتخاب جداول پایگاه داده !");
	}
	
	$bookid=$_REQUEST['bookid'];
	
	mysqli_set_charset($connector, utf8);
	$sql="SELECT * FROM Books WHERE ID=$bookid";
	$result=$connector->query($sql);
	$dbinfo=mysqli_fetch_assoc($result);
	?>

	<div class="container" style="background: #0088cc " >
	<form class="span10 form-group" action="bookupdate.php" method="post" >
		<div class="form-group">
			<div  class="alert alert-info " > 
			<h2>ویرایش کتاب <?php echo" کد:  <input type='number' name='bookid' value='$bookid' style='width:30px' >" ;?></h2>
			<p >
			اطلاعات را ویرایش کنید سپس روی گزینه ثبت تغییرات کلیک نمایید.
			</p>
			</div>				
					<label for="booknamebox">نام کتاب:</label>
					<input type="text" placeholder="نام کتاب" id="booknamebox" name="bookname" required value="<?php echo "{$dbinfo['BName']}";?>">
					
					<label for="authorbx">نویسنده:</label>
					<input type="text" placeholder="نام نویسنده" id="authorbx" name="author" required value="<?php echo "{$dbinfo['Author']}";?>">
					
					<label for="numpage">تعداد صفحات:</label>
					<input type="number" id="numpage" placeholder="تعداد صفحات کتاب" name="pagenumber" required value="<?php echo "{$dbinfo['NumPage']}";?>">
					
						<div class="form-inline" style="background-color: #e7eff2;">
							<label>زبان کتاب:</label>
								<label class="radio-inline">
									<input type="radio" name="radiolang" onclick="booklangDisable()" id="fabooklang" value="فارسی" <?php if ($dbinfo['BLang']=="فارسی"):?> checked="checked" onclick="booklangDisable()"<?php endif;?> required >
									فارسی
								</label>
								<label class="radio-inline">		
									<input type="radio" name="radiolang" onclick="booklangEnable()" id="enbooklang" value="انگلیسی" <?php if ($dbinfo['BLang']=="انگلیسی"):?> checked="checked" onclick="booklangEnable()"<?php endif; ?>required >
									انگلیسی
								</label>
						</div>
							
							<script type="text/javascript">
								function booklangDisable(){
									document.getElementById("translator").disabled= true;
									document.getElementById("translator").value= "";
								}
								function booklangEnable(){
									document.getElementById("translator").disabled= false;
								}
							</script>
							
					<label for="translator">مترجم:</label>
					<input type="text" id="translator" placeholder="نام مترجم کتاب" name="translatorname" required value="<?php echo "{$dbinfo['Translator']}";?>">
						
					<label for="publicdate">تاریخ انتشار:</label>
					<input type="date" id="publicdate" placeholder="مثال: 2016-08-02" name="pubdate" required value="<?php echo "{$dbinfo['PublicDate']}";?>">
					
					<div class="form-inline" style="background-color: #e7eff2;">
						<label>فرمت کتاب:</label>
						<label class="radio-inline">
							<input type="radio" id="pdfformat" name="bookformat" value="PDF"<?php if ($dbinfo['BFormat']=="PDF"):?> checked="checked" <?php endif;?> required>
							PDF
						</label>
						<label class="radio-inline">
							<input type="radio" id="epubformat" name="bookformat" value="EPub" <?php if ($dbinfo['BFormat']=="EPub"):?> checked="checked" <?php endif;?>required>
							EPub
						</label>
					</div>
					
					<label for="booksizebx">حجم فایل کتاب:</label>
						<input type="number" id="booksizebx" placeholder="فقط عدد" style="width: 150px;" name="booksize" required value="<?php echo "{$dbinfo['BSize']}";?>">
						<select style="width: 80px" name="sizetype">
							<option  >KB</option>
							<option selected="selected" >MB</option>
						</select>
						
					<label for="isbnbx">شابک (ISBN):  شمارهٔ استاندارد بین‌المللی کتاب</label>
					<input type="text" id="isbnbx" placeholder="مثال: 978-3-16-148410-0" name="isbn" required value="<?php echo "{$dbinfo['ISBN']}";?>">
					
					<label for="publisher">ناشر:</label>
					<input type="text" id="publisher" placeholder="نام ناشر" name="publishername" required value="<?php echo "{$dbinfo['Bpublisher']}";?>">
					
 					<!--price start -->
 					<div class="form-inline" style="background-color: #e7eff2;">
						<label>قیمت کتاب:</label>
							<label class="radio-inline">
								<input type="radio" id="freebook" name="priceradio" onclick="priceboxdisable()" value="free"<?php if ($dbinfo['BPriceType']=="free"):?> checked="checked" <?php endif;?> required>
								رایگان
							</label>
							<label class="radio-inline">
								<input type="radio" id="nonfree" name="priceradio" onclick="priceboxenable()" value="non-free" <?php if ($dbinfo['BPriceType']=="non-free"):?> checked="checked" <?php endif;?>required>
								غیر رایگان
							</label>	
						<input type="number" id="pricebox" placeholder="قیمت به تومان" style="width: 150px;" name="price" required value="<?php echo "{$dbinfo['BPrice']}";?>">
						<script type="text/javascript">
							function priceboxdisable(){
								document.getElementById("pricebox").disabled= true;
								document.getElementById("pricebox").value="0" ;
							}
							function priceboxenable(){
								document.getElementById("pricebox").disabled= false;
							}
						</script>
					</div><!--price start -->
					
					<label for="printnum">تعداد چاپ:</label>
					<input type="number" id="printnum" placeholder="تعداد چاپ کتاب" style="width: 150px;" name="printnumber" required value="<?php echo "{$dbinfo['BPrintNum']}";?>">
					
					<div align="center">
						<button type="submit" id="submitbtn" class="btn btn-success">ثبت تغییرات</button>
						<button type="reset" id="clearbtn" class="btn btn-danger clearfix">لغو</button>
					</div>
		</div>

	</form>	
	</div>
 <?php mysqli_close($connector);?>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>    
  </body>
</html>