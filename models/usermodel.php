<?php


class UserModel extends Model implements IModel
{
    private $id;
    private $username;
    private $password;
    private $role;
    private $firstname;
    private $lastname;
    private $photo;

    public function __construct()
    {
        parent::__construct();
        $this->username = '';
        $this->password = '';
        $this->role = '';
        $this->firstname = '';
        $this->lastname = '';
        $this->photo = '';
    }

    public function save(){
        try {
            $query = $this->prepare('INSERT INTO users(username,password,role,firstname,lastname,photo) VALUES(:username,:password,:role,:firstname,:lastname,:photo)');
            $query->execute([
                'username' => $this->username,
                'password' => $this->password,
                'role' => $this->role,
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'photo' => $this->photo
            ]);

            return true;


        } catch (PDOException $e) {
            error_log('USERMODEL::save => PDOException '. $e);
            return false;
        }


    }
    public function getAll(){


    }
    public function get($id){


    }
    public function delete($id){


    }
    public function update(){


    }
    public function from($array){


    }

    //setters

    public function setId($id){ $this->id = $id;}
    public function setUsername($username){ $this->username = $username;}
    public function setpassword($password){ $this->password = $password;}
    public function setRole($role){ $this->role = $role;}
    public function setFirstname($firstname){ $this->firstname = $firstname;}
    public function setLastname($lastname){ $this->lastname = $lastname;}
    public function setPhoto($photo){ $this->photo = $photo;}


    //getters

    public function getId(){ return $this->id;}
    public function getUsername(){return $this->username;}
    public function getpassword(){return $this->password;}
    public function getRole(){return $this->role;}
    public function getFirstname(){return $this->firstname;}
    public function getLastname(){return $this->lastname;}
    public function getPhoto(){return $this->photo;}









}


?>