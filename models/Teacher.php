<?php
  class Teacher {
    // DB Stuff
    private $conn;
    private $table = 'teacher';

    // Properties
    public $id;
    public $t_name;
    public $subject;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Teachers
    public function read() {
      // Create query
      $query = 'SELECT id, t_name, subject FROM ' . $this->table ;

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single teacher
  public function read_single(){
    // Create query
    $query = 'SELECT
          id,
          t_name,
          subject
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
      $this->t_name = $row['t_name'];
      $this->subject = $row['subject'];
  }

  // Create teacher entry
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      t_name = :t_name, subject = :subject';


  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->t_name = htmlspecialchars(strip_tags($this->t_name));
  $this->subject = htmlspecialchars(strip_tags($this->subject));

  // Bind data
  $stmt-> bindParam(':t_name', $this->t_name);
  $stmt-> bindParam(':subject', $this->subject);

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
      t_name = :t_name, subject = :subject
      WHERE
      id = :id';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->t_name = htmlspecialchars(strip_tags($this->t_name));
  $this->id = htmlspecialchars(strip_tags($this->id));
  $this->subject = htmlspecialchars(strip_tags($this->subject));

  // Bind data
  $stmt-> bindParam(':t_name', $this->t_name);
  $stmt-> bindParam(':subject', $this->subject);
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
