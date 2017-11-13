<?php
namespace Funnlz\Helpers;

class ImageHelper{	
	public static function create_thumb($src,$dest,$desired_width = FALSE, $desired_height = FALSE)
	{
		/*If no dimenstion for thumbnail given, return FALSE */
		if (!$desired_height&&!$desired_width) 
			return FALSE;
		$fparts = pathinfo($src);
		$ext = strtolower($fparts['extension']);
		/* if its not an image return FALSE */
		if (!in_array($ext,array('gif','jpg','png','jpeg'))) 
			return FALSE;

		/* read the source image */
		if ($ext == 'gif')
			$resource = imagecreatefromgif($src);
		else if ($ext == 'png')
			$resource = imagecreatefrompng($src);
		else if ($ext == 'jpg' || $ext == 'jpeg')
			$resource = imagecreatefromjpeg($src);

		$width = imagesx($resource);
		$height = imagesy($resource);
		/* find the “desired height” or “desired width” of this thumbnail, relative to each other, if one of them is not given */
		if(!$desired_height) $desired_height = floor($height*($desired_width/$width));
		if(!$desired_width) $desired_width = floor($width*($desired_height/$height));

		/* create a new, “virtual” image */
		$virtual_image = imagecreatetruecolor($desired_width,$desired_height);

		/* copy source image at a resized size */
		imagecopyresized($virtual_image,$resource,0,0,0,0,$desired_width,$desired_height,$width,$height);

		/* create the physical thumbnail image to its destination */
		/* Use correct function based on the desired image type from $dest thumbnail source */
		$fparts = pathinfo($dest);
		$ext = strtolower($fparts['extension']);
		/* if dest is not an image type, default to jpg */
		if (!in_array($ext,array('gif','jpg','png','jpeg'))) 
			$ext = 'jpg';
		$dest = $fparts['dirname'].'/'.$fparts['filename'].'.'.$ext;

		if ($ext == 'gif')
			imagegif($virtual_image,$dest);
		else if ($ext == 'png')
			imagepng($virtual_image,$dest,1);
		else if ($ext == 'jpg' || $ext == 'jpeg')
			imagejpeg($virtual_image,$dest,100);

		return array(
			'width' => $width,
			'height' => $height,
			'new_width' => $desired_width,
			'new_height'=> $desired_height,
			'dest' => $dest
			);
	}

}

