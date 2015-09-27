<div class="page account-page">
    <div class="area sub-wrapper">
        <div class="grid-section">
            <div class="col-m col-12">
                <?php include_once '_side.php'; ?>
                <div class="col-m col-9 content">
                    <!-- follower / following center -->
                    <div class="col-m col-12 content-heading">
                        <h2><?=Language::invokeOutput('heading/follow');?></h2>
                        <p class="section-desc"><?=Language::invokeOutput('desc/follow');?></p>
                    </div>
                    <div class="col-m col-12 content-body">
                        <div class="col-m col-12 section-caption">
                            <h3><?=Language::invokeOutput('labels/followers2');?></h3>
                            <p class="section-desc"><?=Language::invokeOutput('label-desc/followers2');?></p>
                        </div>
                        <div class="col-m col-12 box followers-wrapper">
                            <form action="ajax/loadFollowers" method="POST" class="more">
                                <div class="sub-follower container">
                                        <?php
                                        if (empty($data['followers']))
                                        {
                                            echo "<div class='no-data'>". Language::invokeOutput('no-followers') ."</div>";
                                        }else{
                                            foreach($data['followers'] as $follower)
                                            {
                                         ?>
                                            <div class="col-m col-12 v-middle follower-model">
                                                <div class="v-col">
                                                    <img src="<?=$follower->profile_picture;?>" alt="user-pic" class="hide-sm x-50">
                                                </div>
                                                <div class="v-col padding-h">
                                                    <h3><a href="<?=$follower->uID;?>"><?=$follower->username;?></a></h3>
                                                    <small><?=language::invokeOutput('frequent/level').' '.$follower->level;?></small>
                                                </div>
                                            </div>
                                        <?php } } ?>
                                </div>
                                <!--- load more !-->
                                <input type="hidden" name="page" class="holder" value="2">
                                <a href="#loadmore" class="load-more more-followers"><?=language::invokeOutput('load-more');?></a>
                            </form>
                            <!--- end - load more !-->
                        </div>
                        <div class="col-m col-12 section-caption">
                            <h3><?=Language::invokeOutput('labels/following2');?></h3>
                            <p class="section-desc"><?=Language::invokeOutput('label-desc/following2');?></p>
                        </div>
                        <div class="col-m col-12 box followers-wrapper">
                            <form action="ajax/loadFollowings" method="POST" class="more">
                                <div class="sub-follower container">
                                        <?php
                                        if (empty($data['following']))
                                        {
                                            echo "<div class='no-data padding-h'>". Language::invokeOutput('no-followings') ."</div>";
                                        }else{
                                            foreach($data['following'] as $following)
                                            {?>
                                            <div class="col-m col-12 v-middle follower-model">
                                                <div class="v-col">
                                                    <img src="<?=$following->profile_picture;?>" alt="user-pic" class="hide-sm x-50">
                                                </div>
                                                <div class="v-col">
                                                    <h3><a href="<?=$following->uID;?>"><?=$following->username;?></a></h3>
                                                    <small><?=language::invokeOutput('frequent/level').' '.$following->level;?></small>
                                                </div>
                                            </div>
                                        <?php } }  ?>
                                </div>
                                <!--- load more !-->
                                <input type="hidden" name="page" class="holder" value="2">
                                <a href="#loadmore" class="load-more more-followers"><?=language::invokeOutput('load-more');?></a>
                            </form>
                            <!--- end - load more !-->
                        </div>
                    </div>
                    <!-- end - follower / following center -->
                    <!-- ########## -->
                </div>
            </div>
        </div>
    </div>
</div>
