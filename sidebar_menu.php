<!-- sidebar navigation -->
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="home.php" class="site_title"><i class="fa fa-university"></i> <span>DASHBOARD</span></a>
        </div>
        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <a href="admin_profile.php">
            <div class="profile">
                <?php
                include('include/dbcon.php');
                $user_query = mysqli_query($con, "select *  from admin where admin_id='$id_session'") or die(mysqli_error());
                $row = mysqli_fetch_array($user_query);
                ?>
                <div class="profile_pic">
                    <?php if($row['admin_image'] != ""): ?>
                    <img src="upload/<?php echo $row['admin_image']; ?>" style="height:65px; width:75px;" class="img-thumbnail profile_img">
                    <?php else: ?>
                    <img src="images/user.png" style="height:65px; width:75px; border-radius:100px;" class="img-circle profile_img">
                    <?php endif; ?>    
                </div>

                <div class="profile_info">
                    <span>Welcome,</span>
                    <h2><?php echo $row['firstname']; ?></h2>
                </div>
            </div>
        </a>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3 style="margin-top:85px;">Location Mapping</h3>
                <div class="separator"></div>
                <ul class="nav side-menu">
                    <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="backend.php"><i class="fa fa-home"></i> Store list</a></li>
                    <li><a href="store.php"><i class="fa fa-home"></i> Store Outlets</a></li>
                    <li><a href="theatre.php"><i class="fa fa-home"></i> Theatre Outlets</a></li>
                                        <li><a href="backend1.php"><i class="fa fa-home"></i> Store-new</a></li>
                                        <li><a href="theatre1.php"><i class="fa fa-home"></i> Theatre-new</a></li>
                                          <li><a href="brandlist.php"><i class="fa fa-home"></i> Brand List</a></li>
                                            <li><a href="mismatch.php"><i class="fa fa-home"></i> Missing Data</a></li>
                     <!--<li><a href="brand.php"><i class="fa fa-home"></i> Brand</a></li>-->
                    <?php
                    if ($row['role'] == 'super_admin') {
                        echo '<li><a href="setting.php"><i class="fa fa-home"></i>Settings</a></li>';
                        // Add more menu items here
                  
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>
<!-- end of sidebar navigation -->
