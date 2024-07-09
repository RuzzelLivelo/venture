<?php include('conn.php');?>

<?php
// Initialize variables
$totalFullnames = 0;
$total_quantity = 0;
$totalsold = 0;
$totalmotorcy = 0;

// Query to get the sum of quantity from the manufacyouu table
$sql1 = "SELECT SUM(quantity) AS total_quantity FROM manufacyouu";
$result1 = $conn->query($sql1);
if ($result1 && $result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
    $total_quantity = $row1['total_quantity'];
}

// Query to get the count of fullname from the costumertb table
$sql2 = "SELECT COUNT(fullname) AS total FROM costumertb";
$result2 = $conn->query($sql2);
if ($result2 && $result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    $totalFullnames = $row2['total'];
}

// Query to get the sum of quantity from the costumertb table (assuming it represents sold items)
$sql3 = "SELECT SUM(quantity) AS total FROM costumertb";
$result3 = $conn->query($sql3);
if ($result3 && $result3->num_rows > 0) {
    $row3 = $result3->fetch_assoc();
    $totalsold = $row3['total'];
}

// Query to get the sum of quantity from the motorcy table
$sql4 = "SELECT SUM(quantity) AS total FROM motorcy";
$result4 = $conn->query($sql4);
if ($result4 && $result4->num_rows > 0) {
    $row4 = $result4->fetch_assoc();
    $totalmotorcy = $row4['total'];
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Graph of Total Manufacturers and Customers</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="grph">
        <canvas id="myChart" width="400" height="150"></canvas>
    </div>
    <script>
        var totalManufactured = <?php echo $total_quantity; ?>;
        var totalCustomers = <?php echo $totalFullnames; ?>;
        var totalSold = <?php echo $totalsold; ?>;
        var totalMotorcy = <?php echo $totalmotorcy; ?>;

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', // Bar chart
            data: {
                labels: ['Manufactured Items', 'Customers', 'Total Sold', 'Total Motorcycle'],
                datasets: [{
                    label: 'Total Count',
                    data: [totalManufactured, totalCustomers, totalSold, totalMotorcy],
                    backgroundColor: [
                        'rgba(6, 96, 81, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(255, 99, 132, 0.5)' // This is an additional color for the fourth item
                    ],
                    borderColor: [
                        'rgba(24, 24, 24)',
                        'rgba(24, 24, 24)',
                        'rgba(24, 24, 24)',
                        'rgba(24, 24, 24)' // Border color for the fourth item
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <div class="pek">
        <p>New Delivered: <?php echo $total_quantity; ?></p>
        <p>Customer: <?php echo $totalFullnames; ?></p>
        <p>Sold: <?php echo $totalsold; ?></p>
        <p>Motorcycles Available: <?php echo $totalmotorcy; ?></p>
    </div>
</body>
</html>