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
	caption {
		text-align: left;
		padding-bottom: 3px;
	}
	caption button {
		float: right;
	}
	#c1 {
		width: 100px;
	}
	#c2 {
		width: 350px;
	}
	#c3 {
		width: 150px;
	}
/* 	table th { */
/* 		background: green; */
/* 		color: yellow; */
/* 		padding: 5px; */
/* 		border-right: solid 1px white; */
/* 		font-size:12px; */
/* 	} */
/* 	tr:nth-of-type(odd) { */
/* 		background: lavender; */
/* 	} */
/* 	tr:nth-of-type(even) { */
/* 		background: whitesmoke; */
/* 	} */
/* 	td { */
/* 		vertical-align: middle; */
/* 		padding: 3px 0px 3px 10px; */
/* 		border-right: solid 1px white; */
/* 	} */
/* 	td:nth-child(odd) { */
/* 		text-align: center; */
/* 	} */
	p#pagenum {
		width: 90%;
		text-align: center;
		margin: 5px;
	}
</style>
  </head>

  <body>

<?php include "../include/include_admin/header.php"; ?>
<br>
    <div class="container-fluid">
      <div class="row row-offcanvas row-offcanvas-right">
		<?php include "../include/include_admin/side_menu.php"; ?>
        <div class="col-12 col-md-9">
          <article>
<?php
include "../include/dblink.php";
include "../../lib/pagination.php";

$sql = "SELECT * FROM categories";
$result = page_query($link, $sql, 20);
$first = page_start_row();
$last = page_stop_row();
$total = page_total_rows();
if($total == 0) {
	$first = 0;
}
?>
<table border="0" class="table table-hover table-responsive">
<caption>
	<?php 	echo "หมวดหมู่ลำดับที่  $first - $last จากทั้งหมด $total"; ?>
	<button id="add-cat">เพิ่มหมวดหมู่</button>
</caption>
<colgroup><col id="c1"><col id="c2"><col id="c3"></colgroup>
<tr><th>รหัส</th><th>ชื่อหมวดสินค้า</th><th>คำสั่ง</th></tr>
<?php
while($cat = mysqli_fetch_array($result)) {
?>
<tr>
 	<td><?php echo $cat['cat_id']; ?></td>
    <td><?php echo $cat['cat_name']; ?></td>
    <td>	
    <a class="edit" id="<?php echo $cat['cat_id']; ?>" href=""><span class="fa fa-pencil"></span></a>
    <a class="del" id="<?php echo $cat['cat_id']; ?>" href=""><span class="fa fa-trash-o"></span></a>
   
    </td>
</tr>
<?php
}
?>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">

<?php
if(page_total() > 1) { 	 //ให้แสดงหมายเลขเพจเฉพาะเมื่อมีมากกว่า 1 เพจ
	echo '<li class="page-item"><p id="pagenum">';
	page_echo_pagenums();
	echo '</p></li>';
}
?>
</ul>
</nav>
</article>
          
          
      	</div>
	</div>
	
	
	
      <hr>
	<?php include "../include/include_admin/footer.php"; ?>     

    </div>
<script>
$(function() {
	$('#add-cat').click(function() {
		var cat = prompt("กรุณากำหนดชื่อหมวด", "");
		if(cat) { 	
		 	ajaxSend({'action': 'add', 'cat':cat});  
		}
	});

	$('a.edit').click(function() {
		var cat = prompt("กรุณากำหนดชื่อใหม่สำหรับหมวดนี้", "");
		if(cat) {
			var id = $(this).attr('data-id');
			ajaxSend({'action': 'edit', 'cat':cat, 'cat_id': id});
		}
	});	
	
	$('a.del').click(function() {
		if(confirm("ยืนยันที่จะลบหมวดนี้")) {
			var id = $(this).attr('data-id');
			ajaxSend({'action': 'del', 'cat_id': id});
		}
	});
		
});
function ajaxSend(dataJSON) {
	$.ajax({
		url: 'category-action.php',
		data: dataJSON,
		type: 'post',
		dataType:"html",
		beforeSend: function() {
			$.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
		},
		success: function(result) {
				
		},
		complete: function() {
			$.unblockUI();
			location.reload();
		}
	});
}
</script>
  </body>
</html>
