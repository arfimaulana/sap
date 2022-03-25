<!DOCTYPE html>
<html>
<body>
<center>
	<h1>Send Data SAP Manual</h1>

	<form action="cron.php" method="post">
	  <label for="sapdate">Tanggal:</label>
	  <input type="date" id="sapdate" name="sapdate">
	  <input type="submit">
	</form>

	<p><strong>Note:</strong>Untuk data scan Pukul 10:00 - 23:59:59</p>
	<br>
	<form action="cron2.php" method="post">
	  <label for="sapdate2">Tanggal:</label>
	  <input type="date" id="sapdate2" name="sapdate2">
	  <input type="submit">
	</form>
	<p><strong>Note:</strong>Untuk data scan Pukul 00:00 - 09:59:59</p>
</center>
</body>
</html>