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

  // Get ID
  $student->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get student
  $student->read_single();

  // Create array
  $arr = array(
    'id' => $student->id,
    's_name' => $student->s_name,
    'age' => $student->age,
    'field' => $student->field
  );

  // Make JSON
  print_r(json_encode($arr));