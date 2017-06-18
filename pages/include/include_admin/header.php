<?php
include "../include_web.php";
?>
<style>
.bg-lavender{
background-color:#FFF;
}
   .navbar {
    -webkit-box-shadow: 0 8px 6px -6px #999;
    -moz-box-shadow: 0 8px 6px -6px #999;
    box-shadow: 0 4px 6px 0px #999;
}
</style>
		<nav
			class="navbar navbar-toggleable-md navbar-light bg-lavender">
			<button class="navbar-toggler navbar-toggler-right" type="button"
				data-toggle="collapse" data-target="#navbarsExampleDefault"
				aria-controls="navbarsExampleDefault" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand btn-outline-success" href="#"><img src="../../images/likesenshop_logo.png" alt="logo" style="width: 50px"> Likesen Shop</a>
				 <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			      Szeged
			    </button>
				<div class="dropdown-menu" aria-labelledby="dropdown01">
					<a class="dropdown-item" href="#">Action</a> 
					<a class="dropdown-item" href="#">Another action</a> 
					<a class="dropdown-item" href="logout.php" title="signout">ออกจากระบบ</a>
				</div>
<div class="hidden-md-up ">
			<div class="collapse navbar-collapse visible-md-down" id="navbarsExampleDefault">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active"><a class="nav-link" href="product.php">รายการสินค้า
							<span class="sr-only">(current)</span>
					</a></li>
					<li class="nav-item"><a class="nav-link" href="category.php">หมวดหมู่สินค้า</a>
					</li>
					<li class="nav-item"><a class="nav-link" href="supplier.php">ผู้จัดส่งสินค้า</a>
					</li>
					<li class="nav-item"><a class="nav-link" href="order.php">รายการสั่งซื้อ</a>
					</li>
					<li class="nav-item"><a class="nav-link" href="payment.php">แจ้งการโอนเงิน</a>
					</li>
					<li class="nav-item"><a class="nav-link" href="customer.php">ข้อมูลลูกค้า</a>
					</li>
					<li class="nav-item">
						<button href="../OnlineStore/" class="btn btn-outline-success my-2 my-sm-0" type="submit">ไปที่ร้านค้า</button>
					</li>
					<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Szeged</a>
						<div class="dropdown-menu" aria-labelledby="dropdown01">
							<a class="dropdown-item" href="#">Action</a> 
							<a class="dropdown-item" href="#">Another action</a> 
							<a class="dropdown-item" href="logout.php" title="signout">ออกจากระบบ</a>
						</div>
					</li>
				</ul>						
			</div>
</div>
		</nav>
