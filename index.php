
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chirpify</title>
    <link rel="shortcut icon" href="./img/chirpfy.png" type="image/x-icon">
    <link 
    rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" 
    />
    <link 
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" 
    rel="stylesheet"   
    />
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="like.css">
    <title>Document</title>
</head>
    <!-- News-Feed Page -->
  
    <body>
<section class="feeds-page">
    <nav class="feeds-nav dark-mode-1">
        <div class="icons">
            <a href="home.php" class="active"><i class="fas fa-home"></i></a>
            <a href="#"><i class="fas fa-hashtag"></i></a>
            <a href="#"><i class="far fa-bell"></i></a>
            <a href="#"><i class="far fa-envelope"></i></a>
        </div>

<div class="search-bar">
 <i class="fas fa-search"></i>
  <input 
  type="text" 
  placeholder="Search Chirpify" 
  class="search-bar-input dark-mode-2 light-text border"
  />
</div>


<?php
session_start();

    //$user = ("SELECT * FROM accounts WHERE username = :username");
if ($_SESSION['username'] !== null) {
    //echo "Welcome: ".$_SESSION['username'];
} else {
    echo "You are not logged in.";
}
?>

<div class="user">
  <div class="user-img-wrapper">
    <img src="./img/ profile picture.png" alt="" />
  </div>
  <?php if (isset($_SESSION['username']) && $_SESSION['username'] !== null): ?>
    <a href="#" class="user-link light-text"><?php echo substr($_SESSION['username'], 0, ); ?></a>
  <?php else: ?>
    <a href="#" class="user-link light-text">-</a>
  <?php endif; ?>
  <i class="fas fa-chevron-down"></i>
</div>
</nav>
<div class="feeds-content dark-mode-2">
<div class="feeds-header dark-mode-1">
    <div class="header-top border">
        <h4 class="light-text">Home</h4>
        <i class="far fa-star"></i>
    </div>

    <div class="header-post dark-mode-1 border">
        <div class="header-img-wrapper">
            <img src="./img/ profile picture.png">
        </div>
        <input 
        type="text" 
        placeholder="What's happening?" 
        class="dark-mode-2 light-text border"
        />
        <i class="far fa-image"></i>
        <i class="fas fa-camera"></i>
        <i class="far fa-chart-bar"></i>
      </div>
    </div>


<script>
    function submitForm() {
        document.getElementById("myForm").submit();
    }
</script>

<?php

$conns = new mysqli(
    "localhost",
    "root",
    "",
    "chirpify"
);

$result = $conns->query("SELECT * FROM tweets");
$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}


foreach ($data as $row) {
    $btn = "";
    if ($_SESSION['username'] == substr(base64_decode($row['tweetid']), 0, strlen(base64_decode($row['tweetid'])) - 10)) {
        $btn = '<button type="submit" name="id" value='.$row['tweetid'].'>Delete Tweet</button>';
    }
    echo '
        <div class="posts dark-mode-1">
            <div class="post border">
                <div class="user-avatar">
                    <img src="./img/sefa catak profile pictuyre.png">
                </div>
                <div class="post-content">
                     <div class="post-user-info light-text">
                         <h4>
                             ' . substr(base64_decode($row['tweetid']), 0, strlen(base64_decode($row['tweetid'])) - 10) . '
                         </h4>
                        <i class="fas fa-check-circle"></i>
                         <span>@' . substr(base64_decode($row['tweetid']), 0, strlen(base64_decode($row['tweetid'])) - 10). '</span>
        
                     </div>
                
                     <p class="post-text light-text">
                        ' . $row['text'] . '
                         
                     </p>
                          <form method="post" action="delete.php">
                         <div class="post-icons">
                            <i class="far fa-comment"></i>
                            <i class="fas fa-retweet"></i>
                            <i class="fas fa-heart"></i>
                            
                            <i class="fas fa-share-alt"></i>
                         </div>
                          
                        '.$btn.'  
                        </form>
                      </div>
                     </div>
                    ';



}

?>

<div class="follow dark-mode-1">
    <h3 class="follow-heading light-text border">Who to follow?</h3>
    <div class="follow-user border">
        <div class="follow-user-img">
<img src="./img/ali_profile_picture.jpg">
        </div>
        <div class="follow-user-info light-text">
            <h4>Mert hakan yandas</h4>
            <p>@mertie010</p>
        </div>
        <button type="button" class="follow-btn dark-mode-2">Follow</button>
      </div>
      <div class="follow-user border">
        <div class="follow-user-img">
<img src="./img/berkay profile picture.jpg">
        </div>
        <div class="follow-user-info light-text">
            <h4>Altay bayandir</h4>
            <p>@ally1907</p>
        </div>
        <button type="button" class="follow-btn dark-mode-2">Follow</button>
      </div>
     


<!--Post button-->

<button type="submit" class="post-btn" >
    +<i class="fas fa-feather-alt"></i>Post
</button>


<!--Post Modal-->

<form action="tweet.php" method="post" class="modal-wrapper">
    <div class="modal dark-mode-1">
        <div class="modal-header border">
            <i class="fas fa-times"></i>
            <button type="submit">Post</button>


            </div>
            <div class="modal-body">
                <div class="modal-img">

                    <img src="./img/ali_profile_picture.jpg"/>
                    </div>
                    <input type="text" id="text" class="modal-input dark-mode-2 light-text border tweet-text-content" placeholder="What's happening?" name="text"/>
                    <i class="far fa-smile"></i>
                    </div>
                    <div class="modal-footer">
                    <div class="modal-icons">
                        <i class="far fa-image"></i>
                        <i class="far fa-solid fa-camera"></i>
                        <i class="far fa-chart-bar"></i>
                        <span>+</span>
            </div>
        </div>
    </div>
</form>


</body>

<!-- End of Post Modal-->

<!-- Sidebar -->

<div class="sidebar-wrapper">
    <div class="sidebar dark-mode-1">
        <div class="sidebar-header border">
            <h2 class="light-text">Account Info</h2>
            <i class="fas fa-times"></i>
            </div>
            <div class="sidebar-user">
                <div class="sidebar-user-img">
                    <img src="./img/ profile picture.png"/>
            </div>
            <span>+</span>
        </div>
        <div class="sidebar-user-info light-text">
            <?php
            echo '
                <h4>'.substr(base64_decode($row['tweetid']), 0, strlen(base64_decode($row['tweetid'])) - 10).' </h4>
                <p>@'.substr(base64_decode($row['tweetid']), 0, strlen(base64_decode($row['tweetid'])) - 10).'</p>
            '
            ?>
        </div>
        <div class="following light-text">
            <p class="following-paragraph"><span>811</span> Following</p>
            <p class="following-paragraph"><span>9.4k</span> Followers</p>
        </div>
        <div class="sidebar-list-1 border">
        <div class="modal-wrapper">
            <ul>
                <li>
                    <a href="profiel_pagina.php"><i class="fas fa-user"></i> Profile</a>
                </li>
            </ul>
        </div>
</div>
        <div class="sidebar-list-2">
            <ul>
            <form method="POST" action="logout.php">
                <input type="submit" value="LogOut">

            </form>

                <!-- <li><a href="">Log Out</a>

                </li> -->
            </ul>
        </div>

<!-- Dark mode -->

<div class="dark-mode">
<p>Dark Mode</p>
<div class="toggle">
    <div class="circle"></div>
   </div>
  </div>
 </div>
</div>

<!-- End of Sidebar -->

</section>

    <script src="script.js"></script>
    
</body>
</html>
