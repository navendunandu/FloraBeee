<?php
include('../Connection/Connection.php');
session_start();

$pname = $_GET['pname'];
$occa = $_GET['occa'];
$type = $_GET['type'];
$colour = $_GET['colour'];
$flower = $_GET['flower'];

$selproduct = "SELECT * FROM tbl_product p 
INNER JOIN tbl_occassion o ON p.occassion_id = o.occassion_id 
INNER JOIN tbl_type t ON p.type_id = t.type_id 
INNER JOIN tbl_colour c ON p.colour_id = c.colour_id 
INNER JOIN tbl_flower f ON p.flower_id = f.flower_id 
WHERE TRUE";

if ($occa != "") {
    $selproduct .= " AND p.occassion_id = " . $occa;    
}
if ($pname != "") {
    $selproduct .= " AND p.product_name LIKE '%$pname%'";    
}
if ($type != "") {
    $selproduct .= " AND p.type_id = " . $type;    
}
if ($colour != "") {
    $selproduct .= " AND p.colour_id = " . $colour;    
}
if ($flower != "") {
    $selproduct .= " AND p.flower_id = " . $flower;    
}

$resultproduct = $Con->query($selproduct);
?>

<div class="row">
    <?php while ($dataproduct = $resultproduct->fetch_assoc()) {
        $id = $dataproduct['product_id'];
        
        // Get total cart quantity
        $cart = "SELECT SUM(cart_qty) AS cart_total FROM tbl_cart WHERE product_id = '$id'";
        $cresult = $Con->query($cart);
        $cdata = $cresult->fetch_assoc();

        // Get total stock quantity
        $Stock = "SELECT SUM(stock_qty) AS total_stock FROM tbl_stock WHERE product_id = '$id'";
        $sresult = $Con->query($Stock);
        $sdata = $sresult->fetch_assoc();
        
        $rem = $sdata['total_stock'] - $cdata['cart_total'];
    ?>
        <div class="col-md-4 mb-4 text-center">
            <div class="menu-wrap">
			<a href="#" class="menu-img" style="
    background-image: url(../Assets/Files/Seller/Product/<?php echo $dataproduct['product_photo']; ?>); 
    background-size: contain; 
    background-repeat: no-repeat; 
    background-position: center; 
    display: inline-block; /* Make sure the anchor behaves like a block element */
    width: 200px; /* Set a specific width */
    height: 200px; /* Set a specific height */
"></a>

                <div class="text">
                    <h3><a href="#"><?php echo $dataproduct['product_name']; ?></a></h3>
                    <p class="text-dark"><?php echo $dataproduct['product_details']; ?></p>
                    <p class="price"><span><?php echo $dataproduct['product_price']; ?></span></p>
					<?php
										
											
										$average_rating = 0;
										$total_review = 0;
										$five_star_review = 0;
										$four_star_review = 0;
										$three_star_review = 0;
										$two_star_review = 0;
										$one_star_review = 0;
										$total_rating_value = 0;
										$review_content = array();
									
										$query = "SELECT * FROM tbl_rating where product_id = '".$dataproduct["product_id"]."' ORDER BY rating_id  DESC";
									
										$result = $Con->query($query);
									
										while($row = $result->fetch_assoc())
										{
											
									
											if($row["rating_value"] == '5')
											{
												$five_star_review++;
											}
									
											if($row["rating_value"] == '4')
											{
												$four_star_review++;
											}
									
											if($row["rating_value"] == '3')
											{
												$three_star_review++;
											}
									
											if($row["rating_value"] == '2')
											{
												$two_star_review++;
											}
									
											if($row["rating_value"] == '1')
											{
												$one_star_review++;
											}
									
											$total_review++;
									
											$total_rating_value = $total_rating_value + $row["rating_value"];
									
										}
										
										
										if($total_review==0 || $total_rating_value==0 )
										{
											$average_rating = 0 ; 			
										}
										else
										{
											$average_rating = $total_rating_value / $total_review;
										}
										
										?>
										<p align="center" style="color:#F96;font-size:20px">
									   <?php
									   if($average_rating==5 || $average_rating==4.5)
									   {
										   ?>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
										   <?php
									   }
									   if($average_rating==4 || $average_rating==3.5)
									   {
										   ?>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
										   <?php
									   }
									   if($average_rating==3 || $average_rating==2.5)
									   {
										   ?>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
										   <?php
									   }
									   if($average_rating==2 || $average_rating==1.5)
									   {
										   ?>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
										   <?php
									   }
									   if($average_rating==1)
									   {
										   ?>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
										   <?php
									   }
									   if($average_rating==0)
									   {
										   ?>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
											<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
										   <?php
									   }
									   ?>
									   
									</p>
                    
						<?php
						if($rem>0){
						?>

                        <button type="button" onclick="addCart(<?php echo $id; ?>)" class="btn btn-primary btn-outline-primary">Add to cart</button>
						<?php
						}
						else{
							echo "<span class=' text-danger' >Out of stock</span>";
						}
						?>
                        <a href="SearchProduct.php?wid=<?php echo $id; ?>" class="btn btn-outline-danger" title="Add to Wishlist">
                            <i class="fas fa-heart"></i>
                        </a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<!-- Include Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
