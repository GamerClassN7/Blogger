      <?php include('part_header.php'); ?>
      <div class="container">
        <?php
        
        $stmt = $db->prepare('SELECT id, title, body, date FROM blog_post WHERE id = :id');
        $stmt->execute(array(':id' => $_GET['id']));
        $row = $stmt->fetch();
        
        if($row['id'] == ''){
          header('Location: ./');
          exit;
        }
      
        echo '<div>';
          echo '<h1>'.$row['title'].'</h1>';
          echo '<p>Posted on '.date('d/m/y H:i:s', strtotime($row['date'])).'</p>';
          echo '<p>'.$row['body'].'</p>';                
        echo '</div>';
      ?>
      </div>
      <?php include('part_footer.php'); ?>