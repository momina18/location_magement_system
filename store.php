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

// Fetch stores from the database
$stores_query = "SELECT name, latitude, longitude, brand FROM stores_1";
$stores_result = $conn->query($stores_query);

$stores = array();
if ($stores_result->num_rows > 0) {
    while($row = $stores_result->fetch_assoc()) {
        $stores[] = $row;
    }
}

// Fetch theaters from the database
$theaters_query = "SELECT  name, latitude, longitude FROM theaters_1";
$theaters_result = $conn->query($theaters_query);

$theaters = array();
if ($theaters_result->num_rows > 0) {
    while($row = $theaters_result->fetch_assoc()) {
        $theaters[] = $row;
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

    <!-- Search input for filtering by store name -->
    <div style="margin-bottom: 10px;">
        <label for="store-filter">Search by Store Name:</label>
        <input type="text" id="store-filter" onkeyup="filterStores()" placeholder="Enter store name...">
    </div>

    <!-- Button for downloading table content as Excel -->
    <button id="download-btn">Download as Excel</button>

    <h2>List of Stores and Their Nearest Theaters within 1-10 km</h2>
    
    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>Brand</th>
                    <th>Store Name</th>
                    <th>Distance</th>
                    <th>Nearest Theaters</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($stores as $store) {
                    // Initialize arrays to store theaters by distance categories
                    $theaters_by_distance = array(
                        '2' => array(),
                        '5' => array(),
                        '7' => array(),
                        '10' => array()
                    );

                    // Loop through theaters to find nearby ones
                    foreach ($theaters as $theater) {
                        $distance = calculate_distance($store, $theater);
                        if ($distance >= 1 && $distance <= 10) {
                            // Group theaters by distance categories and check for duplicates
                            if ($distance <= 2 && !in_array($theater['name'], array_column($theaters_by_distance['2'], 'name'))) {
                                $theaters_by_distance['2'][] = array('name' => $theater['name'], 'distance' => $distance);
                            } elseif ($distance <= 5 && !in_array($theater['name'], array_column($theaters_by_distance['5'], 'name'))) {
                                $theaters_by_distance['5'][] = array('name' => $theater['name'], 'distance' => $distance);
                            } elseif ($distance <= 7 && !in_array($theater['name'], array_column($theaters_by_distance['7'], 'name'))) {
                                $theaters_by_distance['7'][] = array('name' => $theater['name'], 'distance' => $distance);
                            } elseif (!in_array($theater['name'], array_column($theaters_by_distance['10'], 'name'))) {
                                $theaters_by_distance['10'][] = array('name' => $theater['name'], 'distance' => $distance);
                            }
                        }
                    }

                    // Display store and its nearest theaters in table rows
                    echo "<tr>";
                    echo "<td>" . $store['brand'] . "</td>"; // Brand
                    echo "<td>" . $store['name'] . "</td>"; // Store Name
                    echo "<td>2 km</td>"; // Distance
                    echo "<td>";
                    if (!empty($theaters_by_distance['2'])) {
                        foreach ($theaters_by_distance['2'] as $theater) {
                            echo $theater['name'] . " (" . round($theater['distance'], 2) . " km)" . "<br>"; // Nearest Theaters
                        }
                    } else {
                        echo "-";
                    }
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td></td>"; // Empty cell for Brand
                    echo "<td></td>"; // Empty cell for Store Name
                    echo "<td>5 km</td>"; // Distance
                    echo "<td>";
                    if (!empty($theaters_by_distance['5'])) {
                        foreach ($theaters_by_distance['5'] as $theater) {
                            echo $theater['name'] . " (" . round($theater['distance'], 2) . " km)" . "<br>"; // Nearest Theaters
                        }
                    } else {
                        echo "-";
                    }
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td></td>"; // Empty cell for Brand
                    echo "<td></td>"; // Empty cell for Store Name
                    echo "<td>7 km</td>"; // Distance
                    echo "<td>";
                    if (!empty($theaters_by_distance['7'])) {
                        foreach ($theaters_by_distance['7'] as $theater) {
                            echo $theater['name'] . " (" . round($theater['distance'], 2) . " km)" . "<br>"; // Nearest Theaters
                        }
                    } else {
                        echo "-";
                    }
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td></td>"; // Empty cell for Brand
                    echo "<td></td>"; // Empty cell for Store Name
                    echo "<td>10 km</td>"; // Distance
                    echo "<td>";
                    if (!empty($theaters_by_distance['10'])) {
                        foreach ($theaters_by_distance['10'] as $theater) {
                            echo $theater['name'] . " (" . round($theater['distance'], 2) . " km)" . "<br>"; // Nearest Theaters
                        }
                    } else {
                        echo "-";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // Function to trigger Excel download using SheetJS library
        function downloadExcel() {
            // Convert table to Excel data
            var table = document.querySelector("table");
            var workbook = XLSX.utils.table_to_book(table, {sheet: "Sheet1"});
            
            // Save Excel file
            XLSX.writeFile(workbook, "nearest_theaters.xlsx");
        }

        // Function to filter stores by name
        function filterStores() {
            var input, filter, table, tr, tdStore, i, txtValueStore;
            input = document.getElementById("store-filter");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                tdStore = tr[i].getElementsByTagName("td")[1];
                if (tdStore) {
                    txtValueStore = tdStore.textContent || tdStore.innerText;
                    if (txtValueStore.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        // Attach click event listener to the download button
        document.getElementById("download-btn").addEventListener("click", downloadExcel);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.0/xlsx.full.min.js"></script>

</body>
</html>