<?php
  require 'config/db.php';
  $sql = "SELECT * FROM posts";
  $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>proj</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="styles.css" />
  </head>
  <body>
    <div class="header">
      <h3>Piazza 2.0</h3>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-2 section py-3 empty">
          <h5>sidebar:</h5>
        </div>

        <div class="col-6 section py-3 main">
         <div class = "post"><h5>post:</h5>
          <?php
            while($rows = $result->fetch_assoc()){
            echo "<h5>" .$rows['Title']. "</h2>";
            echo "<p>" .$rows['Content']. "</p>";
            }
          ?>
         </div> 
          <div class = "react"> <h5>react:</h5> </div>
        </div>
        <div class="col-2 section py-3 chat">
          <h5>Chat:</h5>
          <ul class = "you">
            <li>something</li>
            <li>something</li>
          </ul>
          <ul class = "mechat">
            <li>me something</li>
            <li>me something</li>
          </ul>
          <textarea name="chatbox" class="form-control"></textarea>
        </div>
        <div class="col-2 section py-3 online">
          <h4>ONLINE</h4>

          <div class="instructors">
            <h5>Instructors:</h5>
            <ul>
              <li><img src="smile.png" alt="prof pic" /> teacher</li>
              <li><img src="smile.png" alt="prof pic" />teacher</li>
              <li><img src="smile.png" alt="prof pic" />cp</li>
            </ul>
          </div>

          <div class="students">
            <h5>Students:</h5>
            <ul>
              <li><img src="smile.png" alt="prof pic" />student</li>
              <li><img src="smile.png" alt="prof pic" />student</li>
              <li><img src="smile.png" alt="prof pic" />student</li>
              <li><img src="smile.png" alt="prof pic" />student</li>
              <li><img src="smile.png" alt="prof pic" />student</li>
              <li><img src="smile.png" alt="prof pic" />student</li>
            </ul>
          </div>

          <div class="disc">
            <h5>Live Discussion:</h5>
            <ul>
              <li>something</li>
              <li>something</li>
              <li>something</li>
              <li>something</li>
              <li>something</li>
            </ul>
          </div>
          <div class="me">
            <ul>
              <li>me something</li>
            </ul>
            <textarea name="discussion" class="form-control"></textarea>

          </div>
        </div>
      </div>
      <div class="row">
        
      </div>
    </div>
    <script></script>
  </body>
</html>
