<?php
class Image{
	protected $_options = null;
	protected $_image = null;
	protected $_type = null;
	protected $_width = 0;
	protected $_height = 0;
	protected $_file_path = null;

	function __construct($file) {
		list($this->_width, $this->_height) = getimagesize($file);
		$mime = $this->get_mime_type($file);
		$this->_type = $mime;
		$this->_file_path = $file;
		switch($mime){
			case 'image/jpeg':
				$this->_image = imagecreatefromjpeg($file);
				break;
			case 'image/png':
				$this->_image = imagecreatefrompng($file);
				break;
			case 'image/gif':
				$this->_image = imagecreatefromgif($file);
				break;
		}
	}
	public function get_mime_type($filepath) {
		$info = @getimagesize($filepath);
		if(is_array($info) && !empty($info['mime'])){
			return strtolower($info['mime']);
		}
		return "";
	}
	public function getOriginalSize() {
		return array($this->_width, $this->_height);
	}
	public function resize($toWidth, $toHeight, $stretch = false) { 
		if ($this->_image){
			if ($this->_width > $toWidth || $this->_height > $toHeight) {
				$new_width = $toWidth;
				$new_height = $toHeight;
				if(!$stretch){
					$scale = $this->_width / $this->_height;
					if ($toWidth / $toHeight < $scale) {
						$new_height = $toWidth / $scale;
						$new_width = $toWidth;
					}else{
						$new_width = $toHeight * $scale;
						$new_height = $toHeight;
					}
				}
				$this->_thumbwidth = $new_width;
				$this->_thumbheight = $new_height;
				$newimage = imagecreatetruecolor($new_width, $new_height);
				imagecopyresampled($newimage, $this->_image, 0, 0, 0, 0, $new_width, $new_height, $this->_width, $this->_height);
				imagedestroy($this->_image);
				$this->_image = $newimage;
			}else{
				$newimage = imagecreatetruecolor($this->_width, $this->_height);
				imagecopyresampled($newimage, $this->_image, 0, 0, 0, 0, $this->_width, $this->_height, $this->_width, $this->_height);
				imagedestroy($this->_image);
				$this->_image = $newimage;
			}
		}
	}
	
	public function crop($toWidth, $toHeight, $stretch = false) {
		if ($this->_image) {
			if($this->_width > $toWidth || $this->_height > $toHeight){
				$new_width = $toWidth;
				$new_height = $toHeight;
				if(!$stretch){
					$scale = $this->_width / $this->_height;
					if ($toWidth / $toHeight > $scale){
						$new_height = $toWidth / $scale;
						$new_width = $toWidth;
					}else{
						$new_width = $toHeight * $scale;
						$new_height = $toHeight;
					}
				}
				$x_mid = $new_width / 2;
				$y_mid = $new_height / 2;

				$this->_thumbwidth = $toWidth;
				$this->_thumbheight = $toHeight;
				$process = imagecreatetruecolor(round($new_width), round($new_height));
				$newimage = imagecreatetruecolor($toWidth, $toHeight);
				imagecopyresampled($process, $this->_image, 0, 0, 0, 0, $new_width, $new_height, $this->_width, $this->_height);
				imagecopyresampled($newimage, $process, 0, 0, ($x_mid - ($toWidth / 2)), ($y_mid - ($toHeight / 2)), $toWidth, $toHeight, $toWidth, $toHeight);
				imagedestroy($process);
				imagedestroy($this->_image);
				$this->_image = $newimage;
			}else{
				$newimage = imagecreatetruecolor($this->_width, $this->_height);
				imagecopyresampled($newimage, $this->_image, 0, 0, 0, 0, $this->_width, $this->_height, $this->_width, $this->_height);
				imagedestroy($this->_image);
				$this->_image = $newimage;
			}
		}
	}
	public function save($path, $quality=75)
    {
        if (empty($this->_image)){
            return FALSE;
        }
        $fp = fopen($path, "w");
        if ($fp){
            fclose($fp);
			switch($this->_type){
				case 'image/jpeg':
					if(imageJpeg($this->_image, $path, $quality)){
						imagedestroy($this->_image);
						return true;
					}
					break;
				case 'image/png':
					if(imagePng($this->_image, $path)){
						imagedestroy($this->_image);
						return true;
					}
					break;
				case 'image/gif':
					if(imageGif($this->_image, $path)){
						imagedestroy($this->_image);
						return true;
					}
					break;
			}
        }
		return false;
    }
	function remove()
    {
        if ($this->_image) {
			if(is_file($this->_file_path)){
				@unlink($this->_file_path);
			}
			imagedestroy($this->_image);
            return true;
        }
		return false;
    }    
}