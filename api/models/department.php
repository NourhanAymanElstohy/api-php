<?php
class Department
{
    private $conn;
    private $table_name = "department";

    public $dept_id;
    public $dept_name;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function read()
    {
        $query = "SELECT * from " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    public function read_single()
    {
        $query = "SELECT d.id, d.name from $this->table_name d where d.id=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
    }
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name .
            "(name) values(:name)";

        $stmt = $this->conn->prepare($query);

        $stmt->execute(array(
            ':name' => $this->name,
        ));

        return $stmt;
    }

    public function update()
    {
        $query = "UPDATE $this->table_name SET name=:name WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->execute(array(
            ':id' => $this->id,
            ':name' => $this->name,
        ));

        return $stmt;
    }

    public function delete()
    {
        $query = "DELETE from $this->table_name WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->execute(array(
            ':id' => $this->id,
        ));

        return $stmt;
    }
}
