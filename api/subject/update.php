<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Subject.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate object
  $subject = new Subject($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $subject->id = $data->id;
  $subject->subj_name = $data->subj_name;
  $subject->marks = $data->marks;

  // Update data
  if($subject->update()) {
    echo json_encode(
      array('message' => 'Subject Data Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Subject Data Not Updated')
    );
  }
