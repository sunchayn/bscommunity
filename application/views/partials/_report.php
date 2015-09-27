<a href="report/view/<?=$report->id;?>" class="col-m col-12 report <?=(reportAPI::getInstance()->isSeen($report->reported, $report->type)) ? 'unseen' : '';?>">
    <div class="col-m col-1">#<?=$report->id;?></div>
    <div class="col-m col-7">
        <?php
        if ($report->type == 0)
            echo '<span class="color-5">['. Language::invokeOutput('thread') .']</span> '. $report->TT;
        else
            echo '<span class="color-5">['. Language::invokeOutput('reply') .']</span> '. $report->title;
        ?>
    </div>
    <div class="col-m col-1"><?=$report->nor;?></div>
    <div class="col-m col-2"><?=$report->date;?></div>
    <div class="col-m col-1"><?=$report->global_seen;?></div>
</a>