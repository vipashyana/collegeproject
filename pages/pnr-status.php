
<div class="content">
        <h1>Check Pnr Status</h1>
<!-- form to input various variables using POST METHOD -->
        <form method="POST">
        <div class="input-box">
               <div class="input-area">
                   <div class="input-label"><label>Enter PNR Number</label></div>
                    <!-- $pnr input variables  -->  
                   <div class="input-filed"><input type="number" name="pnr" placeholder="enter 10 Digit PNR number" max="10" min="10" required> </div>
               </div>

               <div class="input-area">
                   <div><input type="submit" name="submit" class="submit-btn" value="submit"> </div>
               </div>


          </form>
       </div>


</div>

<?php

 if(isset($_POST['submit']))
{
/* variable for pnr number and intialized with POST method from above form*/  
$pnr=mysqli_real_escape_string($conn, $_POST['pnr']);

/*$file fetch data from api in json format*/
$file=file_get_contents("INSERT_YOUR_API_URL_TO_FETCH_DATA_FROM_SERVER");
         
/* stores decoded value of $file variable in array*/ 
$decode=json_decode($file,true);

/* if respond code is 200 means api has returned true values*/
if ($decode['response_code'] == 200)
{
    echo "<div class='result-box'>";
    echo "<div class='result-display'>";
        echo "PNR Enquiry for : <h3 style='color:red;'>".$decode['pnr']."</h3>";  
        /*prints pnr number queried*/
    echo "</div>";

    echo "<div class='result-table'>";
          echo "<table>";
            echo "<tr>";
               echo "<th>Train no.</th>";
               echo "<th>Train Name</th>";
               echo"<th>FROM</th>";
               echo "<th>TO</th>";
            echo "</tr>";

            echo "<tr>";
               echo "<td>".$decode['train_num']."</th>";             /*prints train number of pnr*/
               echo "<td>".$decode['train_name']."</th>";            /*prints train name*/
               echo"<td>".$decode['from_station']['name']."</th>";   /*prints boarding point*/
               echo "<td>".$decode['to_station']['name']."</th>";    /*prints destination point */
            echo "</tr>";


            echo "<tr>";
               echo "<th>Chart status</th>";
               echo "<th>Class</th>";
               echo"<th>Passenger</th>";
               echo "<th>DOJ</th>";
            echo "</tr>";

            echo "<tr>";
               echo "<td>".$decode['chart_prepared']."</th>";/*prints chart status*/
               echo "<td>".$decode['class']."</th>";/*prints reservation class of pnr number (SL/AC/3AC etc)*/
               echo"<td>".$decode['total_passengers']."</th>"; /*prints passenger count*/
               echo "<td>".$decode['doj']."</th>"; /*prints date of journey of pnr*/
            echo "</tr>";

           echo "</table>";

           echo "<table>";
            echo "<tr>";
               echo "<th>S.no</th>";
               echo "<th>Booking Status</th>";
               echo"<th>Current Status</th>";
               echo "<th>Coach postion</th>";
            echo "</tr>";
         
          /* foreach loop echo's stored data in $decode variable*/
          foreach($decode['passengers'] as $pass)
           {
            echo "<tr>";
               echo "<td>".$pass['no']."</th>";
               echo "<td>".$pass['booking_status']."</th>"; /*prints booking status of pnr */
               echo"<td>".$pass['current_status']."</th>";  /*prints current status of pnr*/
               echo "<td>".$pass['coach_position']."</th>"; /*prints coach position if specified*/
            echo "</tr>";
          }
           echo "</table>";
     echo "</div>";


   echo "</div>";
}
/* if respond code is 410 means pnr is either flushed or false pnr*/
elseif ($decode['response_code'] == 410) {
   echo "<div class='result-box'>";
    echo "<div class='result-display'>";
        echo "<h3 style='color:red;'>Flushed PNR / PNR not yet generated</h3>";
    echo "</div>";
    echo "</div>";

}

/* if respond code is 202 means pnr is correct but server is not responding*/
elseif ($decode['response_code'] == 202) {
    echo "<div class='result-box'>";
    echo "<div class='result-display'>";
        echo "<h3 style='color:red;'>Service Down / Source not responding</h3>";
    echo "</div>";
    echo "</div>";
}

else {
    echo "<div class='result-box'>";
    echo "<div class='result-display'>";
        echo "<h3 style='color:red;'>Service Down / Source not responding</h3>";
    echo "</div>";
    echo "</div>";
}

}

?>
<div class="sub-menu">
<ul class="topnav">
  <li><a class="spot" href="national-train-enquiry-system">spot your train</a></li>
  <li><a class="pnr" href="pnr-status">Pnr Status</a></li>
  <li><a class="fare" href="pnr-status">Fare Enquiry</a></li>
  <li><a class="time" href="pnr-status">Train Time Table</a></li>
  <li><a class="seat" href="seat-availability">Seat Availability</a></li>
  <li><a class="tbstn" href="trains-between-stations">Trains Between Stations</a></li>
</ul>
</div>
