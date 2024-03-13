<?php

namespace CT27502\Project;

use PDO;

class Product
{
    private ?PDO $db;

    private int $pd_id = -1;
    public $pd_name;
    public $pd_price;
    public $pd_info;
    public $pd_image;
    public $cat_id;
    private array $errors = [];

    public function getID(): int
    {
        return $this->pd_id;
    }

    public function __construct(?PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function fill(array $data): Product {
        $this->pd_name = $data['pd_name'] ?? '';
        $this->pd_price = $data['pd_price'] ?? '';
        $this->pd_info = $data['pd_info'] ?? '';
        $this->pd_image = $data['pd_image'] ?? '';
        $this->cat_id = $data['cat_id'] ?? '';
        return $this;
    }

    public function getValidationErrors(): array
    {
        return $this->errors;
    }

    public function validate(): bool
    {
        $name = trim($this->pd_name);
        if (!$name) {
            $this->errors['name'] = 'Invalid name.';
        }

        $price = trim($this->pd_price);
        if (!$price) {
            $this->errors['price'] = 'Invalid price.';
        }

        return empty($this->errors);
    }

    public function all(): array {
        $products = [];

        $statement = $this->db->prepare('SELECT * FROM products');
        $statement->execute();
        while($row = $statement->fetch()) {
            $product = new Product($this->db);
            $product->fillFromDB($row);
            $products[] = $product;
        }

        return $products;
    }

    protected function fillFromDB(array $row): Product {
        [
            'pd_id' => $this->pd_id,
            'pd_name,' => $this->pd_name,
            'pd_price,' => $this->pd_price,
            'pd_info,' => $this->pd_info,
            'pd_image,' => $this->pd_image,
            'cat_id,' => $this->cat_id
        ] = $row;

        return $this;
    }

    public function find(int $id): ?Product {
        $statement = $this->db->prepare('SELECT * FROM products WHERE pd_id = :id');
        $statement->execute(['id' => $id]);

        if($row = $statement->fetch()) {
            $this->fillFromDB($row);
            return $this;
        }

        return null;
    }

    // Lưu thông tin sản phẩm (thêm/cập nhật)
    public function save(): bool {
        $result = false;

        if($this->pd_id >=0) {
            $statement = $this->db->prepare('UPDATE products 
                SET pd_name = :name, pd_price = :price, pd_info = :info, 
                pd_image = :image, cat_id = :cat_id WHERE pd_id = :pd_id');
            $result = $statement->execute([
                'name' => $this->pd_name,
                'price' => $this->pd_price,
                'info' => $this->pd_info,
                'image' => $this->pd_image,
                'cat_id' => $this->cat_id,
                'pd_id' => $this->pd_id
            ]);
        } else {
            $statement = $this->db->prepare('INSERT INTO products(pd_name, pd_price, pd_info, pd_image, cat_id) 
                VALUES (:name, :price, :info, :image, :cat_id)');
            $result = $statement->execute([
                'name' => $this->pd_name,
                'price' => $this->pd_price,
                'info' => $this->pd_info,
                'image' => $this->pd_image,
                'cat_id' => $this->cat_id
            ]);

            if($result) {
                $this->pd_id = $this->db->lastInsertId();
            }
        }
        
        return $result;
    }

    // Cập nhật sản phẩm
    public function update(array $data): bool {
        $this->fill($data);
        if($this->validate()) {
            return $this->save();
        }
        return false;
    }

    // Xóa sản phẩm
    public function delete(): bool {
        $statement = $this->db->prepare('DELETE FROM products WHERE pd_id = ?');
        return $statement->execute([$this->pd_id]);
    }

    // Phân trang
    public function count($cat_id): int {
        if($cat_id === -1){
            $statement = $this->db->prepare('SELECT count(*) FROM products');
            $statement->execute();
        } else {
            $statement = $this->db->prepare('SELECT count(*) FROM products WHERE cat_id = ?');
            $statement->execute([$cat_id]);
        }
        return $statement->fetchColumn();
    }

    public function paginate(int $offset = 0, int $limit = 10, $cat_id): array {
        $products = [];
        if($cat_id === -1) {
            $statement = $this->db->prepare('SELECT * FROM products LIMIT  :offset, :limit');
            $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        } else {
            $statement = $this->db->prepare('SELECT * FROM products WHERE cat_id = :cat_id LIMIT  :offset, :limit');
            $statement->bindValue(':cat_id', $cat_id, PDO::PARAM_INT);
            $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        }
        $statement->execute();
        while($row = $statement->fetch()) {
            $product = new Product($this->db);
            $product->fillFromDB($row);
            $products[] = $product;
        }

        return $products;
    }

    // Tìm kiếm
    public function search($key): array {
        $products = [];

        $statement = $this->db->prepare('SELECT * FROM products WHERE pd_name LIKE :search');
        $statement->execute([':search => "%$key%']);
        while($row = $statement->fetch()) {
            $product = new Product($this->db);
            $product->fillFromDB($row);
            $products[] = $product;
        }

        return $products;
    }

}
