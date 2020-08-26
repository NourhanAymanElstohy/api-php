<?php
class Employee
{
    private $conn;
    private $employees = "employees";
    private $department = "department";

    public $id;
    public $name;
    public $phone;
    public $age;
    public $dept_id;
    public $dept_name;
    public $is_mgr;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function read()
    {
        $query = "SELECT
                d.id as dept_id, 
                d.name as dept_name, 
                e.id,
                e.is_mgr,
                e.name, 
                e.phone, 
                e.age 
            from $this->employees e, $this->department d 
            WHERE e.dept_id=d.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    public function read_single () 
    {
        $query = "SELECT e.id, e.name, e.phone, e.age from $this->employees e where e.id=?";
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
        $query = "INSERT INTO " . $this->employees .
            "(name, is_mgr, phone, age, dept_id) values(:name, :is_mgr,:phone, :age, :dept_id)";

        $stmt = $this->conn->prepare($query);

        $stmt->execute(array(
            ':name' => $this->name,
            ':is_mgr' => $this->is_mgr,
            ':phone' => $this->phone,
            ':age' => $this->age,
            ':dept_id' => $this->dept_id
        ));

        return $stmt;
    }

    public function update()
    {
        $query = "UPDATE $this->employees SET 
            name=:name, 
            phone=:phone,
            age=:age,
            dept_id=:dept_id,
            is_mgr=:is_mgr 
        WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->execute(array(
            ':id' => $this->id,
            ':name' => $this->name,
            ':phone' => $this->phone,
            ':age' => $this->age,
            ':dept_id' => $this->dept_id,
            ':is_mgr' => $this->is_mgr
        ));

        return $stmt;
    }

    public function delete()
    {
        $query = "DELETE from $this->employees WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->execute(array(
            ':id' => $this->id,
        ));

        return $stmt;
    }
}
