<?php
echo Controller::$GLOBAL['site_name'] . PHP_EOL;
?>
----

<?=language::invokeOutput('mails/subscribes/heading') . PHP_EOL;?>
---------------------

<?php
echo language::invokeOutput('mails/subscribes/desc') . PHP_EOL;
echo language::invokeOutput('mails/subscribes/may') . PHP_EOL ;
?>

---------------------
<?php
echo PHP_EOL;
foreach ($data['content'] as $row) {
	echo $row['title'] . PHP_EOL . '#####' . PHP_EOL . URL . 'thread/' . $row['id'] . PHP_EOL . $row['content'] . PHP_EOL . PHP_EOL;
}
?>
---------------------

<?=language::invokeOutput('mails/subscribes/remind') . PHP_EOL;?>
<?=language::invokeOutput('mails/subscribes/unsubscribe') . PHP_EOL;?>
#<?=URL;?>newsletter/unsubscribe/<?=$data['hash'] . PHP_EOL;?>
<?=language::invokeOutput('mails/verification/regards');?>