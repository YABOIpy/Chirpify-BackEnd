<?php
// Check if the form has been submitted
function delete($id) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $conn = new PDO(
            "mysql:host=localhost;dbname=chirpify",
            "root",
            ""
        );
        $conn->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("DELETE FROM tweets WHERE tweetid = :tweetid");
        $stmt->bindParam(':tweetid', $id);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo "Error deleting tweet.";
        }
    }
}

delete($_POST["id"]);
?>