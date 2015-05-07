<?PHP  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** CILayout library made by MrGate (Randall Perkins)
 *	Under GPLv3
 *	Version 0.55
 */

class Layout 
{
	/**
	 * CodeIgniter Super Global Object
	 * 
	 * @access protected
	 * @var object
	 */
	protected $CI;


	protected $layout_title = "Your Title";

	/**
	 * Template header
	 * has a default value
	 * @access protected
	 * @var string
	 */
	protected $layout_header = "template/header";

	/**
	 * Template footer
	 * has a default value
	 * @access protected
	 * @var string
	 */
	protected $layout_footer = "template/footer";

	/**
	 * Page Description [Meta]
	 *
	 * @access protected
	 * @var string
	 */
	protected $layout_description = "";

	/**
	 * Page Keywords [Meta]
	 *
	 * @access protected
	 * @var string
	 */
	protected $layout_keywords = "";

	/**
	 * Javascripts and other scripts for the header
	 *
	 * @access protected
	 * @var string
	 */
	protected $header_scripts = null;

	/**
	 * Javascripts and other scripts for the header
	 *
	 * @access protected
	 * @var string
	 */
	protected $footer_scripts = null;

	/**
	 * Class Construct
	 *
	 * Executed during the "setup" of this class
	 *
	 * @access public
	 */

	public function __construct() 
	{
		$this->CI =& get_instance();
	}


	public function set_title($title, $append = true)
	{
		if($append)
		{
			$this->layout_title .= $title;
		}
		else
		{
			$this->layout_title = $title;
		}
		return $this;
	}

	/**
	 * Set the header template
	 *
	 * @access public
	 * @param string $title
	 * @return object
	 */

	public function set_header($location) 
	{
		$this->layout_header = $location;
		return $this;
	}

	/**
	 * Set the footer template
	 *
	 * @access public
	 * @param string $title
	 * @return object
	 */

	public function set_footer($location) 
	{
		$this->layout_footer = $location;
		return $this;
	}


	/**
	 * Set the meta description
	 *
	 * @access public
	 * @param string $description
	 * @return object
	 */

	public function set_description($description)
	{
		$this->layout_description = $description;

		return $this;
	}

	/**
	 * Set the meta keywords
	 *
	 * @access public
	 * @param string keywords
	 * @return object
	 */

	public function set_keywords($keywords)
	{
		$this->layout_keywords = $keywords;

		return $this;
	}

	/**
	 * Old version to set scripts
	 *
	 * @access public
	 * @param string $scripts
	 * @return object
	 */

	public function set_hscripts($scripts) 
	{
		$this->header_scripts .= $scripts;
		return $this;
	}

	/**
	 * Old version to set scripts
	 *
	 * @access public
	 * @param string $scripts
	 * @return object
	 */

	public function set_fscripts($scripts) 
	{
		$this->footer_scripts .= $scripts;
		return $this;
	}

	/**
	 * Set javascript links
	 *
	 * @access public
	 * @param string $js
	 * @param string $where
	 * @param boolen $location
	 * @return object
	 */

	public function set_js($js, $where = "footer", $location = true)
	{
		if($location == true)
		{
			switch($where)
			{
				case 'header':
					if(is_array($js)) {
						foreach($js as $loc)
						{
							$this->header_scripts .= "<script src='/assets/js/".$loc."'></script>";
						}
					}else{
						$this->header_scripts .= "<script src='/assets/js/".$js."'></script>";
					}
				break;
				case 'footer':
					if(is_array($js)) {
						foreach($js as $loc)
						{
							$this->footer_scripts .= "<script src='/assets/js/".$loc."'></script>";
						}
					}else{
						$this->footer_scripts .= "<script src='/assets/js/".$js."'></script>";
					}
				break;
			}
		}else{
			switch($where)
			{
				case 'header':
					if(is_array($js)) {
						foreach($js as $loc)
						{
							$this->header_scripts .= $loc;
						}
					}else{
						$this->header_scripts .= $js;
					}
				break;
				case 'footer':
					if(is_array($js)) {
						foreach($js as $loc)
						{
							$this->footer_scripts .= $loc;
						}
					}else{
						$this->footer_scripts .= $js;
					}
				break;
			}
		}
		return $this;
	}

	/**
	 * Set CSS Style sheet links
	 *
	 * @access public
	 * @param string $js
	 * @param boolen $location
	 * @return object
	 */

	public function set_css($css, $location = true)
	{
		if($location == true)
		{
			if(is_array($css))
			{
				foreach($css as $loc)
				{
					$this->header_scripts .= "<link href='/assets/css/".$loc."' rel='stylesheet'>";
				}
			}else{
				$this->header_scripts .= "<link href='/assets/css/".$css."' rel='stylesheet'>";
			}
		}else{
			if(is_array($css))
			{
				foreach($css as $loc)
				{
					$this->header_scripts .= $loc;
				}
			}else{
				$this->header_scripts .= $loc;
			}
		}
		return $this;
	}

	/**
	 * Load the view
	 *
	 * This method handles loading the header, content, and footer views
	 * 
	 * @access public
	 * @param string $view_name
	 * @param mixed $content_var
	 * @param bool $default
	 */

	public function view($view_name, $content_var = null, $default = TRUE)
	{
		if ($default===true)
		{
			// our basic template data
			$send_data = array
			(
				'header_title' => $this->layout_title,
				'header_description' => $this->layout_description,
				'header_keywords' => $this->layout_keywords,
				'header_scripts' => $this->header_scripts,
				'footer_scripts' => $this->footer_scripts,
				'baseurl' => base_url()
			);

			if (is_array($content_var))
			{
				//we have view content sent from the user
				// lets merge that with our template content
				$send_data = array_merge($content_var,$send_data);
			}
			$this->CI->load->vars($send_data);
			$this->CI->load->view($this->layout_header);

			if (!is_array($view_name))
			{
				$this->CI->load->view($view_name);
			}
			else
			{
				foreach ($view_name as $view)
				{
					$this->CI->load->view($view);
				}
			}
			$this->CI->load->view($this->layout_footer);
		}
		else
		{
			if (is_array($view_name))
			{
				foreach ($view_name as $view)
				{
					$this->CI->load->view($view,$content_var);
				}
			}
			else
			{
				$this->CI->load->view($view_name,$content_var);
			}
		}

	}

}
