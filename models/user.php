<?php
    require_once "configs/db.php";

    class User {
        private $id;
        var $name;
        var $username;
        var $email;
        var $password;
        var $address;
        var $phone;

        function __construct($id=null) {
            if ($id != null) {
                $query = $conn->prepare("SELECT name, username, email, address, phone FROM user WHERE id=?");
                $query->bind_param('i', $id);
                $result = $query->execute();

                if (mysqli_num_rows($result) == 0) {
                    throw new Exception("User with specified id cannot be found.");
                } else {
                    $obj = mysqli_fetch_row($result)[0];
                    $this->id = $id;
                    $this->name = $obj['name'];
                    $this->username = $obj['username'];
                    $this->email = $obj['email'];
                    $this->address = $obj['address'];
                    $this->phone = $obj['phone'];
                }
            }
        }

        static function verify($email, $password) {
            global $conn;
            $query = $conn->prepare("SELECT `email`, `password` FROM user WHERE email=?");
            $query->bind_param('s', $email);
            $query->execute();

            $result = mysqli_stmt_get_result($query);
            if (mysqli_num_rows($result) == 0) {
                return FALSE;
            } else {
                $obj = mysqli_fetch_row($result);
                return $obj[1] == $password;
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

        function commit() {
            global $conn;
            if (!isset($this->$id)) {
                $query = $conn->prepare("
                    INSERT INTO user (`name`, `username`, `email`, `password`, `address`, `phone`)
                    VALUES (?, ?, ?, ?, ?, ?)");
                $query->bind_param('ssssss', 
                    $this->name, $this->username, $this->email, 
                    $this->password, $this->address, $this->phone);
                if ($query->execute() === TRUE) {
                    $this->id = mysqli_insert_id($conn);
                } else {
                    throw new Exception("Unable to new user's data.");
                }
            } else {
                $query = $conn->prepare("
                    UPDATE user SET `name`=?, `username`=?, `email`=?, `address`=?, `phone`=?)
                    WHERE `id`=?");
                $query->bind_param('ssssi', 
                    $this->name, $this->username, $this->email, $this->address, $this->phone, $this->id);
                if ($query->execute() === FALSE) {
                    throw new Exception("Unable to update user's data.");
                }
            }
        }
    }
?>