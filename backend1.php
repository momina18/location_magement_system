<?php
include('header.php');

// Database connection
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

if(isset($_GET['brand'])) {
    $brand = $_GET['brand'];
    // Adding WHERE clause to filter by brand
    $stores_query .= " WHERE brand LIKE '".$brand."%'";
}

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

// Close database connection
// $conn->close();
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

<!-- Search input for filtering by store name -->
<div style="margin-bottom: 10px;">
    <label for="store-filter">Search by Store Name:</label>
    <input type="text" id="store-filter" onkeyup="filterStores()" placeholder="Enter store name...">
</div>
<div style="margin-bottom: 10px;">
    <label for="store-filter">Search by Brand Name:</label>
    
    <select id="brand-filter"  onchange="brandfilter()" name="">
        <option value="">Select Brand</option>
    <?php 
    $theaters_query1 = "SELECT DISTINCT brand FROM brand";
    $theaters_result1 = $conn->query($theaters_query1);
    while ($row = $theaters_result1->fetch_assoc()) {
    ?>
    <option value="<?php echo $row['brand']; ?>"   <?php if(isset($_GET['brand']) && $_GET['brand'] == $row['brand']){ echo 'selected'; } ?>><?php echo $row['brand']; ?></option>
    <?php
    }
    ?>
</select>
    
    
    
    <label for="store-filter">Search by Km:</label>
    <select id="km-filter" onchange="kmfilter()">
        <option value="">Select Km</option>
         <option value="1" <?php if(isset($_GET['km']) && $_GET['km'] == '1'){ echo 'selected'; } ?>>1 Km</option>
         <option value="5" <?php if(isset($_GET['km']) && $_GET['km'] == '5'){ echo 'selected'; } ?>>5 Km</option>
         <option value="7" <?php if(isset($_GET['km']) && $_GET['km'] == '7'){ echo 'selected'; } ?>>7 Km</option>
         <option value="10" <?php if(isset($_GET['km']) && $_GET['km'] == '10'){ echo 'selected'; } ?>>10 Km</option>
    </select>
</div>

<!-- Button for downloading table content as Excel -->
<button id="download-btn" onclick="downloadExcel()">Download as Excel</button>

<h2>List of Stores and Their Nearest Theaters within <?php echo isset($_GET['km']) ? intval($_GET['km']) : 10; ?> km</h2>

<div style="overflow-x:auto;">
    <table>
        <thead>
        <tr>
            <th>Store Name</th>
            <th>Brand</th>
            <th>Nearest Theater Address</th>
            <th>Screen Code</th>
            <th>Network</th>
            <th>Distance (km)</th>
        </tr>
        </thead>
     <tbody id="store-table-body">
    <?php
    // Initialize an array to keep track of which screen_codes have been printed
    $printed_screen_codes = array();

    foreach ($stores as $store) {
        // Initialize array to store unique nearby theaters
        $unique_theaters = array();
        $max_distance = isset($_GET['km']) ? intval($_GET['km']) : 10;
        // Loop through theaters to find nearby ones
        foreach ($theaters as $theater) {
            $distance = calculate_distance($store, $theater);
            if ($distance <= $max_distance) {
                // Check if screen_code has already been printed
                if (!in_array($theater['screen_code'], $printed_screen_codes)) {
                    // Add theater to unique theaters list
                    $unique_theaters[] = array(
                        'address' => $theater['address'],
                        'screen_code' => $theater['screen_code'],
                        'network' => $theater['network'],
                        'distance' => $distance
                    );
                    // Add screen_code to printed screen_codes
                    $printed_screen_codes[] = $theater['screen_code'];
                }
            }
        }

        // Display store and its unique nearest theaters in table rows
        if (!empty($unique_theaters)) {
            foreach ($unique_theaters as $index => $unique_theater) {
                echo "<tr>";
                // Output store name and brand only for the first row of each store
                if ($index === 0) {
                    echo "<td rowspan='" . count($unique_theaters) . "'>" . $store['store'] . "</td>"; // Increment rowspan for the store name
                    echo "<td rowspan='" . count($unique_theaters) . "'>" . $store['brand'] . "</td>"; // Increment rowspan for the brand
                }
                echo "<td>" . $unique_theater['address'] . "</td>";
                echo "<td>" . $unique_theater['screen_code'] . "</td>";
                echo "<td>" . $unique_theater['network'] . "</td>";
                echo "<td>" . number_format($unique_theater['distance'], 2) . "</td>";
                echo "</tr>";
            }
        } else {
            // If no nearby theaters found, print empty rows for the store
            echo "<tr>";
            echo "<td>" . $store['store'] . "</td>"; // Store name
            echo "<td>" . $store['brand'] . "</td>"; // Brand
            echo "<td colspan='4'>No theaters found within " . (isset($_GET['km']) ? intval($_GET['km']) : 10) . " km</td>"; // No theaters message
            echo "</tr>";
        }
    }
    ?>
</tbody>








    </table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.0/xlsx.full.min.js"></script>
<script>
    function brandfilter() {
        var input1, filter1, table1, tr1, tdStore1, j, txtValueStore1;
        input1 = document.getElementById("brand-filter");
        filter1 = input1.value;
        
        input2 = document.getElementById("km-filter");
        filter2 = input2.value;
        if(filter2!='')
        {
             window.location.href = 'https://location.databee.in/latlong/backend1.php?brand='+filter1+'&km='+filter2;
        }
        else
        {
             window.location.href = 'https://location.databee.in/latlong/backend1.php?brand='+filter1;
        }
        
        
    }
      function kmfilter() {
        var input1, filter1, table1, tr1, tdStore1, j, txtValueStore1;
        input1 = document.getElementById("km-filter");
        filter1 = input1.value;
        
        input2 = document.getElementById("brand-filter");
        filter2 = input2.value;
        if(filter2!='')
        {
             window.location.href = 'https://location.databee.in/latlong/backend1.php?brand='+filter2+'&km='+filter1;
        }
        else
        {
             window.location.href = 'https://location.databee.in/latlong/backend1.php?km='+filter1;
        }
        
        
    }


      // Function to trigger Excel download using SheetJS library
function downloadExcel() {
    // Convert table to Excel data
    var table = document.querySelector("table");
    var workbook = XLSX.utils.table_to_book(table, {sheet: "Sheet1"});

    // Access the first sheet in the workbook
    var sheetName = workbook.SheetNames[0];
    var worksheet = workbook.Sheets[sheetName];

    // Adjust column widths for spacing
    worksheet['!cols'] = [
        { width: 80 }, // Width of the first column
        { width: 40 }, // Width of the space column
        { width: 150 }, // Width of the second column
        { width: 40 }, // Width of the second column

        // Add more columns as needed
    ];

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
            tdStore = tr[i].getElementsByTagName("td")[0];
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
    function filterStores() {
        var input, filter, table, tr, tdStore, i, txtValueStore;
        input = document.getElementById("store-filter");
        filter = input.value.toUpperCase();
        table = document.querySelector("table");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            tdStore = tr[i].getElementsByTagName("td")[5];
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
    
    
  

    
</script>

</body>
</html>