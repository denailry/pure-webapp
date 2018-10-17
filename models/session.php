<?php
    require_once "configs/db.php";
    require_once "models/user.php";

    define("SESSION_CLEAN_SCHEDULE", 86400);

    function generateRandomString($length=32) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function triggerCleanSession() {
        global $conn;
        $query = $conn->query("SELECT `datestamp` FROM session_datestamp");
        $obj = mysqli_fetch_row($query);
        if (time() - $obj[0] > SESSION_CLEAN_SCHEDULE) {
            $current_time = time();
            $datestamp_threshold = $current_time - SESSION_CLEAN_SCHEDULE;
            $query = $conn->query("DELETE FROM session WHERE `expire_time`<$datestamp_threshold");
            $query = $conn->query("UPDATE session_stamp SET `datestamp`=$current_time");    
        }
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

        function get_user() {
            return new User($this->userId);
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
                $query->close();
                return null;
            } else {
                $obj = mysqli_fetch_row($result);
                $query->close();
                if ($obj[1] < time()) {
                    $session = new Session();
                    $session->accessToken = $accessToken;
                    $session->remove();
                    return null;
                } else {
                    $session = new Session();
                    $session->accessToken = $accessToken;
                    $session->userId = $obj[0];
                    $session->expireTime = $obj[1];
                    if (time() - $obj[1] <= 900) {
                        $session->renew();
                    }
                    return $session;
                }
            }
        }

        static function new($userId) {
            triggerCleanSession();

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

        function renew() {
            $temp = $this->expireTime;
            $this->expireTime = time() + self::SESSION_DURATION;
            if (!$this->commit()) {
                $this->expireTime = $temp;
                return false;
            }
            return true;
        }

        function remove() {
            global $conn;
            $query = $conn->prepare("DELETE FROM session WHERE `access_token`=?");
            $query->bind_param('s', $this->accessToken);
            $result = $query->execute();
            $query->close();
            return $result;
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