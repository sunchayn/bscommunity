<!-- search modal -->
<div class="col-m col-12 v-middle search-modal">
    <div class="v-col">
        <img src="<?=$result->profile_picture;?>" alt="user-picture" class="img-circel img-edge x-75 v-col" />
    </div>
    <div class="v-col">
        <h3><a href="thread/<?=$result->TID;?>"><?=$result->title;?></a></h3>
        <small><?=Language::invokeOutput('frequent/by');?> </small>
        <a href="profile/<?=$result->UID;?>"><?=$result->username;?></a><small> ( <?=Language::invokeOutput('frequent/level') .' '. $result->level;?> )</small>
    </div>
</div>
<!-- end - search modal -->