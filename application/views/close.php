<!-- bloostone community V1 beta !-->
<!DOCTYPE html>
<html>
<head>
    <title><?=$data['title'] ." - ". $global['site_name'];?></title>
    <base href="<?=Application::$prefix;?>">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <link rel="icon" type="image/png" href="<?=isset_get($global, 'favicon_url');?>" />
    <link rel="stylesheet" href="<?=URL; ?>css/global.css" media="screen" />
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<!-- # Wrapper # -->
<div class="wrapper">
    <div class="scroll-up hide-sm">
        <i class="icon-up-dir"></i>
    </div>
    <div class="scroll-up-res">
        <i class="icon-up-dir"></i>
    </div>
    <div class="box-page">
        <div class="central-box grid-section">
            <div class="col-m col-12 center-sm">
                <h1 class="color-5"><?=language::invokeOutput('frequent/closedSite');?></h1>
                <p><?=$global['close_msg']?></p>
            </div>
        </div>
    </div>
    <footer>
        <script src="<?=URL?>vendor/jquery.js"></script>
        <script src="<?=URL?>js/functions.js"></script>
        <script src="<?=URL?>js/style.js"></script>
    </footer>
</div>
</body>
</html>
