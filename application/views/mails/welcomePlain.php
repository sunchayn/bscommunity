## <?=Language::invokeOutput('mails/welcome/heading').' '.$data['username'];?> ##
--------------

<?=Language::invokeOutput('mails/welcome/desc') . PHP_EOL;?>
--------------
<?=Language::invokeOutput('mails/verification/username').' '.$data['username'] . PHP_EOL;?>
<?=Language::invokeOutput('mails/welcome/forgetPassword') . PHP_EOL;?>
#<?=Language::invokeOutput('mails/welcome/recover');?> : <?=URL;?>account/recover
--------------
<?=Language::invokeOutput('mails/welcome/suggLink') . PHP_EOL;?>

####

<?=Language::invokeOutput('mails/welcome/link/heading') . PHP_EOL;?>
--------------
<?=Language::invokeOutput('mails/welcome/link/desc') . PHP_EOL;?>
#<?=URL;?>support

####

<?=Language::invokeOutput('mails/welcome/thanks') . PHP_EOL;?>
<?=Language::invokeOutput('mails/verification/regards');?>