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
        <link rel="icon" type="image/png" href="<?=isset_get($global, 'favicon_url', '');?>" />
        <?php
            if (LANGUAGE_CODE == 'ar')
                echo '<link rel="stylesheet" href="'.URL.'css/global_ar.css" media="screen" />';
            else
                echo '<link rel="stylesheet" href="'.URL.'css/global.css" media="screen" />';
        ?>        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- # Wrapper # -->
        <div class="wrapper">
            <div class="scroll-up hide-sm"><i class="icon-up-dir"></i></div>
            <div class="scroll-up-res"><i class="icon-up-dir"></i></div>
            <div class="box-page">
                <div class="central-box error-page v-middle">
                    <h1>404</h1>
                    <h2><?=language::invokeOutput('hint');?></h2>
                    <nav>
                        <a href="home"><?=language::invokeOutput('back');?></a> -
                        <a href="FAQ"><?=Language::invokeOutput('footer/help-menu/FAQ');?></a> -
                        <a href="support"><?=Language::invokeOutput('footer/help-menu/help');?></a> -
                        <a href="term"><?=Language::invokeOutput('footer/help-menu/term');?></a>
                    </nav>
                </div>
            </div>
            <footer>
                <script src="<?=URL;?>vendor/jquery.js"></script>
                <script src="<?=URL;?>js/functions_full.js"></script>
                <script src="<?=URL;?>js/style.js"></script>
                <script src="<?=URL;?>js/global_full.js"></script>
            </footer>
        </div>
    </body>
</html>