<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Student.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate object
  $student = new Student($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $student->id = $data->id;
  $student->s_name = $data->s_name;
  $student->age = $data->age;
  $student->field = $data->field;

  // Update student data
  if($student->update()) {
    echo json_encode(
      array('message' => 'Student Data Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Student Data Not Updated')
    );
  }

