<?php
class Controller
{
  public function __construct(private Gateway $gateway) {}

  public function  processRequest(string $method)
  {
    switch ($method) {
      case 'GET':
        echo json_encode($this->gateway->getAll());
        break;

      case 'POST':
        try {
          $data = (array) json_decode(file_get_contents("php://input", true));

          $id = $this->gateway->create($data);

          http_response_code(201);
          echo json_encode([
            "message" => "Product Added Successfully",
            "id" => $id
          ]);
        } catch (\Throwable $th) {
          echo json_encode(["message" => "can't have the same sku for 2 products"]);
          http_response_code(400);
        }
        break;

      case 'DELETE':
        $data = (array) json_decode(file_get_contents("php://input", true));
        
        $count = $this->gateway->massDelete($data["skus"]);

        echo json_encode([
          "message" => $count > 0? "Successfully deleted $count Products": "No Products to delete",
          "status" => 204
        ]);
        break;

      default:
        echo json_encode([
          "message" => "Method Not Allowed",
          "status" => 405
        ]);
        http_response_code(405);
        header("Allow: GET, POST, DELETE");
        break;
    }
  }
}
