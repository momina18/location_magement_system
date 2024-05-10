<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Home / Students</small>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <!-- If needed 
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a></li>
                                    <li><a href="#">Settings 2</a></li>
                                </ul>
                            </li>
						-->
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
            
                    <div class="row">
                
                <div class="col-md-6">
                        <!-- content starts here -->
                        <h2>Personal Information</h2>
                            <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">ID Number <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="number" name="school_number" id="first-name2" required="required" class="form-control col-md- col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">First Name <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="firstname" placeholder="First Name....." id="first-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Middle Name
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="middlename" placeholder="MI / Middle Name....." id="first-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Last Name <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="lastname" placeholder="Last Name....." id="last-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Contact
                                    </label>
                                    <div class="col-md-4">
                                    <input type="tel" pattern="[0-9]{10}" autocomplete="off" maxlength="10" name="contact" id="last-name2" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Gender <span class="required" style="color:red;">*</span>
                                    </label>
									<div class="col-md-4">
                                        <select name="gender" class="select2_single form-control" required="required" tabindex="-1" >
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>								
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Address
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="address" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
</div>

<div class="col-md-6">
                                <h2>Education Information</h2>
                                <div class="form-group ">
									<label class="control-label col-md-3 " for="last-name">Type <span class="required" style="color:red;">*</span>
									</label>
									<div class="col-md-8">
                                        <select name="type" class="select2_single form-control" required="required" tabindex="-1" >
                                            <option value="Student">Student</option>
                                            <!-- <option value="Teacher">Teacher</option> -->
                                        </select>
                                    </div>
                                    </div>
                                <div class="form-group">
									<label class="control-label col-md-3" for="last-name">College Stream <span class="required" style="color:red;">*</span>
									</label>
									<div class="col-md-8">
                                        <select name="level" class="select2_single form-control" required="required" tabindex="-1" >
                                            <option value="Bachelor of Arts (B.A)">Bachelor of Arts (B.A)</option>
                                            <option value="Bachelor of Commerce (B.Com)">Bachelor of Commerce (B.Com)</option>
                                            <option value="Bachelor of Fine Arts (B.A) Music">Bachelor of Fine Arts (B.A) Music</option>
                                            <option value="Bachelor of Visual Arts (B.V.A)">Bachelor of Visual Arts (B.V.A)</option>
                                            <option value="Bachelor of Home Science (B.Sc.) Food Science and Nutrition">Bachelor of Home Science (B.Sc.) Food Science and Nutrition</option>

                                            <option value="Bachelor of Home Science (B.Sc.) Human Development">Bachelor of Home Science (B.Sc.) Human Development</option>
                                            <option value="Bachelor of Home Science (B.Sc.) Family Resource Management">Bachelor of Home Science (B.Sc.) Family Resource Management</option>
                                            <option value="Bachelor of Home Science (B.Sc.) Family Resource Management">Bachelor of Home Science (B.Sc.) Family Resource Management</option>

                                            <option value="Bachelor of Home Science (B.Sc.) Family Resource Management">Bachelor of Home Science (B.Sc.) Textile Science</option>



                                            <option value="Bachelor of Home Science (B.Sc.) Family Resource Management">Bachelor of Technology (B.Tech.) Electronics & Telecommunication</option>
                                            

                                            <option value="Faculty">Faculty</option>
                                        </select>
                                </div>
                                    </div>
                                <!-- <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Section <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" name="section" placeholder="Section....." id="first-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div> -->



                                <div class="form-group">
    <label class="control-label col-md-3" for="first-name">Section <span class="required" style="color:red;">*</span></label>
    <div class="col-md-8">
        <select name="section" class="form-control col-md-7 col-xs-12" required>
            <option value="" disabled selected>Select Section</option>
            <option value="English">English</option>
            <option value="Hindi">Hindi</option>
            <option value="Marathi">Marathi</option>
            <option value="Gujarati">Gujarati</option>
        </select>
    </div>
</div>
              

</div>
</div>

<!---        <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">User Image <span class="required">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="file" style="height:44px;" name="image" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>	-->
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
                                        <a href="user.php"><button type="button" class="btn btn-primary"><i class="fa fa-times-circle-o"></i> Cancel</button></a>
                                        <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-plus-square"></i> Submit</button>
                                    </div>
                                </div>
                            </form>
							
							<?php	
							include ('include/dbcon.php');
                if (isset($_POST['submit'])){
							
		//					if (!isset($_FILES['image']['tmp_name'])) {
		//					echo "";
		//					}else{
		//					$file=$_FILES['image']['tmp_name'];
		//					$image = $_FILES["image"] ["name"];
		//					$image_name= addslashes($_FILES['image']['name']);
		//					$size = $_FILES["image"] ["size"];
		//					$error = $_FILES["image"] ["error"];
		//					
		//					{
		//								if($size > 10000000) //conditions for the file
		//								{
		//								die("Format is not allowed or file size is too big!");
		//								}
		//								
		//							else
		//								{
		//
		//							move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" . $_FILES["image"]["name"]);			
		//							$profile=$_FILES["image"]["name"];
									$school_number = $_POST['school_number'];
									$firstname = $_POST['firstname'];
									$middlename = $_POST['middlename'];
									$lastname = $_POST['lastname'];
									$contact = $_POST['contact'];
									$gender = $_POST['gender'];
									$address = $_POST['address'];
									$type = $_POST['type'];
									$level = $_POST['level'];
									$section = $_POST['section'];
					
					$result=mysqli_query($con,"select * from user WHERE school_number='$school_number' ") or die (mysqli_error());
					$row=mysqli_num_rows($result);
					if ($row > 0)
					{
					echo "<script>alert('ID Number already active!'); window.location='user.php'</script>";
					}
					else
					{		
						mysqli_query($con,"insert into user (school_number,firstname, middlename, lastname, contact, gender, address, type, level, section, status, user_added)
						values ('$school_number','$firstname', '$middlename', '$lastname', '$contact', '$gender', '$address', '$type', '$level', '$section', 'Active', NOW())")or die(mysqli_error());
						echo "<script>alert('User successfully added!'); window.location='user.php'</script>";
					}
			//						}
			//						}
							}
								?>
						
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>