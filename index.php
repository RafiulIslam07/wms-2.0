

<html  lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log In Form</title>
    <link rel="icon" type="images/icon" href="Images/logo-upd.png">
    <link rel="stylesheet" href="stylesheet/login.css" />
  </head>
  <body>
    <div class="container">
      <div class="left-container">
        <h1>WasteLess<br />Log In</h1>
        <div class="horizontal-bar"></div>
        
      </div>

      <div class="right-container">
        <div class="hello">
          <h3>Hello Again!</h3>
          <p>
            Welcome back you've <br />
            been missed!
          </p>
        </div>
        <div class="form">
          <form action="index.php" method="post">
            <select id="user_type" name="user_type">
              <option value="" selected disabled>Select User Type</option>
              <option value="customer">Customer</option>
              <option value="service_provider">Service Provider</option>
              <option value="volunteer">Volunteer</option>
              <option value="admin">Admin</option>
            </select><br><br>
            <input
              type="number"
              name="ID"
              id="user id"
              placeholder="Enter your user id"
            />
            <br />
            <br />
            <input type="password" name = "password" placeholder="Password" />
           
            <button type="submit" >Sign in</button>
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
          Not a member? <a href="register.php" id="register-now-anchor">Register Now</a>
        </p>
      </div>
    </div>
    

  </body>
</html>

<?php




if($_SERVER['REQUEST_METHOD']=='POST'){
    
    include 'connect.php';
   
     
    $userType=$_POST['user_type'];
    $ID=$_POST['ID'];
    
    $password=$_POST['password'];
   
    

  
    
    $sql="SELECT * from USER where userID='$ID' and password='$password'";
    $result=mysqli_query($con,$sql);
    if($result){
        $num=mysqli_num_rows($result);
        if($num>0){
            $name_query = "SELECT firstName FROM USER WHERE userId = '$ID' and password ='$password'";
            $res = mysqli_query($con,$name_query);
            if ($res){
              
              $name = mysqli_fetch_assoc($res)['firstName'];
              session_start();
              $_SESSION['Name']=$name;
              $_SESSION['userID'] = $ID;
              if($userType=="customer"){
                header('location:home.php');
              }
              else if ($userType =="service_provider"){
                header('location:Service-provider/home-service-provider.php');
              }
              
              
            }
            
        }
      }    
      

          else{
              $invalid=1;
          }
  }
  ?>