<?php
class TestController extends Controller {
	function index() {
		
		// check if we'd like to go somewhere else
		if(!empty($this->data['form']['destination'])) {
			redirect('/test/'.$this->data['form']['destination']);
		}
		
		$test = array("test"=>array(2,3,4,5,6,7,8,9),"lala"=>array(9,8,7,6,5,4),"lalax"=>array(9,8,7,6,5,4));
		//$test = array("test"=>1);
		$styleT = array("border"=>"1");
		echo table($test);
		
	}
	
	function views() {
		$this->set('myparam', 'This is string a parameter set as $this->set("myparam", content) on the controller. The view will access it as $myparam.');
		
		load("dummy.php");
		$this->set('dummy', dummy_string());
		
		// Example for elements
		$this->set('data', array('name' => 'iGrape', 'age' => 'Since Nov/2007', 'color' => 'Who cares?'));
	}
	
	function sessions($data = null) {
		$this->set('sample_data', session('sample_data'));
		
		if($data) {
			
			session('sample_data', $data);
			$this->set('written', true);
			
		}
		
	}
	
	function forms() {
		load('thumb/ThumbLib.inc.php');

		$thumb = PhpThumbFactory::create('test.jpg');
		$thumb->resize(300, 300);
		$thumb->show();
	}
	
}
?>
