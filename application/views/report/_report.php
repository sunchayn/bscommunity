<div class="col-m col-12 one-report">
    <div class="col-m col-12 v-middle box report-heading">
        <div class="v-col">
            <img src="<?=$report->profile_picture;?>" alt="profile_picture" class="x-50 img-circel">
        </div>
        <div class="v-col">
            <h3><a href="profile/<?=$report->reporter;?>"><?=$report->username;?></a></h3>
            <small><?=Language::invokeOutput('frequent/level'). ' ' .$report->level;?></small>
        </div>
    </div>
    <div class="col-m col-12 report-core">
        <p><?=$report->content;?></p>
    </div>
</div>