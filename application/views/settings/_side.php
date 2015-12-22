<aside class="col-m col-3">
    <a href="settings" <?=isset_get($data['selected'], 'general','');?>><?=language::invokeOutput('heading/general');?></a>
    <a href="settings/logging" <?=isset_get($data['selected'], 'logging','');?>><?=language::invokeOutput('heading/logging');?></a>
    <a href="settings/about" <?=isset_get($data['selected'], 'about','');?>><?=language::invokeOutput('heading/about');?></a>
    <a href="settings/security" <?=isset_get($data['selected'], 'security','');?>><?=language::invokeOutput('heading/security');?></a>
    <a href="settings/privacy" <?=isset_get($data['selected'], 'privacy','');?>><?=language::invokeOutput('heading/privacy');?></a>
    <a href="settings/notifications" <?=isset_get($data['selected'], 'notifications','');?>><?=language::invokeOutput('heading/notification');?></a>
    <a href="settings/follow" <?=isset_get($data['selected'], 'follow','');?>><?=language::invokeOutput('heading/follow');?></a>
    <a href="logout"><?=language::invokeOutput('user-panel/logout');?></a>
</aside>