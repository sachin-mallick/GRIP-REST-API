<?php 
  class Student {
    // DB stuff
    private $conn;
    private $table = 'student';

    // Post Properties
    public $id;
    public $s_name;
    public $age;
    public $field;


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT p.id, p.s_name, p.age, p.field FROM ' . $this->table . ' p ' ;
                                
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT p.id, p.s_name, p.age, p.field
                                    FROM ' . $this->table . ' p
                                    WHERE
                                      p.id = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->s_name = $row['s_name'];
          $this->age = $row['age'];
          $this->field = $row['field'];
        
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET s_name = :s_name, age = :age, field = :field';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->s_name = htmlspecialchars(strip_tags($this->s_name));
          $this->age = htmlspecialchars(strip_tags($this->age));
          $this->field = htmlspecialchars(strip_tags($this->field));

          // Bind data
          $stmt->bindParam(':s_name', $this->s_name);
          $stmt->bindParam(':age', $this->age);
          $stmt->bindParam(':field', $this->field);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET s_name = :s_name, age = :age, field = :field
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->s_name = htmlspecialchars(strip_tags($this->s_name));
          $this->age = htmlspecialchars(strip_tags($this->age));
          $this->field= htmlspecialchars(strip_tags($this->field));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':s_name', $this->s_name);
          $stmt->bindParam(':age', $this->age);
          $stmt->bindParam(':field', $this->field);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Post
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }