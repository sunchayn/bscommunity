## <?=Language::invokeOutput('mails/recover/greeting').' '.$data['username'];?> ##
--------------

<?=Language::invokeOutput('mails/recover/desc') . PHP_EOL;?>

<?=Language::invokeOutput('mails/verification/hint') . PHP_EOL;?>

#<?=URL;?>account/recover/<?=$data['hash'] . PHP_EOL;?>

<?=Language::invokeOutput('mails/verification/regards');?>