<!-- feed modal -->
<div class="col-m col-12 v-middle feed-modal center-sm">
    <div class="v-col">
        <img src="<?=$following->profile_picture;?>" alt="user-picture" class="img-circel img-edge x-75" />
    </div>
    <div class="v-col">
        <h3><a href="thread/<?=$following->TID;?>"><?=$following->title;?></a></h3>
        <small><?=Language::invokeOutput('frequent/by');?> </small>
        <a href="profile/<?=$following->following_id;?>"><?=$following->username;?></a><small> ( <?=Language::invokeOutput('frequent/level') .' '. $following->level;?> )</small>
        <br>
        <small><?=Language::invokeOutput('frequent/posted').' '.$following->create;?></small>
    </div>
</div>
<!-- end - feed modal -->