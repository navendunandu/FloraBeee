<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/Connection.php");

if (isset($_POST['btn_submit'])) {
    $Name = $_POST['txt_name'];
    $id = $_POST['txt_id'];
    if ($id != '') {
        $upQry = "UPDATE tbl_district SET district_name ='$Name' WHERE district_id='$id'";
        if ($Con->query($upQry)) {
            echo 'Updated';
        }
    } else {
        $insQry = "INSERT INTO tbl_district(district_name) VALUES('" . $Name . "')";
        if ($Con->query($insQry)) {
            echo "Inserted";
        }
    }
}

if (isset($_GET['did'])) {
    $delQry = "DELETE FROM tbl_district WHERE district_id=" . $_GET['did'];
    if ($Con->query($delQry)) {
        echo "Deleted";
    }
}

$did = '';
$dname = '';
if (isset($_GET['eid'])) {
    $SelQry = "SELECT * FROM tbl_district WHERE district_id='" . $_GET['eid'] . "'";
    $result = $Con->query($SelQry);
    $data = $result->fetch_assoc();
    $did = $data['district_id'];
    $dname = $data['district_name'];
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
        background-color: #32383e; /* Dark grey for form */
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
        background-color: #c49b63; /* Darker grey on hover */
    }

    /* Table container styling */
    .table-container {
        max-width: 800px;
        margin: 50px auto;
        padding: 30px;
        background-color: #32383e; /* Dark grey for table */
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Subtle shadow */
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

<title>District</title>
</head>

<body>

    <div class="form-container">
        <form id="form1" name="form1" method="post" action="">
            <div class="mb-3">
                <label for="txt_name" class="form-label">Name</label>
                <input required type="text" class="form-control" name="txt_name" id="txt_name" value="<?php echo $dname; ?>" />
                <input type="hidden" name="txt_id" value="<?php echo $did; ?>" />
            </div>

            <div class="text-center">
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
    </div>

    <div class="table-container">
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
                $selQry = "SELECT * FROM tbl_district";
                $result = $Con->query($selQry);
                $i = 0;
                while ($data = $result->fetch_assoc()) {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['district_name']; ?></td>
                    <td>
                       <p> <a href="District.php?did=<?php echo $data['district_id']; ?>">Delete</a></p>
                    
                       <p> <a href="District.php?eid=<?php echo $data['district_id']; ?>">Edit</a></p>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
include("Foot.php");
ob_end_flush();
?>
