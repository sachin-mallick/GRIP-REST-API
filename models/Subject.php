<?php
  class Subject {
    // DB Stuff
    private $conn;
    private $table = 'subject';

    // Properties
    public $id;
    public $subj_name;
    public $marks;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Subjects
    public function read() {
      // Create query
      $query = 'SELECT id, subj_name, marks FROM ' . $this->table ;

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Subject
  public function read_single(){
    // Create query
    $query = 'SELECT
          id,
          subj_name,
          marks
        FROM
          ' . $this->table . '
      WHERE id = ?
      LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->id = $row['id'];
      $this->subj_name = $row['subj_name'];
      $this->marks = $row['marks'];
  }

  // Create subject entry
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      subj_name = :subj_name, marks = :marks';


  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->subj_name = htmlspecialchars(strip_tags($this->subj_name));
  $this->marks = htmlspecialchars(strip_tags($this->marks));

  // Bind data
  $stmt-> bindParam(':subj_name', $this->subj_name);
  $stmt-> bindParam(':marks', $this->marks);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Update teacher data
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      subj_name = :subj_name, marks = :marks
      WHERE
      id = :id';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->subj_name = htmlspecialchars(strip_tags($this->subj_name));
  $this->id = htmlspecialchars(strip_tags($this->id));
  $this->marks = htmlspecialchars(strip_tags($this->marks));

  // Bind data
  $stmt-> bindParam(':subj_name', $this->subj_name);
  $stmt-> bindParam(':marks', $this->marks);
  $stmt-> bindParam(':id', $this->id);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Delete teacher entry
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind Data
    $stmt-> bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
  }
