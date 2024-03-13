<?php 
namespace CT27502\Project;

use PDO;

class Profile 
{

    private ?PDO $db;

    private int $id=-1;
    public $name;
    public $email;
    public $psw;
    private array $errors=[];

    public function __construct(?PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function fill(array $data): Profile
    {
        $this->name = $data['name'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->psw = $data['psw'] ?? '';
        return $this;
    }

    public function validate():bool
    {
    
        $name = trim($this->name);
        if (!$name) {
            $this->errors['name'] = 'Tên không hợp lệ.';
        }

        //$validEmail = trim($this->email);
        $validEmail = preg_match("/^[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i", $this->email);
        if(!$validEmail){
            $this->errors['email'] = "Email không hợp lệ.";
        }

        

        return empty($this->errors);
    }

}