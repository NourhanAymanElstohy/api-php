<?php
class Employee
{
    private $conn;
    private $table_name = "employees";

    public $id;
    public $name;
    public $phone;
    public $age;

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
    public function read_single () 
    {
        $query = "SELECT e.id, e.name, e.phone, e.age from $this->table_name e where e.id=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->phone = $row['phone'];
        $this->age = $row['age'];

        // return $stmt;
    }
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name .
            "(name, phone, age) values(:name, :phone, :age)";

        $stmt = $this->conn->prepare($query);

        $stmt->execute(array(
            ':name' => $this->name,
            ':phone' => $this->phone,
            ':age' => $this->age,
        ));

        return $stmt;
    }

    public function update()
    {
        $query = "UPDATE $this->table_name SET name=:name, phone=:phone,age=:age WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->execute(array(
            ':id' => $this->id,
            ':name' => $this->name,
            ':phone' => $this->phone,
            ':age' => $this->age,
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
