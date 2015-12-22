<!-- one category -->
<div class="col-m col-12 cat-modal">
    <div class="col-m col-12">
        <h2 class='inline-b middle'><a href="forum/<?=$forum->id;?>"><?=$forum->$data['Ftitle'];?></a></h2>
    </div>
    <div class="col-m col-12">
        <p><?=$forum->$data['Fdesc'];?></p>
    </div>
    <div class="col-m col-12 options">
        <a href="#delete-forum" class="delete-forum" data-content="id=<?=$forum->id;?>&token=<?=$global['token'];?>"><?=language::invokeOutput('frequent/delete');?></a> -
        <a href="admin_cp/categories?section=editForum&id=<?=$forum->id;?>"><?=language::invokeOutput('edit-label');?></a> -
        <?php
        if ($forum->status == 0)
            echo '<a href="#open-forum" class="normalAJAX" data-url="ajax/openForum" data-content="id='.$forum->id.'&token='.$global['token'].'">'.language::invokeOutput('frequent/open').'</a>';
        else
            echo '<a href="#close-forum" class="normalAJAX" data-url="ajax/closeForum" data-content="id='.$forum->id.'&token='.$global['token'].'">'.language::invokeOutput('close-label').'</a>';
        ?>
    </div>
</div>
<!-- end - one forum / category -->