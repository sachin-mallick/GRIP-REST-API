<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Subject.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate object
  $subject = new Subject($db);

  // Category read query
  $result = $subject->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any subject
  if($num > 0) {
        // array
        $arr = array();
        $arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $item = array(
            'id' => $id,
            'subj_name' => $subj_name,
            'marks' => $marks
          );

          // Push to "data"
          array_push($arr['data'], $item);
        }

        // Turn to JSON & output
        echo json_encode($arr);

  } else {
        // No Subject Category
        echo json_encode(
          array('message' => 'No Subject Found')
        );
  }
