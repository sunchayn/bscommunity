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
    ?>
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<!-- # Wrapper # -->
<div class="wrapper">
    <div class="overlay"></div>
    <div class="scroll-up hide-sm"><i class="icon-up-dir"></i></div>
    <div class="scroll-up-res"><i class="icon-up-dir"></i></div>
    <div class="box-page">
        <div class="central-box login-page v-middle grid-section">
            <div class="col-m col-12 a-center"><img src="<?=$global['logo_url'];?>" alt="site_logo" class="x-100"></div>
            <form action="ajax/login" method="POST" class="ajax noScroll col-m col-12">
                <div class="ajax-loader"></div>
                <div class="col-m col-12 login-label">
                    <div class="col-m col-12 box">
                        <h4><?=Language::invokeOutput('login/identifier');?></h4>
                        <small><?=Language::invokeOutput('login/identifier-desc');?></small>
                    </div>
                    <div class="col-m col-12">
                        <input type="text" id="username" name="username" placeholder="<?=Language::invokeOutput('login/identifier');?>" class="rad2 col-12" tabindex="1"/>
                    </div>
                </div>
                <div class="col-m col-12 login-label">
                    <div class="col-m col-12 box">
                        <h4 class="inline-b"><?=Language::invokeOutput('login/password');?></h4>&nbps;
                        (
                        <input type="checkbox" id="remember2" name="remember" class="anchorCheckBox" />
                        <label for="remember2" class="anchorCheckLabel anchorCheck"><?=Language::invokeOutput('login/remember');?></label>
                        )
                        <br />
                        <small><?=Language::invokeOutput('login/password-desc');?></small>
                    </div>
                    <div class="col-m col-12">
                        <input type="password" id="password" name="password" placeholder="<?=Language::invokeOutput('login/password');?>" class="rad2 anchorCheckBox col-12" tabindex="2" />
                    </div>
                </div>
                <div class="col-m col-12 login-label">
                    <a href="#" class="formSubmit"><?=Language::invokeOutput('login/button');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                    <input type="hidden" name="token" value="<?=$global['token'];?>" />
                </div>
            </form>
        </div>
    </div>
    <footer>
        <script src="<?=URL?>js/min/basic.js"></script>
        <script>
            //form submitter
            $('.formSubmit').on("click",function(e){
                e.preventDefault();
                $(this).closest('form').submit();
            });
            //
            $('form.ajax').ajaxSubmit();
        </script>
    </footer>
</div>
</body>
</html>
