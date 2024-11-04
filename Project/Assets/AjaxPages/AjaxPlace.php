<option value="">Select Place</option>
<?php
include("../Connection/Connection.php"); 
 $selQry = "select * from tbl_place where district_id=".$_GET['did'];
 $result=$Con->query($selQry);
		while($data=$result->fetch_assoc())
		{
		?>
        <option  value="<?php echo $data['place_id'] ?>"><?php echo $data['place_name']; ?></option>
    <?php
		}
		?>