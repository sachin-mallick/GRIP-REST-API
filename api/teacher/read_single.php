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

  // Get ID
  $teacher->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get teacher
  $teacher->read_single();

  // Create array
  $arr = array(
    'id' => $teacher->id,
    't_name' => $teacher->t_name,
    'subject' => $teacher->subject
  );

  // Make JSON
  print_r(json_encode($arr));
