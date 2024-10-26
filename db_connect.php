<?php
class Database
{
  private $host;
  private $username;
  private $password;
  private $dbname;
  private $conn;

  public function __construct()
  {
    $this->host = "localhost:3306";
    $this->username = "root";
    $this->password = "";
    $this->dbname = "bolashop";
    $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

    if ($this->conn->connect_error) {
      die("Kết nối không thành công: " . $this->conn->connect_error);
    }
  }
  public function query($sql)
  {
    $result = $this->conn->query($sql);

    // Kiểm tra và xử lý lỗi nếu có
    if (!$result) {
      die("Lỗi truy vấn: " . $this->conn->error);
    }

    return $result;
  }

  public function insert($sql)
  {
    if ($this->conn->query($sql) === TRUE) {
      return $this->conn->insert_id;
    } else {
      return false;
    }
  }

  // Phương thức ngắt kết nối
  public function close()
  {
    $this->conn->close();
  }
}
