<!-- # one thread # -->
<div class="col-m col-12 thread v-middle">
    <div class="col-6 v-col">
        <div class="col-12">
            <h2 class="inline-b middle thread-title">
                <a href="thread/<?=isset_get($thread, 'id');?>"><?=isset_get($thread, 'title');?></a>
            </h2>
        </div>
        <div class="col-12">
            <span><?=Language::invokeOutput('by');?> <a href="profile/<?=isset_get($thread->author, 'id');?>"><?=isset_get($thread->author, 'username');?></a></span>
        </div>
    </div>
    <div class="col-1 v-col hide-sm"><?=isset_get($thread, 'replies');?></div>
    <div class="col-1 v-col hide-sm"><?=isset_get($thread, 'views');?></div>
    <div class="col-2 v-col"><?=isset_get($thread, 'create');?></div>
    <div class="col-2 v-col hide-sm">
        <a href="create/reply/<?=isset_get($thread, 'id');?>"><?=Language::invokeOutput('op/reply');?></a>
        <?php
        if (accessAPI::getInstance()->checkAccessToPin())
            echo ' - <a href="#pin" class="reloadAJAX" data-url="ajax/pinThread" data-content="id='.$thread->id.'&token='.$global['token'].'">'. Language::invokeOutput('op/pin') .'</a>';
        ?>
    </div>
    <div class="show-sm small-counters">
        <?=$thread->replies;?> <i class="icon-comment"></i> -
        <?=$thread->views;?> <i class="icon-camera"></i> -
        <a href="addReply/<?=isset_get($thread, 'id');?>"><?=Language::invokeOutput('operation/reply');?></a>
    </div>
</div>
<!-- # end - one thread # -->