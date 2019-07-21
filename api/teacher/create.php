<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Teacher.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate  object
  $teacher = new Teacher($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $teacher->t_name = $data->t_name;
  $teacher->subject = $data->subject;

  // Create entry
  if($teacher->create()) {
    echo json_encode(
      array('message' => 'Teacher Data Entry Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Teacher Data Entry Not Created')
    );
  }
