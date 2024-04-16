<?php  
   session_start();

?>
<header>
  <div class="logo">
    <a href="home.php">
      <img src="Images/logo-upd.png" alt="Logo" />
    </a>
  </div>
  <nav>
    <ul>
      <li><a href="home.php">Home</a></li>
      <li>
        <a href="about.php">About</a>
      </li>
      <li>
        <a href="our-services.php">Our Services</a>
      </li>
      <li><a href="industries.php">Industries</a></li>
      <li><a href="contact.php">Contact Us</a></li>
      <li><a href="logout.php">Log Out</a></li>
      
      <li id="person-img-txt">
        <a href="#">
          <img src="Images/person.png">
          <span><?php if(isset($_SESSION['Name'])){
              echo $_SESSION['Name'];
              
          }
          else{
            echo "LogIn";}?></span>
        </a>
      </li>

      
      
    </ul>
  </nav>
</header>
