<h1>Passing parameters</h1>
<p><i><?=$myparam?></i></p>

<h2>Loading external libs</h2>
<p>The special <b>load($file)</b> function imports a file residing in APP/lib. Check /app/lib/dummy.php's source code</p>
<p><i><?=$dummy?></i></p>
<p>Please note that, altough it could be done on the view, the lib was loaded and data was passed to the view by a variable.<br/>
Views <b>should not</b> contain application logic. If sometime in the future you change to dummylib v2, changing the controller will be sufficient.<br/>
It also helps people who do the webdesign (it's much easier to use &lt;?=$var?&gt; than copying and pasting several lines of code).</p>
<h2>Tip - using <i>load()</i> to render HTML Elements</h2>
<p>The load function has a second optional parameter, which accepts an array of variables to pass to the element.<br/>
Let's imagine we have a <i>$data</i> variable with the following data:</p>
<pre>
<?php print_r($data); ?>
</pre>
<p>Now let's load a lib called dataElement, at <i>lib/dataElement.php</i> using <i>load("dataElement.php", array("data" => $data))</i></p>
<?php load('dataElement.php', array('data' => $data))?>
<p>Ps: This is a live example. $data was actually set on this action (on the controller) and dataElement.php really exists. Check the source code!</p>
<hr/>
<h3>Go <a href="<?=url('/test')?>">Back</a> to the first page.</h3>