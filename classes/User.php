<?php

include_once(__DIR__ . "/DB.php");

class User
{
    private $firstname;
    private $lastname;
    private $email;
    private $password;

    public function getFirstName()
    {
        return $this->firstname;
    }

    // set value of username
    public function setFirstName($firstname)
    {
        // username cannot be empty
        if (empty($firstname)) {
            throw new Exception("Name cannot be empty.");
        }

        $this->firstname = $firstname;

        return $this;
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    // set value of username
    public function setLastName($lastname)
    {
        // username cannot be empty
        if (empty($lastname)) {
            throw new Exception("Name cannot be empty.");
        }

        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    // set value of email
    public function setEmail($email)
    {
        // email cannot be empty
        if (empty($email)) {
            throw new Exception("Email cannot be empty.");
        }

        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        // password cannot be empty
        if (empty($password)) {
            throw new Exception("Password cannot be empty.");
        }

        if (strlen($password) < 5) {
            throw new Exception("Password must be longer than 5 characters.");
        }

        // password cannot be empty
        if (empty($password)) {
            throw new Exception("Password cannot be empty.");
        }

        $this->password = $password;

        return $this;
    }

    public function canLogin($email, $password)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select * from users where email = :email");
        $statement->bindValue(":email", $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            // er is een onbestaande gebruiker ingevuld
            throw new Exception("We couldn't find an account matching the email and password you entered.");
            return false;
        }

        $hash = $user["password"];

        if (password_verify($password, $hash)) {
            // password is correct
            return true;
        } else {
            // password is incorrect
            throw new Exception("Password is incorrect.");
            return false;
        }

        return $this;
    }

    // this function saves the user in the database
    public function register()
    {
        $options = [
            'cost' => 13
        ];

        $password = password_hash($this->password, PASSWORD_DEFAULT, $options);

        $role = "user";

        try {
            $conn = DB::getConnection();
            $statement = $conn->prepare("insert into users (firstname, lastname, email, password, role) values (:firstname, :lastname, :email, :password, :role)");
            $statement->bindValue(":firstname", $this->firstname);
            $statement->bindValue(":lastname", $this->lastname);
            $statement->bindValue(":email", $this->email);
            $statement->bindValue(":password", $password);
            $statement->bindValue(":role", $role);
            return $statement->execute();
    
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function findByEmail($email)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare('select * from users where email = :email');
        $email = htmlspecialchars($email);
        $statement->bindValue("email", $email);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // var_dump($user);

        if ($user) {
            // email exists
            // echo "user exists";
            return $user;
        } else {
            // email does not exist
            return false;
        }
    }




}
