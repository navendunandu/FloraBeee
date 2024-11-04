<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/Connection.php");

if(isset($_POST['btn_submit']))
{
	$Name = $_POST['txt_name'];
	$id=$_POST['txt_id'];
	if($id!='')
	{
	$upQry=" update tbl_occassion set occassion_name ='$Name' where occassion_id='$id' ";
	if($Con->query($upQry))
	{
		?>
        <script>
		alert("Updated")
		window.location="occassion.php"
		</script>
        <?php
	}
	}
	else
	{
	
        $insQry = "insert into tbl_occassion(occassion_name)values('".$Name."')";
        if($Con->query($insQry))
        {
        ?>
            <script>
                        alert("inserted");
                        window.location="Occassion.php"
            </script>
        <?php
            }
        else
            {
                echo "Error";
            }
    
    }
	
}

if(isset($_GET['did'])){
	$delQry="delete from tbl_occassion where occassion_id=".$_GET['did'];
	if($Con -> query($delQry))
	{
		echo "Deleted";
	}
}
$did='';
$dname='';
if(isset($_GET['eid']))
{
	$SelQry=" select * from tbl_occassion where occassion_id='".$_GET['eid']."' ";
	$result=$Con->query($SelQry);
	$data=$result->fetch_assoc();
	$did=$data['occassion_id'];
	$dname=$data['occassion_name'];
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
            background-color: #32383e; /* Light grey background for form */
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Subtle shadow */
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
<title>Occassion</title>
</head>

<body>

    <!-- Form container -->
    <div class="form-container">
        <form id="form1" name="form1" method="post" action="">
            <div class="mb-3">
                <label for="txt_name" class="form-label">Name</label>
                <input required type="text" class="form-control" name="txt_name" id="txt_name" value="<?php echo $dname ?>" />
                <input type="hidden" name="txt_id" value="<?php echo $did ?>" />
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
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;
                    $selQry = "select * from tbl_occassion";
                    $result = $Con -> query($selQry);
                    while($data = $result -> fetch_assoc()) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data['occassion_name']; ?></td>
                        <td>
                          <P>  <a href="Occassion.php?did=<?php echo $data['occassion_id']; ?>">Delete</a></p>
                           <P> <a href="Occassion.php?eid=<?php echo $data['occassion_id']; ?>">Edit</a></p>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
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