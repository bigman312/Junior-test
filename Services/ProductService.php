<?php
require_once __DIR__ . '/../conn/connection.php';
include_once __DIR__ . '/../Data/product.php';

class ProductService {
    private $conn;
    private $table = "products";
    private $insertMethods;

    public function __construct($connection) {
        $this->conn = $connection;
        // Map product types to their respective insert methods
        $this->insertMethods = [
            'book' => [$this, 'insertBook'],
            'dvd' => [$this, 'insertDVD'],
            'furniture' => [$this, 'insertFurniture']
        ];
    }

    public function insertProduct($sku, $name, $price, $type, $additionalData) {
        try {
            // Call the corresponding method for the product type
            $method = $this->insertMethods[$type];
            return call_user_func($method, $sku, $name, $price, $additionalData);
        } catch (PDOException $e) {
            // Handle duplicate SKU error
            if ($e->getCode() == '23000') { // Integrity constraint violation
                throw new Exception("SKU already exists.");
            }
            // Re-throw other database errors
            throw $e;
        }
    }

    private function insertBook($sku, $name, $price, $additionalData) {
        $sql = "INSERT INTO $this->table (sku, name, price, type, weight) 
                VALUES (:sku, :name, :price, 'book', :weight)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':weight', $additionalData['weight']);
        
        return $stmt->execute();
    }

    private function insertDVD($sku, $name, $price, $additionalData) {
        $sql = "INSERT INTO $this->table (sku, name, price, type, size_mb) 
                VALUES (:sku, :name, :price, 'dvd', :size_mb)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':size_mb', $additionalData['size']);
        
        return $stmt->execute();
    }

    private function insertFurniture($sku, $name, $price, $additionalData) {
        $sql = "INSERT INTO $this->table (sku, name, price, type, height, width, length) 
                VALUES (:sku, :name, :price, 'furniture', :height, :width, :length)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':height', $additionalData['height']);
        $stmt->bindParam(':width', $additionalData['width']);
        $stmt->bindParam(':length', $additionalData['length']);
        
        return $stmt->execute();
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteProducts($ids) {
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql = "DELETE FROM $this->table WHERE id IN ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($ids);
    }
}
?>
