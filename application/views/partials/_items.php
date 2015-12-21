<!-- one item -->
<div class="col-m col-6 item v-top center-sm">
    <div class="v-col">
        <div class="item-picture">
            <img src="<?=$item->item_icon;?>" alt="item_icon" height="120" width="120">
        </div>
    </div>
    <div class="v-col col-8 scale-sm item-info">
        <h2 class="inline-b middle"><?=$item->$data['item-title'];?></h2>
        ( <a href="#buy-item" data-content="id=<?=$item->id;?>&token=<?=$global["token"];?>" class="buy-item"><?=Language::invokeOutput('buy-item');?></a> )
        <br />
        <p><?=$item->$data['item-desc'];?></p>
        <span><?=$item->cost. ' ' .Language::invokeOutput('frequent/gold');?></span><br>
        <small class="item-field-label"><?=Language::invokeOutput('labels/label'.$item->item_cat);?></small>
    </div>
</div>
<!-- end - one item -->