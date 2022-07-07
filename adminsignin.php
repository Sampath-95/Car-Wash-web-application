
<?php 
session_start();
$host="localhost";
$user="root";
$passw="";
$dbname="demo";
$conn=mysqli_connect($host,$user,$passw,$dbname);

// if(isset($_POST['user']) && isset($_POST['pass'])){
//     function validate($data){
//         $data=trim($data);
//         $data=stripslashes($data);
//         $data=htmlspecialchars($data);
//         return data;
//     }
// }
if(isset($_POST['user']) && isset($_POST['pass'])){
$uname=$_POST['user'];
$password=$_POST['pass'];
// if(empty($uname)){
//     echo "enter username";
// }
// else if(empty($password)){
//     echo "enter password";
// }

    
    $sql="select * from loginform where Name='$uname' AND Password='$password' limit 1";
    
    $result=mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result)===1){
        $row=mysqli_fetch_assoc($result);
        if($row['Name']===$uname && $row['Password']===$password){
        echo "login successfull";
        header("location: adminmain.html");
        exit();
        }
    }
    else{
        echo "login is unsuccessfull";
        header("location: fail.html");
        exit();
    }
}

?>
