<?php


namespace app;
use PDO;

class User
{
    private PDO $pdo;
    private string $tableName = "users";
    use DBLogger;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getAllRecords():array
    {
        $stmt = $this->pdo->prepare('SELECT users.id,login,email,image,r.name as role_name, user_ip FROM users INNER JOIN roles r on users.role_id = r.id');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllEmails():array
    {
        $stmt = $this->pdo->query('SELECT email FROM users');
        return $stmt->fetchAll(PDO::FETCH_COLUMN);

    }



    public function insertRecord(string $login, string $email, string $password, string $image, string $userIp=null):void
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (login,email,password,image,role_id,user_ip) 
                VALUES (:login, :email, :password, :image, 2,:user_ip)");
        $stmt->execute([
            ':login'=>$login,
            ':email'=>$email,
            ':password'=>$password,
            ':image'=>$image,
            ':user_ip'=>$userIp
        ]);
    }

    public function searchRecord(string $login)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE login=:login');
        $stmt->execute([':login'=>$login]);
        return $stmt->fetch();
    }

    public function getUser(int $userId)
    {
        $stmt = $this->pdo->prepare('SELECT u.id, login, email, password, image, role_id, name as role_name,user_ip FROM users u INNER JOIN roles r on u.role_id = r.id WHERE u.id=:id');
        $stmt->execute(['id'=>$userId]);
        return $stmt->fetch();
    }

    public function banUser(int $userId){
        if(in_array($userId,$this->getBannedIdList())){
            return;
        }
        $stmt = $this->pdo->prepare('INSERT INTO banned (user_id) VALUES (:user_id)');
        $stmt->execute([
            ':user_id'=>$userId,
        ]);
    }


    public function getBannedIpList(){
        $stmt = $this->pdo->query('SELECT user_ip FROM banned inner join users u on banned.user_id = u.id');
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getBannedIdList(){
        $stmt = $this->pdo->query('SELECT user_id FROM banned');
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }



}