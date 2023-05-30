<?php


include_once "models/User.php";

class Database
{
    public ?\PDO $pdo = null;
    public static ?Database $db = null;
    public function __construct()
    {
        $this->pdo = new \PDO('mysql:host=localhost;port=3306;dbname=movie_chief', 'root', '');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        self::$db = $this;
    }

    public function createUser(User $user)
    {
        $statement = $this->pdo->prepare("INSERT INTO users (email, password, username, age , gender ,watchList)
                VALUES (:email, :password, :username, :age, :gender, :watchList)");
        $statement->bindValue(':email', $user->email);
        $statement->bindValue(':password', $user->password);
        $statement->bindValue(':username', $user->username);
        $statement->bindValue(':age', $user ->age);
        $statement->bindValue(':gender',  $user->gender);
        $statement->bindValue(':watchList',  json_encode($user->watchList));

        $statement->execute();
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


}
