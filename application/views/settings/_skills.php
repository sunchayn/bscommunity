<div class="col-m col-12 field-label delete-wrapper v-middle">
    <div class="v-col col-4">
        <h5><?=$skill->label;?></h5>
        <?php
        if (isset($skill->certification))
            echo "<small><a href='{$skill->certification}'>". Language::invokeOutput('isset-certification') ."</a></small>";
        else
            echo "<small>". Language::invokeOutput('missing-certification') ."</small>";
        ?>
    </div>
    <div class="v-col col-5">
        <div class="col-12 bar">
            <div style="width: <?=$skill->master;?>%;"></div>
        </div>
    </div>
    <div class="v-col col-1 middle">
        <?=$skill->master;?>%
    </div>
    <div class="v-col col-2 a-right">
        <?="<a class='ajaxQuickDeleteSkill' data-content='key={$key}&token={$global["token"]}' href='#deleteSkill'>". Language::invokeOutput('remove-label') ."</a>";?>
    </div>
</div>