<?php include ('header.php'); ?>
<?php
// Database connection
$servername = "localhost";
$username = "locationdatabee_admin";
$password = "cp*#M&Q)~h5*";
$database = "locationdatabee_lms";
$conn = new mysqli($servername, $username, $password, $database);

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
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $kilometers = $miles * 1.609344;

    return $kilometers;
}

$raymond_store_query = "SELECT srno	,
brand,
buyerno,	
poscode1,	
poscode2,	
region,	
tier,	
city,	
shirting,	
suiting	,
ethnix,	
rr,	
state	,
storename,	
address1,	
address2,	
zip	,
hs_mall,	
latitude,	
longitude FROM raymondstore";
$raymond_store_result = $conn->query($raymond_store_query);

$raymond_stores = array();
if ($raymond_store_result->num_rows > 0) {
    while($row = $raymond_store_result->fetch_assoc()) {
        $raymond_stores[] = $row;
    }
}

// Fetch data from the raymondtheatre table
$raymond_theatre_query = "SELECT 
srno,	
state,	
city,	
cinemacategory,	
screencode	,
multiplex_name,	
address	,
audi,	
seatingcapcity,	latitude,longitude FROM raymondtheatre";
$raymond_theatre_result = $conn->query($raymond_theatre_query);

$raymond_theatres = array();
if ($raymond_theatre_result->num_rows > 0) {
    while($row = $raymond_theatre_result->fetch_assoc()) {
        $raymond_theatres[] = $row;
    }
}

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nearest Theaters</title>
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #dddddd;
        vertical-align: top; /* Align text at the top */
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }

    thead{
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

    <!-- Dropdowns for filtering by brand and city -->
    <div style="margin-bottom: 10px;">
        <label for="brand-filter">Filter by Brand:</label>
        <select id="brand-filter" onchange="filterByBrand()">
            <option value="">All Brands</option>
            <?php
            // Populate dropdown options with unique brand names
            $brands = array_unique(array_column($raymond_stores, 'brand'));
            foreach ($brands as $brand) {
                echo "<option value=\"$brand\">$brand</option>";
            }
            ?>
        </select>
        <label for="city-filter">Filter by City:</label>
        <select id="city-filter" onchange="filterByCity()">
            <option value="">All Cities</option>
            <?php
            // Populate dropdown options with unique city names
            $cities = array_unique(array_column($raymond_stores, 'city'));
            foreach ($cities as $city) {
                echo "<option value=\"$city\">$city</option>";
            }
            ?>
        </select>
    </div>

    <!-- Search input for filtering by store name -->
    <div style="margin-bottom: 10px;">
        <label for="store-filter">Search by Store Name:</label>
        <input type="text" id="store-filter" onkeyup="filterStores()" placeholder="Enter store name...">
    </div>

    <!-- Button for downloading table content as Excel -->
    <button id="download-btn" onclick="downloadExcel()">Download as Excel</button>
     <button id="download-store-btn" onclick="downloadRaymondStoreExcel()">Download Store Data as Excel</button>
<button id="download-theater-btn" onclick="downloadRaymondTheatreExcel()">Download Theater Data as Excel</button>
    <h2>List of Stores and Their Nearest Theaters within 1-10 km</h2>
    
    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <!--<th>Network</th>-->
                    <th>Brand</th>
                    <th>City</th>
                    <th>Store Name</th>
                    <th>Distance</th>
                    <th>Nearest Theaters</th>
                    <th>Distance to Nearest Theater</th>
                </tr>
            </thead>
            <tbody>
        <?php
        foreach ($raymond_stores as $store) {
            // Initialize arrays to store theaters by distance categories
            $theaters_by_distance = array(
                '0' => array(), // Modify to include distance zero
                '2' => array(),
                '5' => array(),
                '7' => array(),
                '10' => array()
            );
        
            // Loop through theaters to find nearby ones
            foreach ($raymond_theatres as $theater) {
                $distance = calculate_distance($store, $theater);
                if ($distance >= 0 && $distance <= 10) { // Modify to include distance zero
                    // Group theaters by distance categories
                    if ($distance <= 2) {
                        $theaters_by_distance['2'][] = array('address' => $theater['address'], 'distance' => $distance);
                    } elseif ($distance <= 5) {
                        $theaters_by_distance['5'][] = array('address' => $theater['address'], 'distance' => $distance);
                    } elseif ($distance <= 7) {
                        $theaters_by_distance['7'][] = array('address' => $theater['address'], 'distance' => $distance);
                    } else {
                        $theaters_by_distance['10'][] = array('address' => $theater['address'], 'distance' => $distance);
                    }
                }
            }
        
            // Display store and its nearest theaters in table rows
            
            // For each distance category
            foreach ($theaters_by_distance as $distance => $theaters_list) {
                echo "<tr>";
                // echo "<td>" . $store['network'] . "</td>"; // Network
                echo "<td>" . $store['brand'] . "</td>"; // Brand
                echo "<td>" . $store['city'] . "</td>"; // City
                echo "<td>" . $store['storename'] . "</td>"; // Store Name
                echo "<td>$distance km</td>"; // Distance
                echo "<td>";
                if (!empty($theaters_list)) {
                    foreach ($theaters_list as $theater) {
                        echo $theater['address'] . "<br>";
                    }
                } else {
                    echo "-";
                }
                echo "</td>"; // Nearest Theater Address
                
                // New column for distance to nearest theater
                echo "<td>";
                if (!empty($theaters_list)) {
                    foreach ($theaters_list as $theater) {
                        echo round($theater['distance'], 2) . " km<br>";
                    }
                } else {
                    echo "-";
                }
                echo "</td>"; // Distance to Nearest Theater

                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>
    </div>

    <script>
        // Your JavaScript code here
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.0/xlsx.full.min.js"></script>
</body>
</html>
