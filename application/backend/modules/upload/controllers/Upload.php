<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * --------------------------------------------------
 * Group module
 * --------------------------------------------------
 * @param string $module
 * @param string $class
 * @param string $view_dir
 * @return void
 * --------------------------------------------------
 */
class Upload extends MX_Controller
{

	private $module, $class, $view_dir;
	
	/**
	 * --------------------------------------------------
	 * controller constructor
	 * --------------------------------------------------
	 * @access public
	 * @return void
	 * --------------------------------------------------
	 */
	public function __construct()
	{
		parent::__construct();

		$this->module = '/upload/';
		$this->class = strtolower(__CLASS__);
	}

	/**
	 * --------------------------------------------------
	 * home page for the  module
	 * --------------------------------------------------
	 * @access public
	 * @return void
	 * --------------------------------------------------
	 */
	public function index()
	{	
		require_once(APPPATH.'/modules/upload/lib/UploadHandler.php');
		$options = array();
		$options['script_url'] = base_url('upload/upload/index');
		$options['upload_dir'] = BASEPATH.'/../tmp/upload/';
		$options['upload_url'] = root_url('tmp/upload').'/';
		$options['mkdir_mode'] = 777;
		$options['image_versions']['thumbnail']['max_width'] = 100;
		$options['image_versions']['thumbnail']['max_height'] = 100;
		$upload_handler = new UploadHandler($options);
		exit();
		//echo json_encode('');
	}
	
}

/**
 * --------------------------------------------------
 * LOCATION
 * --------------------------------------------------
 * ./application/modules/sample/controllers/sample.php
 * --------------------------------------------------
 */