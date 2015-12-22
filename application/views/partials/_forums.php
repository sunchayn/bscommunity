<!-- # one forum # -->
<div class="col-m col-12 v-middle o-forum">
    <div class="col-8 v-col v-middle">
        <div class="v-col center-sm">
            <img src="<?=$forum->logo;?>" alt="forum icon" height="75" width="75">
        </div>
        <div class="v-col">
            <h2><a href="forum/<?=$forum->id;?>"><?=$forum->title;?></a></h2>
            <p><?=$forum->desc;?></p>
        </div>
    </div>
    <div class="col-1 v-col hide-sm"><?=$forum->threads;?></div>
    <div class="col-1 v-col hide-sm"><?=$forum->replies;?></div>
    <div class="col-2 v-col hide-sm">
        <a href="create/thread/<?=$forum->id;?>"><?=Language::invokeOutput('add-thread');?></a>
    </div>
    <div class="col-m col-12 show-sm small-counters">
        <?=$forum->replies;?> <i class="icon-comment"></i> -
        <?=$forum->replies;?> <i class="icon-doc-text"></i>
    </div>
</div>
<!-- # end - one forum # -->