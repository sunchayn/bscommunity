<!-- one category -->
<div class="col-m col-12 cat-modal">
    <div class="col-m col-12">
        <h2 class='inline-b middle'><a href="category/<?=$cat->id;?>"><?=$cat->title;?></a></h2><small> (order : <?=$cat->order;?>) </small>
    </div>
    <div class="col-m col-12">
        <p><?=$cat->desc;?></p>
    </div>
    <div class="col-m col-12 options">
        <a href="#delete-category" class="delete-category" data-content="id=<?=$cat->id;?>&token=<?=$global['token'];?>"><?=language::invokeOutput('frequent/delete');?></a> -
        <a href="#edit-category" class="edit-category triggerPanel"  data-panel="edit-category" data-content="id=<?=$cat->id;?>&token=<?=$global['token'];?>"><?=language::invokeOutput('edit-label');?></a> -
        <?php
        if ($cat->status == 0)
            echo '<a href="#open-category" class="normalAJAX" data-url="ajax/openCategory" data-content="id='.$cat->id.'&token='.$global['token'].'">'.language::invokeOutput('frequent/open').'</a>';
        else
            echo '<a href="#close-category" class="normalAJAX" data-url="ajax/closeCategory" data-content="id='.$cat->id.'&token='.$global['token'].'">'.language::invokeOutput('close-label').'</a>';
        ?>
    </div>
</div>
<!-- end - one forum / category -->