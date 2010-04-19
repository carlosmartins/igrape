<p>The session parameter "sample_data" currently contains `<?=urldecode($sample_data)?>`.<br/>
Visit <a href="<?=url('/test/sessions/Anything you write on the url')?>">/test/sessions/somedata</a> to write to it.</p>
<?php if(isset($written)): ?>
<p>New data has been written to the Session, navigate <a href="<?=url('/test/sessions')?>">here</a> to check it.<br/>
You can write different strings to the session by changing the url.</p>
<?php endif; ?>
<hr/>
<h3>Go <a href="<?=url('/test')?>">Back</a> to the first page.</h3>