

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact</title>
    <link rel="icon" type="images/icon" href="Images/logo-upd.png">
    <link rel="stylesheet" href="stylesheet/contact.css" />
    <link rel="stylesheet" href="stylesheet/home.css" />
  </head>
  <body>
    <?php 
       include 'header.php';
    ?>
    <div class="background-img">CONTACT US</div>
    <div class="container">
      <div class="left-container">
        <p id="beg-para">Contact With Us</p>
        <h2>HAVE QUESTIONS? FEEL FREE <br />TO WRITE US</h2>
        <p id="para-02">
          We will be delighted to hear from you. <br />Just drop you queries in
          the right box
        </p>
        <div class="call">
          <div class="call-logo">
            <img src="Images/call.png" alt="" />
          </div>
          <div class="text">
            <p>Call Anytime<br />0178.......</p>
          </div>
        </div>
        <div class="call">
          <div class="call-logo">
            <img src="Images/email.png" alt="" />
          </div>
          <div class="text">
            <p>Email Us<br />infoWaste@gmail.com</p>
          </div>
        </div>
        <div class="call">
          <div class="call-logo">
            <img src="Images/visit.png" alt="" />
          </div>
          <div class="text">
            <p>Visit Us Anytime<br />Agargaon,Dhaka</p>
          </div>
        </div>
      </div>
      <div class="right-container">
        <form action="">
          <div class="grid-1">
            <input type="text" placeholder="Your Name" class="grid-01" />
            <input
              type="text"
              placeholder="Email Address"
              name=""
              class="grid-01"
            />
            <input type="text" placeholder="Phone Number" class="grid-01" />
            <input type="text" placeholder="Subject" name="" class="grid-01" />
          </div>
          <div class="grid-2">
            <input type="text" placeholder="Message" class="grid-02" />
          </div>
          <div class="grid-3">
            <button type="submit" class="grid-03">Send Message</button>
          </div>
        </form>
      </div>
    </div>
    <?php 
      
    
      include 'footer.php';
    ?>
  </body>
</html>


