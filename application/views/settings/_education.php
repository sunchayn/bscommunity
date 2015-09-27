<div class="col-m col-12 field-label delete-wrapper">
    <div class="col-m col-9">
        <h5><?=$education->department . ' (' . $education->title . ')'?></h5>
        <small><?=language::invokeOutput('from'). ' ' .$education->years[0]. ' ' .language::invokeOutput('from'). ' ' .$education->years[1];?></small>
        <br>
        <?php
        if (isset($education->website))
            echo "<small><a href='{$education->website}'>". language::invokeOutput('isset-website') ."</a></small>";
        else
            echo "<small>". language::invokeOutput('missing-website') ."</small>";
        ?>
    </div>
    <div class="col-m col-3 a-right">
       <?="<a class='ajaxQuickDeleteEdTitle' data-content='key={$key}&token={$global["token"]}' href='#deleteReply'>". Language::invokeOutput('remove-label') ."</a>";?>
    </div>
</div>