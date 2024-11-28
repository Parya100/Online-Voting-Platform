<?php 
include("connect.php");  


$name = isset($_POST['name']) ? mysqli_real_escape_string($connect, $_POST['name']) : '';
$email = isset($_POST['email']) ? mysqli_real_escape_string($connect, $_POST['email']) : '';
$mobile = isset($_POST['mobile']) ? mysqli_real_escape_string($connect, $_POST['mobile']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$cpassword = isset($_POST['cpassword']) ? $_POST['cpassword'] : '';
$address = isset($_POST['address']) ? mysqli_real_escape_string($connect, $_POST['address']) : '';
$tmp_name = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';
$image = isset($_FILES['image']['name']) ? mysqli_real_escape_string($connect, $_FILES['image']['name']) : '';
$role = isset($_POST['role']) ? mysqli_real_escape_string($connect, $_POST['role']) : 'user'; 


if($password == $cpassword) {
   
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
   
    if($image && $tmp_name) {
       
        if (!file_exists("../uploads")) {
            mkdir("../uploads", 0777, true);  
        }
        move_uploaded_file($tmp_name, "../uploads/$image");
    }

   
    $query = "INSERT INTO users (name, email, mobile, password, address, image, role) 
              VALUES ('$name', '$email', '$mobile', '$hashed_password', '$address', '$image', '$role')";

   
    $insert = mysqli_query($connect, $query);

  
    if(!$insert) {
        $error = mysqli_error($connect);  // Get the error from MySQL
        error_log("MySQL Error: " . $error, 0);  // Log the error
        echo '
        <script>
            alert("Some error occurred: ' . $error . '");
            window.location = "../routes/register.html";
        </script>
        ';
    }
    
    
} else {
    echo '
    <script>
        alert("Password and Confirm password do not match!");
        window.location = "../routes/register.html";
    </script>
    ';
}
?>
