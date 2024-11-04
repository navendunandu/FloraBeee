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
            background-color: white; /* White background for the page */
        }

        .table-container {
            background-color: #ddd; /* Grey background for the table */
            padding: 20px;
            border-radius: 10px;
            color: white; /* White text for all table elements */
        }

        .table-container th, .table-container td {
            color: white; /* White text for table headers and cells */
        }

        .table-container img {
            width: 200px;
            height: 200px;
        }

        a {
            color: white; /* White text for links */
        }

        a:hover {
            color: grey ; /* Slightly lighter color on hover */
        }
    </style>
<title>Untitled Document</title>
</head>

<body>
    <div class="container mt-5">
        <form id="form1" name="form1" method="post" action="">
            <div class="table-container">
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Date</th>
                            <th>Title</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>File</th>
                            <th>Description</th>
                            <th>Reply</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selQry = "SELECT * FROM tbl_seller s 
                                   INNER JOIN tbl_product p ON s.seller_id = p.seller_id 
                                   INNER JOIN tbl_complaint c ON c.product_id = p.product_id 
                                   INNER JOIN tbl_userregistration u ON c.user_id = u.user_id 
                                   WHERE s.seller_id = ".$_SESSION['sid'];
                        $result = $Con->query($selQry);
                        while($row = $result->fetch_assoc()) {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['complaint_date']; ?></td>
                            <td><?php echo $row['complaint_title']; ?></td>
                            <td><?php echo $row['user_name']; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><img src="../Assets/Files/User/Complaint/<?php echo $row['complaint_file'];?>" alt="Complaint File"/></td>
                            <td><?php echo $row['complaint_details']; ?></td>
                            <td><a href="Reply.php?cid=<?php echo $row['complaint_id']; ?>" class="btn btn-primary">Reply</a></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
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