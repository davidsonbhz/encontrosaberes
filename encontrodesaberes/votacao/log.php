<?php
error_reporting(0);
if(isset($_REQUEST['limpar'])) {
    unlink("log.txt");
    header("Location: log.php");
}
echo "<a href='log.php?limpar=1'>Limpar</a><br>";
echo "<a href='logout.php'>Logout</a><hr>";
$handle = fopen("log.txt", "r");
while (($line = fgets($handle)) !== false) {
    // process the line read.
    echo "$line<br>\n";
}
fclose($handle);
