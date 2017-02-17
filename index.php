<?php
include ('includes/configure.php'); /*inclides configure file for database connection*/

include ('header.php'); /* inlcudes header file which consist meta tags and nav bar of website*/

/* Stores the get value of $page variable in url and routes according to its value*/
/* Routing mechanism for single page web application */
$page=$_GET['page'];
   switch ($page)
		    {
          case 'national-train-enquiry-system' : include ('pages/live-status.php');   
	        break;

          case 'pnr-status' : include ('pages/pnr-status.php');
		      break;

          case 'train' : include ('pages/train.php');
          break;


          case 'list' : include ('pages/list.php');
	        break;

          case 'seat-availability' : include ('pages/seat.php');
	        break;

          case 'trains-between-stations' : include ('pages/trainbtwstn.php');
	        break;

          case 'station-name-to-code' : include ('pages/stncode.php');
	        break;

          case 'time-table' : include ('pages/table.php');
          break;


          default: include('pages/home.php');    /* if $page is empty or get $page is empty then routes to home.php in pages folder (default value)*/
          break;

        }

include ('footer.php'); /* inlcludes footer file for website*/
?>
