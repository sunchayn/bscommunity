<!-- one member -->
<div class="col-m col-4 v-middle member-modal">
    <div class="col-12 v-col v-middle">
        <img src="<?=$user->profile_picture;?>" alt="user-picture" class="img-circel img-edge v-col" height="75" width="75" />
        <div class="v-col">
            <h2><a href="profile/<?=$user->id;?>"><?=$user->username;?></a></h2>
            <small><?=Language::invokeOutput('frequent/level'). ' ' .$user->level;?></small>
            <small><?=Language::invokeOutput('frequent/posts'). ' ' .$user->posts;?></small>
            <?php
                if (!is_null($user->country))
                    echo '<span class="label bg-color-5 rad2">' . $user->country . '</span>';
                else
                    echo '<span class="label disabled rad2">' . Language::invokeOutput('frequent/unset') . '</span>';
            ?>
        </div>
    </div>
</div>
<!-- end - one member -->