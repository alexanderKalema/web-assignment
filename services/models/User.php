<?php

class User
{
    public string $email;

    public string $password;
    public string $username;
    public int $age;
    public ?array $watchList;
    public string $gender;

    public function load($data)
    {

        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->username = $data['username'];
        $this->watchList = $data['watchList']?? null;
        $this->age = $data['age'];
        $this->gender = $data['gender'];
    }

}