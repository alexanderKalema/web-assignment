<?php
require_once __DIR__ . '/../database.php';

class User
{
    public ?int $id;
    public string $email;
    public string $password;
    public string $username;
    public string $dob;
    public ?string $bio;
    public ?string $path;
    public string $gender;

    public function load($data)
    {
        $this->extracted($data);
    }

    public function getUser($id){
        $db = new Database();
    $data = $db->getUserById($id);
        $this->extracted($data);
    }

    public function extracted($data): void
    {
        $this->id = $data['id'] ?? null;
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->username = $data['username'];
        $this->bio = $data['bio'] ?? null;
        $this->path = $data['profile_path'] ?? null;
        $this->dob = $data['dob'];
        $this->gender = $data['gender'];
    }
}

?>