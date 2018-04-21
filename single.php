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
          echo '<div class="single">';
          echo '<h1>'.$row['title'].'</h1>';
          echo '<div class="datum">'.date('j. F Y', strtotime($row['date'])).'</div>';
          echo $row['body'];
          echo '</div>';
      ?>
      </div>
      <?php include('part_footer.php'); ?>
