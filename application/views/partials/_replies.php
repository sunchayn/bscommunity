<!-- ######## -->
<!-- #  one reply # -->
<div class="col-m col-12 reply flexbox delete-wrapper">
    <aside class="col-m col-2 user-info">
        <div class="col-m col-12 info-heading">
            <h3 class="inline-b"><a href="profile/<?=$reply->uID;?>"><?=$reply->username;?></a></h3> - <small><?=$reply->role;?></small>
            <br /><img src="<?=$reply->profile_picture;?>" alt="reply-author-photo" class="img-circel x-100"><br />
        </div>
        <div class="col-m col-12 info-body">
            <span><?=language::invokeOutput('frequent/level'). '   ' . $reply->level;?></span><br />
            <span><?=language::invokeOutput('frequent/posts'). ' : ' . $reply->posts;?></span><br />
            <span><?=language::invokeOutput('country'). ' : ' . $reply->country;?></span><br />
            <span><?=language::invokeOutput('join'). ' : ' . usersAPI::getDays($reply->create_date) . ' ' . language::invokeOutput('ago');?></span>
        </div>
    </aside>
    <div class="col-m col-10 reply-core">
        <div class="col-m col-12 a-left"><a href="reply/<?=$reply->id;?>">#<?=$x;?></a></div>
        <div class="col-m col-12 reply-content">
            <span class="col-m col-1 reply-rate a-center">
                <span><a class='icon-angle-up normalAJAX'  data-url="ajax/rateUpReply" data-content='id=<?=$reply->id;?>&token=<?=$global["token"];?>' href='#rateReply'></a></span>
                <span><?=$reply->rate;?></span>
                <span><a class='icon-angle-down normalAJAX'  data-url="ajax/rateDownReply" data-content='id=<?=$reply->id;?>&token=<?=$global["token"];?>' href='#rateReply'></a></span>
            </span>
            <p class="col-m col-11"><?=$reply->content;?></p>
        </div>
        <div class="col-m col-12 reply-footer">
            <span>
                <?php
                    echo Language::invokeOutput('frequent/posted').'  '. $reply->create .' ';
                    if (accessAPI::getInstance()->checkAccessToDeleteReply($reply->author_id))
                        echo "- <a  href='#deleteReply' class='delete-reply' data-content='id={$reply->id}&token={$global["token"]}'>" . Language::invokeOutput('remove-reply') . "</a> ";
                    if (accessAPI::getInstance()->checkAccessToUpdateReply($reply->author_id))
                        echo '- <a href="edit/reply/'. $reply->id. '">'. Language::invokeOutput('update-reply') .'</a>';
                ?>
                - <a href="#report-reply" data-reported="<?=$reply->id;?>" data-type="1" data-panel="report-panel" class="reportTrigger triggerPanel"><?=language::invokeOutput('frequent/report');?></a>
            </span>
        </div>
    </div>
</div>
<!-- #  end - one reply # -->
<!-- ######## -->