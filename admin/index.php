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
<<<<<<< HEAD
	<?php
		//Write message if eddit or delete
		if(isset($_GET['action'])){
			if($_GET['action'] == 'updated')
			 echo '<div class="alert zeleny">Příspěvek byl aktualizován.</div>';
			elseif($_GET['action'] == 'deleted')
 			 echo '<div class="alert">Příspěvek byl smazán.</div>';
			elseif($_GET['action'] == 'added')
					echo '<div class="alert zeleny">Příspěvek byl vytvořen.</div>';
		}
		if(isset($_GET['setting'])){
			 echo '<h3>Setting '.$_GET['setting'].'.</h3>';
		}?>

=======
>>>>>>> 292238a21a4566764950ca95b53ef46a7195a995
  <table>
    <tr>
      <th>Název článku</th>
      <th>Datum</th>
<<<<<<< HEAD
			<th>Krátký popisek</th>
=======
			<th>Urivek</th>
>>>>>>> 292238a21a4566764950ca95b53ef46a7195a995
      <th>Akce</th>
    </tr>
    <tr>
      	<?php
		try {
			$stmt = $db->query('SELECT * FROM blog_post ORDER BY id DESC');
			while($row = $stmt->fetch()){
				echo '<tr>';
				echo '<td>'.$row['title'].'</td>';
<<<<<<< HEAD
				echo '<td>'.datum(date('j. F Y', strtotime($row['date']))).'</td>';
				echo '<td>'.$row['short'].'</td>';
				?>
  				<td>
  					<a href="edit-post.php?id=<?php echo $row['id'];?>">Upravit</a>
=======
				echo '<td>'.datum(date('d.F.Y', strtotime($row['date']))).'</td>';
				echo '<td>'.$row['short'].'</td>';
				?>
  				<td>
  					<a href="edit-post.php?id=<?php echo $row['id'];?>">Upravit</a> |
>>>>>>> 292238a21a4566764950ca95b53ef46a7195a995
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
<<<<<<< HEAD

=======
  <?php
    //Write message if eddit or delete
    if(isset($_GET['action'])){
	     echo '<h3>Příspěvek '.$_GET['action'].'.</h3>';
    }
    if(isset($_GET['setting'])){
	     echo '<h3>Setting '.$_GET['setting'].'.</h3>';
    }?>
  <p><a href='add-post.php'>Přidat příspěvek</a></p>
>>>>>>> 292238a21a4566764950ca95b53ef46a7195a995
</div>
<?php include('../part_footer.php'); ?>
