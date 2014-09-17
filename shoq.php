<?php
$file = 'cache/queue.php';
echo '<html><body><pre>';
if (file_exists($file)) {
    ob_clean();
    flush();
    readfile($file);
}
else
{
echo 'Queue is Empty';
}
exit;
?>

