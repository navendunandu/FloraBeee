<?php
ob_start();
include("Head.php");
?>

<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_GET['wid'])){
		$selWish="select * from tbl_wishlist where product_id=".$_GET['wid']." and user_id=".$_SESSION['uid'];;
		$resWish=$Con->query($selWish);
		if($resWish->num_rows>0){
			$del="delete from tbl_wishlist where product_id=".$_GET['wid']." and user_id=".$_SESSION['uid'];	
			if($Con->query($del)){
					?>
                    <script>
					alert("Removed from wishlist")
					window.location="SearchProduct.php"
					</script>
                    <?php
			}
		}
		else{
			$ins="insert into tbl_wishlist (wishlist_date,product_id,user_id) values(curdate(),'".$_GET['wid']."','".$_SESSION['uid']."')";
			if($Con->query($ins)){
					?>
                    <script>
					alert("Added to wishlist")
					window.location="SearchProduct.php"
					</script>
                    <?php
			}	
		}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Base styles for the select element */
.custom-select {
    background-color: #f8f9fa; /* Light gray background */
    border: 1px solid #ced4da; /* Light border */
    border-radius: 0.375rem; /* Rounded corners */
    padding: 0.5rem 1rem; /* Padding for better spacing */
    font-size: 1rem; /* Font size */
    color: #495057; /* Dark gray text color */
    transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out; /* Smooth transition */
}

/* Style when the select is focused */
.custom-select:focus {
    border-color: #80bdff; /* Blue border color on focus */
    outline: none; /* Remove default outline */
    box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25); /* Light blue shadow */
}

/* Styling for options within the select */
.custom-select option {
    padding: 0.5rem; /* Padding for options */
}

/* Custom select arrow */
.custom-select {
    appearance: none; /* Remove default arrow */
    background: url('data:image/svg+xml;charset=utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>') no-repeat right 1rem center;
    background-size: 1rem;
    padding-right: 2.5rem; /* Space for custom arrow */
}

    </style>
</head>
<body onload="search()">
<section class="ftco-menu">
    	<div class="container">
    		<div class="row justify-content-center mb-5">
          <div class="col-md-12  heading-section text-center ftco-animate">
          	<span class="subheading">Discover</span>
            <h2 class="mb-4">Our Products</h2>
            <p>In the virtual world of petals and stems,FloraBeee brings together stunning flower arrangements, shipped directly to your home</p>
            <div class="container">
        <div class="row ">
            <div class="col-md-4">
                <input type="text" class="custom-select" name="txt_product" placeholder="Search Here...." id="txt_product" onchange="search()">
            </div>

            <div class="col-md-2">
                <select class="custom-select" name="txt_occa" id="txt_occa" onchange="search()">
                    <option value="">Select Occasion</option>
                    <?php
                    $selOc = "SELECT * FROM tbl_occassion";
                    $resultOc = $Con->query($selOc);
                    while ($dataOc = $resultOc->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $dataOc['occassion_id'] ?>"><?php echo $dataOc['occassion_name'] ?></option>
                    <?php 
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-2">
                <select class="custom-select" name="txt_type" id="txt_type" onchange="search()">
                    <option value="">Select Type</option>
                    <?php
                    $selTyp = "SELECT * FROM tbl_type";
                    $resultTyp = $Con->query($selTyp);
                    while ($dataTyp = $resultTyp->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $dataTyp['type_id'] ?>"><?php echo $dataTyp['type_name'] ?></option>
                    <?php 
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-2">
                <select class="custom-select" name="txt_colour" id="txt_colour" onchange="search()">
                    <option value="">Select Colour</option>
                    <?php
                    $selClr = "SELECT * FROM tbl_colour";
                    $resultClr = $Con->query($selClr);
                    while ($dataClr = $resultClr->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $dataClr['colour_id'] ?>"><?php echo $dataClr['colour_name'] ?></option>
                    <?php 
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-2">
                <select class="custom-select" name="txt_flower" id="txt_flower" onchange="search()">
                    <option value="">Select Flower</option>
                    <?php
                    $selFlw = "SELECT * FROM tbl_flower";
                    $resultFlw = $Con->query($selFlw);
                    while ($dataFlw = $resultFlw->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $dataFlw['flower_id'] ?>"><?php echo $dataFlw['flower_name'] ?></option>
                    <?php 
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
          </div>
        </div>
    		<div class="row d-md-flex">
	    		<div class="col-lg-12 ftco-animate p-md-5">
		    		<div class="row">
		          
		          <div class="col-md-12 d-flex align-items-center">
		            
		            <div class="tab-content ftco-animate" id="v-pills-tabContent">

		              <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
		              	<div class="row" id="result">
                            <!-- iTEM sTART -->
		              		<div class="col-md-4 text-center">
		              			<div class="menu-wrap">
		              				<a href="#" class="menu-img img mb-4" style="background-image: url(Assets/Templates/Main/images/dish-1.jpg);"></a>
		              				<div class="text">
		              					<h3><a href="#">Grilled Beef</a></h3>
		              					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
		              					<p class="price"><span>$2.90</span></p>
		              					<p><a href="#" onclick="addCart('<?php echo $dataproduct['product_id']?>')" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
		              				</div>
		              			</div>
		              		</div>
		              		<!-- iTEM eND -->
		              	</div>
		              </div>

		              
		          </div>
		        </div>
		      </div>
		    </div>
    	</div>
    </section>
    
    
</body>
</html>
    <script src="../Assets/JQ/jQuery.js"></script>
<script>

    search();

  function search() {
	  var product=document.getElementById('txt_product').value;
	  var occassion=document.getElementById('txt_occa').value;
	  var type = document.getElementById('txt_type').value;
	  var colour=document.getElementById('txt_colour').value;
	  var flower=document.getElementById('txt_flower').value;
	  
	  $.ajax({
      url: "../Assets/AjaxPages/AjaxSearchProduct.php?pname=" + product + "&occa=" + occassion +"&type=" + type + "&colour=" + colour + "&flower=" + flower,
      success: function (result) {

        $("#result").html(result);
      }
    });
  }
  function addCart(pid){
    $.ajax({
        url: '../Assets/AjaxPages/AjaxAddCart.php?id=' + pid,
        success: function(response) {
            alert(response);
        }
    });
}
  
  </script>
<?php
include("Foot.php");
ob_flush();
?>

