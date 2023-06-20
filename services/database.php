<?php


include_once "models/User.php";

class Database
{
    public ?\PDO $pdo = null;
    public static ?Database $db = null;

    public function __construct()
    {
        $this->pdo = new \PDO('mysql:host=localhost;port=3306;', 'root', 'Maya@1jesus');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        self::$db = $this;
        $this->initalize();
    }

    public function initalize()
    {
        $sql = "CREATE DATABASE IF NOT EXISTS movie_chief";
        $this->pdo->exec($sql);
        $sql = "USE movie_chief";
        $this->pdo->exec($sql);
    }

    public function createUser(User $user)
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    gender VARCHAR(50) NOT NULL,
    bio VARCHAR(255) ,
    profile_path VARCHAR(255),
    dob DATE
)";
        $this->pdo->exec($sql);

        $statement = $this->pdo->prepare("INSERT INTO users (email, password, username, dob , gender ,bio , profile_path )
                VALUES (:email, :password, :username, :dob, :gender, :bio, :profile_path)");
        $statement->bindValue(':email', $user->email);
        $statement->bindValue(':password', $user->password);
        $statement->bindValue(':username', $user->username);
        $statement->bindValue(':dob', $user->dob);
        $statement->bindValue(':gender', $user->gender);
        $statement->bindValue(':bio', $user->bio);
        $statement->bindValue(':profile_path', $user->path);

        $result = $statement->execute();
        if ($result) {
            return $this->getUserByEmailAndPassword($user->email, $user->password);

        } else {
            return null;
        }
    }

    public function getUserByEmailAndPassword(string $email, string $password): ?User
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->execute();

        $user_data = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($user_data) {
            $user = new User();
            $user->load($user_data);
            return $user;
        }

        return null;
    }

    public function addWatchList($userId, $movieId): bool
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS watchlist ( user_id VARCHAR(20) ,movie_id VARCHAR(20), saved_date DATE )");

        $statement = $this->pdo->prepare("INSERT INTO watchlist (user_id, movie_id, saved_date) VALUES ( 'fsddsf', 'gff', NOW())");
//        $statement->bindValue(':userid', $userId);
//        $statement->bindValue(':movieid', $movieId);



        return $statement->execute();
    }

    public function loadWatchList(int $userId): array
    {
        $statement = $this->pdo->prepare("SELECT movie_id, saved_date  FROM watchlist WHERE user_id = :id");
        $statement->bindValue(':id', $userId);
        $statement->execute();

        $movie_data = $statement->fetchAll(\PDO::FETCH_ASSOC);


        $movieIds = array();

        foreach ($movie_data as $row) {
            array_push($movieIds, array($row['movie_id'], $row['saved_date']));
        }
        return $movieIds;
    }

    public function deleteWatchList(int $movieId): bool
    {
        $statement = $this->pdo->prepare("DELETE FROM watchlist WHERE movie_id = :id");
        $statement->bindValue(':id', $movieId);
      return $statement->execute();

    }
}
