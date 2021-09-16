<?php

namespace Orca;
use PDO;
use PDOException;

class Tasks
{
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($task) {
        $this->name = $task['name'];
        $this->email = $task['email'];
        $this->comment = $task['comment'];
        $this->post();
    }

    public function post() {
        try {
            $query = "INSERT INTO orca.comments (username, email, comment)
            VALUES (:val1, :val2, :val3)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':val1', $this->name, PDO::PARAM_STR);
            $stmt->bindParam(':val2', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':val3', $this->comment, PDO::PARAM_STR);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function createReply($task) {
        $this->commentid = $task['commentid'];
        $this->name = $task['replyName'];
        $this->email = $task['replyEmail'];
        $this->comment = $task['replyComment'];
        $this->postReply();
    }

    public function postReply() {
        try {
            $query = "INSERT INTO orca.replies (commentid, username, email, comment)
            VALUES (:val1, :val2, :val3, :val4)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':val1', $this->commentid, PDO::PARAM_STR);
            $stmt->bindParam(':val2', $this->name, PDO::PARAM_STR);
            $stmt->bindParam(':val3', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':val4', $this->comment, PDO::PARAM_STR);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function fetchComments(){$stmt = $this->pdo->prepare("SELECT * FROM orca.comments ORDER BY time DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchReplies(){$stmt = $this->pdo->prepare("SELECT * FROM orca.replies ORDER BY time DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
