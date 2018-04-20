
function delPost(id, title)
{
	if (confirm("Chcete opravdu smazat příspevek:'" + title + "'"))
	{
	  window.location.href = 'index.php?delpost=' + id;
	}
}
