<?php include ('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload and Download Excel</title>
    <script>
        // Function to handle file upload
        function uploadExcel() {
            var fileInput = document.getElementById("excelFile");
            var file = fileInput.files[0];
            var formData = new FormData();
            formData.append("excelFile", file);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "upload.php", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                } else {
                    alert("Error uploading file.");
                }
            };
            xhr.send(formData);
        }

        // Function to handle file download
        function downloadTemplate() {
            window.location.href = "download_template.php";
        }
    </script>
</head>
<body>

    <!-- Upload Excel button -->
    <h2>Upload Excel File</h2>
    <input type="file" name="excelFile" id="excelFile">
    <button type="button" onclick="uploadExcel()">Upload Excel</button>

    <!-- Download Excel button -->
    <h2>Download Excel Template</h2>
    <button type="button" onclick="downloadTemplate()">Download Excel Template</button>

</body>
</html>
