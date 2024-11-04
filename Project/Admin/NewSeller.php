<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/Connection.php");
if(isset($_GET['aid'])){
$upQry=" update tbl_seller set seller_status ='1' where seller_id=".$_GET['aid'];
	if($Con->query($upQry))
	{
		?>
    	<script>
		alert("Accepted")
		window.location="NewSeller.php";
		</script>
    <?php	
	}
}
	if(isset($_GET['rid'])){
	$upQry=" update tbl_seller set seller_status ='2' where seller_id=".$_GET['rid'];
	if($Con->query($upQry))
	{
		?>
    	<script>
		alert("Rejected")
		window.location="NewSeller.php";
		</script>
    <?php	
	}
}

	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
        /* Grey theme body background */
        body {
            background-color: #e5e5e5; /* Light grey background */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333333; /* Dark grey text */
        }

       

        /* Table container styling */
        .table-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #32383e; /* Light grey background for table */
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        /* Input fields styling */
        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #e5e5e5;
        }

        /* Submit button styling */
        input[type="submit"] {
            background-color: #c49b63; /* Grey button */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: ##e5e5e5; /* Darker grey on hover */
        }

        /* Table styling */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #f0f0f0;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #cccccc; /* Light grey border */
            text-align: center;
        }

        table th {
            background-color: #32383e; /* Medium grey for table header */
            color: white;
        }

        table td a {
            text-decoration: none;
            color: #c49b63; /* Grey color for links */
        }

        table td a:hover {
            color: black; /* Darker link on hover */
        }

        /* Responsive table styling */
        @media screen and (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
                width: 100%;
            }
            th, td {
                padding: 15px;
                text-align: left;
            }
        }
    </style>
<title>New Seller</title>
</head>

<body>

    <div class="form-container">
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered">
                <tr>
                    <th>Sl No</th>
                    <th>District</th>
                    <th>Place</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Proof</th>
                    <th>Action</th>
                </tr>
                <?php
                $selQry = "SELECT * FROM tbl_seller s 
                            INNER JOIN tbl_place p ON s.place_id = p.place_id 
                            INNER JOIN tbl_district d ON d.district_id = p.district_id 
                            WHERE seller_status = 0";
                $result = $Con->query($selQry);
                $i = 0;
                while ($data = $result->fetch_assoc()) {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['district_name']; ?></td>
                    <td><?php echo $data['place_name']; ?></td>
                    <td><?php echo $data['seller_name']; ?></td>
                    <td><?php echo $data['seller_contact']; ?></td>
                    <td><?php echo $data['seller_email']; ?></td>
                    <td><img src="../Assets/Files/Seller/Logo/<?php echo $data['seller_logo']; ?>" alt="Logo"></td>
                    <td><img src="../Assets/Files/Seller/Proof/<?php echo $data['seller_proof']; ?>" alt="Proof"></td>
                    <td>
                        <p><a href="NewSeller.php?aid=<?php echo $data['seller_id']; ?>">Accept</a></P>
                        <p><a href="NewSeller.php?rid=<?php echo $data['seller_id']; ?>">Reject</a></P>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
include("Foot.php");
ob_start();
?>