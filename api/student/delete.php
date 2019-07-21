<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
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

  // Set ID to delete
  $student->id = $data->id;

  // Delete student
  if($student->delete()) {
    echo json_encode(
      array('message' => 'Student Data Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Student Data Not Deleted')
    );
  }

