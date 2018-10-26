<?php
    require_once "configs/db.php";
    require_once "models/book.php";

	class Order {
		private $id;
        private $book;
        var $total;
        var $orderdate;
        var $rating;
        var $reviewcomment;

        function get_id() {
            return $this->id;
        }

        function get_book() {
            return $this->book;
        }

		function __construct($id=null) {
            global $conn;
            if ($id != null) {
                $query = $conn->prepare("SELECT orderdate, bookid, rating, reviewcomment, total FROM orderbook WHERE id=?");
                $query->bind_param('i', $id);
                $query->execute();

                $result = mysqli_stmt_get_result($query);
                if (mysqli_num_rows($result) == 0) {
                    throw new Exception("Book with specified id cannot be found.");
                }
                $obj = mysqli_fetch_row($result);
                $this->id = $id;
                $this->orderdate = $obj[0];
                $this->book = new Book($obj[1]);
                $this->rating = $obj[2];
                $this->reviewcomment = $obj[3];
                $this->total = $obj[4];
            }
        }

        static function get_history($userId) {
            global $conn;
            $query = $conn->prepare("SELECT `id`, `bookid`, `total`, `orderdate`, `reviewcomment`
                FROM orderbook WHERE userid = ? ORDER BY orderdate DESC");
            $query->bind_param('i', $userId);
            $query->execute();
            $result = mysqli_stmt_get_result($query);

            $history = array();

            while($row = $result->fetch_assoc()) {
                $order = new Order();
                $order->id = $row['id'];
                $order->book = new Book($row['bookid']);
                $order->total = $row['total'];
                $order->orderdate = $row['orderdate'];
                $order->reviewcomment = $row['reviewcomment'];
                array_push($history, $order);
            }

            return $history;
        }
	}
?>