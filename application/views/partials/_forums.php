<!-- # one forum # -->
<div class="col-m col-12 v-middle o-forum">
    <div class="col-8 v-col v-middle">
        <div class="v-col center-sm">
            <img src="<?=$forum->logo;?>" alt="forum icon" class="x-75">
        </div>
        <div class="v-col center-sm">
            <h3><a href="forum/<?=$forum->id;?>"><?=$forum->$global['curr_title'];?></a></h3>
            <p><?=$forum->$global['curr_desc'];?></p>
        </div>
    </div>
    <div class="col-1 v-col hide-sm"><?=$forum->threads;?></div>
    <div class="col-1 v-col hide-sm"><?=$forum->replies;?></div>
    <div class="col-2 v-col hide-sm">
        <a href="create/thread/<?=$forum->id;?>"><?=Language::invokeOutput('add-thread');?></a>
    </div>
    <div class="col-m col-12 show-sm small-counters center-sm">
        <?=$forum->threads;?> <i class="icon-doc-text"></i> - 
        <?=$forum->replies;?> <i class="icon-comment"></i>
    </div>
</div>
<!-- # end - one forum # -->
