<?php
    require_once "configs/db.php";

    function generateRandomString($length=32) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    class Session {
        const SESSION_DURATION = 3600;

        private $accessToken;
        private $userId;
        private $expireTime;

        function get_token() {
            return $this->accessToken;
        }

        function get_id() {
            return $this->userId;
        }

        static function verify($accessToken) {
            global $conn;
            $query = $conn->prepare("
                SELECT `id_user`, `expire_time` 
                FROM session WHERE `access_token`=?");
            $query->bind_param('s', $accessToken);
            $query->execute();
            $result = mysqli_stmt_get_result($query);
            
            if (mysqli_num_rows($result) == 0) {
                return null;
            } else {
                $obj = mysqli_fetch_row($result);
                if ($obj[1] < time()) {
                    return null;
                } else {
                    $session = new Session();
                    $session->accessToken = $accessToken;
                    $session->userId = $obj[0];
                    $session->expireTime = $obj[1];
                    return $session;
                }
            }
        }

        static function new($userId) {
            $session = new Session();
            $session->userId = $userId;
            $session->expireTime = time() + self::SESSION_DURATION;
            $fail_counter = 0;

            do {
                $session->accessToken = generateRandomString(32);
                if ($session->commit()) {
                    return $session;
                } else {
                    $fail_counter++;
                }
            } while ($fail_counter < 3);
            
            return null;
        }

        function commit() {
            global $conn;
            $query = $conn->prepare("
                INSERT INTO session (`access_token`, `id_user`, `expire_time`)
                VALUES (?, ?, ?)");
            $query->bind_param('sii', 
                $this->accessToken, $this->userId, $this->expireTime);
            $result = $query->execute();
            $query->close();
            return $result;
        }
    }
?>