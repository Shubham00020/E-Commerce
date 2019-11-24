<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
require_once 'core/init.php';
include 'includes/header.php';
include 'includes/headerfull.php';
include 'includes/banner.php';
?>
<!--content-->
<div class="content">
	<div class="container">
		<div class="content-top">
			<div class="content-top1">
				<?php
					$sql1 = "SELECT * FROM products WHERE featured = 0";
					$featuredp = $db->query($sql1);
					$count = 0;
					while($ids = mysqli_fetch_assoc($featuredp)):
						$count = $count+1;
						if($count == 2){
							echo '<div class="col-md-6 animated wow fadeInDown animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
								<div class="col-md3">
									<div class="up-t">
										<h3>Flat 50% Offer</h3>
									</div>
								</div>
							</div>';						
						}
						//if($count == 7){
						//	break;
						//}
				?>
				<?php if($count == 2||$count == 5||$count == 6){
					echo '<div class="col-md-3 col-md2 animated wow fadeInRight" data-wow-delay=".5s">';
				}
				else{
					echo '<div class="col-md-3 col-md2 animated wow fadeInLeft" data-wow-delay=".5s">';
				}?>
					<div class="col-md1 simpleCart_shelfItem">
						<a href="single.php?pid=<?=$ids['id']?>">
							<img class="img-responsive" style="width:200px;height:260px" src="<?=$ids['image'];?>" alt="" />
						</a>
						<h3><a href="single.php?pid=<?=$ids['id']?>"><?=$ids['title'];?></a></h3>
						<div class="price">
								<h5 class="item_price">Rs <?=$ids['price'];?></h5>
								<a href="#" class="item_add">Add To Cart</a>
								<div class="clearfix"> </div>
						</div>
					</div>
				</div>
				<?php
				if($count == 2||$count == 6){
					echo '<div class="clearfix"> </div></div>';
				}
				endwhile;?>

			<!--div class="col-md-3 col-md2 animated wow fadeInRight" data-wow-delay=".5s">
					<div class="col-md1 simpleCart_shelfItem">
						<a href="single.php">
							<img class="img-responsive" src="images/pi4.png" alt="" />
						</a>
						<h3><a href="single.php">Pant</a></h3>
						<div class="price">
								<h5 class="item_price">$300</h5>
								<a href="#" class="item_add">Add To Cart</a>
								<div class="clearfix"> </div>
						</div>
					</div>
				</div-->	
			
				
			<!--div class="content-top1">
				<div class="col-md-3 col-md2 animated wow fadeInLeft" data-wow-delay=".5s">
					<div class="col-md1 simpleCart_shelfItem">
						<a href="single.php">
							<img class="img-responsive" src="images/pi3.png" alt="" />
						</a>
						<h3><a href="single.php">Palazoo</a></h3>
						<div class="price">
								<h5 class="item_price">$300</h5>
								<a href="#" class="item_add">Add To Cart</a>
								<div class="clearfix"> </div>
						</div>
					</div>
				</div>	
			<div class="col-md-3 col-md2 animated wow fadeInLeft" data-wow-delay=".5s">
					<div class="col-md1 simpleCart_shelfItem">
						<a href="single.php">
							<img class="img-responsive" src="images/pi2.png" alt="" />
						</a>
						<h3><a href="single.php">Trouser</a></h3>
						<div class="price">
								<h5 class="item_price">$300</h5>
								<a href="#" class="item_add">Add To Cart</a>
								<div class="clearfix"> </div>
						</div>
					</div>
				</div>	
			<div class="col-md-3 col-md2 animated wow fadeInRight" data-wow-delay=".5s">
					<div class="col-md1 simpleCart_shelfItem">
						<a href="single.php">
							<img class="img-responsive" src="images/pi6.png" alt="" />
						</a>
						<h3><a href="single.php">Trouser</a></h3>
						<div class="price">
								<h5 class="item_price">$300</h5>
								<a href="#" class="item_add">Add To Cart</a>
								<div class="clearfix"> </div>
						</div>
					</div>
				</div>	
			<div class="col-md-3 col-md2 cmn animated wow fadeInRight" data-wow-delay=".5s">
					<div class="col-md1 simpleCart_shelfItem">
						<a href="single.php">
							<img class="img-responsive" src="images/pi8.png" alt="" />
						</a>
						<h3><a href="single.php">Palazoo</a></h3>
						<div class="price">
								<h5 class="item_price">$300</h5>
								<a href="#" class="item_add">Add To Cart</a>
								<div class="clearfix"> </div>
						</div>
					</div>
				</div>	
			<div class="clearfix"> </div>
			</div-->			
<div class="clearfix"></div>
		</div>
	</div>
</div>
<?php
include 'includes/offers.php';
echo '</br>';
?>
	<!--div class="c-btm">
		<!--div class="content-top"-->
		<!--div class="content-top1">
			<div class="container">
					<?php
					//$sql1 = "SELECT * FROM products WHERE featured = 1";
					//$featuredp = $db->query($sql1);
					//$count = 0;
					//while($ids = mysqli_fetch_assoc($featuredp)):
					//	$count = $count+1;
				?>
				<?php //if($count == 3||$count == 4){
					//echo '<div class="col-md-3 col-md2 animated wow fadeInRight" data-wow-delay=".5s">';
				//}
				//else{
				//	echo '<div class="col-md-3 col-md2 animated wow fadeInLeft" data-wow-delay=".5s">';
				//}?>
					<div class="col-md1 simpleCart_shelfItem">
						<a href="">
							<img class="img-responsive" src="" alt="" />
						</a>
						<h3><a href=""></a></h3>
						<div class="price">
								<h5 class="item_price">Rs </h5>
								<a href="#" class="item_add">Add To Cart</a>
								<div class="clearfix"> </div>
						</div>
					</div>
				</div-->
				<?php
				//if($count == 4){
				//	echo '<div class="clearfix"> </div></div>';
				//}
				//endwhile;?>

		<!--div class="content-top1">
			<div class="container">
				<div class="col-md-3 col-md2 animated wow fadeInLeft" data-wow-delay=".5s">
					<div class="col-md1 simpleCart_shelfItem">
						<a href="single.php">
							<img class="img-responsive" src="images/pi9.png" alt="" />
						</a>
						<h3><a href="single.php">Trousers</a></h3>
						<div class="price">
								<h5 class="item_price">$300</h5>
								<a href="#" class="item_add">Add To Cart</a>
								<div class="clearfix"> </div>
						</div>
						
					</div>
				</div>	
			<div class="col-md-3 col-md2 animated wow fadeInLeft" data-wow-delay=".5s">
					<div class="col-md1 simpleCart_shelfItem">
						<a href="single.php">
							<img class="img-responsive" src="images/pi10.png" alt="" />
						</a>
						<h3><a href="single.php">Formal</a></h3>
						<div class="price">
								<h5 class="item_price">$450</h5>
								<a href="#" class="item_add">Add To Cart</a>
								<div class="clearfix"> </div>
						</div>
						
					</div>
				</div>	
			<div class="col-md-3 col-md2 animated wow fadeInRight" data-wow-delay=".5s">
					<div class="col-md1 simpleCart_shelfItem">
						<a href="single.php">
							<img class="img-responsive" src="images/pi11.png" alt="" />
						</a>
						<h3><a href="single.php">Trousers</a></h3>
						<div class="price">
								<h5 class="item_price">$350</h5>
								<a href="#" class="item_add">Add To Cart</a>
								<div class="clearfix"> </div>
						</div>
						
					</div>
				</div>	
			<div class="col-md-3 col-md2 animated wow fadeInRight" data-wow-delay=".5s">
					<div class="col-md1 simpleCart_shelfItem">
						<a href="single.php">
							<img class="img-responsive" src="images/pi12.png" alt="" />
						</a>
						<h3><a href="single.php">Formal</a></h3>
						<div class="price">
								<h5 class="item_price">$400</h5>
								<a href="#" class="item_add">Add To Cart</a>
								<div class="clearfix"> </div>
						</div>
						
					</div>
				</div>	 <!--/div>
			</div-->	
	<!--/div-->
<?php
include 'includes/footer.php';
?>