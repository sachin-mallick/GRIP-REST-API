<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Teacher.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate object
  $teacher = new Teacher($db);

  // Category read query
  $result = $teacher->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any teachers
  if($num > 0) {
        // array
        $arr = array();
        $arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $item = array(
            'id' => $id,
            't_name' => $t_name,
            'subject' => $subject
          );

          // Push to "data"
          array_push($arr['data'], $item);
        }

        // Turn to JSON & output
        echo json_encode($arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Teachers Found')
        );
  }
