<?php
include('include/dbcon.php');

if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password before comparing
    $hashed_password = hash('sha256', $password);

    // Fetch user details including role using prepared statement
    $login_query = mysqli_prepare($con, "SELECT admin_id, role FROM admin WHERE username=? AND password=?");
    mysqli_stmt_bind_param($login_query, "ss", $username, $hashed_password);
    mysqli_stmt_execute($login_query);
    mysqli_stmt_store_result($login_query);

    // Check if user exists and get the user's details
    if (mysqli_stmt_num_rows($login_query) > 0){
        session_start();
        mysqli_stmt_bind_result($login_query, $admin_id, $role);
        mysqli_stmt_fetch($login_query);
        $_SESSION['id'] = $admin_id;

        // Check if the user is a super admin
        if ($role == 'super_admin') {
            // Redirect to the super admin dashboard
            echo "<script>alert('Successfully Logged in as Super Admin!'); window.location='super_admin_dashboard.php'</script>";
        } else {
            // Redirect to the regular admin dashboard
            echo "<script>alert('Successfully Logged in!'); window.location='admin_dashboard.php'</script>";
        }
    } else {
        // Invalid login credentials
        echo "<script>alert('Invalid Username and Password! Try again.'); window.location='index.php'</script>";
    }
}
?>