<?php 

require_once('core/BaseModel.php');

class ProductModel extends BaseModel
{
    public function getProducts()
    {
        return $this->query("SELECT * FROM products");
    }

    public function createProduct($data) 
    {
        extract($data);
        $sql = "INSERT INTO products (name, unit, type, stock, price) VALUES ('$name', '$unit', '$type', '$stock', $price)";
        return $this->exec($sql);
    }

    public function getProductById($id)
    {
        return $this->query("SELECT * FROM products WHERE id = $id")[0];
    }

    public function updateProduct($data, $id) 
    {
        extract($data);
        $sql = "UPDATE products SET `name` = '$name', `unit` = '$unit', `type` = '$type', `price` = '$price' WHERE `id` = $id";
        return $this->update($sql);
    }
}