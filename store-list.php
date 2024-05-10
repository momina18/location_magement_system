<?php include ('header.php'); ?>
 

<!DOCTYPE html>
<html>
<head>
<title>Stores and Theatres</title>

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
    </style>
</head>
<body>

<!-- <h2>Store Names</h2> -->
<form action="your_action_page.php" method="POST">
    <label for="district">Select District:</label>
    <select name="district" id="district">
        <option value="Amravati">Agra</option>
        <option value="Mumbai">Mumbai</option>
        <option value="Ahmadabad">Ahmadabad</option>
        <option value="Ajmer">Ajmer</option>  
        <option value="Aligarh">Aligarh</option>  
        <option value="Ambala">Ambala</option>  
        <option value="Amravati">Amravati</option> 
        <option value="Amritsar">Amritsar</option>  
        <option value="Anand">Anand</option>  
        <option value="Bangalore">Bangalore</option>
        <option value="Bareilly">Bareilly</option>
        <option value="Belagavi">Belagavi</option>
        <option value="Bhagalpur">Bhagalpur</option>
        <option value="Bhavnagar">Bhavnagar</option>
        <option value="Bhopal">Bhopal</option>
        <option value="Bijnor">Bijnor</option>
        <option value="Bikaner">Bikaner</option>
        <option value="Bilaspur">Bilaspur</option>
        <option value="Chandigarh">Chandigarh</option>
        <option value="Chandrapur">Chandrapur</option>
        <option value="Chennai">Chennai</option>
        <option value="Coimbatore">Coimbatore</option>
        <option value="Darjeeling">Darjeeling</option>
        <option value="Dehradun">Dehradun</option>
        <option value="Deoria">Deoria</option>
        <option value="Dharwad">Dharwad</option>
        <option value="East Godavari">East Godavari</option>
        <option value="East Singhbum">East Singhbum</option>
        <option value="Ernakulam">Ernakulam</option>
        <option value="Erode">Erode</option>
        <option value="Faridabad">Faridabad</option>
        <option value="Ghazipur">Ghazipur</option>
        <option value="Gorakhpur">Gorakhpur</option>
        <option value="Guntur">Guntur</option>
        <option value="Gurugram">Gurugram</option>
        <option value="Gwalior">Gwalior</option>
        <option value="Hanumakonda">Hanumakonda</option>
        <option value="Hanumangarh">Hanumangarh</option>
        <option value="Haridwar">Haridwar</option>
        <option value="Hisar">Hisar</option>
        <option value=" Faridkot"> Faridkot</option>
        <option value="Gandhinagar">Gandhinagar</option>
        <option value="Gautam Buddha Nagar">Gautam Buddha Nagar</option>
        <option value="Gaya">Gaya</option>
        <option value="Ghaziabad">Ghaziabad</option>
        <option value="Hyderabad">Hyderabad</option>
        <option value="Indore">Indore</option>
        <option value="Jabalpur">Jabalpur</option>
        <option value="Jaipur">Jaipur</option>
        <option value="Jalandhar">Jalandhar</option>
        <option value="Jammu">Jammu</option>
        <option value="Kakinada">Kakinada</option>
        <option value="Kamrup Metro">Kamrup Metro</option>
        <option value="Kanpur Nagar">Kanpur Nagar</option>
        <option value="Karnal">Karnal</option>
        <option value="Khordha">Khordha</option>
        <option value="Kolhapur">Kolhapur</option>
        <option value="Kolkata">Kolkata</option>
        <option value="Kota">Kota</option>
        <option value="Kozhikode">Kozhikode</option>
        <option value="Krishnagiri">Krishnagiri</option>
        <option value="Lucknow">Lucknow</option>
        <option value="Ludhiana">Ludhiana</option>
        <option value="Madurai">Madurai</option>
        <option value="Mathura">Mathura</option>
        <option value="Meerut">Meerut</option>
        <option value="Moga">Moga</option>
        <option value="Moradabad">Moradabad</option>
        <option value="Mumbai">Mumbai</option>
        <option value="Muzaffarpur">Muzaffarpur</option>
        <option value="Nagpur">Nagpur</option>
        <option value="Nainital">Nainital</option>
        <option value="Nashik">Nashik</option>
        <option value="New Delhi">New Delhi</option>
        <option value="NTR">NTR</option>
        <option value="Panchkula">Panchkula</option>
        <option value="Pathankat Patiala">Pathankat Patiala</option>
        <option value="Patna">Patna</option>
        <option value="Pondicherry">Pondicherry</option>
        <option value="Prayagraj">Prayagraj</option>
        <option value="Pune">Pune</option>
        <option value="Purnia">Purnia</option>
        <option value="Raipur">Raipur</option>
        <option value="Rajkot">Rajkot</option>
        <option value="Ranchi">Ranchi</option>
        <option value="Rewari">Rewari</option>
        <option value="SAS Nagar">SAS Nagar</option>
        <option value="Salem">Salem</option>
        <option value="Satara">Satara</option>
        <option value="Shahjahanpur">Shahjahanpur</option>
        <option value="Shimla">Shimla</option>
        <option value="Shivamogga">Shivamogga</option>
        <option value="Sakar">Sakar</option>
        <option value="Sirsa">Sirsa</option>
        <option value="South Goa">South Goa</option>
        <option value="Srinagar">Srinagar</option>
        <option value="Sundargarh">Sundargarh</option>
        <option value="Surat">Surat</option>
        <option value="Thanjavur">Thanjavur</option>
        <option value="Thiruvananthapuram">Thiruvananthapuram</option>
        <option value="Tiruchirappalli">Tiruchirappalli</option>
        <option value="Vadodara">Vadodara</option>
        <option value="Varanasi">Varanasi</option>
        <option value="Vellore">Vellore</option>
        <option value="Visakhapatanam">Visakhapatanam</option>
        <option value="Vizianagaram">Vizianagaram</option>






        
        
        
        

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nearest Theater</title>
</head>
<body>
    <h2>Select Store:</h2>
    <select id="storeSelect">
        <option value="0">ETH-Chandigarh-Sector 17</option>
        <option value="1">Ethnix R City Ghatkopar</option>
    </select>
    <h2>Nearest Theater:</h2>
    <p id="nearestTheater"></p>

    <script>
        document.getElementById('storeSelect').addEventListener('change', function() {
            var storeIndex = this.value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'backend.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var theater = JSON.parse(xhr.responseText);
                    document.getElementById('nearestTheater').textContent = theater.name;
                }
            };
            xhr.send('store_index=' + storeIndex);
        });
    </script>
</body>
</html>

</body>
</html>
