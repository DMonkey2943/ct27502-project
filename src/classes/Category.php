<?php

namespace CT27502\Project;

use PDO;

class Category
{
    private ?PDO $db;

    private int $cat_id = -1;
    public $cat_name;
    private array $errors = [];

    public function getID(): int
    {
        return $this->cat_id;
    }

    public function __construct(?PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function fill(array $data): Category
    {
        $this->cat_name = $data['cat_name'] ?? '';
        return $this;
    }

    public function getValidationErrors(): array
    {
        return $this->errors;
    }

    public function validate(): bool
    {
        $name = trim($this->cat_name);
        if (!$name) {
            $this->errors['name'] = 'Tên không được để trống.';
        } elseif (!preg_match('/^[\p{L}0-9\s(),&]+$/u', $name)) {
            $this->errors['name'] = 'Tên không hợp lệ.';
        }

        return empty($this->errors);
    }

    public function all(): array
    {
        $categories = [];

        $statement = $this->db->prepare('SELECT * FROM categories');
        $statement->execute();
        while ($row = $statement->fetch()) {
            $category = new Category($this->db);
            $category->fillFromDB($row);
            $categories[] = $category;
        }

        return $categories;
    }

    protected function fillFromDB(array $row): Category
    {
        [
            'cat_id' => $this->cat_id,
            'cat_name' => $this->cat_name
        ] = $row;

        return $this;
    }

    public function find(int $id): ?Category
    {
        $statement = $this->db->prepare('SELECT * FROM categories WHERE cat_id = :id');
        $statement->execute(['id' => $id]);

        if ($row = $statement->fetch()) {
            $this->fillFromDB($row);
            return $this;
        }
        return null;
    }


    public function save(): bool
    {
        $result = false;

        if ($this->cat_id >= 0) {
            $statement = $this->db->prepare('UPDATE categories SET cat_name=? WHERE cat_id = ?');
            $result = $statement->execute([$this->cat_name, $this->cat_id]);
        } else {
            $statement = $this->db->prepare('INSERT INTO categories(cat_name) VALUES (?)');
            $result = $statement->execute([$this->cat_name]);

            if ($result) {
                $this->cat_id = $this->db->lastInsertId();
            }
        }

        return $result;
    }

    public function update(array $data): bool
    {
        $this->fill($data);
        if($this->validate()) {
            return $this->save();            
        }
        return false;
    }

    public function delete(): bool
    {
        $statement = $this->db->prepare('DELETE FROM categories WHERE cat_id = ?');
        return $statement->execute([$this->cat_id]);
    }

    public function getNameByID($id): string {
        $statement = $this->db->prepare('SELECT cat_name FROM categories WHERE cat_id = ?');
        $statement->execute([$id]);
        return $statement->fetchColumn();
    }
}
