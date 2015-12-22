<!DOCTYPE html>
<html lang="<?=LANGUAGE_CODE;?>"
      xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <title><?=isset_get($data, 'title') ." - ". isset_get($global, 'site_name');?></title>
    <base href="<?=Application::$prefix;?>">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?=isset_get($global, 'site_desc', '');?>" />
    <meta name="keywords" content="<?=isset_get($global, 'site_keywords', '');?>" />
    <meta property="og:image" content="<?=isset_get($global, 'logo_url');?>" />
    <link rel="icon" type="image/png" href="<?=isset_get($global, 'favicon_url');?>" />
    <?php
    if (LANGUAGE_CODE == 'ar')
        echo '<link rel="stylesheet" href="'.URL.'css/global_ar.css" media="screen" />';
    else
        echo '<link rel="stylesheet" href="'.URL.'css/global.css" media="screen" />';
    ?>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <style></style>
</head>
<body>
<!-- # Wrapper # -->
<div class="wrapper">
    <header>
        <div class="grid-section">
            <?php
                if (usersAPI::isLogged())
                {
                    //load logged users navbar sub view
                    require_once 'partials/_membersNav.php';
                }else{
                    //load visitors navbar sub view
                    require_once 'partials/_visitorsNav.php';
                }
            ?>
        <div class="wide-zone grid-section">
            <div class="sub-wrapper">
                <div class="col-m col-12"><h1 id="title"><?=isset_get($data, 'page-title');?></h1></div>
            </div>
        </div>
    </header>