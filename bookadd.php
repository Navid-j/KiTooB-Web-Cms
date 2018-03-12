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
	<form class="span10 form-group" action="addnewbook.php" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<div  class="alert alert-info" > 
			<h2>اضافه کردن کتاب جدید</h2>
			<p >
			تمام فیلد هارا بر اساس مشخصات ذکر شده تکمیل نمایید.
			</p>
			</div>
	
					<label for="booknamebox">نام کتاب:</label>
					<input type="text" placeholder="نام کتاب" id="booknamebox" name="bookname" required>
					
					<label for="authorbx">نویسنده:</label>
					<input type="text" placeholder="نام نویسنده" id="authorbx" name="author" required>
					
					<label for="numpage">تعداد صفحات:</label>
					<input type="number" id="numpage" placeholder="تعداد صفحات کتاب" name="pagenumber" required>
					
						<div class="form-inline" style="background-color: #e7eff2;">
							<label>زبان کتاب:</label>
								<label class="radio-inline">
									<input type="radio" name="radiolang" onclick="booklangDisable()" id="fabooklang" value="فارسی" required>
									فارسی
								</label>
								<label class="radio-inline">		
									<input type="radio" name="radiolang" onclick="booklangEnable()" id="enbooklang" value="انگلیسی" required>
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
					<input type="text" id="translator" placeholder="نام مترجم کتاب" name="translatorname" required>
						
					<label for="publicdate">تاریخ انتشار:</label>
					<input type="date" id="publicdate" placeholder="مثال: 2016-08-02" name="pubdate" required>
					
					<div class="form-inline" style="background-color: #e7eff2;">
						<label>فرمت کتاب:</label>
						<label class="radio-inline">
							<input type="radio" id="pdfformat" name="bookformat" value="PDF"  required>
							PDF
						</label>
						<label class="radio-inline">
							<input type="radio" id="epubformat" name="bookformat" value="EPub" required>
							EPub
						</label>
					</div>
					
					<label for="booksizebx">حجم فایل کتاب:</label>
						<input type="number" id="booksizebx" placeholder="فقط عدد" style="width: 150px;" name="booksize" required>
						<select style="width: 80px" name="sizetype">
							<option  >KB</option>
							<option selected="selected" >MB</option>
						</select>
						
					<label for="isbnbx">شابک (ISBN):  شمارهٔ استاندارد بین‌المللی کتاب</label>
					<input type="text" id="isbnbx" placeholder="مثال: 978-3-16-148410-0" name="isbn" required>
					
					<label for="publisher">ناشر:</label>
					<input type="text" id="publisher" placeholder="نام ناشر" name="publishername" required>
					
 					<!--price start -->
 					<div class="form-inline" style="background-color: #e7eff2;">
						<label>قیمت کتاب:</label>
							<label class="radio-inline">
								<input type="radio" id="freebook" name="priceradio" onclick="priceboxdisable()" value="free" required>
								رایگان
							</label>
							<label class="radio-inline">
								<input type="radio" id="nonfree" name="priceradio" onclick="priceboxenable()" value="non-free" required>
								غیر رایگان
							</label>	
						<input type="number" id="pricebox" placeholder="قیمت به تومان" style="width: 150px;" name="price" required>
						<script type="text/javascript">
							function priceboxdisable(){
								document.getElementById("pricebox").disabled= true;
								document.getElementById("pricebox").value="" ;
							}
							function priceboxenable(){
								document.getElementById("pricebox").disabled= false;
							}
						</script>
					</div><!--price start -->
					
					<label for="printnum">تعداد چاپ:</label>
					<input type="number" id="printnum" placeholder="تعداد چاپ کتاب" style="width: 150px;" name="printnumber" required>
					
					<label for="uploadimage">آپلود تصویر کتاب:</label>
					<input type="file" id="uploadimage" name="uploadimage">
					
					<label for="bookfile">آپلود فایل کتاب:</label>
					<input type="file" id="bookfile" name="bookfile">
					
					<div align="center">
						<button type="submit" id="submitbtn" class="btn btn-success">ثبت اطلاعات</button>
						<button type="reset" id="clearbtn" class="btn btn-danger clearfix">خالی کردن فرم</button>
					</div>
					

		</div>

	</form>	
	</div>

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>    
  </body>
</html>