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
$stores_query = "SELECT brand, latitude, longitude FROM brand";
$stores_result = $conn->query($stores_query);

$stores = array();
if ($stores_result->num_rows > 0) {
    while($row = $stores_result->fetch_assoc()) {
        $stores[] = $row;
    }
}

// Fetch theaters from the database
$theaters_query = "SELECT address, latitude, longitude FROM theatrenew";
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
    <!-- <div style="margin-bottom: 10px;">
        <label for="store-filter">Search by Store Name:</label>
        <input type="text" id="store-filter" onkeyup="filterStores()" placeholder="Enter store name...">
    </div>

    <!-- Button for downloading table content as Excel 
    <button id="download-btn">Download as Excel</button> -->

    <h2>List of Brands and Their Distances within 1-10 km</h2>
    
    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>Brand</th>
                    <th>Address</th>
                    <th>Distance (km)</th>
                    <th>Distance Category</th> <!-- New column for distance categories -->
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($stores as $store) {
                    // Loop through theaters to find nearby ones
                    foreach ($theaters as $theater) {
                        $distance = calculate_distance($store, $theater);
                        if ($distance >= 1 && $distance <= 10) {
                            // Display store and its nearest theaters in table rows
                            echo "<tr>";
                            echo "<td>" . $store['brand'] . "</td>"; // Brand
                            echo "<td>" . $theater['address'] . "</td>"; // Address
                            echo "<td>" . round($distance, 2) . "</td>"; // Distance in kilometers
                            // Concatenate distance categories into a single column
                            echo "<td>";
                            if ($distance >= 1 && $distance < 3) {
                                echo "1-3 km";
                            } elseif ($distance >= 3 && $distance < 5) {
                                echo "3-5 km";
                            } elseif ($distance >= 5 && $distance < 7) {
                                echo "5-7 km";
                            } elseif ($distance >= 7 && $distance < 9) {
                                echo "7-9 km";
                            } elseif ($distance >= 9 && $distance < 11) {
                                echo "9-11 km";
                            } // Add more conditions for other distance ranges as needed
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
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
                tdStore = tr[i].getElementsByTagName("td")[0]; // Adjusted index for Brand column
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
