<?php
include 'core/init.php';
include 'includes/header.php';
include 'includes/headerfull.php';?>

<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInLeft;">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Products</li>
			</ol>
		</div>
	</div>
<!--content-->
<div class="products">
	<div class="container">
		<h2>Products</h2>
		<div class="col-md-9">
						<?php
						$sqlp = "SELECT * FROM products WHERE products_page = 0";
						$products = $db->query($sqlp);
						while($products_are = mysqli_fetch_assoc($products)):
						if($products_are['id'] == 1 || $products_are['id']%4 == 0):?>
			<div class="content-top1">
			<?php endif;?>
				<div class="col-md-4 col-md4">
					<div class="col-md1 simpleCart_shelfItem">
						<a href="single.php?pid=<?=$products_are['id']?>">
							<img class="img-responsive" src="<?=$products_are['image'];?>" alt="" />
						</a>
						<h3><a href="single.php?pid=<?=$products_are['id']?>"><?=$products_are['title'];?></a></h3>
						<div class="price">
								<h5 class="item_price">Rs <?=$products_are['price'];?></h5>
								<a href="#" class="item_add">Add To Cart</a>
								<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<?php if($products_are['id']%3 == 0 && $products_are['id']!=1):?>	
					<div class="clearfix"> </div>
			</div>
		<?php endif;?>
			<?php endwhile;?>	
			<!--div class="content-top1">
				<div class="col-md-4 col-md4">
					<div class="col-md1 simpleCart_shelfItem">
						<a href="single.php">
							<img class="img-responsive" src="images/pi1.png" alt="" />
						</a>
						<h3><a href="single.php">Trouser</a></h3>
						<div class="price">
								<h5 class="item_price">$300</h5>
								<a href="#" class="item_add">Add To Cart</a>
								<div class="clearfix"> </div>
						</div>
					</div>
				</div>	
			<div class="col-md-4 col-md4">
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
			<div class="col-md-4 col-md4">
					<div class="col-md1 simpleCart_shelfItem">
						<a href="single.php">
							<img class="img-responsive" src="images/pi12.png" alt="" />
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
			</div>	
			<div class="content-top1">
				<div class="col-md-4 col-md4">
					<div class="col-md1 simpleCart_shelfItem">
						<a href="single.php">
							<img class="img-responsive" src="images/pi9.png" alt="" />
						</a>
						<h3><a href="single.php">Trouser</a></h3>
						<div class="price">
								<h5 class="item_price">$300</h5>
								<a href="#" class="item_add">Add To Cart</a>
								<div class="clearfix"> </div>
						</div>
					</div>
				</div>	
			<div class="col-md-4 col-md4">
					<div class="col-md1 simpleCart_shelfItem">
						<a href="single.php">
							<img class="img-responsive" src="images/pi11.png" alt="" />
						</a>
						<h3><a href="single.php">Jeans</a></h3>
						<div class="price">
								<h5 class="item_price">$300</h5>
								<a href="#" class="item_add">Add To Cart</a>
								<div class="clearfix"> </div>
						</div>
						
					</div>
				</div>	
			<div class="col-md-4 col-md4">
					<div class="col-md1 simpleCart_shelfItem">
						<a href="single.php">
							<img class="img-responsive" src="images/pi10.png" alt="" />
						</a>
						<h3><a href="single.php">Trouser</a></h3>
						<div class="price">
								<h5 class="item_price">$300</h5>
								<a href="#" class="item_add">Add To Cart</a>
								<div class="clearfix"> </div>
						</div>
						
					</div>
				</div>	
			
			<div class="clearfix"> </div>
			</div-->	
		</div>
		<div class="col-md-3 product-bottom">
			<!--categories-->
				<div class=" rsidebar span_1_of_left">
						<h3 class="cate">Categories</h3>
							 <ul class="menu-drop">
							 	<?php
							 	$sql = "SELECT * FROM navigation";
							 	$pitem = $db->query($sql);
							 	while($item = mysqli_fetch_assoc($pitem)):
							 		$parent_id = $item['id'];
							 	?>
							<li class="item1"><a href="#"><?=$item['navitem'];?></a>
								<ul class="cute">
									<?php
									$sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
									$citem = $db->query($sql2);
									while($child = mysqli_fetch_assoc($citem)): 
									?>
									<li class="subitem1"><a href="single.php"><?= $child['name']?></a></li>
								<?php endwhile;?>
									<!--li class="subitem2"><a href="single.php">Strange Stuff </a></li>
									<li class="subitem3"><a href="single.php">Automatic Fails </a></li-->
								</ul>
							</li>
						<?php endwhile;?>
							<!--li class="item2"><a href="#">Women </a>
								<ul class="cute">
									<li class="subitem1"><a href="single.php">Cute Kittens </a></li>
									<li class="subitem2"><a href="single.php">Strange Stuff </a></li>
									<li class="subitem3"><a href="single.php">Automatic Fails </a></li>
								</ul>
							</li>
							<li class="item3"><a href="#">Kids</a>
								<ul class="cute">
									<li class="subitem1"><a href="single.php">Cute Kittens </a></li>
									<li class="subitem2"><a href="single.php">Strange Stuff </a></li>
									<li class="subitem3"><a href="single.php">Automatic Fails</a></li>
								</ul>
							</li>
							<li class="item4"><a href="#">Accessories</a>
								<ul class="cute">
									<li class="subitem1"><a href="single.php">Cute Kittens </a></li>
									<li class="subitem2"><a href="single.php">Strange Stuff </a></li>
									<li class="subitem3"><a href="single.php">Automatic Fails</a></li>
								</ul>
							</li>
									
							<li class="item4"><a href="#">Shoes</a>
								<ul class="cute">
									<li class="subitem1"><a href="product.php">Cute Kittens </a></li>
									<li class="subitem2"><a href="product.php">Strange Stuff </a></li>
									<li class="subitem3"><a href="product.php">Automatic Fails </a></li>
								</ul>
							</li-->
						</ul>
					</div>
				<!--initiate accordion-->
						<script type="text/javascript">
							$(function() {
							    var menu_ul = $('.menu-drop > li > ul'),
							           menu_a  = $('.menu-drop > li > a');
							    menu_ul.hide();
							    menu_a.click(function(e) {
							        e.preventDefault();
							        if(!$(this).hasClass('active')) {
							            menu_a.removeClass('active');
							            menu_ul.filter(':visible').slideUp('normal');
							            $(this).addClass('active').next().stop(true,true).slideDown('normal');
							        } else {
							            $(this).removeClass('active');
							            $(this).next().stop(true,true).slideUp('normal');
							        }
							    });
							
							});
						</script>
<!--//menu-->
<!--seller-->
				<div class="product-bottom">
						<h3 class="cate">Best Sellers</h3>
					<div class="product-go">
						<div class=" fashion-grid">
							<a href="single.php"><img class="img-responsive " src="images/pr.jpg" alt=""></a>	
						</div>
						<div class=" fashion-grid1">
							<h6 class="best2"><a href="single.php" >Lorem ipsum dolor sitamet consectetuer  </a></h6>
							<span class=" price-in1"> $40.00</span>
						</div>	
						<div class="clearfix"> </div>
					</div>
					<div class="product-go">
						<div class=" fashion-grid">
							<a href="single.php"><img class="img-responsive " src="images/pr1.jpg" alt=""></a>	
						</div>
						<div class=" fashion-grid1">
							<h6 class="best2"><a href="single.php" >Lorem ipsum dolor sitamet consectetuer  </a></h6>
							<span class=" price-in1"> $40.00</span>
						</div>	
						<div class="clearfix"> </div>
					</div>
					<div class="product-go">
						<div class=" fashion-grid">
							<a href="single.php"><img class="img-responsive " src="images/pr2.jpg" alt=""></a>	
						</div>
						<div class=" fashion-grid1">
							<h6 class="best2"><a href="single.php" >Lorem ipsum dolor sitamet consectetuer  </a></h6>
							<span class=" price-in1"> $40.00</span>
						</div>	
						<div class="clearfix"> </div>
					</div>	
					<div class="product-go">
						<div class=" fashion-grid">
							<a href="single.php"><img class="img-responsive " src="images/pr3.jpg" alt=""></a>	
						</div>
						<div class=" fashion-grid1">
							<h6 class="best2"><a href="single.php" >Lorem ipsum dolor sitamet consectetuer  </a></h6>
							<span class=" price-in1"> $40.00</span>
						</div>	
						<div class="clearfix"> </div>
					</div>		
				</div>

<!--//seller-->
<!--tag-->
				<div class="tag">	
						<h3 class="cate">Tags</h3>
					<div class="tags">
						<ul>
							<li><a href="#">design</a></li>
							<li><a href="#">fashion</a></li>
							<li><a href="#">lorem</a></li>
							<li><a href="#">dress</a></li>
							<li><a href="#">fashion</a></li>
							<li><a href="#">dress</a></li>
							<li><a href="#">design</a></li>
							<li><a href="#">dress</a></li>
							<li><a href="#">design</a></li>
							<li><a href="#">fashion</a></li>
							<li><a href="#">lorem</a></li>
							<li><a href="#">dress</a></li>
						<div class="clearfix"> </div>
						</ul>
				</div>					
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<!--//content-->
<?php
include 'includes/footer.php';
?>