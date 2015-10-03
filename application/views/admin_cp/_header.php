<!-- bloostone community V1 beta !-->
<!DOCTYPE html>
<html>
<head>
    <title><?=isset_get($data, 'title') ." - ". isset_get($global, 'site_name');?></title>
    <base href="<?=Application::$prefix;?>">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <link rel="icon" type="image/png" href="<?=isset_get($global, 'favicon_url');?>" />
    <?php
    if (LANGUAGE_CODE == 'ar')
        echo '<link rel="stylesheet" href="'.URL.'css/admin_cp_ar.css" media="screen" />';
    else
        echo '<link rel="stylesheet" href="'.URL.'css/admin_cp.css" media="screen" />';
    ?>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<!-- # Wrapper # -->
<div class="wrapper">
    <!-- header -->
    <header>
        <div class="nav-bar grid-section">
            <div class="overlay"></div>
            <div class="scroll-up hide-sm">
                <i class="icon-angle-up"></i>
            </div>
            <div class="scroll-up-res">
                <i class="icon-angle-up"></i>
            </div>
            <div class="confirm-modal" id="create-link">
                <div class="cf-modal-content"></div>
                <div class="modal-buttons grid-section">
                    <a href="#confirm" class="c-confirm"><?=language::invokeOutput('frequent/confirm');?></a>
                    <a href="#cancel" class="c-cancel"><?=language::invokeOutput('frequent/cancel');?></a>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="result-modal">
            </div>
            <div class="sub-wrapper">
                <div class="col-m col-12">
                    <div class="col-m col-2 page-title">
                        <h3><?=Language::invokeOutput('heading');?></h3>
                    </div>
                    <div class="col-m col-10 pure-nav no-margin">
							<span class="col-12">
								<nav>
									<span>
										<?=Language::invokeOutput('welcome');?>
										<h3 class="inline-b">
                                            <a href="profile/<?=$global['logged']->id;?>"><?=$global['logged']->username;?></a>
                                        </h3>
									</span>
                                    <?php
                                    if ($global['inboxCount'] <= 0)
                                    {
                                        ?>
                                        <span>
										    <a href="#" class="icon-mail dropdown-trigger" data-id="empty-inbox"></a>
									    </span>
                                    <?php } else { ?>
                                        <div class="label label-with-icon rad2 middle bg-color-5">
                                            <a href="#" data-id="inbox-menu" class="icon-mail-alt dropdown-trigger"></a>
                                            <span><?=$global['inboxCount'];?></span>
                                        </div>
                                        <ul id="inbox-menu" class="dropdown-menu max-width light-hover separate-menu">
                                            <?php //inbox
                                            foreach($global['logged']->inbox as $inbox)
                                            {
                                                ?>
                                                <a class="menu-element" href="message/<?=$inbox->id;?>">
                                                    <h4><?=$inbox->title.'-'.$inbox->username;?></h4>
                                                    <p><?=$inbox->content;?></p>
                                                    <small><?=$inbox->date;?></small>
                                                </a>
                                            <?php } ?>
                                            <a class="menu-element menu-all" href="inbox"><?=Language::invokeOutput('messages/more');?></a>
                                        </ul>
                                    <?php } //notifications
                                    if ($global['notificationsCount'] <= 0)
                                    {
                                        ?>
                                        <span>
                                            <a href="#" data-id="empty-notify" class="icon-bell dropdown-trigger"></a>
                                        </span>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="label label-with-icon rad2 middle bg-color-5">
                                            <a href="#notification" data-id="notify-menu" class="icon-bell-alt dropdown-trigger notifications"></a>
                                            <span><?=$global['notificationsCount'];?></span>
                                        </div>
                                    <?php } ?>
                                    <ul id="empty-notify" class="dropdown-menu plain-html">
                                        <p><?=Language::invokeOutput('notification/no-notify');?></p>
                                    </ul>
                                    <ul id="empty-inbox" class="dropdown-menu plain-html">
                                        <?=Language::invokeOutput('messages/no-msg');?></p>
                                    </ul>
									<span class="f-right">
										<a href="<?=URL;?>logout" class="icon-off">&nbsp;<?=Language::invokeOutput('logout')?></a>
									</span>
                                </nav>
							</span>
                    </div>
                    <ul id="notify-menu" class="dropdown-menu max-width light-hover separate-menu">
                        <li class="menu-heading">
                            <?=Language::invokeOutput('notification/center');?>
                            <span class="f-right"><a href="settings/notifications"><?=Language::invokeOutput('frequent/settings');?></a></span>
                            <div class="clear"></div>
                        </li>
                        <?php
                        foreach($global['logged']->notifications as $notify)
                        {
                            ?>
                            <a class="menu-element" href="<?=$notify['url'];?>">
                                <?=$notify['content'];?>
                            </a>
                        <?php } //end foreach ?>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- end header -->