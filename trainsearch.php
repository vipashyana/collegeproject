<?php
include ('includes/configure.php');  /*inclides configure file for database connection*/

/* $_GET['term'] stores the value inserted in train search form in live-status.php*/
if (isset($_GET['term'])) {
  $query=$_GET['term'];
  $s = ("SELECT tno, tname FROM train WHERE tno LIKE '%{$query}%' OR tname LIKE '%{$query}%'"); /*query to select all possible match with trai number or name inserted by user*/
  $sql=$conn->query($s);
$array = array();
  /*fetches the array in $row from $sql query execution and prints one by one in a row*/
  while ($row = $sql->fetch_assoc()) {   
      $array[] = array (
          'label' => $row['tno'].'-'.$row['tname'], 
          'value' => $row['tno'],
      );
  }
  //RETURN JSON ARRAY
  echo json_encode($array);
}
 ?>
