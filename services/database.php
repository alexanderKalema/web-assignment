<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    public function getUserById($id): ?array
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $statement->bindValue(':id', $id);
        $statement->execute();

        $user_data = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($user_data) {
            return $user_data;
        }

        return null;
    }


    public function addWatchList($userId, $movieId): bool
    {

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS watchlist ( movie_id INT , user_id INT , saved_date DATE)");

        $statement = $this->pdo->prepare("INSERT INTO watchlist ( user_id  ,movie_id  , saved_date) VALUES (:userid , :movie , NOW())");
        $statement->bindValue(':userid', $userId);
        $statement->bindValue(':movie', $movieId);

        return $statement->execute();
    }

    public function loadWatchList(int $userId): array
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS watchlist ( movie_id INT , user_id INT , saved_date DATE)");

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

    public function deleteWatchList( $movieId, $userId ): bool
    {
        $statement = $this->pdo->prepare("DELETE FROM watchlist WHERE movie_id = :movieid AND user_id = :userid");
        $statement->bindValue(':userid', $userId);
        $statement->bindValue(':movieid',  $movieId);

      return $statement->execute();

    }

    public function addFavourite($userId, $movieId): bool
    {

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS favourite ( user_id INT , mov_id INT , saved_date DATE)");

        $statement = $this->pdo->prepare("INSERT INTO favourite ( user_id  , mov_id , saved_date) VALUES (:userid , :movie , NOW())");
        $statement->bindValue(':userid', $userId);
        $statement->bindValue(':movie', $movieId);

        return $statement->execute();
    }

    public function loadFavourite(int $userId): array
    {
        $statement = $this->pdo->prepare("SELECT user_id, saved_date  FROM favourite WHERE movie_id = :id");
        $statement->bindValue(':id', $userId);
        $statement->execute();

        $movie_data = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $movieIds = array();

        foreach ($movie_data as $row) {
            array_push($movieIds, array($row['user_id'], $row['saved_date']));
        }
        return $movieIds;
    }

    public function deleteFavourite( $movieId, $userId ): bool
    {
        $statement = $this->pdo->prepare("DELETE FROM watchlist WHERE movie_iduser = :userid && user_idmovie = :movieid");
        $statement->bindValue(':userid', $userId);
        $statement->bindValue(':movieid',  $movieId);

        return $statement->execute();

    }


    public function addComplaint($userId, $message): bool
    {

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS complaint ( user_id INT , message VARCHAR(300) , saved_date DATE)");

        $statement = $this->pdo->prepare("INSERT INTO complaint ( user_id  , message , saved_date) VALUES (:userid , :message , NOW())");
        $statement->bindValue(':userid', $userId);
        $statement->bindValue(':message', $message);

        return $statement->execute();
    }


    public function addReview($movieId,$userId, $mess){

        $this->pdo->exec(   "CREATE TABLE IF NOT EXISTS reviews (
  id INT NOT NULL AUTO_INCREMENT,
  movie_id INT NOT NULL,
  user_id INT NOT NULL,
  review_text TEXT NOT NULL,
  likes INT NOT NULL DEFAULT 0,
  dislikes INT NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id)
)");

        $checkStatement = $this->pdo->prepare("SELECT * FROM reviews WHERE movie_id = :movieid AND user_id = :userid AND review_text = :mess");
        $checkStatement->execute([':movieid' => $movieId, ':userid' => $userId, ':mess' => $mess]);

        // Fetch the result
        $existingRow = $checkStatement->fetch(PDO::FETCH_ASSOC);

        // If no existing row is found, proceed with the insertion
        if (!$existingRow) {
            $insertStatement = $this->pdo->prepare("INSERT INTO reviews (movie_id, user_id, review_text) VALUES (:movieid, :userid, :mess)");
            $insertStatement->execute([':movieid' => $movieId, ':userid' => $userId, ':mess' => $mess]);
        }


    }

    public function getReviewsByMovieId($movieId) {
        $this->pdo->exec(   "CREATE TABLE IF NOT EXISTS reviews (
  id INT NOT NULL AUTO_INCREMENT,
  movie_id INT NOT NULL,
  user_id INT NOT NULL,
  review_text TEXT NOT NULL,
  likes INT NOT NULL DEFAULT 0,
  dislikes INT NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id)
)");

        $statement = $this->pdo->prepare("SELECT * FROM reviews WHERE movie_id = :movieid");
        $statement->bindValue(':movieid', $movieId);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }




    public function likeReview(){

    }
}
