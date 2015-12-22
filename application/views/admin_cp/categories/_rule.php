<div class="col-m col-12 one-rule">
    <div class="col-m col-12 field-label">
        <div class="col-m col-7">
            <h3><?=$rule->$data['heading'];?></h3>
            <p><?=$rule->$data['desc'];?></p>
        </div>
        <div class="col-m col-5 a-right">
            <a href="admin_cp/categories?section=editRule&id=<?=$rule->id;?>"><?=Language::invokeOutput('edit-label');?></a> -
            <a href="#delete-rule" class="delete-rule" data-content="id=<?=$rule->id;?>&token=<?=$global['token'];?>"><?=Language::invokeOutput('frequent/delete');?></a>
        </div>
    </div>
    <div class="col-m col-12 split"></div>
</div>
