<?php
/**
 *  Security package : GLOBAL variables will be accesed securly through Security package.
 *                     This package provides necessary in built validation for users data.
 *
 *  PHP version 5.1.6 or newer
 *
 *  @category PHP
 *
 *  @package  Security
 *
 *  @author   balamathankumar<balamathankumar@gmail.com>
 *
 *  @Copyright    : Copyright (c) 2013 - 2014,
 *  @License      : http://www.appsntech.com/license.txt
 *  @Link	  : http://appsntech.com
 *  @Since	  : Version 1.0
 *  @Filesource
 *  @Warning      : Any changes in this library can cause abnormal behaviour of the framework
 *
 */

include_once('globals'.OS_PATH_SEPERATOR.FRAMEWORK_PREFIX.'Globals.php'); // includes GLOBAL class
include_once('globals'.OS_PATH_SEPERATOR.FRAMEWORK_PREFIX.'SecureData.php'); // includes SecureData Interface
include_once('globals'.OS_PATH_SEPERATOR.FRAMEWORK_PREFIX.'Cookie.php'); // includes Cookie class
include_once('globals'.OS_PATH_SEPERATOR.FRAMEWORK_PREFIX.'Files.php'); // includes Files class
include_once('globals'.OS_PATH_SEPERATOR.FRAMEWORK_PREFIX.'Get.php'); // includes Get class
include_once('globals'.OS_PATH_SEPERATOR.FRAMEWORK_PREFIX.'Post.php'); // includes Post class
include_once('globals'.OS_PATH_SEPERATOR.FRAMEWORK_PREFIX.'Request.php'); // includes Request class
include_once('globals'.OS_PATH_SEPERATOR.FRAMEWORK_PREFIX.'Server.php'); // includes Server class
include_once('globals'.OS_PATH_SEPERATOR.FRAMEWORK_PREFIX.'Session.php'); // includes Session class

/**
 *
 *  Security class creates instance for a class thats inheriting GLOBALS class and implementing
 *  secureData interface and holds instances in register_global array
 *
 *  @todo need to more validation or data filter methods
 *
 *  @name Security
 *
 */

class Security
{

	public $register_global = array(); // Array to object instances

	public function __construct(){}

	/**
	 *  __get() Magic method gets class name as a parameter and determines wheather instance exists
	 *  for incoming key value(class name) or  not.
	 *  if instance exists in register_global array instance will be returned
	 *  otherwise if requested class exists new instance will be created, stored in register_global array
	 *  and returned
	 *
	 *  @access public
	 *
	 *  @method __get($key)
	 *
	 *  @param  string  $key class name to create instance
	 *
	 *  @return Globals $instance
	 */

	public function __get($key)
	{
		$key = ucwords($key);
		if(isset($this->register_global[$key])): // determines whether requested instance exists
			return $this->register_global[$key];
		elseif(class_exists($key)): // determines whether requested class included into package
			return $this->register_global[$key] = new $key;
		endif;
	} // end __get magic method

	/**
	 * This method escapes quotes existed in incoming string
	 *
	 * @access public
	 *
	 * @method escape
	 *
	 * @param  string $data string value need to escape quotes
	 *
	 * @return string quotes escaped string
	 */

	public function escape($data)
	{

		return "'".addslashes($data)."'";

	} // end escape method

	/**
	 * This method escapes quotes existed in incoming string that will be used in SQL like operator
	 *
	 * @access public
	 *
	 * @method escape
	 *
	 * @param string $data string value need to escape quotes while using SQL like operator
	 *
	 * @return string quotes escaped string
	 */

	public function escape_for_like($data)
	{

		return "'".addcslashes(addslashes($data), "%_")."'";
	} // end escape_for_like method

	public function __destruct(){ }

} // end security class
