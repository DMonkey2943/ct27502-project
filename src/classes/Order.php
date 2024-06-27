<?php 
namespace CT27502\Project;

use PDO;

class Order
{
    private ?PDO $db;
    private $order_id;
    private $order_code;
    private $user_id;
    private $pd_id;
    public $quantity;
    public $price;
    public $address;
    public $phone;
    public $order_total;
    public $order_status;

    public function __construct(?PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function getOrderCode(): int{
        return $this->order_code;
    }

    public function fill($code, $user, $pd, $data) : Order
    {
        $this->order_code = $code ?? '';
        $this->user_id = $user ?? '';
        $this->pd_id = $pd ?? '';
        $this->address = $data['address'] ?? '';
        $this->phone = $data['phone'] ?? '';
        $statement = $this->db->prepare('SELECT * FROM products where pd_id = ?');
        $statement->execute([$pd]);
        if($row = $statement->fetch()){
            $this->price = $row['pd_price'] ?? 0;
        }

        $statement = $this->db->prepare('SELECT * FROM carts where user_id = ? and pd_id = ?');
        $statement->execute([$user, $pd]);
        if($row = $statement->fetch()){
        $this->quantity = $row['pd_quantity'] ?? 0;
        }

        if(  $this->price != 0 && $this->quantity!= 0) $this->order_total =  $this->price * $this->quantity;
        else $this->order_total = -1;
        return $this;
    }

    public function allPdFromCart(int $user): array
    {
        $items = [];
        $statement = $this->db->prepare('SELECT * FROM carts where user_id = ?');
        $statement->execute([$user]);
        while ($row = $statement->fetch()) {
            $item = $row['pd_id'];
            $items[] = $item;
        }
        
        return $items;
    }

    public function orderInfo($data) : Order {
        $order = new Order($this->db);
        $statement = $this->db->prepare('SELECT DISTINCT user_id, phone, address, order_status FROM orders WHERE order_code =?');
        $statement->execute([$data['orderCode']]);
        if ($row = $statement->fetch()){
            $order->user_id = $row['user_id'];
            $order->phone = $row['phone'];
            $order->address = $row['address'];
            $order->order_status = $row['order_status'];
            $order->order_code = $data['orderCode'];
        }
        return $order;
    }

    public function all(): array{
        $orders = [];
        $statement = $this->db->prepare('SELECT * FROM orders');
        $statement->execute();
        while ($row = $statement->fetch()) {
            $order = new Order($this->db);
            $order->fillFromDB($row);
            $orders[] = $order;
        }

        return $orders;
    }

    public function allCode(): array{
    
        $order_codes = [];

        $statement = $this->db->prepare('SELECT DISTINCT order_code FROM orders ORDER BY order_id DESC');
        $statement->execute();
        while($row = $statement->fetch()){
            $this->order_code = $row['order_code'];
            $order_codes[] = $row['order_code'];
        }

        return $order_codes;
    }


    protected function fillFromDB(array $row): Order
    {
        [
            'order_id' => $this->order_id,
            'order_code' => $this->order_code,
            'user_id' => $this->user_id,
            'address' => $this->address,
            'phone' => $this->phone,
            'pd_id' => $this->pd_id,
            'order_total' =>$this->order_total,
            'order_status' => $this->order_status
        ] = $row;

        return $this;
    }

    public function save() : int {
        $result = 0;
        $statement = $this->db->prepare('insert into orders(order_code, user_id, address, phone, pd_id, pd_quantity, order_total) values (?,?,?,?,?,?,?)');
        $result = $statement->execute([$this->order_code, $this->user_id, $this->address, $this->phone, $this->pd_id, $this->quantity, $this->order_total]);
        return $result;
    }

    public function getStatus($code): bool{
        $status = 0;
        $statement = $this->db->prepare('SELECT DISTINCT order_status  FROM orders where order_code = ?');
        $statement->execute([$code]);
        while($row = $statement->fetch()){
            $status = $row['order_status'];
        }
        return $status;
    }

    public function getUserName(): string{
        $statement = $this->db->prepare('SELECT user_name  FROM users where user_id = ?');
        $statement->execute([$this->user_id]); 
        if($row = $statement->fetch()){
            return $row['user_name'];
        }else return '';
    }

    public function updateStatus($data)  {
        $statement = $this->db->prepare('update orders set order_status = ?  where order_code = ?');
        $statement->execute([$data['status'], $this->order_code]); 

        $statement = $this->db->prepare('select distinct order_status from orders where order_code = ?');
        $statement->execute([$this->order_code]); 
        if($row = $statement->fetch()){
            $this->order_status = $row['order_status'];
        }

    }


    public function allPd(int $code): array {
        $pds = [];
        $statement = $this->db->prepare('select pd_id, pd_quantity from orders where order_code = ?');
        $statement->execute([$code]); 
        while($row = $statement->fetch()){
            $pd = new Order($this->db);
            $pd->order_code = $code;
            $pd->pd_id = $row['pd_id'];
            $pd->quantity = $row['pd_quantity'];
            $pds[] = $pd; 
        }

        return $pds;
    }

    public function getNamePd(): string {
        $statement = $this->db->prepare('select pd_name from products where pd_id = ?');
        $statement->execute([$this->pd_id]);
        if($row = $statement->fetch())
            return $row['pd_name'];
        else return '';
    }

    public function getPricePd(): int {
        $statement = $this->db->prepare('select pd_price from products where pd_id = ?');
        $statement->execute([$this->pd_id]);
        if($row = $statement->fetch()){
            $this->price = $row['pd_price'];
            return $row['pd_price'];
        }
        else return 0;
    }

    public function getQuantityPd(): int {
        $statement = $this->db->prepare('select pd_quantity from orders where pd_id = ? and order_code = ?');
        $statement->execute([$this->pd_id, $this->order_code]);
        if($row = $statement->fetch()){
            $this->quantity = $row['pd_quantity'];
            return $row['pd_quantity'];
        }
        else return 0;
    }

    public function getTotal(): int {
        $statement = $this->db->prepare('select order_total from orders where pd_id = ? and order_code = ?');
        $statement->execute([$this->pd_id, $this->order_code]);
        if($row = $statement->fetch()){
            $this->order_total = $row['order_total'];
            return $row['order_total'];
        }
        else return 0;
    }

    public function find($code): bool{
        $statement = $this->db->prepare('select * from orders where order_code = ?');
        $statement->execute([$code]);
        if($row = $statement->fetch() ){
            return 1;
        } else return 0;
    }

    public function delete($data): bool {
        $statement = $this->db->prepare('delete from orders where order_code = ?');
        return $statement->execute([$data['order_code']]);
    }

    


}