<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/Connection.php");
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
            background-color: #32383e; /* Grey button */
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
            color: #6c757d; /* Grey color for links */
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
<title>UserListt</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<table width="200" border="1">
<tr>
<td>SlNo</td>
<td>District</td>
<td>Place</td>
<td>Name</td>
<td>Gender</td>
<td>Contact</td>
<td>Email</td>
<td>Password</td>
<td>Photo</td>
</tr>

<?php
$selQry="select * from  tbl_userregistration n inner join tbl_place p on n.place_id=p.place_id inner join tbl_district d on d.district_id=p.district_id";
$result=$Con->query($selQry);
$i=0;
while($data=$result->fetch_assoc())
{
	$i++;

?>
<tr>
<td><?php echo $i?> </td>
<td><?php echo $data['district_name'];?> </td>
<td><?php echo $data['place_name'];?> </td>
<td><?php echo $data['user_name'];?> </td>
<td><?php echo $data['user_gender'];?> </td>
<td><?php echo $data['user_contact'];?> </td>
<td><?php echo $data['user_email'];?> </td>
<td><?php echo $data['user_password'];?> </td>
<td><img src="../Assets/Files/User/Photo/<?php echo $data['user_photo'];?>"width="100" height="100"></td>







<?php
}
?>
</table>
</form>


</body>
</html>

<?php
include("Foot.php");
ob_start();
?>