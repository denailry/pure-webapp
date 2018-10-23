<?php
	require_once "configs/db.php";

    define("BOOK_COMMIT_SUCCESS", 0);

	class Book {
		private $id;
		var $title;
		var $author;
		var $cover;
        var $detail;

		function __construct($id=null) {
            global $conn;
            if ($id != null) {
                $query = $conn->prepare("SELECT title, author, cover, detail FROM book WHERE id=?");
                $query->bind_param('i', $id);
                $query->execute();

                $result = mysqli_stmt_get_result($query);
                if (mysqli_num_rows($result) == 0) {
                    throw new Exception("Book with specified id cannot be found.");
                } else {
                    $obj = mysqli_fetch_row($result);
                    $this->id = $id;
                    $this->title = $obj[0];
                    $this->author = $obj[1];
                    $this->cover = $obj[2];
                    $this->detail = $obj[3];
                }
            }
        }

        static function new($title,$author,$cover,$detail) {
            $book = new Book();
            $book->title = $title;
            $book->author = $author;
            $book->cover = $cover;
            $book->detail = $detail;
            return $book;
        }

        function commit() {
            global $conn;
            if (!isset($this->id)) {
                $query = $conn->prepare("
                    INSERT INTO book (`title`, `author`, `cover`, `detail`)
                    VALUES (?, ?, ?, ?)");
                $query->bind_param('ssssss', 
                    $this->title, $this->author, $this->cover, $this->detail);
                if ($query->execute() === TRUE) {
                    $this->id = mysqli_insert_id($conn);
                } else {
                    throw new Exception("Unable to create new book's data.");
                }
            } else {
                $query = $conn->prepare("
                    UPDATE book SET `title`=?, `author`=?, `cover`=?, `detail`=?)
                    WHERE `id`=?");
                $query->bind_param('ssssi', 
                    $this->title, $this->author, $this->cover, $this->detail, $this->id);
                if ($query->execute() === FALSE) {
                    throw new Exception("Unable to update book's data.");
                }
            }
            return BOOK_COMMIT_SUCCESS;
        }
	}
?>