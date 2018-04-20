
function delPost(id, title)
{
	if (confirm("Are you sure you want to delete '" + title + "'"))
	{
	  window.location.href = 'index.php?delpost=' + id;
	}
}