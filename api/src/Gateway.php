<?php
class Gateway
{
  private PDO $conn;

  public function __construct(Database $database)
  {
    $this->conn = $database->getConnection();
  }

  public function getAll(): array
  {
    $sql = "SELECT * FROM product";

    $get = $this->conn->query($sql);

    $data = [];

    while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
      $data[] = $row;
    }
    return $data;
  }

  public function create(array $data)
  {

      $sql = "INSERT INTO product (sku,name,price,type,attribute_value) VALUES (:sku,:name,:price,:type,:attribute_value)";

      $post = $this->conn->prepare($sql);

      $post->bindValue(":sku", $data["sku"], PDO::PARAM_STR);
      $post->bindValue(":name", $data["name"], PDO::PARAM_STR);
      $post->bindValue(":price", $data["price"], PDO::PARAM_INT);
      $post->bindValue(":type", $data["type"], PDO::PARAM_STR);
      $post->bindValue(":attribute_value", $data["attribute_value"], PDO::PARAM_STR);
      $post->execute();

      return $this->conn->lastInsertId();
  }

  public function massDelete(array $data) : string 
  {
    $placeholders  = rtrim(str_repeat('?,',count($data)),",");

    $sql = "DELETE FROM product WHERE sku IN ($placeholders)";

    $delete = $this->conn->prepare($sql);

    $delete->execute($data);
    
    return $delete->rowCount();
  }

}
