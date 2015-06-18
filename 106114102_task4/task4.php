<!DOCTYPE html>
<html>
<style>
.error {color: #FF0000;}
</style>
<body>
<?php
// define variables and set to empty values
session_start();
$nameErr = $emailErr = $rollErr = $yrofstudyErr = $deptErr ="";
$pass = $name = $email = $dept = $yrofstudy = $rollno = "";
$flag=5;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$pass=$_POST["psw"];
	if (empty($_POST["dept"])) {
     		$deptErr = "Dept is required";

   	} else {
     		$dept = test_input($_POST["dept"]);
     		// check if name only contains letters and whitespace
     		if (!preg_match("/^[a-zA-Z ]*$/",$dept)) {
       			$deptErr = "Only letters and white space allowed"; }
			else $flag--;   
	}
	if (empty($_POST["name"])) {
     		$nameErr = "Name is required";

	} else {
     		$name = test_input($_POST["name"]);
     		// check if name only contains letters and whitespace
     		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       			$nameErr = "Only letters and white space allowed"; 

			}else $flag--;	
		}
   		if (empty($_POST["email"])) {
	     		$emailErr = "Email is required";
	
   		} else {
     			$email = test_input($_POST["email"]);
     			// check if e-mail address is well-formed
     			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       			$emailErr = "Invalid email format"; 

     			}else $flag--;
   		}
     
   		if (empty($_POST["rollno"])) {
	     		$rollErr = "Roll Number required!!";

   		} else {
     			$rollno = test_input($_POST["rollno"]);
    
		     if (is_numeric($rollno)==0) {
	       			$rollErr = "Invalid Roll Number"; 
		
	     		}else $flag--;
   		}
   
		if (empty($_POST["yrofstudy"])) {
	     		$yrofstudyErr = "Required";
		} else {
	     		$yrofstudy = test_input($_POST["yrofstudy"]);
    
    	 		if (is_numeric($yrofstudy)==0) {
       				$yrofstudyErr = "Invalid Year of study";

			}else $flag--;
  		}	
  	} 	


  

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


function update(){
	global $name,$dept,$email,$pass,$rollno,$yrofstudy; 	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "deltatask4";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if (!$conn) {
    		die("Connection failed: " . mysqli_connect_error());
	}

	
	$sql = "INSERT INTO students(rollno, studentname, dept, yrofstudy, email, password) VALUES ('$rollno','$name','$dept','$yrofstudy','$email','$pass')";
	//insert the image
	

	if($conn->query($sql)==TRUE){
	
	echo "Data successfully entered.<br>";	
	$sql="SELECT ID FROM students WHERE rollno='$rollno' ";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	//insert image if other data is inserted
	
	$target_dir = "uploads/";
	$target_file = $target_dir . $rollno .".jpg"; 
	$uploadOk = 1;
	if(isset($_POST["submit"])) {
    		$check = getimagesize($_FILES["image"]["tmp_name"]);
    		if($check !== false) {
        	$uploadOk = 1;
    	} else {
        	echo "File is not an image.<br>";
     	   	$uploadOk = 0;
   		 }
	}
// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.<br>";
	    $uploadOk = 0;
	}
// Check file size
	if ($_FILES["image"]["size"] > 500000) {
    		echo "Sorry, your file is too large.<br>";
 	   	$uploadOk = 0;
	}

// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
    	echo "Sorry, your file was not uploaded.<br>";

// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        	echo "The file  has been uploaded.<br>";
    	} else {
        	echo "Sorry, there was an error uploading your file.<br>";
	    }
	}	





		
	echo "Your Unique Number is---";
	echo $row["ID"];
	 	}
	else echo "Data already exists.<br>";
	$conn->close();
}
global $txt;
if($flag==0){
if($_POST["captcha"]==$_SESSION["captcha"])
update();

else echo "WRONG CAPTCHA.<br>";



}
else echo "Something went wrong on your side";
echo "Please ignore the above message if you are entering data for the first time";
?>
<h2>Student  Registration Form</h2>
<span class="error"> *:required fields:</span>
<form action="task4.php" method="post" enctype="multipart/form-data">
<h3>Roll Number:</h3>
<input type="number" name="rollno" min="100000000" max="999999999" required value="<?php echo $rollno;?>">
<br> <span class="error">* <?php echo $rollErr;?></span>
<h3>Name:</h3>
<input type="text" name="name"  maxlength="35" required value="<?php echo $name; ?>">
<br> <span class="error">* <?php echo $nameErr;?></span>
<h3>Department:</h3>
<input type="text" name="dept"  required maxlength="20" value="<?php echo $dept; ?>">
<br> <span class="error">* <?php echo $deptErr;?></span>
<h3>Year of Study:(enter the entry year)</h3>
<input type="number" name="yrofstudy"  min="1920" max="2050" required value="<?php echo $yrofstudy; ?>">
<br> <span class="error">* <?php echo $yrofstudyErr;?></span>
<h3>E-mail:</h3>
<input type="email" name="email" required value="<?php echo $email; ?>">
<br> <span class="error">* <?php echo $emailErr;?></span>
<h3>Password:</h3>
<input type="password" name="psw" required>
<br><span class="error">* </span>
<br>

<h3>Upload Profile Pic:(optional)</h3>
Select image to upload:
    <input type="file" name="image" id="image"  />
<br>
<h3> Enter Captcha: </h3> <img src="captcha.php"> <input type="number" name="captcha" required>
<span class="error">* </span>
<br>
<input type="submit" value="submit" name="submit">

</form>

</body>
</html>
