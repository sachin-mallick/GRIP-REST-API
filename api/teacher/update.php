<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Teacher.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate object
  $teacher = new Teacher($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $teacher->id = $data->id;
  $teacher->t_name = $data->t_name;
  $teacher->subject = $data->subject;

  // Update data
  if($teacher->update()) {
    echo json_encode(
      array('message' => 'Teacher Data Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Teacher Data Not Updated')
    );
  }
