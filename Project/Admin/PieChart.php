<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
$xValues = [];
$yValues = [];
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="../Assets/JQ/jQuery.js"></script>
    <link rel="stylesheet" href="../Assets/CSS/styles.css"> <!-- Include your CSS file -->
    <title>Seller Sales Report</title>
    <style>
        /* Add some custom styles for the table */
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-primary {
            background-color: #2865AF;
            color: white;
        }
        .btn-success {
            background-color: #28a745;
            color: white;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <form id="form1" name="form1" method="post" action="">
            <center>
                <div class="col-lg-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Select the Dates Here</h4>
                            <table>
                                <tr>
                                    <td>
                                        <label for="txt_f">From Date</label>
                                        <input type="date" name="txt_f" id="txt_f" max="<?php echo date('Y-m-d')?>" required>
                                    </td>
                                    <td>
                                        <label for="txt_t">To Date</label>
                                        <input type="date" name="txt_t" id="txt_t" max="<?php echo date('Y-m-d')?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div style="margin:15px;text-align:center;">
                                            <input type="submit" name="btnsave" id="btnsave" class="btn btn-primary" value="View Results" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </center>
            <center>
                <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Sales Per Seller</h4>
                            <h4><?php if(isset($_POST['btnsave'])){ echo " between " . $_POST["txt_f"]. " and " . $_POST["txt_t"] ; } ?></h4>
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </center>
            <?php
            if (isset($_POST["btnsave"])) {
                // Fetch sellers and their sales data
                $sel = "SELECT * FROM tbl_seller";
                $row = $Con->query($sel);
                while ($data = $row->fetch_assoc()) {
                    $xValues[] = $data["seller_name"];
                    $sel1 = "SELECT IFNULL(SUM(cart_qty), 0) AS id FROM tbl_cart c 
                              INNER JOIN tbl_product p ON c.product_id = p.product_id 
                              INNER JOIN tbl_booking o ON c.booking_id = o.booking_id 
                              WHERE cart_status IN (1,3,4) 
                              AND p.seller_id = '" . $data["seller_id"] . "' 
                              AND o.booking_date BETWEEN '" . $_POST["txt_f"] . "' AND '" . $_POST["txt_t"] . "'";
                    $row1 = $Con->query($sel1);
                    while ($data1 = $row1->fetch_assoc()) {
                        $yValues[] = $data1["id"];
                    }
                }
                ?>

                <div class="col-lg-12 grid-margin stretch-card" style="margin-top:30px">
                    <div class="card">
                        <div class="card-body">
                            <div id="pri">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Sl. No</th>
                                                <th>Product Name</th>
                                                <th>Quantity<br>On Each Order</th>
                                                <th>Seller Name</th>
                                                <th>Contact/Email</th>
                                                <th>Ordered On</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sel = "SELECT * FROM tbl_booking o 
                                                    INNER JOIN tbl_cart c ON o.booking_id = c.booking_id 
                                                    INNER JOIN tbl_product p ON c.product_id = p.product_id 
                                                    INNER JOIN tbl_seller s ON s.seller_id = p.seller_id 
                                                    WHERE cart_status IN (1,3,4) 
                                                    AND o.booking_date BETWEEN '" . $_POST["txt_f"] . "' AND '" . $_POST["txt_t"] . "'";
                                            $row = $Con->query($sel);
                                            $i = 0;
                                            while ($data = $row->fetch_assoc()) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo htmlspecialchars($data["product_name"]); ?></td>
                                                    <td><?php echo htmlspecialchars($data["cart_qty"]); ?></td>
                                                    <td><?php echo htmlspecialchars($data["seller_name"]); ?></td>
                                                    <td><?php echo htmlspecialchars($data["seller_contact"]); ?><br><?php echo htmlspecialchars($data["seller_email"]); ?></td>
                                                    <td><?php echo htmlspecialchars($data["booking_date"]); ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <center>
                                <input type="button" onclick="printDiv('pri')" id="invoice-print" class="btn btn-success" value="Print" />
                            </center>
                        </div>
                    </div>
                </div>

                <?php
            } else {
                // Initial seller data retrieval
                $sel = "SELECT * FROM tbl_seller WHERE seller_status = 1";
                $row = $Con->query($sel);
                while ($data = $row->fetch_assoc()) {
                    $xValues[] = $data["seller_name"];
                    $sel1 = "SELECT IFNULL(SUM(cart_qty), 0) AS id FROM tbl_cart c 
                              INNER JOIN tbl_product p ON c.product_id = p.product_id 
                              INNER JOIN tbl_booking o ON c.booking_id = o.booking_id 
                              WHERE cart_status IN (1,3,4) 
                              AND p.seller_id = '" . $data["seller_id"] . "'";
                    $row1 = $Con->query($sel1);
                    while ($data1 = $row1->fetch_assoc()) {
                        $yValues[] = $data1["id"];
                    }
                }
            }
            ?>
        </form>
    </div>
</body>

</html>

<?php
$xValuesJson = json_encode($xValues);
$yValuesJson = json_encode($yValues);
?>

<script>
    // Chart and print functionality
    function generatePastelBrightColorPalettes(numColors) {
        const fillColors = [];
        const borderColors = [];
        const colorStep = 360 / numColors;
        for (let i = 0; i < numColors; i++) {
            const hue = Math.round(i * colorStep);
            const saturation = 50 + Math.random() * 30;
            const lightness = 65 + Math.random() * 30;
            const fillColor = `hsla(${hue}, ${saturation}%, ${lightness}%, 0.65)`;
            const borderColor = `hsla(${hue}, ${saturation}%, ${lightness}%, 1)`;
            fillColors.push(fillColor);
            borderColors.push(borderColor);
        }
        return { fillColors, borderColors };
    }

    $(function () {
        'use strict';
        var xValues = <?php echo $xValuesJson; ?>;
        var stringArray = <?php echo $yValuesJson; ?>;
        const yValues = stringArray.map(str => Number(str));

        const { fillColors, borderColors } = generatePastelBrightColorPalettes(xValues.length);
        var doughnutPieData = {
            datasets: [{
                data: yValues,
                backgroundColor: fillColors,
                borderColor: borderColors,
            }],
            labels: xValues,
        };

        var doughnutPieOptions = {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce((accumulator, value) => accumulator + value, 0);
                        var value = dataset.data[tooltipItem.index];
                        var percentage = ((value / total) * 100).toFixed(2) + "% of Total";
                        return `${data.labels[tooltipItem.index]}: ${value} (${percentage})`;
                    }
                }
            }
        };

        if ($("#pieChart").length) {
            var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: doughnutPieData,
                options: doughnutPieOptions
            });
        }
    });

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<?php
include("Foot.php");
ob_flush();
?>
