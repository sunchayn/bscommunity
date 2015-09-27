<!-- # forum area # -->
<div class="page reply-page">
    <div class="sub-wrapper area">
        <div class="grid-section">
            <div class="col-m col-12">
                <div class="col-m col-12 hint">
                    <a href="thread/<?=$data['reply']->thread_id;?>"><?=Language::invokeOutput('hint');?></a>
                </div>
                <div class="col-m col-12 box the-reply">
                    <div class="col-m col-12 v-middle">
                        <div class="v-col"><img src="<?=$data['reply']->profile_picture;?>" alt="profile_picture" class="x-50 img-circel"></div>
                        <div class="v-col">
                            <h2><a href="profile/<?=$data['reply']->author_id;?>"><?=$data['reply']->username;?></a></h2>
                            <small><?=Language::invokeOutput('frequent/level').' '.$data['reply']->level;?></small>
                        </div>
                    </div>
                    <p class="col-m col-12"><?=$data['reply']->content;?></p>
                </div>
            </div>
        </div>
    </div><!-- # end sub-wrapper # -->
</div>
<!-- # end forum area # -->