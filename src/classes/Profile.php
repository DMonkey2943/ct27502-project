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

    // public function save(){
    //     $result = false;
    //     $statement = $this->db->prepare();
    // }

}