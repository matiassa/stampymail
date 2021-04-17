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
        $items = [];
        try {
            $query = $this->query('SELECT * FROM users');
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new UserModel();
                $item->setId($p['id']);
                $item->setUsername($p['username']);
                $item->setpassword($p['password']);
                $item->setRole($p['role']);
                $item->setPhoto($p['photo']);
                $item->setFirstname($p['firstname']);
                $item->setLastname($p['lastname']);

                array_push($items,$item);
            }
            return $items;
        } catch (PDOException $e) {
            error_log('USERMODEL::getAll => PDOException '. $e);
            return false;
        }


    }
    public function get($id){
      
        try {
            
            $query = $this->prepare('SELECT * FROM users WHERE id = :id');
            $query->execute([
                'id' => $id
            ]);
                
                $user = $query->fetch(PDO::FETCH_ASSOC);
               
                $this->setId($user['id']);
                $this->setUsername($user['username']);
                $this->setpassword($user['password']);
                $this->setRole($user['role']);
                $this->setPhoto($user['photo']);
                $this->setFirstname($user['firstname']);
                $this->setLastname($user['lastname']);

            return $this;

        } catch (PDOException $e) {
            error_log('USERMODEL::getID => PDOException '. $e);
            return false;
        }


    }
    public function delete($id){
        try {

            $query = $this->prepare('DELETE FROM users WHERE id = :id');
            $query->execute([
                'id' => $id
            ]);
            
            return true;

        } catch (PDOException $e) {
            error_log('USERMODEL::delete => PDOException '. $e);

            return false;
        }

    }
    public function update(){
        try {
             
            $query = $this->prepare('UPDATE users SET username = :username, password = :password, role = :role, photo = :photo, firstname = :firstname, lastname = :lastname  WHERE id = :id');
            $query->execute([
                'id' => $this->id,
                'username' => $this->username,
                'password' => $this->password,
                'role' => $this->role,
                'photo' => $this->photo,
                'firstname' => $this->firstname,
                'lastname' => $this->lastname
            ]);
   
            return true;          

        } catch (PDOException $e) {
            error_log('USERMODEL::update => PDOException '. $e);
            return false;
        }


    }
    public function from($array){
        $this->id = $array('id');
        $this->username = $array('username');
        $this->password = $array('password');
        $this->role = $array('role');
        $this->photo = $array('photo');
        $this->firstname = $array('firstname');
        $this->lastname = $array('lastname');    
    }

    private function getHashedPassword($password){
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
    }


    public function exists($username){
        try {
            $query = $this->prepare('SELECT usarname FROM users WHERE username = :username');
            $query->execute(['username' => $username]);
            if ($query->rowCount() > 0) {
                return true;
            }else{
                return false;
            }
            
        }catch (PDOException $e) {
            error_log('USERMODEL::exists => PDOException '. $e);
            return false;
        }
    }

    public function comparePasswords($password, $id){
        try {
            
            $user = $this->get($id);

            return password_verify($password, $user->getpassword());


        }catch (PDOException $e) {

            error_log('USERMODEL::comparePasswords => PDOException '. $e);
            return false;
        }

    }

    //setters

    public function setId($id){ $this->id = $id;}
    public function setUsername($username){ $this->username = $username;}
    public function setpassword($password){ $this->password = $this->getHashedPassword($password);}
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