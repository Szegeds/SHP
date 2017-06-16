<?php 
include "../include/include_web.php";
include "../include/check-login.php"; 
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Data Store</title>
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
/* 	td:nth-child(1) { */
/* 		width: 50px; */
/* 	} */
/* 	td:nth-child(2) { */
/* 		width: 180px; */
/* 	} */
/* 	td:nth-child(3) { */
/* 		width: 200px; */
/* 	} */
/* 	td:nth-child(4) { */
/* 		width: 100px; */
/* 	} */
/* 	td:nth-child(5) { */
/* 		width: 220px; */
/* 	} */
/* 	td:nth-child(6) { */
/* 		width: 50px; */
/* 	} */
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
/* 		vertical-align: top; */
/* 		padding: 3px 0px 3px 5px; */
/* 		border-right: solid 1px white; */
/* 	} */
/* 	td:first-child, td:last-child { */
/* 		text-align: center; */
/* 	} */
/* 	td a:hover { */
/* 		color: red; */
/* 	} */
	p#pagenum {
		width: 90%;
		text-align: center;
		margin: 5px;
	}
	#dialog {
		display: none;
		font-size: 14px !important;
	}
	form {
		float: right;
	}
</style>
<script src="js/jquery-2.1.1.min.js"> </script>
<script src="js/jquery.blockUI.js"> </script>
<script>
$(function() {	
	$('a.del').click(function() {
		if(!(confirm("ยืนยันการลบลูกค้ารายนี้"))) {
			return;
		}
		var id = $(this).attr('data-id');
		ajaxSend({'action': 'del', 'cust_id': id});
	});
		
});
function ajaxSend(dataJSON) {
	$.ajax({
		url: 'customer-delete.php',
		data: dataJSON,
		type: 'post',
		dataType:"html",
		beforeSend: function() {
			$.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
		},
		complete: function() {
			$.unblockUI();
			location.reload();
		}
	});
}
</script>
</head>

<body>
<?php include "../include/header.php"; ?>

 <div class="container-fluid">
      <div class="row row-offcanvas row-offcanvas-right">
		<?php include "../include/side_menu.php"; ?>
        <div class="col-12 col-md-9">
<article>
<?php
include "../include/dblink.php";
include "../../lib/pagination.php";

$sql = "SELECT * FROM customers";
$result = page_query($link, $sql, 20);
$first = page_start_row();
$last = page_stop_row();
$total = page_total_rows();
if($total == 0) {
	$first = 0;
}
?>
<table>
<caption>
	<?php 	echo "ลูกค้าลำดับที่  $first - $last จากทั้งหมด $total"; ?>
    <form>
    	<input name="kw">&nbsp;
        <button onClick="javascript: alert('ลองทำด้วยตนเอง')">ค้นหา</button>
        <a class="" id="<?php echo $cust['cust_id']; ?>" href=""><span class="fa fa-search"></span></a>
        
     </form>
</caption>
<tr><th>ลำดับ</th><th>ชื่อลูกค้า</th><th>ที่อยู่</th><th>โทร</th><th>อีเมล</th><th>คำสั่ง</th></tr>
<?php
$row = $first;
while($cust = mysqli_fetch_array($result)) {
?>
<tr>
	<td><?php echo $row; ?></td>
    <td><?php echo $cust['firstname'] . "  " . $cust['lastname']; ?></td>
    <td><?php echo $cust['address']; ?></td>
    <td><?php echo $cust['phone']; ?></td>
    <td><a href="mailto:<?php echo $cust['email']; ?>"><?php echo $cust['email']; ?></a></td>
    <td>
     		<a class="del" id="<?php echo $cust['cust_id']; ?>" href=""><span class="fa fa-trash-o"></span></a>
    </td>
</tr>
<?php
	$row++;
}
?>
</table>
<?php
if(page_total() > 1) { 	 //ให้แสดงหมายเลขเพจเฉพาะเมื่อมีมากกว่า 1 เพจ
	echo '<p id="pagenum">';
	page_echo_pagenums();
	echo '</p>';
}
?>

</article>
</div></div>
</body>
</html>