<?php 
session_start();
$host="localhost";
$user="root";
$passw="";
$dbname="demo";
$conn=mysqli_connect($host,$user,$passw,$dbname);

if (isset($_POST['name']) && isset($_POST['email'])
    && isset($_POST['pass']) && isset($_POST['cpass'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['name']);
	$pass = validate($_POST['pass']);

	$re_pass = validate($_POST['cpass']);
	$name = validate($_POST['email']);

	$user_data = 'uname='. $uname. '&name='. $name;


	if (empty($uname)) {
		header("Location: fail.html?error=User Name is required&$user_data");
	    exit();
	}else if(empty($pass)){
        header("Location: fail.html?error=Password is required&$user_data");
	    exit();
	}
	else if(empty($re_pass)){
        header("Location: fail.html?error=Re Password is required&$user_data");
	    exit();
	}

	else if(empty($name)){
        header("Location: fail.html?error=Name is required&$user_data");
	    exit();
	}

	else if($pass !== $re_pass){
        header("Location: fail.html?error=The confirmation password  does not match&$user_data");
	    exit();
	}

	else{

		// hashing the password
        $pass = md5($pass);

	    $sql = "SELECT * FROM loginform WHERE Name='$uname'";

        

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result)>0) {
			header("Location: fail.html?error=The username is taken try another&$user_data");
	        exit();
		}else {
           $sql2 = "INSERT INTO loginform(Name, Email, Password) VALUES('$uname', '$name', '$pass')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
           	 header("Location: usermain.html?success=Your account has been created successfully");
	         exit();
           }else {
	           	header("Location: fail.html?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
	
}else{
	header("Location: usersignup.php");
	exit();
}

// if(isset($POST['btn'])){
//     // $user=mysqli_real_escape_string($conn,$_POST['user']);
//     // $email=mysqli_real_escape_string($conn,$_POST['email']);
//     // $pass=mysqli_real_escape_string($conn,$_POST['pass']);
//     // $cpass=mysqli_real_escape_string($conn,$_POST['cpass']);
//     $user=$_POST['user'];
//     $email=$_POST['email'];
//     $pass=$_POST['pass'];
//     $cpass=$_POST['cpass'];
// // if($pass==$cpass){
//     // echo "password does not match";
// // }
// // else{
//     // $check_email="SELECT * FROM loginform where email='$email'";
//     // $data=mysqli_query($conn,$check_email);
//     // $result=mysqli_fetch_array($data);
//     // if($result>0){
//     //     echo "Email already exists";
//     // }
//     // else{
        
//         echo $pass;
//         // $insert="insert into loginform (Name,Email,Password) values('$user','$email','$pass')";
//         // $q=mysqli_query($conn,$insert);
//         // if($q){
//         //     echo "Your account has been successfully created";
//         //     header("location: user.html");
//         // }

        
//     // }
// // }
// }
// ?>