<?php
    require_once "configs/db.php";

    define("USER_COMMIT_SUCCESS", 0);
    define("ERR_USERNAME_EXIST", 1);
    define("ERR_EMAIL_EXIST", 2);

    class User {
        private $id;
        var $name;
        var $username;
        var $email;
        var $password;
        var $address;
        var $phone;
        var $profilepic;

        function __construct($id=null) {
            global $conn;
            if ($id != null) {
                $query = $conn->prepare("SELECT name, username, email, address, phone, profilepic FROM user WHERE id=?");
                $query->bind_param('i', $id);
                $query->execute();

                $result = mysqli_stmt_get_result($query);
                if (mysqli_num_rows($result) == 0) {
                    throw new Exception("User with specified id cannot be found.");
                } else {
                    $obj = mysqli_fetch_row($result);
                    $this->id = $id;
                    $this->name = $obj[0];
                    $this->username = $obj[1];
                    $this->email = $obj[2];
                    $this->address = $obj[3];
                    $this->phone = $obj[4];
                    $this->profilepic = $obj[5];
                }
            }
        }

        static function verify($username, $password) {
            global $conn;
            $query = $conn->prepare("SELECT `id`, `username`, `password` FROM user WHERE username=?");
            $query->bind_param('s', $username);
            $query->execute();

            $result = mysqli_stmt_get_result($query);
            if (mysqli_num_rows($result) == 0) {
                return -1;
            } else {
                $obj = mysqli_fetch_row($result);
                if ($obj[2] == $password) {
                    return $obj[0];
                } else {
                    return -1;
                }
            }
        }

        static function new($data) {
            $user = new User();
            $user->name = $data['name'];
            $user->username = $data['username'];
            $user->email = $data['email'];
            $user->password = $data['password'];
            $user->address = $data['address'];
            $user->phone = $data['phone'];
            return $user;
        }

        static function isValidUsername($username) {
            global $conn;
            $query = $conn->prepare("SELECT `username` FROM user WHERE `username`=?");
            $query->bind_param('s', $username);
            if ($query->execute() === TRUE) {
                $result = mysqli_stmt_get_result($query);
                return (mysqli_num_rows($result) == 0);
            } else {
                throw new Exception("Unable to validate username.");
            }
        }

        static function isValidEmail($email) {
            global $conn;
            $query = $conn->prepare("SELECT `email` FROM user WHERE `email`=?");
            $query->bind_param('s', $email);
            if ($query->execute() === TRUE) {
                $result = mysqli_stmt_get_result($query);
                return (mysqli_num_rows($result) == 0);
            } else {
                throw new Exception("Unable to validate email.");
            }
        }

        function commit() {
            global $conn;
            if (!isset($this->id)) {
                if (!User::isValidUsername($this->username)) {
                    return ERR_USERNAME_EXIST;
                }
                if (!User::isValidEmail($this->email)) {
                    return ERR_EMAIL_EXIST;
                }
                $query = $conn->prepare("
                    INSERT INTO user (`name`, `username`, `email`, `password`, `address`, `phone`)
                    VALUES (?, ?, ?, ?, ?, ?)");
                $query->bind_param('ssssss', 
                    $this->name, $this->username, $this->email, 
                    $this->password, $this->address, $this->phone);
                if ($query->execute() === TRUE) {
                    $this->id = mysqli_insert_id($conn);
                } else {
                    throw new Exception("Unable to create new user's data.");
                }
            } else {
                $query = $conn->prepare("
                    UPDATE user SET `name`=?, `address`=?, `phone`=?, `profilepic`=?
                    WHERE `id`=?");
                $query->bind_param('ssssi', 
                    $this->name, $this->address, $this->phone,$this->profilepic, $this->id);
                if ($query->execute() === FALSE) {
                    throw new Exception("Unable to update user's data.");
                }
            }
            return USER_COMMIT_SUCCESS;
        }
    }
?>