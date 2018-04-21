      <?php include('part_header.php'); ?>
      <div class="container">
        <?php
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 060c6c233b69c3275e8987c8a9fbf0dbf6b3962a

        $stmt = $db->prepare('SELECT id, title, body, date FROM blog_post WHERE id = :id');
        $stmt->execute(array(':id' => $_GET['id']));
        $row = $stmt->fetch();

<<<<<<< HEAD
=======
=======
        
        $stmt = $db->prepare('SELECT id, title, body, date FROM blog_post WHERE id = :id');
        $stmt->execute(array(':id' => $_GET['id']));
        $row = $stmt->fetch();
        
>>>>>>> 292238a21a4566764950ca95b53ef46a7195a995
>>>>>>> 060c6c233b69c3275e8987c8a9fbf0dbf6b3962a
        if($row['id'] == ''){
          header('Location: ./');
          exit;
        }
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 060c6c233b69c3275e8987c8a9fbf0dbf6b3962a
          echo '<div class="single">';
          echo '<h1>'.$row['title'].'</h1>';
          echo '<div class="datum">'.date('j. F Y', strtotime($row['date'])).'</div>';
          echo $row['body'];
          echo '</div>';
      ?>
      </div>
      <?php include('part_footer.php'); ?>
<<<<<<< HEAD
=======
=======
      
        echo '<div>';
          echo '<h1>'.$row['title'].'</h1>';
          echo '<p>Posted on '.date('d/m/y H:i:s', strtotime($row['date'])).'</p>';
          echo '<p>'.$row['body'].'</p>';                
        echo '</div>';
      ?>
      </div>
      <?php include('part_footer.php'); ?>
>>>>>>> 292238a21a4566764950ca95b53ef46a7195a995
>>>>>>> 060c6c233b69c3275e8987c8a9fbf0dbf6b3962a
