<?php
ob_start();
include("Head.php");
?>

<?php
session_start();
include("../Assets/Connection/Connection.php");
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
    body {
        background-color: white; /* White background */
    }

    .decoration-container {
        background-color: #32383e; /* Grey background for the container */
        padding: 20px;
        border-radius: 10px;
        color: white; /* White text */
        max-width: 1200px; /* Enlarged width */
        margin: auto;
        margin-top: 50px;
    }

    table {
        width: 100%; /* Full width for the table */
        border-collapse: collapse; /* Collapse borders */
        margin-top: 20px; /* Margin for spacing */
    }

    th, td {
        border: 1px solid #555; /* Dark border */
        padding: 10px; /* Padding for cells */
        text-align: left; /* Align text to the left */
    }

    th {
        background-color: #444; /* Darker background for table header */
    }

    img {
        width: 200px; /* Set image width */
        height: 200px; /* Set image height */
        border-radius: 5px; /* Rounded corners for images */
    }
</style>


<title>DecorationIdeas</title>
</head>
<body>
    <div class="decoration-container">
        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <th>SlNo</th>
                    <th>Description</th>
                    <th>Photo</th>
                </tr>
                <?php
                $selQry = "SELECT * FROM tbl_decoration";
                $result = $Con->query($selQry);
                $i = 0;
                while ($data = $result->fetch_assoc()) {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo htmlspecialchars($data['decoration_description']); ?></td>
                    <td><img src="../Assets/Files/Seller/Decoration/<?php echo htmlspecialchars($data['decoration_photo']); ?>" alt="Decoration Photo"/></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </form>
    </div>
</body>
</html>

