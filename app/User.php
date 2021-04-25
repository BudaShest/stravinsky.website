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
        $stmt = $this->pdo->prepare('SELECT users.id,login,email,image,r.name as role_name FROM users INNER JOIN roles r on users.role_id = r.id');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllEmails():array
    {
        $stmt = $this->pdo->query('SELECT email FROM users');
        return $stmt->fetchAll(PDO::FETCH_COLUMN);

    }



    public function insertRecord(string $login, string $email, string $password, string $image):void
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (login,email,password,image,role_id) 
                VALUES (:login, :email, :password, :image, 2)");
        $stmt->execute([
            ':login'=>$login,
            ':email'=>$email,
            ':password'=>$password,
            ':image'=>$image,
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
        
        
        $stmt = $this->pdo->prepare('SELECT u.id, login, email, password, image, role_id, name as role_name FROM users u INNER JOIN roles r on u.role_id = r.id WHERE u.id=:id');
        $stmt->execute(['id'=>$userId]);
        return $stmt->fetch();
    }





}