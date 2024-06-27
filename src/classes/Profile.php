<?php 
namespace CT27502\Project;

use LDAP\Result;
use PDO;

class Profile 
{

    private ?PDO $db;

    private int $id=-1;
    public $name;
    public $email;
    private $psw;
    private $role;
    private array $errors=[];

    public function getID(): int {
        return $this->id;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function __construct(?PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function fill(array $data): Profile
    {
        $this->name = $data['name'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->psw = $data['psw'] ?? '';
        
        $statement = $this->db->prepare("SELECT * FROM users WHERE user_email = ? and user_psw = ?");
        $statement->execute([$this->email, $this->psw]);
    
        $result = $statement->fetch();
        
        if ($result && isset($result['role'])) {
            if($result['role'] == 'admin') 
                $this->role = 'admin';
            elseif ($result['role'] == 'user') 
                $this->role = 'user';
            else 
                $this->role = '';
        } else {
            $this->role = '';
        }
        return $this;
    }

    public function getValidationErrors(): array
    {
        return $this->errors;
    }


    public function validateR(string $psw2):bool
    {
    
        $name = trim($this->name);
        if (!$name) {
            $this->errors['name'] = 'Tên không hợp lệ.';
        }

       
        $validEmail = preg_match("/^[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i", $this->email);
        if(!$validEmail){
            $this->errors['email'] = "Email không hợp lệ.";
        }

        $statement = $this->db->prepare("SELECT * FROM users WHERE user_email = ?");
        $statement->execute([$this->email]);
        $result = $statement->fetch();
        if($result && count($result) > 0){
            $this->errors['email'] = "Email đã tồn tại.";
        }

        $validPsw = preg_match("/^.{8,32}$/", $this->psw);
        if(!$validPsw) {
            $this->errors['psw'] = "Mật khẩu không hợp lệ.";
        }

        if((string)$this->psw != $psw2)
            $this->errors['psw2'] = 'Mật khẩu không khớp';
        

        return empty($this->errors);
    }

    public function validateL():bool
    {
       
        $statement = $this->db->prepare("SELECT user_id, user_name FROM users WHERE user_email = :email and user_psw = :psw");
        $statement->execute([
            'email' =>$this->email,
            'psw'=> $this->psw
        ]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if(!$row)
            $this->errors['psw'] = "Mật khẩu hoặc email không chính xác."; 
        else  {
            
            $this->id = $row['user_id'];
            $this->name = $row['user_name'];

        }
        
        return empty($this->errors);
    }



    public function save(): bool
    {
        $result = false;
        
        $statement = $this->db->prepare(
            'insert into users (user_name,user_email,user_psw) values (:name, :email, :psw)'
        );
        $result = $statement->execute([
            'name' =>$this->name,
            'email' =>$this->email,
            'psw' =>$this->psw
        ]);

        if ($result) {
            $this->id = $this->db->lastInsertId();
        }
        return $result;
    }

}