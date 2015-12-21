## <?=Language::invokeOutput('mails/verification/welcome').' '.Controller::$GLOBAL['site_name'];?> ##
--------------

<?=Language::invokeOutput('mails/verification/desc') . PHP_EOL;?>
#<?=URL;?>account/verify/<?=$data['id'];?>/<?=$data['hash'] . PHP_EOL;?>

--------------
<?=Language::invokeOutput('mails/verification/username').' '.$data['username'] . PHP_EOL;?>
--------------
<?=Language::invokeOutput('mails/verification/regards');?>