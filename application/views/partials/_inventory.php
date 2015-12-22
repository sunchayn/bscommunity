<div class="col-m col-12 inventory-case">
    <div class="case-img inline-b top hide-sm">
       <img src="<?=$inventory->item_icon;?>" alt="item_picture" height="100" width="100">
    </div>
    <div class="case-desc inline-b">
        <h2><?=$inventory->$data['item-title'];?></h2>
        <p><?=$inventory->$data['item-desc'];?></p>
        <a href="#consume-item" data-content="id=<?=$inventory->item_id;?>&token=<?=$global["token"];?>" class="gift-item consume-item"><?=Language::invokeOutput('consume');?></a><br>
        <small>
            <?=Language::invokeOutput('amount').' '.$inventory->amount.'.';?>
        </small>
    </div>
</div>
