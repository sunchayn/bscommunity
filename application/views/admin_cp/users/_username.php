<!-- #### -->
<!-- one user -->
<div class="col-m col-12 v-middle one-row">
    <div class="col-1 v-col"><?=$username->id;?></div>
    <div class="col-3 v-col"><a href="profile/<?=$username->user_id;?>"><?=$username->old;?></a></div>
    <div class="col-3 v-col"><?=$username->new;?></div>
    <div class="col-3 v-col"><?=$username->date;?></div>
    <div class="col-2 v-col">
        <a href="#approve" class="usernameRequest" data-content="id=<?=$username->id;?>&status=1&token=<?=$global['token'];?>"><?=language::invokeOutput('approve');?></a> -
        <a href="#decline" class="usernameRequest" data-content="id=<?=$username->id;?>&status=2&token=<?=$global['token'];?>"><?=language::invokeOutput('decline');?></a>
    </div>
</div>
<!-- end - one user -->
<!-- #### -->