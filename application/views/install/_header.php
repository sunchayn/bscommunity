<!-- bloostone community V1 beta !-->
<!DOCTYPE html>
<html>
<head>
    <title><?=$data['title'] ." - ". language::invokeOutput('bsc');?></title>
    <base href="<?=Application::$prefix;?>">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <link rel="icon" type="image/png" href="<?=URL?>img/logo.png" />
    <?php
    if (LANGUAGE_CODE == 'ar')
        echo '<link rel="stylesheet" href="'.URL.'css/install_ar.css" media="screen" />';
    else
        echo '<link rel="stylesheet" href="'.URL.'css/install.css" media="screen" />';
    ?>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<div class="overlay"></div>
<div class="scroll-up hide-sm"><i class="icon-angle-up"></i></div>
<div class="scroll-up-res"><i class="icon-angle-up"></i></div>
<div class="confirm-modal" id="create-link">
    <div class="cf-modal-content"></div>
    <div class="modal-buttons grid-section">
        <a href="#confirm" class="c-confirm"><?=language::invokeOutput('frequent/confirm');?></a>
        <a href="#cancel" class="c-cancel"><?=language::invokeOutput('frequent/cancel');?></a>
        <div class="clear"></div>
    </div>
</div>
<div class="result-modal"></div>
