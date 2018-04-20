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
<div class="admin-posts container">
  <table>
    <tr>
      <th>Název článku</th>
      <th>Datum</th>
			<th>Urivek</th>
      <th>Akce</th>
    </tr>
    <tr>
      	<?php
		try {
			$stmt = $db->query('SELECT * FROM blog_post ORDER BY id DESC');
			while($row = $stmt->fetch()){
				echo '<tr>';
				echo '<td>'.$row['title'].'</td>';
				echo '<td>'.datum(date('d.F.Y', strtotime($row['date']))).'</td>';
				echo '<td>'.$row['short'].'</td>';
				?>
  				<td>
  					<a href="edit-post.php?id=<?php echo $row['id'];?>">Upravit</a> |
  					<a href="javascript:delPost('<?php echo $row['id'];?>','<?php echo $row['title'];?>')">Smazat</a>
  				</td>
				<?php
				echo '</tr>';
			}
		} catch(PDOException $e) {
		    echo 'Nelze se připojit k Databázi.';
		}
	?>
    </tr>
  </table>
  <?php
    //Write message if eddit or delete
    if(isset($_GET['action'])){
	     echo '<h3>Příspěvek '.$_GET['action'].'.</h3>';
    }
    if(isset($_GET['setting'])){
	     echo '<h3>Setting '.$_GET['setting'].'.</h3>';
    }?>
  <p><a href='add-post.php'>Přidat příspěvek</a></p>
</div>
<?php include('../part_footer.php'); ?>
