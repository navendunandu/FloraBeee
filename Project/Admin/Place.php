<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
	$Name = $_POST['txt_place'];
	$district=$_POST['txt_district'];
	$insQry = "insert into tbl_place(place_name,district_id)values('".$Name."','".$district."')";
	if($Con->query($insQry))
	{
	?>
		<script>
					alert("inserted");
					window.location="Place.php"
		</script>
	<?php
		}
	else
		{
			echo "Error";
		}

}
if(isset($_GET['did'])){
	$delQry="delete from tbl_place where place_id=".$_GET['did'];
	if($Con -> query($delQry))
	{
		echo "Deleted";
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

    /* Form container styling */
    .form-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background-color: #32383e; /* Dark grey background for form */
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }

    /* Table container styling */
    .table-container {
        max-width: 800px;
        margin: 50px auto;
        padding: 30px;
        background-color: #32383e; /* Dark grey background for table */
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
        background-color: black; /* Darker grey on hover */
    }

    /* Table styling */
    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        background-color: #f0f0f0; /* Light grey for table */
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
<title>Place</title>
</head>

<body>

    <!-- Form container -->
    <div class="form-container">
        <form id="form1" name="form1" method="post" action="">
            <div class="mb-3">
                <label for="txt_district" class="form-label">District</label>
                <select class="form-select" name="txt_district" id="txt_district" required>
                    <option value="">---Select---</option>
                    <?php
                        $sel = "SELECT * FROM tbl_district";
                        $result = $Con->query($sel);
                        while ($data = $result->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $data['district_id']; ?>"><?php echo $data['district_name']; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="txt_place" class="form-label">Place</label>
                <input type="text" class="form-control" name="txt_place" id="txt_place" required>
            </div>

            <div class="text-center">
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
    </div>

    <!-- Table container -->
    <div class="table-container">
        <form id="form2" name="form2" method="post" action="">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>District</th>
                        <th>Place</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 0;
                        $selQry = "SELECT * FROM tbl_place p INNER JOIN tbl_district d ON p.district_id = d.district_id";
                        $result = $Con->query($selQry);
                        while ($data = $result->fetch_assoc()) {
                            $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $data['district_name']; ?></td>
                            <td><?php echo $data['place_name']; ?></td>
                            <td><a href="Place.php?did=<?php echo $data['place_id']; ?>">Delete</a></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </form>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include("Foot.php");
ob_start();
?>
