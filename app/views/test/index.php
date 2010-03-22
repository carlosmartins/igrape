<table>
	
</table>
<h1>TestController</h1>

<p>This controller was written with two purposes, in this order of importance</p>
<ol>
	<li>To allow me to test all the funcionality</li>
	<li>To serve as reference to other users (Maybe someone besides me will use this)</li>
</ol>

<form action="<?=url('/test')?>" method="post">
<p>You're currently visiting the index() function of the MechTestController.<br/>
Installation and basic setup instructions are on the header of the index.php file<br/>
I've created a form as an example on how to pass data between requests, so choose the topic and click <input type="submit" value="Go"/></p>
<ul>
	<li><input type="radio" name="destination" value="views"/> About Views, using variables and external functions.</li>
	<li><input type="radio" name="destination" value="forms"/> About Forms and the special <i>$form</i> variable</li>
	<li><input type="radio" name="destination" value="sessions"/> About Sessions, or how to retain values between requests (also accesses parameters from the command line).</li>
</ul>
</form>