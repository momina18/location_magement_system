<?php
include('header.php');

// Database connection
$servername = "localhost";
$username = "locationdatabee_admin";
$password = "cp*#M&Q)~h5*";
$database = "locationdatabee_lms";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to calculate distance between two coordinates
function calculate_distance($coord1, $coord2) {
    $lat1 = floatval($coord1['latitude']);
    $lon1 = floatval($coord1['longitude']);
    $lat2 = floatval($coord2['latitude']);
    $lon2 = floatval($coord2['longitude']);

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $kilometers = $miles * 1.609344;

    return $kilometers;
}

$brand = '';
$stores_query = "SELECT store, brand, latitude, longitude FROM store3";

// Fetch stores from the database
$stores_result = $conn->query($stores_query);

$stores = array();
if ($stores_result->num_rows > 0) {
    while ($row = $stores_result->fetch_assoc()) {
        $stores[] = $row;
    }
}

// Fetch theaters from the database
$theaters_query = "SELECT address, latitude, longitude,network,screen_code FROM theatre4";
$theaters_result = $conn->query($theaters_query);

$theaters = array();
if ($theaters_result->num_rows > 0) {
    while ($row = $theaters_result->fetch_assoc()) {
        $theaters[] = $row;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stores without Theaters or Latitude/Longitude</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            vertical-align: top; /* Align text at the top */
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        thead {
            position: sticky;
            top: 0;
            z-index: 1;
        }

        #download-btn {
            float: right;
        }

        @media only screen and (max-width: 600px) {
            th, td {
                padding: 6px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<h2>List of Stores without Theaters or Latitude/Longitude</h2>

<div style="overflow-x:auto;">
    <table>
        <thead>
        <tr>
            <th>Store Name</th>
            <th>Brand</th>
            <th>Latitude</th>
            <th>Longitude</th>
        </tr>
        </thead>
        <tbody id="store-table-body">
        <?php
        foreach ($stores as $store) {
            // Check if the store has latitude and longitude information
            if (empty($store['latitude']) || empty($store['longitude'])) {
                echo "<tr>";
                echo "<td>" . $store['store'] . "</td>";
                echo "<td>" . $store['brand'] . "</td>";
                echo "<td>" . ($store['latitude'] ?? "N/A") . "</td>";
                echo "<td>" . ($store['longitude'] ?? "N/A") . "</td>";
                echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
