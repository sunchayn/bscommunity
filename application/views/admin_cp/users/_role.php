<!-- one role -->
<div class="col-m col-12 v-middle one-row">
    <div class="col-1 v-col"><?=$role->id;?></div>
    <div class="col-2 v-col"><?=$role->$data['role_name'];?></div>
    <div class="col-6 v-col"><?=accessAPI::explainAccess($role->access_json);?></div>
    <div class="col-3 v-col">
        <?php
        if ((in_array($role->id, [1,2,3])))
        {
            ?>
            <a href="#" class="disabled"><?=language::invokeOutput('edit-label');?></a> -
            <a href="#" class="disabled"><?=language::invokeOutput('frequent/delete');?></a>
        <?php
        }else{
            ?>
                <a href="admin_cp/users?section=editRole&id=<?=$role->id;?>"><?=Language::invokeOutput('edit-label');?></a> -
                <a href="#delete-role" class="delete-role" data-content="id=<?=$role->id;?>&token=<?=$global['token'];?>"><?=language::invokeOutput('frequent/delete');?></a>
        <?php } ?>

    </div>
</div>
<!-- end - one role -->