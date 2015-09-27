<div class="col-m col-12 profile-header">
    <img src="<?=isset_get($data['user'], 'profile_picture', 'unset');?>" alt="profile-picture" height="250" width="250" class="img-circel online">
</div>
<div class="col-m col-12 profile-menu">
    <nav class="profile-menu-res">
        <a href="profile/<?=$data['user']->id;?>" <?=isset_get($data['selected'], 'general', '');?>>
            <?=Language::invokeOutput('Pmenu/general');?>
        </a><span> / </span>
        <a href="profile/threads/<?=$data['user']->id;?>" <?=isset_get($data['selected'], 'threads', '');?>>
            <?=Language::invokeOutput('Pmenu/threads');?>
        </a><span> / </span>
        <a href="profile/statistic/<?=$data['user']->id;?>" <?=isset_get($data['selected'], 'statistic', '');?>>
            <?=Language::invokeOutput('Pmenu/static');?>
        </a><span> / </span>
        <a href="profile/about/<?=$data['user']->id;?>" <?=isset_get($data['selected'], 'about', '');?>>
            <?=Language::invokeOutput('Pmenu/about');?>
        </a>
    </nav>
</div>
<div class="col-m col-12 box a-center">
    <small>
        <a href="create/message/<?=$data['user']->id;?>"><?=Language::invokeOutput('links/pm');?></a> -
        <?php
            if (!followAPI::getInstance()->isFollowingWithCheck($data['user']->id))
                echo '<a href="#follow" id="followUser" class="followUnfollow" data-content="following_id='. $data['user']->id .'&token='. $global['token'] .'" data-trigger="'.Language::invokeOutput('links/unfollow').'">'.Language::invokeOutput('links/follow').'</a> -';
            else
                echo '<a href="#follow" id="unfollowUser" class="followUnfollow" data-content="following_id='. $data['user']->id .'&token='. $global['token'] .'" data-trigger="'.Language::invokeOutput('links/follow').'">'.Language::invokeOutput('links/unfollow').'</a> -';
        ?>
        <a href="#disabled" class="disabled"><?=Language::invokeOutput('links/report');?></a>
    </small>
</div>