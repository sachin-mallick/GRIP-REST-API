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

  // Get ID
  $subject->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get subject
  $subject->read_single();

  // Create array
  $arr = array(
    'id' => $subject->id,
    'subj_name' => $subject->subj_name,
    'marks' => $subject->marks
  );

  // Make JSON
  print_r(json_encode($arr));
