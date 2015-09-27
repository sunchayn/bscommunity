<div class="top-nav hide-sm">
    <div class="sub-wrapper input-to-toggle-wrapper">
        <div class="col-m col-12 input-to-toggle">
            <form action="search" action="GET">
                <input type="text" name="q" placeholder="<?=Language::invokeOutput('input-placeholder/search');?>">
            </form>
            <a class="icon-cancel toggle-back"></a>
        </div>
        <div class="col-m col-12">
            <span class="middle menu col-7">
                <img src="<?=$global['logo_url'];?>" alt="logo" height="50" width="50" class="middle">
                <nav>
                    <a href="home" <?=isset_get($data, 'menu-home', '');?>><?=Language::invokeOutput('menu/home');?></a>
                    <a href="members" <?=isset_get($data, 'menu-members', '');?>><?=Language::invokeOutput('menu/members');?></a>
                    <a href="FAQ" <?=isset_get($data, 'menu-FAQ', '');?>><?=Language::invokeOutput('menu/FAQ');?></a>
                    <a href="store" <?=isset_get($data, 'menu-store', '');?>><?=Language::invokeOutput('menu/store');?></a>
                </nav>
            </span>
            <span class="col-5 second-panel a-right">
                <nav>
                    <a href="#" class="toggle-input"><?=Language::invokeOutput('menu/search');?></a>
                    <a href="login" class="triggerPanel" data-panel="loginPanel"><?=Language::invokeOutput('menu/login');?></a>
                    <a href="join" <?=isset_get($data, 'menu-join', '');?>><?=Language::invokeOutput('menu/join');?></a>
                </nav>
            </span>
        </div>
    </div>
</div>
<!-- responsive purpose - will be displayed when screen is small -->
<div class="col-m col-12 show-sm res-nav">
    <div class="col-m col-12 a-center box">
        <img src="<?=$global['logo_url'];?>" alt="logo" height="50" width="50" class="middle">
    </div>
    <div class="field-with-icon rad2">
        <form action="search" method="GET" class="clearfix">
            <span class="icon"><a href="" class="icon-search"></a></span>
            <span class="field"><input type="text" name="q" placeholder="<?=Language::invokeOutput('input-placeholder/search');?>"></span>
        </form>
    </div>
    <div class="col-m col-12 a-center box">
        <a href="join" <?=isset_get($data, 'menu-join', '');?>><?=Language::invokeOutput('menu/join');?></a> - <a href="#" class="trigger-sm-login"><?=Language::invokeOutput('menu/login');?></a>
    </div>
    <nav class="col-m col-12 res-menu">
        <a href="home" class="icon-home"></a>
        <a href="members" class="icon-user"></a>
        <a href="faq" class="icon-help"></a>
        <a href="store" class="icon-lock"></a>
    </nav>
</div>
<!-- end responsive nav -->
</div>
<!-- end navbar -->
<div class="grid-section">
    <div class="col-m col-12 resp-login show-sm">
        <form action="ajax/login" method="POST" class="ajax">
            <div class="col-m col-12 ajax-loader"></div>
            <div class="col-m col-12 login-label">
                <div class="col-m col-12 box">
                    <h4><?=Language::invokeOutput('login/identifier');?></h4>
                    <small><?=Language::invokeOutput('login/identifier-desc');?></small>
                </div>
                <div class="col-m col-12">
                    <input type="text" id="username" name="username" placeholder="<?=Language::invokeOutput('login/identifier');?>" class="rad2" tabindex="1"/>
                </div>
            </div>
            <div class="col-m col-12 login-label">
                <div class="col-m col-12 box">
                    <h4 class="inline-b"><?=Language::invokeOutput('login/password');?></h4> (
                    <input type="checkbox" id="remember" name="remember" class="anchorCheckBox" />
                    <label for="remember" class="anchorCheckLabel anchorCheck"><?=Language::invokeOutput('login/remember');?></label>
                    )
                    <br />
                    <small><?=Language::invokeOutput('login/password-desc');?></small>
                </div>
                <div class="col-m col-12">
                    <input type="password" id="password" name="password" placeholder="<?=Language::invokeOutput('login/password');?>" class="rad2 anchorCheckBox" tabindex="2" />
                </div>
            </div>
            <div class="col-m col-12 login-label">
                <input type="submit" class="btn btn-color7 rad" value="<?=Language::invokeOutput('login/button');?>">
                <input type="hidden" name="token" value="<?=$global['token'];?>" />
            </div>
        </form>
    </div>
</div>
<div class="overlay hide-sm"></div>
<div class="panel hide-sm" id="loginPanel">
    <div class="panel-head">
        <a href="#" class="icon-cancel cancel f-right"></a>
    </div>
    <div class="panel-content grid-section">
        <div class="col-m col-12">
            <h2 class="content-heading">
                <?=Language::invokeOutput('login/header');?>
            </h2>
            <p class="section-desc">
                <?=Language::invokeOutput('login/desc');?>
            </p>
        </div>
        <form action="ajax/login" method="POST" class="ajax noScroll">
            <div class="col-m col-12 ajax-loader"></div>
            <div class="col-m col-12 login-label">
                <div class="col-m col-12 box">
                    <h4><?=Language::invokeOutput('login/identifier');?></h4>
                    <small>
                        <?=Language::invokeOutput('login/identifier-desc');?>
                    </small>
                </div>
                <div class="col-m col-12">
                    <input type="text" id="username" name="username" placeholder="<?=Language::invokeOutput('login/identifier');?>" class="rad2" tabindex="1"/>
                </div>
            </div>
            <div class="col-m col-12 login-label">
                <div class="col-m col-12 box">
                    <h4 class="inline-b"><?=Language::invokeOutput('login/password');?></h4> (
                    <input type="checkbox" id="remember2" name="remember" class="anchorCheckBox" />
                    <label for="remember2" class="anchorCheckLabel anchorCheck"><?=Language::invokeOutput('login/remember');?></label>
                    )
                    <br />
                    <small>
                        <?=Language::invokeOutput('login/password-desc');?>
                    </small>
                </div>
                <div class="col-m col-12">
                    <input type="password" id="password" name="password" placeholder="<?=Language::invokeOutput('login/password');?>" class="rad2 anchorCheckBox" tabindex="2" />
                </div>
            </div>
            <div class="col-m col-12 login-label">
                <a href="#" class="formSubmit"><?=Language::invokeOutput('login/button');?></a>&nbsp;<i class="icon-<?=DIRECTION;?>"></i>
                <input type="hidden" name="token" value="<?=$global['token'];?>" />
            </div>
        </form>
    </div>
    <div class="panel-footer">
        <nav>
            <a href="FAQ"><?=Language::invokeOutput('footer/help-menu/FAQ');?></a> -
            <a href="support"><?=Language::invokeOutput('footer/help-menu/help');?></a> -
            <a href="term"><?=Language::invokeOutput('footer/help-menu/term');?></a>
        </nav>
    </div>
</div>