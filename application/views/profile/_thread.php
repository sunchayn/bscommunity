<div class="col-m col-12 thread v-middle">
    <div class="v-col col-6">
        <div class="col-12">
            <h2 class="inline-b middle thread-title">
                <a href="thread/<?=isset_get($thread, 'id');?>"><?=$thread->title;?></a>
            </h2>
        </div>
        <div class="col-12">
            <span><?=language::invokeOutput('frequent/views').' '.isset_get($thread, 'views');?></span> - <span><?=language::invokeOutput('frequent/replies').' '.isset_get($thread, 'replies');?></span>
        </div>
    </div>
    <div class="col-2 v-col"><?=isset_get($thread, 'create');?></div>
    <div class="col-4 v-col">
        <a href="forum/<?= isset_get($thread, 'fi');?>"><?=isset_get($thread, 'ft');?></a>
    </div>
</div>
