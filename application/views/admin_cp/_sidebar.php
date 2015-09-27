<!-- start menu -->
<div class="col-m col-2 cp-menu no-margin">
    <span>
        <img src="<?=URL;?>img/logo.png" alt="logo" class="x-50">
    </span>
    <nav>
        <a href="admin_cp" <?=isset_get($data['checked'], 'general', '');?>>
            <i class="icon-home"></i><br /><?=Language::invokeOutput('sidebar/general');?>
        </a>
        <div class="sub-menu">
            <a href="#" <?=isset_get($data['checked'], 'settings', '');?>>
                <i class="icon-cog-1"></i> <br />
                <span class="middle"><?=Language::invokeOutput('sidebar/settings/heading');?></span>
                <i class="icon-angle-down toggle"></i>
            </a>
            <nav>
                <a href="admin_cp/settings" <?=isset_get($data['sub-checked'], 'general', '');?>><?=Language::invokeOutput('sidebar/settings/general');?></a>
                <a href="admin_cp/settings?section=variables" <?=isset_get($data['sub-checked'], 'variables', '');?>><?=Language::invokeOutput('sidebar/settings/variables');?></a>
                <a href="admin_cp/settings?section=filter" <?=isset_get($data['sub-checked'], 'filter', '');?>><?=Language::invokeOutput('sidebar/settings/filter');?></a>
            </nav>
        </div>
        <div class="sub-menu">
            <a href="#" <?=isset_get($data['checked'], 'categories', '');?>>
                <i class="icon-th"></i> <br />
                <span class="middle"><?=Language::invokeOutput('sidebar/categories/heading');?></span>
                <i class="icon-angle-down toggle"></i>
            </a>
            <nav>
                <a href="admin_cp/categories" <?=isset_get($data['sub-checked'], 'categories', '');?>><?=Language::invokeOutput('sidebar/categories/categories');?></a>
                <a href="admin_cp/categories?section=forums" <?=isset_get($data['sub-checked'], 'forums', '');?>><?=Language::invokeOutput('sidebar/categories/forums');?></a>
                <a href="admin_cp/categories?section=rules" <?=isset_get($data['sub-checked'], 'rules', '');?>><?=Language::invokeOutput('sidebar/categories/forums-rules');?></a>
            </nav>
        </div>
        <div class="sub-menu">
            <a href="#" <?=isset_get($data['checked'], 'users', '');?>>
                <i class="icon-users"></i> <br />
                <span class="middle"><?=Language::invokeOutput('sidebar/users/heading');?></span>
                <i class="icon-angle-down toggle"></i>
            </a>
            <nav>
                <a href="admin_cp/users" <?=isset_get($data['sub-checked'], 'users', '');?>><?=Language::invokeOutput('sidebar/users/users');?></a>
                <a href="admin_cp/users?section=roles" <?=isset_get($data['sub-checked'], 'roles', '');?>><?=Language::invokeOutput('sidebar/users/roles');?></a>
                <a href="admin_cp/users?section=username" <?=isset_get($data['sub-checked'], 'username', '');?>><?=Language::invokeOutput('sidebar/users/username');?></a>
            </nav>
        </div>
        <a href="admin_cp/support" <?='class="'. ((supportAPI::getInstance()->issetUnread()) ? 'new-msg ' : '') . isset_get($data['checked'], 'support', '') . '"';?>>
            <i class="icon-help"></i> <br />
            <?=Language::invokeOutput('sidebar/support');?>
        </a>
        <a href="admin_cp/seo" <?=isset_get($data['checked'], 'seo', '');?>>
            <i class="icon-minus"></i> <br />
            <?=Language::invokeOutput('sidebar/seo');?>
        </a>
        <a href="admin_cp/about" <?=isset_get($data['checked'], 'about', '');?>>
            <i class="icon-code"></i> <br />
            <?=Language::invokeOutput('sidebar/about');?>
        </a>
    </nav>
</div>
<!-- end menu -->