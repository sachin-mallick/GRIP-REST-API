<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Student.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate object
  $student = new Student($db);

  // Query
  $result = $student->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any students
  if($num > 0) {
    // Post array
    $arr = array();
    // $arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $item = array(
        'id' => $id,
        's_name' => $s_name,
        'age' => $age,
        'field' => $field,
      );

      // Push to "data"
      array_push($arr, $item);
      // push($arr['data'], $item);
    }

    // Turn to JSON & output
    echo json_encode($arr);

  } else {
    // No Students
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }
