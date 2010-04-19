<h1>Form parameters</h1>

<p>POST parameters, when submitted, are stored on the special <i>$this->data['form']</i>
controller variable, and will automatically be made available as <i>$form</i>
on the view.</p>
<p>Here's a simple form to illustrate the mechanism. When submitted, all
variables will be displayed on the bottom of the page</p>
<form method="post" action="">
<table border=1>
	<tr>
		<td>Name</td>
		<td><input type="text" name="name" value="<?=@$form['name'] ?>" /></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><input type="text" name="email" value="<?=@$form['email'] ?>" /></td>
	</tr>
	<tr>
		<td>Comments</td>
		<td><textarea name="comments"><?=@$form['comments'] ?></textarea></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" /></td>
	</tr>
</table>
</form>
<p>Please note that even after submitting data, the form will retain its
values. This happens 'cause we're using
value="&lt;?=@$form['fieldname']?&gt;" on each field. The @ sign tells
php not to display any errors (in case no data was submitted yet). Also
note that there isn't any code on the forms() method on the
MechTestController. All happens automatically.</p>
<?php if(isset($form)): ?>
<h4>Submission results</h4>
<pre>
<?php print_r($form); ?>
</pre>
<?php endif; ?>
<hr/>
<h3>Go <a href="<?=url('/test')?>">Back</a> to the first page.</h3>