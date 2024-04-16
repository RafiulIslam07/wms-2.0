
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" type="images/icon" href="Images/logo-upd.png">
    <link rel="stylesheet" href="stylesheet/home.css" />
    
    <title>WasteLess</title>
  </head>
  <body>
    <?php 
       include 'header.php';
    ?>
    <div class="img-container">
      <div class="waste-home-img">
        <img src="Images/home-01.jpg" alt="" />
      </div>
      <div class="indie-flower-regular">
        <p>YOUR CLUTTER IS<br />OUR BREAD & BUTTER</p>
      </div>
      <div class="pick-up">
        <a href="#pickUp">
           <p>Request a Pickup</p>
        </a>
        
      </div>
    </div>
    <div class="panel">
      <div class="load-size inner-div">
        <div class="load-size-img">
          <img src="Images/budget-icon.png" alt="" />
        </div>
        <p class="panel-para">YOU ESTIMATE<br />LOAD SIZE</p>
      </div>
      <div class="vertical-line"></div>
      <div class="load-size inner-div">
        <div class="load-size-img">
          <img src="Images/schedule.png" alt="" />
        </div>
        <p class="panel-para">YOU CHOOSE<br />A TIME</p>
      </div>
      <div class="vertical-line"></div>
      <div class="load-size inner-div">
        <div class="load-size-img">
          <img src="Images/trash-can.png" alt="" />
        </div>
        <p class="panel-para">WE PICK<br />& CLEAN UP</p>
      </div>
      <div class="vertical-line"></div>
      <div class="load-size inner-div">
        <div class="load-size-img">
          <img src="Images/truck.jpg" alt="" />
        </div>
        <p class="panel-para">WE RESPONSIBLY<br />DISPOSE</p>
      </div>
    </div>
    <div id="chartContainer"  ></div>
    <!-- Container for the form -->
    <div class="home-container">
        <div class="pickUp-left-container">
            <h3>Send Us Your Pick Up Request</h3></br>
           <p>We are available 24/7 in our service</p>
        </div>
        
        <div class="pickUp-right-container" id = "pickUp">
            <form action="home.php" method="post">
              <div class="grid-1">
                <input type="number" placeholder="Your Id" class="grid-01" name="userID"/>
                <input
                  type="text"
                  placeholder="Location"
                  name="location"
                  class="grid-01"
                />
                <input type="datetime-local" id="meeting-time" name="date"placeholder="Date & Time">
                <input type="number" placeholder="Waste Amount (kg)" class="grid-01" name="quantity"/>
                
              </div>
              <div class="grid-2">
                <select id="type" name="type">
                    <option value="" disabled selected>Select Waste Type</option>
                    <option value="Plastic">Plastic</option>
                    <option value="Glass">Glass</option>
                    <option value="Mix-Waste">Mix-Waste</option>
                    <option value="Paper">Paper</option>
                    <option value="Other">Other</option>
                </select><br>
              </div>
              <div class="grid-3">
                <button type="submit" class="grid-03" name="pickUpSend" value="pickUpSend">Send Request</button>
              </div>
          </form>
        </div>
        
    </div>
    <?php
      include 'footer.php';
    ?>
       <?php
            include 'connect.php';

            // sql query for the type and sum of quantity for showing the the chart
            $sql = "SELECT type, SUM(quantity) AS total_quantity
            FROM garbage_tracking
            GROUP BY type";
    
          // Execute the query
          $result = mysqli_query($con, $sql);
          
          // Check if the query was successful
          if ($result) {
              // Initialize an empty array to store the results
              $garbageTotals = array();
          
              // Fetch each row from the result set
              while ($row = mysqli_fetch_assoc($result)) {
                  // Store the type and total quantity in the array
                  $garbageTotals[$row['type']] = $row['total_quantity'];
              }
          
            
          }

            $dataPoints = array( 
              array("y" => $garbageTotals['Plastic'],"label" => "Plastic" ),
              array("y" => $garbageTotals['Glass'],"label" => "Glass" ),
              array("y" => $garbageTotals['Paper'],"label" => "Paper" ),
              array("y" => $garbageTotals['Mix-Waste'],"label" => "Mix-Waste" ),
              array("y" => $garbageTotals['Other'],"label" => "Other" )
            );
              
      ?>
      <script>
      window.onload = function() {
      
      var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title:{
          text: "Total Requested Garbage Collection Chart"
        },
        axisY: {
          title: "Total PickUp Garbage Quantity",
          includeZero: true,
          prefix: "",
          suffix:  "kg"
        },
        data: [{
          type: "bar",
          yValueFormatString: "#,##0Kg",
          indexLabel: "{y}",
          indexLabelPlacement: "inside",
          indexLabelFontWeight: "bolder",
          indexLabelFontColor: "white",
          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart.render();
      
      }
      </script>
      <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
  </body>
</html>

<?php 
   include 'connect.php';
   if (isset($_POST['pickUpSend'])){
     if (!empty($_POST['userID'])&&
         !empty($_POST['quantity'])&&
         !empty($_POST['location'])&&
         !empty($_POST['date'])&&
         !empty($_POST['type'])){

          $userID = $_POST['userID'];
          $quantity = $_POST['quantity'];
          $location = $_POST['location'];
          $date = $_POST['date'];
          $dateTime = date('Y-m-d H:i:s', strtotime($date));

      
          
          $type = $_POST['type'];

          $sql = "INSERT INTO garbage_tracking 
                  (location,quantity,type,c_userID,date)
                  VALUES ('$location',$quantity,'$type',$userID,'$dateTime')";

          $result = mysqli_query($con,$sql);

          if($result){
            echo "<script>alert('You request has been sent')</script>";
           
          }
          else{
            echo "<script>alert('You request was unsuccessful')</script>";
            
          }

      }
      else{
        echo "<script>alert('Please fill up all fields')</script>";
       
      }
        
   }


?>