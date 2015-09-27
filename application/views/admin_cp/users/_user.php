<!-- #### -->
<!-- one user -->
<div class="col-m col-12 v-middle one-row">
    <div class="col-1 v-col"><?=$user->id;?></div>
    <div class="col-2 v-col"><a href="profile/<?=$user->id;?>"><?=$user->username;?></a></div>
    <div class="col-2 v-col"><?=$user->role;?></div>
    <div class="col-1 v-col"><?=$user->posts;?></div>
    <div class="col-3 v-col"><?=$user->create_date;?></div>
    <div class="col-3 v-col">
        <a href="#delete-user" class="delete-user" data-content="id=<?=$user->id;?>&token=<?=$global['token'];?>"><?=language::invokeOutput('frequent/delete');?></a> -
        <a href="#change-role" class="change-role triggerPanel" data-panel="change-role" data-content="id=<?=$user->id;?>&token=<?=$global['token'];?>"><?=language::invokeOutput('change-role');?></a> -
        <?php
        if ($user->status == 0)
            echo '<a href="#open-user" class="normalAJAX" data-url="ajax/openUser" data-content="id='.$user->id.'&token='.$global['token'].'">'.language::invokeOutput('frequent/open').'</a>';
        else
            echo '<a href="#close-user" class="normalAJAX" data-url="ajax/closeUser" data-content="id='.$user->id.'&token='.$global['token'].'">'.language::invokeOutput('close-label').'</a>';
        ?>
    </div>
</div>
<!-- end - one user -->
<!-- #### -->