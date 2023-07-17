<?php

session_start();

class Main {

    public static function Connect($dbname): PDO {
        $conn = new PDO(
            "mysql:host=localhost;dbname=$dbname",
            "root",
            ""
        );
        return $conn;
    }

    public static function Check($value) {
        $UserID = $_SESSION['username'];
        if ($UserID) {
            $value = true;
        } else if ($UserID === false) {
            $value = false;
        }
        return $value;
    }

    public static function Post() {
        if (Main::Check(null)) {
            if (isset($_POST['text'])) {

                if (strlen($_POST['text']) > 400 || $_POST['text'] < 3) {
                    echo 'text is too long/short';
                } else {
                    Main::Insert();
                }

            }
        } else {
            header('Location: chirplogin.php');
        }
    }


    public static function CreateID($ID): string {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = "";
        for ($i = 0; $i < 10; $i++) {
            $str .= $chars[rand(0, strlen($chars) - 1)];
        }
        return base64_encode($ID . $str);
    }


    public static function Insert() {
        $title = filter_input(INPUT_POST,
            "title",
            FILTER_SANITIZE_STRING
        );
        $text = filter_input(INPUT_POST,
            "text",
            FILTER_SANITIZE_STRING
        );

        $ID = Main::CreateID(
            $_SESSION['username']
        );

        $query = Main::Connect("chirpify")->prepare("INSERT INTO tweets (text, tweetid) VALUES (:text, :tweetid)");
        $query->bindParam(":text", $_POST['text']);
        $query->bindParam(":tweetid", $ID);
        if($query->execute()) {
            echo "sent message";
            header('Location: index.php');
        }
    }

}

function run() {
    Main::Post();
}

run()

?>


