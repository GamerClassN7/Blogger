<?php
include('../part_header.php');
if(!$user->isLogged()) header('Location: login.php');

if(isset($_GET['delpost'])){ 
	$sql = $db->prepare('DELETE FROM blog_post WHERE id = :id') ;
	$sql->execute(array(':id' => $_GET['delpost']));
	header('Location: index.php?action=deleted');
	exit;
}	
?>
<div class="admin-posts">
  <table>
    <tr>
      <th>Title</th>
      <th>Date</th>
      <th>Action</th>
    </tr>
    <tr>
      	<?php
		try {
			$stmt = $db->query('SELECT id, title, date FROM blog_post ORDER BY id DESC');
			while($row = $stmt->fetch()){
				echo '<tr>';
				echo '<td>'.$row['title'].'</td>';
				echo '<td>'.date('d/m/y H:i:s', strtotime($row['date'])).'</td>';
				?>
  				<td>
  					<a href="edit-post.php?id=<?php echo $row['id'];?>">Edit</a> | 
  					<a href="javascript:delPost('<?php echo $row['id'];?>','<?php echo $row['title'];?>')">Delete</a>
  				</td>
				<?php 
				echo '</tr>';
			}
		} catch(PDOException $e) {
		    echo 'we can´t connet to sql.';
		}
	?>
    </tr>
  </table>
  <?php   
    //Write message if eddit or delete
    if(isset($_GET['action'])){ 
	     echo '<h3>Post '.$_GET['action'].'.</h3>'; 
    }
    if(isset($_GET['setting'])){ 
	     echo '<h3>Setting '.$_GET['setting'].'.</h3>'; 
    }?>
  <p><a href='add-post.php'>Add Post</a></p>
</div>
<?php include('../part_footer.php'); ?>