<?php


namespace app;
use PDO;

class Banner
{
    use DBLogger;
    private string $tableName = 'banner';
    private PDO $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function searchRecord(int $bannerId, bool $assoc=false)
    {
        $stmt=$this->pdo->prepare('SELECT * FROM banner WHERE id=:id');
        $stmt->execute([':id'=>$bannerId]);
        if($assoc){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $stmt->fetch();
    }

    public function getAllRecords()
    {
        $stmt=$this->pdo->query('SELECT * FROM banner');
        return $stmt->fetchAll();
    }

    public function insertRecord(string $header, string $text,string $image, string $what, string $where, string $when, string $link)
    {
        $stmt = $this->pdo->prepare('INSERT INTO banner (header, text, image, what, `where`, `when`, link) VALUES (:header, :text, :image, :what, :where, :when, :link)');
        $stmt->execute([
            ':header'=>$header,
            ':text'=>$text,
            ':image'=>$image,
            ':what'=>$what,
            ':where'=>$where,
            ':when'=>$when,
            ':link'=>$link
        ]);
    }

    //Обнолвение баннера
    public function updateBanner(int $bannerId,string $header, string $text,string $image, string $what, string $where, string $when, string $link)
    {
        $stmt = $this->pdo->prepare('UPDATE banner SET header = :header, text = :text, image = :image, what = :what,`where`=:where,`when`=:when,link=:link WHERE banner.id = :banner_id');
        $stmt->execute([
           ':header'=>$header,
            ':text'=>$text,
            ':image'=>$image,
            ':what'=>$what,
            ':where'=>$where,
            ':when'=>$when,
            ':link'=>$link,
            ':banner_id'=>$bannerId
        ]);
    }

    public function getRandomBanner()
    {
        $stmt = $this->pdo->query('SELECT * FROM banner ORDER BY rand() LIMIT 1');
        return $stmt->fetch();

    }
}