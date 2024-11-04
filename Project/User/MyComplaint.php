<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/connection.php");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
        body {
            background-color: white; /* White background */
        }

        .profile-container {
            background-color: #32383e; /* Grey background for the table */
            padding: 20px;
            border-radius: 10px;
            color: white; /* White text */
        }

        .profile-container table {
            width: 100%; /* Ensure the table takes up full width */
            border-collapse: collapse; /* Ensure there is no space between borders */
        }

        .profile-container th, .profile-container td {
            padding: 10px; /* Add some padding to the table cells */
            text-align: left; /* Align text to the left */
            color: white; /* White text in table cells */
            border-bottom: 1px solid #ddd; /* Add a light bottom border */
        }

        .profile-container img {
            width: 200px; /* Set complaint file image width */
            height: auto; /* Auto height based on width */
        }

        a {
            color: white; /* White text for links */
        }

        a:hover {
            color: #ddd; /* Slightly lighter on hover */
        }
    </style>
<title>Untitled Document</title>
</head>

<body>
    <div class="container mt-5">
        <div class="profile-container">
            <form id="form1" name="form1" method="post" action="">
                <table class="table table-borderless">
                    <tr>
                        <th>Sl No.</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Product</th>
                        <th>File</th>
                        <th>Reply</th>
                        <th>Date</th>
                    </tr>
                    <?php
                    $i = 0;
                    $selQry = "SELECT * FROM tbl_complaint c INNER JOIN tbl_product p ON c.product_id = p.product_id WHERE c.user_id = " . $_SESSION['uid'];
                    $result = $Con->query($selQry);
                    while ($row = $result->fetch_assoc()) {
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['complaint_title']; ?></td>
                            <td><?php echo $row['complaint_details']; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><img src="../Assets/Files/User/Complaint/<?php echo $row['complaint_file']; ?>" alt="Complaint File"/></td>
                            <td><?php echo $row['complaint_reply']; ?></td>
                            <td><?php echo $row['complaint_date']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
include("Foot.php");
ob_start();
?>