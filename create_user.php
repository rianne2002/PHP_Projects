<?php

    session_start();

    include("connection.php");

    if(!isset($_SESSION['username'])){
    
        header('location:login.php');
        
      }

    if(isset($_POST['submit'])){

        $first_name = mysqli_real_escape_string($conn,$_POST['first_name']);

        $last_name = mysqli_real_escape_string($conn,$_POST['last_name']);
 
        $username=mysqli_real_escape_string($conn,$_POST['username']);
 
        $phone_no=mysqli_real_escape_string($conn,$_POST['phone_no']);
 
        $email=mysqli_real_escape_string($conn,$_POST['email']);

        $role=mysqli_real_escape_string($conn,$_POST['role']);
 
        $password=mysqli_real_escape_string($conn,$_POST['password']);    

        $cpassword=mysqli_real_escape_string($conn,$_POST['cpassword']);

        $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";

        $password_strong = preg_match($password_regex, $password);

        if($password_strong==0){

            $password_error2="Password must contain at least one number, one uppercase letter, one lowercase letter, one special character, and at least 8 or more characters";

        }

        $password=md5($password);

        $cpassword=md5($cpassword);

        if(!preg_match("/^[a-zA-Z]+$/",$first_name)){

            $first_name_error="Name must contain only alphabets and spaces";

        }
        if(!preg_match("/^[a-zA-Z]+$/",$last_name)){

            $last_name_error="Name must contain only alphabets and spaces";

        }
        if(strlen($username)<6){

            $username_error="Username must contain atleast 6 characters";

        }
        if(strlen($phone_no)<10){

            $phone_no_error="Invalid mobile number";

        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

            $email_error="Invalid Email";

        }
        if($password!=$cpassword){

            $cpassword_error="Password and confirm password do not match";
        
        }
        if($password_strong && $password==$cpassword && filter_var($email,FILTER_VALIDATE_EMAIL) && strlen($phone_no)>=10 && strlen($username)>6 && preg_match("/^[a-zA-Z]+$/",$last_name) && preg_match("/^[a-zA-Z]+$/",$first_name)){
            
            $query1 = mysqli_query($conn,"select username from users where username='$username'");

            $query2 = mysqli_query($conn,"select email from users where email='$email'");

            if(mysqli_num_rows($query1)!=0){

                $username_error2= "Username already exists";

            }

            elseif(mysqli_num_rows($query2)!=0){

                $email_error2= "Email already registered continue to login";

            }

            else{

            mysqli_query($conn,"insert into users(first_name, last_name , username ,phone_no ,email, password, role) values('$first_name', '$last_name ', '$username', '$phone_no', '$email','$password', '$role')");

            }
        }

        mysqli_close($conn);

    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Create User</title>
    <link rel="stylesheet" href="create_user.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
</head>
<body>
    <div>
<?php include_once("nav_bar.php");?>
</div>
  <div class="container">
    
    <div class="title">Registration</div>
    <div class="content">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="user-details">
          <div class="input-box">
          <input type="text" id="fname" name="first_name" placeholder="First Name" required>
            <?php if (isset($first_name_error)) echo $first_name_error; ?>
          </div>
          <div class="input-box">
          <input type="text" id="lname" name="last_name" placeholder="Last Name" required>
            <?php if (isset($last_name_error)) echo $last_name_error; ?>
          </div>
          <div class="input-box">
          <input type="text" id="pno" name="phone_no" placeholder="Phone No" required>
            <?php if (isset($phone_no_error)) echo $phone_no_error; ?>
          </div>
          <div class="input-box">
          <input type="email" id="email" name="email" placeholder="Email" required>
            <?php if (isset($email_error)) echo $email_error; ?>
            <?php if (isset($email_error2)) echo $email_error2; ?>
          </div>
          <div class="input-box">
          <select name="role" required>
                <option value="">Select Role</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
          </div>
          <div class="input-box">
          <input type="text" id="uname" name="username" placeholder="Username" required>
            <?php if (isset($username_error)) echo $username_error; ?>
            <?php if (isset($username_error2)) echo $username_error2; ?>
            </div>
            <div class="input-box">
            <input type="password" id="pass" name="password"  placeholder="Password" required>
            <?php if (isset($password_error)) echo $password_error; ?>
            </div>
            <div class="input-box">
            <input type="password" id="cpass" name="cpassword" placeholder="Confirm Password" required>
            <?php if (isset($cpassword_error)) echo $cpassword_error; ?>
            </div>
            
          </div>
          <div class="button">
        <input type="submit" value="Create" name="submit">
        </div>
        </div>
       
            <?php if (isset($password_error2)) echo $password_error2; ?>
      </form>
    </div>
</body>
</html>