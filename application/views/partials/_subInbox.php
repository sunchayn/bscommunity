<div class="col-m col-12 sub-message">
    <div class="col-m col-12 v-top">
        <div class="v-col a-center">
            <a href="profile/<?=$message->uID;?>" data-tooltip="<?=$message->username;?>" class="tool-tip"><img src="<?=$message->profile_picture?>" alt="sender-picture" height="35" width="35" class="img-circel middle" /></a>
        </div>
        <div class="v-col sub-content"><?=$message->content;?></div>
    </div>
    <div class="col-m col-12">
        <small><?=Language::invokeOutput('date') .' '. $message->date;?></small>
    </div>
</div>