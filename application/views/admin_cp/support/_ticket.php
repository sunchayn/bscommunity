<div class="col-m col-12 ticket v-middle <?=($ticket->seen == 0)? 'unread' : '';?>">
    <div class="col-2 v-col">
        <input type="checkbox" id="c<?=$x;?>" name="select[]" value="<?=$ticket->id;?>" class="checkboxTickets">
        <label for="c<?=$x++;?>"></label>
        <?=$ticket->username;?>
    </div>
    <div class="col-6 v-col"><a href="admin_cp/support/<?=$ticket->id;?>"><?=$ticket->title;?></a></div>
    <div class="col-2 v-col"><?=($ticket->status == 1) ? language::invokeOutput('resp') : language::invokeOutput('no-resp');?></div>
    <div class="col-2 v-col"><?=$ticket->date;?></div>
</div>