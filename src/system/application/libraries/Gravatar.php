<?php

class Gravatar {
	
	private $_apiKey 		= null;
	private $_servicePath 	= 'http://www.gravatar.com/avatar';
	private $_cacheDir		= null;
	private $_imgTimeout	= 86400;
	private $CI				= null;

	public function __construct(){
		$this->CI=$ci=&get_instance();
		$this->_cacheDir=$this->CI->config->item('gravatar_cache_dir');
	}
	
	/**
	 * Gets the user's image from the Gravatar site
	 *
	 * @param integer $userId User ID
	 * @param string $userEmail[optional] User email address
	 */
	public function getUserImage($userId,$userEmail=null){
		$hash=$this->buildEmailHash($userEmail);
		$path=$this->_servicePath.'/'.$hash.'?d=mm';
		
		if(!$userEmail){
			$this->CI->load->model('user_model');
			$userDetail=$this->CI->user_model->getUser($userId);
			$userEmail=$userDetail[0]->email;
		}
		
		$imgData=file_get_contents($path);
		$put=$this->_cacheDir.'/user'.$userId.'.jpg';
		file_put_contents($put,$imgData);
	}
	
	/**
	 * Check for the user's image and return/display
	 * 
	 * @param integer $userId User ID
	 * @param boolean $return Return as string or echo
	 */
	public function displayUserImage($userId,$return=false){
		if(is_file($this->_cacheDir.'/user'.$userId.'.jpg')){
			// Check the time on the file....
			if(filectime($this->_cacheDir.'/user'.$userId.'.jpg')+$this->_imgTimeout<time()){
				$this->getUserImage($userId);
			}
			$imgStr='<img src="/inc/img/user_gravatar/user'.$userId.'.jpg"/>';
			if($return){ return $imgStr; }else{ echo $imgStr; }
		}else{ 	
			return false;
		}
	}
	
	/**
	 * Build has of user's email for the Gravatar request
	 *
	 * @param string $userEmail User email address
	 */
	private function buildEmailHash($userEmail){
		$userEmail=strtolower(trim($userEmail));
		return md5($userEmail);
	}
}

?>