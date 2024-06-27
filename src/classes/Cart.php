<?php 
namespace CT27502\Project;

use PDO;

class Cart
{
    private ?PDO $db;

    
    private $user_id;
    private $pd_id;
    public $pd_name;
    public $pd_price;
    public $pd_image;
    public $pd_quantity;
    public $total;
    public $address;
    public $phone;
    private array $errors=[];


    public function __construct(?PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function getIDUser(): int{
    return $this->user_id;
    }

    public function getIDPro(): int{
        return $this->pd_id;
        }

    public function fill(array $data): Cart
    {
        $this->pd_id = $data['idsanpham'] ?? '';;
        $this->user_id = $data['iduser'] ?? '';;
        return $this;
    }

    public function fillUser(array $data): Cart
    {
        $this->user_id = $data['id'] ?? '';;
        return $this;
    }

    public function fillInfo(array $data): Cart
    {
        $this->address= $data['address'] ?? '';;
        $this->phone = $data['phone'] ?? '';;
        $this->user_id = $data['thanhtoan_id_user'];
        return $this;
    }

    public function exist(): int{
        $statement = $this->db->prepare("SELECT pd_id FROM carts WHERE  pd_id = ? and user_id = ?");
        $statement->execute([$this->pd_id, $this->user_id]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if(!$row) return 0;
        else return 1;
    }
    public function save() : int {
        $result = 0;
        $statement = $this->db->prepare("insert into carts values (:user, :pd, :quantity)");
        $result = $statement->execute([
            'user' =>$this->user_id,
            'pd' =>$this->pd_id,
            'quantity' => 1
        ]);
        if($result)
            $this->pd_quantity = 1;
        
        return $result;    
        
    }

    public function plus(int $n) : int{
        $result = 0;

        $statement = $this->db->prepare("update carts set pd_quantity= pd_quantity + :n where user_id= :user and pd_id= :pd");
        $result = $statement->execute([
            'n' => $n,
            'user' =>$this->user_id,
            'pd' =>$this->pd_id
            
        ]);
        if($result)
            $this->pd_quantity += $n;

        return $result;    
    }

    public function updateQuantity(int $n, int $u, int $p) : int{
        $result = 0;

        $statement = $this->db->prepare("update carts set pd_quantity=? where user_id= ? and pd_id= ?");
        $result = $statement->execute([$n, $u, $p ]);
        $statement = $this->db->prepare('SELECT * FROM carts where user_id = ? and pd_id = ?');
        $statement->execute([$u, $p]);
        if ($row = $statement->fetch()) {
            $this->fillFromDB($row);
        }
        return $result;    
    }


    public function all(): array
    {
        $items = [];

        $statement = $this->db->prepare('SELECT * FROM carts where user_id = ?');
        $statement->execute([$this->user_id]);
        while ($row = $statement->fetch()) {
            $item = new Cart($this->db);
            $item->fillFromDB($row);
            $items[] = $item;
        }

        return $items;
    }

    protected function fillFromDB(array $row): Cart
    {
        [
            'user_id' => $this->user_id,
            'pd_id' => $this->pd_id,
            'pd_quantity' => $this->pd_quantity
        ] = $row;

        $statement = $this->db->prepare('SELECT pd_name, pd_price, pd_image FROM products where pd_id = ?');
        $statement->execute([$this->pd_id ]);
        
        while ($row = $statement->fetch()) {
           
            $this->pd_name = $row['pd_name']; 
            $this->pd_price = $row['pd_price']; 
            $this->pd_image = $row['pd_image'];
            $this->total = $this->pd_price *  $this->pd_quantity;
        }

        
        return $this;
    }

    public function delete(): bool {
        $statement = $this->db->prepare('DELETE FROM carts WHERE pd_id = ? and user_id=?');
        return $statement->execute([$this->pd_id, $this->user_id]);
    }

    public function deleteToAddOrder($user, $pd): bool {
        $statement = $this->db->prepare('DELETE FROM carts WHERE pd_id = ? and user_id=?');
        return $statement->execute([$pd, $user]);
    }

    public function find(int $iduser, int $idpd): ?Cart
    {
        $statement = $this->db->prepare('select * from carts where user_id = :user and pd_id = :pd');
        $statement->execute([
        'user' =>$iduser,
        'pd' => $idpd
        ]);

        if ($row = $statement->fetch()) {
            $this->fillFromDB($row);
            return $this;
        }
        return null;
    }

    public function getValidationErrors(): array
    {
        return $this->errors;
    }


    public function validateInfo(): bool
    { 
        $address = trim($this->address);
        if (!$address) {
            $this->errors['address'] = 'Địa chỉ không hợp lệ.';
        }

        $validPhone = preg_match(
            '/^(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b$/',
            $this->phone
        );

        if (!$validPhone) {
            $this->errors['phone'] = 'Số điện thoại không hợp lệ.';
        }

        return empty($this->errors);
    }


}
?>