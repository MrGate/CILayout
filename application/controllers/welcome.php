<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/** Use this as example only
	 *	it best to have layout in your autoload
	 *  and it best to always have settings config loaded!
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->config('settings');
		$this->load->library('layout');
	}

	public function index()
	{
		$this->layout->set_header("template/header"); // you can change the template you use
		$this->layout->set_footer("template/footer"); // you can change the template you use
		$this->layout->set_description("Example description to add to the meta"); // example of meta description
		$this->layout->set_keywords("one,two,three,four,five,six"); // example of meta keywords
		$this->layout->set_scripts("<script></script> or <link></link>"); // you can use full html in this
		$this->layout->set_js("assets/js/javascript_file.js"); // loads javascript file
		$this->layout->set_css("assets/css/stylesheet.css"); // load stylesheet file
		$this->layout->view('YOUR_VIEW');  // load the view
	}
	
	public function basic()
	{
		// it can be as basic as this!
		$this->layout->view("YOUR_VIEW");
	}
	
	public function pass_content()
	{
		$content['first_content'] = "Hello people of codeigniter";
		$content['another_content'] = "I Know this is not the best example!";
		$this->layout->view("YOUR_VIEW",$content);
	}
	
	public function array_basic()
	{
		$array = array('FIRST_VIEW','SECOND_VIEW');
		$this->layout->view($array);
	}
	
	public function no_template()
	{
		$this->layout->view("YOUR_VIEW",NULL,FALSE); // FALSE = no template   TRUE = template 
	}
	
}
