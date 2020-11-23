<?php
require 'config/db.php';
session_start();

$sql = "SELECT * FROM posts";
$result = $conn->query($sql);
$errors = array();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>PIAZZA 2.0</title>
    <link rel="stylesheet" href="/css/main.css" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Yeseva+One&family=Work+Sans:ital,wght@0,300;0,400;1,300;1,400&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <link rel="stylesheet" href="all.css" />
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.html">Piazza 2.0</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php if(!isset($_SESSION['guest'])) :?>
              <li>
                <a class="nav-link" href="addposts.php">Post</a>
              </li>
            <?php endif; ?>
            <?php if(isset($_SESSION['guest']) && $_SESSION['guest']) :?>
              <li>
                <a class="nav-link" href="logout.php">Log out from Guest</a>
              </li>
            <?php else :?>
              <li>
                <a class="nav-link" href="logout.php">Log out</a>
            </li>
            <?php endif; ?>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-2 sidebar" style = "margin:0; border-width: 0px; ">
            load posts here &emsp;&emsp; <button><i class="far fa-star"></i></button>
        </div>

        <div class="col-lg-6 section py-3 main">
          <div class="loadedpost">
            <h5>POST'S TITLE</h5>
            <hr />
            <p>
              Client If valid connection made, let user know how many more
              drivers needed before orders are delivered total number of
              connected drivers should include the current driver Once orders
              are dispatched, client needs to deliver orders to appropriate
              restaurants Also handle returned data from api calls to determine
              distances of each restaurant
            </p>
            <?php
              while($rows = $result->fetch_assoc()){
              echo "<h5>" . $rows['Title']. "</h2>";
              echo "<p>" .$rows['Content']. "</p>";
              $id = $rows['PostID'];
              
              $sql = "SELECT * FROM comments WHERE PostID = " . $id;
              $comment = $conn->query($sql);
                while($commentRows = $comment->fetch_assoc())
                {
                  echo $commentRows['Comment'];
                  echo "<hr>";
                }

              }
            ?>
          </div>
          <hr />
          <div class="react"> 
            <div class = "rct" style = "display:inline;"> <button class="btn thumb" ><i class="far fa-thumbs-up"></i></button> </div>
            <div class = "rct1" style = "display:inline;"> <button class="btn heart"><i class="fas fa-heart"></i></button> </div>
          <div class = "rct2" style = "display:inline;"> <button class="btn grin"><i class="far fa-grin"></i></button> </div>
          <div class = "rct3" style = "display:inline;"> <button class="btn frown"><i class="far fa-frown"></i></button> </div>
          <div class = "rct4" style = "display:inline;"> <button class="btn tears"> <i class="far fa-grin-squint-tears"></i> </button> </div>
          </div>


          <?php if(!isset($_SESSION['guest'])) :?>
          <div class="comment">
            <hr />
            <h5>Comment:</h5>
            <textarea name="commenttext" class="form-control"></textarea>
            <input class="btn btn-primary seagreen" type="submit" name = "comment_btn" value="Submit" />
            <?php
      
              if(isset($_POST['comment_btn'])) { 
                  //setting variable names as assigned in the above
              $PostID = $id;
              $Comment = $_POST['commenttext'];
              if(empty($PostID)){
                $errors['PostID'] = "PostID required";
              }
              if(empty($Comment)){
                $errors['Comment'] = "Comment required";
              }
              if(count($errors) === 0){

                $sql = "INSERT INTO `posts`(`PostID`, `Comment`) VALUES (?, ?)";
                $stmtt = $conn->prepare($sql);
                $stmtt->bind_param('i`s', $PostID, $Comment);
                if($stmtt->execute()){
                  header('Location: main.php');
                }
                else{
                  $errors['db_error'] = "Database error: Failed to add information";
                }

              }
            }
              else{
              ?>  
                <div class="alert alert-danger">
                  <?php foreach($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                  <?php endforeach; ?>
                </div>
              <?php
              }
              ?>

          </div>
        <?php endif; ?>
        </div>

    </div>

  </div>


    <script>
     document.querySelector(".rct").onclick = function(event) {
      if( document.querySelector(".rct").getElementsByTagName("button")[0].style.backgroundColor == "skyblue")
      {
        document.querySelector(".rct").getElementsByTagName("button")[0].style.backgroundColor = "white";
      }
      else
      {
        document.querySelector(".rct").getElementsByTagName("button")[0].style.backgroundColor = "skyblue";
      }
     
    }
    document.querySelector(".rct1").onclick = function(event) {
       if( document.querySelector(".rct1").getElementsByTagName("button")[0].style.backgroundColor == "skyblue")
      {
        document.querySelector(".rct1").getElementsByTagName("button")[0].style.backgroundColor = "white";
      }
      else
      {
        document.querySelector(".rct1").getElementsByTagName("button")[0].style.backgroundColor = "skyblue";
      }
    }
    document.querySelector(".rct2").onclick = function(event) {
       if( document.querySelector(".rct2").getElementsByTagName("button")[0].style.backgroundColor == "skyblue")
      {
        document.querySelector(".rct2").getElementsByTagName("button")[0].style.backgroundColor = "white";
      }
      else
      {
        document.querySelector(".rct2").getElementsByTagName("button")[0].style.backgroundColor = "skyblue";
      }
    }
    document.querySelector(".rct3").onclick = function(event) {
       if( document.querySelector(".rct3").getElementsByTagName("button")[0].style.backgroundColor == "skyblue")
      {
        document.querySelector(".rct3").getElementsByTagName("button")[0].style.backgroundColor = "white";
      }
      else
      {
        document.querySelector(".rct3").getElementsByTagName("button")[0].style.backgroundColor = "skyblue";
      }
    }
    document.querySelector(".rct4").onclick = function(event) {
       if( document.querySelector(".rct4").getElementsByTagName("button")[0].style.backgroundColor == "skyblue")
      {
        document.querySelector(".rct4").getElementsByTagName("button")[0].style.backgroundColor = "white";
      }
      else
      {
        document.querySelector(".rct4").getElementsByTagName("button")[0].style.backgroundColor = "skyblue";
      }
    }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sockjs-client/1.1.4/sockjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stomp.js/2.3.3/stomp.min.js"></script>
    <script src="/js/main.js"></script>
  </body>
</html>
