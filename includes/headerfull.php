<?php
$sql = "SELECT * FROM navigation";
$pquery = $db->query($sql);
?>
<!--header-->
<div class="header">
	<div class="header-top">
		<div class="container">
				<div class="col-sm-4 logo animated wow fadeInLeft" data-wow-delay=".5s">
					<h1><a href="index.php">Youth <span>Fashion</span></a></h1>	
				</div>
			<div class="col-sm-4 world animated wow fadeInRight" data-wow-delay=".5s">
					<div class="cart box_1">
						<a href="checkout.php">
						<h3> <div class="total">
							<span class="simpleCart_total"></span></div>
							<img src="images/cart.png" alt=""/></h3>
						</a>
						<p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>

					</div>
			</div>
			<div class="col-sm-2 number animated wow fadeInRight" data-wow-delay=".5s">
					<span><i class="glyphicon glyphicon-phone"></i>123456789</span>
					<p>Call me</p>
				</div>
			<div class="col-sm-2 search animated wow fadeInRight" data-wow-delay=".5s">		
				<a class="play-icon popup-with-zoom-anim" href="#small-dialog"><i class="glyphicon glyphicon-search"> </i> </a>
			</div>
				<div class="clearfix"> </div>
		</div>
	</div>
		<div class="container">
			<div class="head-top">
			<div class="n-avigation">
			
				<nav class="navbar nav_bottom" role="navigation">
				
				 <!-- Brand and toggle get grouped for better mobile display -->
				  <div class="navbar-header nav_2">
					  <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <a class="navbar-brand" href="#"></a>
				   </div> 
				   <!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
						<ul class="nav navbar-nav nav_1">
							<li><a href="index.php">Home</a></li>
							<?php while($navitem = mysqli_fetch_assoc($pquery)): 
							//if ($navitem['id'] > 2) {
							//	break;
							//}
							?>
							<?php
								$id = $navitem['id'];
								$sql2 = "SELECT * FROM categories WHERE parent = '$id' ORDER BY name";
								$cquery = $db->query($sql2);
							?>
					        <li class="dropdown">
					          <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><?php echo $navitem['navitem'];?><span class="caret"></span></a>
					          <ul class="dropdown-menu">
								<?php while($child = mysqli_fetch_assoc($cquery)):?>
					            <li><a href="#"><?=$child['name']?></a></li>
								<?php endwhile; ?>	
					          </ul>
					        </li>
							<?php endwhile;?>
								<!--li class="dropdown mega-dropdown active">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Men<span class="caret"></span></a>				
								<div class="dropdown-menu mega-dropdown-menu">
									<div class="container-fluid"-->
										<!-- Tab panes -->
										<!--div class="tab-content">
										  <div class="tab-pane active" id="men">
											<ul class="nav-list list-inline">
												<li><a href="men.php"><img src="images/t10.jpg" class="img-responsive" alt=""/></a></li>
												<li><a href="men.php"><img src="images/t2.jpg" class="img-responsive" alt=""/></a></li>
												<li><a href="men.php"><img src="images/t3.jpg" class="img-responsive" alt=""/></a></li>
												<li><a href="men.php"><img src="images/t4.jpg" class="img-responsive" alt=""/></a></li>
												<li><a href="men.php"><img src="images/t5.jpg" class="img-responsive" alt=""/></a></li>
												<li><a href="men.php"><img src="images/t6.jpg" class="img-responsive" alt=""/></a></li>
											</ul>
										  </div>
										 
									   </div>
									</div-->
									<!-- Nav tabs -->
									                   
								<!--/div>				
							</li-->
							<li><a href="products.php">Products</a></li>
							<li><a href="account.php">Sign In</a></li>
							<li class="last"><a href="contact.php">Contact</a></li>
						</ul>
					 </div><!-- /.navbar-collapse -->
				  
				</nav>
			</div>
			
				
		<div class="clearfix"> </div>
			<!---pop-up-box---->   
					<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
					<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
					<!---//pop-up-box---->
				<div id="small-dialog" class="mfp-hide">
				<div class="search-top">
						<div class="login">
							<form action="#" method="post">
								<input type="submit" value="">
								<input type="text" name="search" value="Type something..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">		
							
							</form>
						</div>
						<p>	Shopping</p>
					</div>				
				</div>
				 <script>
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});
																						
						});
				</script>			
	<!---->		
		</div>
	</div>
</div>
