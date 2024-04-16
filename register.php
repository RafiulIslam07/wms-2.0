<html  lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log In Form</title>
    <link rel="icon" type="images/icon" href="Images/logo-upd.png">
    <link rel="stylesheet" href="stylesheet/register.css" />
  </head>
  <body>
    <div class="container">
      <div class="left-container">
        <h1>WasteLess<br />Registration</h1>
        <div class="horizontal-bar"></div>
        
      </div>

      <div class="right-container">
        <div class="hello">
          <h3>Hey!</h3>
          <p>
            Register to Clean <br />
            Your Place!
          </p>
        </div>
        <div class="form">
          <form action="register.php" method="post">
           
              <input
                type="text"
                name="firstName"
                id="firstName"
                placeholder="First Name"
              />
              
              <input
                type="text"
                name="lastName"
                id="lastName"
                placeholder="Last Name"
              />
           
            
            
            <input type="date" name="dateOfBirth"placeholder="Date of Birth">
            <select id="gender" name="gender">
              <option value="" selected disabled>Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
              
            </select>
            <input type="email" name="email" id=""placeholder="Email">
            <input type="number" name="phone" id="" placeholder="Phone">
            <input type="text" name="address" placeholder="Address" id="address">
            <input type="password" name="password" placeholder="Password" />
            <select id="user_type" name="user_type">
              <option value="" selected disabled>Select User Type</option>
              <option value="customer">Customer</option>
              <option value="service_provider">Service Provider</option>
              <option value="volunteer">Volunteer</option>
              <option value="admin">Admin</option>
            </select><br><br>
           
           
           
            <button type="submit" name="submit" value="submit">Register</button>
          </form>
        </div>

        <p id="continue-with">----- or continue with -----</p>
        <div class="sign-in-option">
          <div class="google"><img src="Images/google.png" alt="" /></div>
          <div class="github"><img src="Images/github.png" alt="" /></div>
          <div class="facebook">
            <img src="Images/facebook.png" alt="" />
          </div>
        </div>
        <p>
          Already a member? <a href="index.php" id="register-now-anchor">Log In</a>
        </p>
      </div>
    </div>
  
    <!-- <script src="Scripts/scripts.js" ></script> -->
    <script src="Scripts/script.js"></script>
  </body>
</html>
<?php
$success=0;
$user=0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect.php';

    $firstName=$_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $entryDate =  date('Y-m-d');
    $userType = $_POST['user_type'];
    $password=$_POST['password'];
    
    if(isset($_POST["submit"])){
      if( !empty($_POST['firstName']) &&
          !empty($_POST['lastName']) &&
          !empty($_POST['password']) &&
          !empty($_POST['user_type'])){
            $sql = "INSERT INTO user (firstName,lastName,dateOfBirth,gender,email,phone,address,entryDate,password) 
            VALUES ('$firstName','$lastName',$dateOfBirth,'$gender','$email',$phone,'$address',$entryDate,'$password')";
            $result=mysqli_query($con,$sql);
            if ($userType =="customer"){
              if($result){
                $get_id = "SELECT userID FROM USER
                        WHERE firstName='$firstName' AND
                        lastName ='$lastName' AND 
                        password = '$password' ";
                $result2 = mysqli_query($con,$get_id);
                if ($result2){
                  $num = mysqli_num_rows($result2);
                  if ($num>0){
                      $userID = mysqli_fetch_assoc($result2)['userID'];
                      // INSERTING USER ID INTO CUSTOMER TABLE
  
                      $query = "INSERT INTO customer(c_userID) VALUES ($userID)";
                      mysqli_query($con,$query);
                      // Create a JavaScript script tag to execute after the page has loaded
                      echo '<script>window.onload = function() {';
                        echo 'alert("You have registered successfully! Your ID is ' . $userID . '");';
                        echo 'window.location.href = "index.php";';
                        echo '}</script>';
  
                  
  
                   
                      
                  }
                }
              }
              
            }
            else if ($userType="service_provider"){
              if($result){
                $get_id = "SELECT userID FROM USER
                        WHERE firstName='$firstName' AND
                        lastName ='$lastName' AND 
                        password = '$password' ";
                $result2 = mysqli_query($con,$get_id);
                if ($result2){
                  $num = mysqli_num_rows($result2);
                  if ($num>0){
                      $userID = mysqli_fetch_assoc($result2)['userID'];
                      // INSERTING USER ID INTO service provider table TABLE
                   
                      $query = "INSERT INTO service_provider(s_userID) VALUES ($userID)";
                      mysqli_query($con,$query);
                      // Create a JavaScript script tag to execute after the page has loaded
                      echo '<script>window.onload = function() {';
                        echo 'alert("You have registered successfully! Your ID is ' . $userID . '");';
                        echo 'window.location.href = "index.php";';
                        echo '}</script>';
                  }      
                }
              }
            }
          }

           
             
             
        }
        else{
              die(mysqli_error($con));
        }
    }


?>