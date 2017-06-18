<?php 
	include "../include/include_web.php"; 
 	include "../include/check-login.php"; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">   
    <link rel="icon" href="../../favicon.ico">

    <title>รายการสินค้่า</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--   <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
/* 	@import "../../global.css"; */
	table th {
		background: #bf80ff;
		color: #fff;
		border: solid 1px #bf80ff;
	}
	tr:nth-of-type(odd) {
		background: #fff;
	}
	tr:nth-of-type(even) {
		background: #fff;
	}
	td {
/* 		vertical-align: top; */
/* 		padding: 3px 0px 3px 5px; */
		border: solid 1px #bf80ff;
	}
	td:first-child, td:first-child {
		text-align: center;
	}
	table tr:hover td {
		color: #fff;
		background: #bf80ff;
		border: solid 1px #fff;
		
	}	
</style>
  </head>

  <body>

<?php include "../include/header.php"; ?>
<br>
    <div class="container-fluid">
      <div class="row row-offcanvas row-offcanvas-right">
		<?php include "../include/side_menu.php"; ?>
        <div class="col-12 col-md-9">
          <article>
<?php
include "../include/dblink.php";
include "../../lib/pagination.php";

$sql = "SELECT * FROM categories";
$r_cat= mysqli_query($link, $sql);
$sql = "SELECT sup_id, sup_name FROM suppliers";
$r_sup = mysqli_query($link, $sql);
?>
<form id="form-search" method="get">
	<div class="row">
		<div class="col-md-4" style=" text-align: right;">
		    <label for="searchPro" >แสดง</label>
		</div>
		<div class="col-md-4">
			<select class="form-control" id="searchPro">
		      <option>ทั้งหมด</option>
		      <option>ราคาสินค้า</option>
		      <option>จำนวนที่มี</option>
		      <option>ชื่อสินค้า</option>
		      <option>หมวดหมู่</option>
			</select>
		</div>		
	</div>
<!-- <input type="radio" name="field" value="1">ทั้งหมด<br> -->

<!-- <input type="radio" name="field" value="price">ราคาสินค้า -->
<!-- <select name="price_op"> -->
<!-- 	<option value="=">=</option> -->
<!--     <option value="<="><=</option> -->
<!--     <option value=">=">>=</option> -->
<!-- </select> -->
<!-- <input type="number" name="price_val" min="0"><br> -->

<!-- <input type="radio" name="field" value="quantity">จำนวนที่มี&nbsp; -->
<!-- <select name="quan_op"> -->
<!-- 	<option value="=">=</option> -->
<!--     <option value="<="><=</option> -->
<!--     <option value=">=">>=</option> -->
<!-- </select> -->
<!-- <input type="number" name="quan_val" min="0"><br> -->


<!-- <input type="radio" name="field" value="pro_name">ชื่อสินค้า -->
<!-- <input type="text" name="pro_key"><br> -->

<!-- <input type="radio" name="field" value="category">หมวดหมู่ -->
<!-- <select name="cat" id="cat-search"> -->
    <?php 
// 	while($cat = mysqli_fetch_array($r_cat)) {
// 		echo "<option value=\"{$cat['cat_id']}\">{$cat['cat_name']}</option>";
// 	}
// 	?>
<!-- </select><br> -->
<!-- <input type="radio" name="field" value="supplier">ผู้จัดส่ง&nbsp;&nbsp; -->
<!-- <select name="sup" id="sup-search"> -->
    <?php 
// 	while($sup = mysqli_fetch_array($r_sup)) {
// 		echo "<option value=\"{$sup['sup_id']}\">{$sup['sup_name']}</option>";
// 	}
// 	?>
<!-- </select> -->
<!-- <input type="hidden" name="field_text" id="field-text"> -->

</form>

 <br>

<button type="button" class="btn btn-outline-success" id="bt-add-pro" data-toggle="modal" data-target="#myModal">เพิ่มสินค้า</button>
<button type="submit" class="btn btn-outline-primary" id="bt-search">แสดงสินค้าตามที่ระบุ</button>
 <br>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลสินค้า</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
	<form id="form-pro">
		<input class="form-control" type="text" name="pro_name" id="pro-name" placeholder="ชื่อสินค้า"><br>
		<textarea class="form-control" name="detail" id="detail" placeholder="รายละเอียดของสินค้า"></textarea><br>
		<input class="form-control" type="text" name="price" id="price" placeholder="ราคาต่อหน่วย">
		<input class="form-control" type="text" name="quantity" id="quantity" placeholder="จำนวนสินค้า"><br>
		<select class="form-control" name="category" id="category">
			<option>หมวดหมู่ของสินค้า</option>
		    <?php 
			mysqli_data_seek($r_cat, 0);
			while($cat = mysqli_fetch_array($r_cat)) {
				echo "<option value=\"{$cat['cat_id']}\">- {$cat['cat_name']}</option>";
			}
			?>
		</select>
		<select class="form-control" name="supplier" id="supplier">
			<option>ผู้จัดส่งสินค้า (Supplier)</option>
		    <?php 
			mysqli_data_seek($r_sup, 0);
			while($sup = mysqli_fetch_array($r_sup)) {
				echo "<option value=\"{$sup['sup_id']}\">- {$sup['sup_name']}</option>";
			}
			?>
		</select>
	<br><br>
		<span id="propname">คุณลักษณะสินค้า (เช่น สี)</span>
		<span id="propval">ค่าของคุณลักษณะ (คั่นด้วย ","  เช่น ฟ้า, ขาว, แดง, ดำ)</span><br>
		<input class="form-control" type="text" name="attr_name[]" class="attr-name" placeholder="ชื่อคุณลักษณะ (1)">
		<input class="form-control" type="text" name="attr_value[]"  class="attr-value" placeholder="ค่าของคุณลักษณะ (1)"><br>
		<input class="form-control" type="text" name="attr_name[]" class="attr-name" placeholder="ชื่อคุณลักษณะ (2)">
		<input class="form-control" type="text" name="attr_value[]" class="attr-value" placeholder="ค่าของคุณลักษณะ (2)"><br>
		<input class="form-control" type="text" name="attr_name[]" class="attr-name" placeholder="ชื่อคุณลักษณะ (3)">
		<input class="form-control" type="text" name="attr_value[]" class="attr-value" placeholder="ค่าของคุณลักษณะ (3)"><br>
	</form>
	<br>
	
	<form id="form-img1" method="post" action="product-image.php" enctype="multipart/form-data">
		ภาพสินค้า #1: <input class="form-control-file" type="file" name="file" id="file1">
	    <button type="submit" id="bt-upload1" class="hidden">อัปโหลดภาพ</button>
	</form>
	<form id="form-img2" method="post" action="product-image.php" enctype="multipart/form-data">
		ภาพสินค้า #2: <input class="form-control-file" type="file" name="file" id="file2">
	    <button type="submit" id="bt-upload2" class="hidden">อัปโหลดภาพ</button>
	</form>
	<form id="form-img3" method="post" action="product-image.php" enctype="multipart/form-data">
		ภาพสินค้า #3: <input class="form-control-file" type="file" name="file" id="file3">
	    <button type="submit" id="bt-upload3" class="hidden">อัปโหลดภาพ</button>
	</form>
	<form id="form-img4" method="post" action="product-image.php" enctype="multipart/form-data">
		ภาพสินค้า #4: <input class="form-control-file" type="file" name="file" id="file4">
	    <button type="submit" id="bt-upload4" class="hidden">อัปโหลดภาพ</button>
	</form>
	<form id="form-img5" method="post" action="product-image.php" enctype="multipart/form-data">
		ภาพสินค้า #5: <input class="form-control-file" type="file" name="file" id="file5">
	    <button type="submit" id="bt-upload5" class="hidden">อัปโหลดภาพ</button>
	</form>
		<p>(ภาพสินค้าจะใช้ภาพแรกเป็นภาพหลัก)</p><br>
      </div>
      <div class="modal-footer">      	
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="bt-send">Save</button> 
      </div>
    </div>
  </div>
</div>




<br>
<?php
$field = "ทั้งหมด";
$sql = "SELECT products.*, categories.cat_name,  suppliers.sup_name 
 			FROM products 
			LEFT JOIN categories 
			ON products.cat_id = categories.cat_id			
			LEFT JOIN suppliers 
			ON products.sup_id = suppliers.sup_id";
if(isset($_GET['field'])){	
	if(($_GET['field'] == "price") && is_numeric($_GET['price_val'])) {
		$sql .= " WHERE price " . $_GET['price_op'] . " " . $_GET['price_val'];
		$field = "ราคา " . $_GET['price_op'] . " " . $_GET['price_val'];
	}
	else if(($_GET['field'] == "quantity") && is_numeric($_GET['quan_val'])) {
		$sql .= " WHERE quantity " . $_GET['quan_op'] . " " . $_GET['quan_val'];
		$field = "จำนวนที่มี " .  $_GET['quan_op'] . " " . $_GET['quan_val'];
	}
	else if(($_GET['field'] == "pro_name") && !empty($_GET['pro_key'])) {
		$sql .= " WHERE pro_name LIKE '%" . $_GET['pro_key'] . "%'";
		$field = "ชื่อสินค้า: '" .  $_GET['pro_key'] . "'";
	}
	else if($_GET['field'] == "category") {
		$sql .= " WHERE products.cat_id = " . $_GET['cat'];
		$field = "หมวดหมู่: " . $_GET['field_text']; 
	}
	else if($_GET['field'] == "supplier") {
		$sql .= " WHERE products.sup_id = " . $_GET['sup'];
		$field = "ผู้จัดส่ง: "  . $_GET['field_text']; 
	}
}
	$sql .= " ORDER BY pro_id DESC";
	$result = page_query($link, $sql, 10);
	$first = page_start_row();
	$last = page_stop_row();
	$total = page_total_rows();
	if($total == 0) {
		$first = 0;
	}

?>

<table border="0" class="table table-hover table-responsive">
<thead>
    <tr>
      <th>No.</th>
      <th>ชื่อสินค้า</th>
      <th>ราคา</th>
      <th>จำนวนที่มี</th>
      <th>รูปภาพ</th>
      <th>รายละเอียด</th>
      <th>หมวดหมู่</th>
      <th>ผู้จัดส่ง</th>
      <th>คุณลักษณะ</th>
      <th>แก้ไข/ลบ</th>
    </tr>
  </thead>
  <tbody>
<caption>
<?php 	echo "สินค้าลำดับที่  $first - $last จาก $total  ($field)"; ?>
</caption>
<colgroup><col id="c1"><col id="c2"><col id="c3"><col id="c4"></colgroup>
<?php
include "../../lib/IMGallery/imgallery-no-jquery.php";
if(isset($first)){	
$row = $first;
}else{
	$row = '';
}
while($pro = mysqli_fetch_array($result)) {
?>
<tr>
	<td><?php echo $row; ?></td>
    <td><?php echo $pro['pro_name']; ?></td>
    <td><?php echo $pro['price']; ?></td> 
    <td><?php echo $pro['quantity']; ?></td> 
    <td>
    <?php
		$sql = "SELECT * FROM images WHERE pro_id = {$pro['pro_id']}";
		$r = mysqli_query($link, $sql);
		if(mysqli_num_rows($r) > 0) {
			echo "<br>";
			$src = "read-image.php?id=";
			gallery_thumb_width(50);
			while($img =mysqli_fetch_array($r)) {
				gallery_echo_img($src . $img['img_id']);
			}
		}
	?> 
    </td> 
    <td><?php echo $pro['detail']; ?></td> 
    <td><?php echo $pro['cat_name']; ?></td> 
    <td><?php echo $pro['sup_name']; ?></td> 
    <td> 
	 <?php
		$sql = "SELECT * FROM attributes WHERE pro_id = {$pro['pro_id']}";
		$r = mysqli_query($link, $sql);
		if(mysqli_num_rows($r) > 0) {
			echo "<br>";
			while($attr =mysqli_fetch_array($r)) {
				echo "- " .  $attr['attr_name'] . ": " . $attr['attr_value'] . "<br>";
			}
		}
		else {
			echo " - <br>";
		}
	?>
    </td>
     <td>
     	<a class="edit" id="<?php echo $pro['pro_id']; ?>" href=""><span class="fa fa-pencil"></span></a>
    	<a class="del" id="<?php echo $pro['pro_id'];?>" href=""><span class="fa fa-trash-o"></span></a>
   
    </td>
</tr>
<?php
	$row++;
}
?>
</tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
<?php
	if(page_total() > 1) { 	 //ให้แสดงหมายเลขเพจเฉพาะเมื่อมีมากกว่า 1 เพจ
		
		echo '<p id="pagenum">';
		page_echo_pagenums();
		echo '</p>';
	}
?>
  </ul>
</nav>
</article>
          
          
      	</div>
	</div>
	
	
	
      <hr>
	<?php include "../include/footer.php"; ?>     

    </div>
<script>


$(document).ready(function() {
	$("#myModal").on('click',function(){
  	$("#myModal").modal();
  }):
});


var fileNo = 1;
var fileCount = 5;

$(function() {
	$('#bt-search').click(function() {
		if($(':radio[name=field]:checked').val() == "category") {
			$('#field-text').val($('#cat-search option:selected').text());
		}
		else if($(':radio[name=field]:checked').val() == "supplier") {
			$('#field-text').val($('#sup-search option:selected').text());
		}
		$('#form-search').submit();
	});
	
	$('#bt-add-pro').click(function() {
 		showDialog();
	});
	
	$('#bt-send').click(function(event) {
		var data = $('#form-pro').serializeArray();
		ajaxSend(data);
	});
	
	fileCount = $('[type=file]').length;
	for(i = 1; i <= fileCount; i++) {
		$('#bt-upload' + i).click(function() {
			uploadFile();
		});
	}
	
	$('a.edit').click(function() {
		var id = $(this).attr('data-id');
		window.open('product-edit.php?id=' + id);
	});
	
	$('a.del').click(function() {
		if(!(confirm("ยืนยันการลบสินค้ารายการนี้"))) {
			return;
		}
		var id = $(this).attr('data-id');
		$.ajax({
			url: 'product-delete.php',
			data: {'action': 'del', 'pro_id': id},
			type: 'post',
			dataType: "html",
			beforeSend: function() {
				$.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
			},
			success: function(result) {
				location.reload();
			},
			complete: function() {
				$.unblockUI();
			}
		})			
	});
	
});

function resetForm() {
	$('#form-pro')[0].reset();
// 	$('input:file').clearInputs();  //อยู่ในไลบรารี form.js

	$('input:file').not(':button, :submit, :reset, :hidden')
	$('input:file').val('')
	$('input:file').removeAttr('checked')
	$('input:file').removeAttr('selected');
}

function showDialog() {
	fileNo = 1;
	resetForm();
	$('#dialog').dialog({
		title: 'เพิ่มสินค้า',
		width: 'auto',
		modal: true,
		position: { my: "center top", at: "center top", of: $('nav')}
	});	
}

function ajaxSend(dataJSON) {
	$.ajax({
		url: 'product-add.php',
		data: dataJSON,
		type: 'post',
		dataType: "html",
		beforeSend: function() {
			$.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
		},
		success: function(result) {
			$('#bt-upload' + fileNo).click();
		},
		complete: function() {
			//$.unblockUI();
		}
	});
}

function uploadFile() {
	if(fileNo > fileCount) {
		return;
	}
	var input = '#file' + fileNo;
	$('#form-img'  + fileNo).ajaxForm({
		dataType: 'html',
		beforeSend: function() {
			if($(input).val().length != 0) {
				$.blockUI({message:'<h3>กำลังอัปโหลดภาพที่ ' + fileNo + '</h3>'});
			}
		}, 
		success: function(result) {	},
		complete: function() { 
			fileNo++;
			if(fileNo <= fileCount) {
				$('#bt-upload' + fileNo).click();
			}
			else {
				fileNo = 1;
				$('#dialog').dialog('close');
				$.unblockUI();
				location.reload();
			}
		}			
	});
}
</script>
  </body>
</html>
