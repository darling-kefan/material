<?php
/**
 * 这个文件是处理图象的函数定义，必须要有GD2的扩展才能使用。
 * 
 * 主要包含的功能有为图片创建缩略图，给图片增加水印。
 *
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
class Image
{
	/**
	 * 打开图象文件，根据不同的图象格式使用不同的函数来打开
	 * 返回值为该图象文件的标识句柄
	 *
	 * @param  string $imageFile
	 * @return resource
	 */
	static function openImage($imageFile)
	{
		$array = getimagesize($imageFile);
		$mime  = strtolower($array['mime']);
		switch($mime){
			case 'image/jpeg':
				return imagecreatefromjpeg($imageFile);
				break;
			case 'image/png':
				return imagecreatefrompng($imageFile);
				break;
			case 'image/gif':
				return imagecreatefromgif($imageFile);
				break;
			default:
				return false;
				break;
		}
	}

	/**
	 * 缩略图生成函数，注意是整张图片缩略而不是部分。按照宽和高的最小值做为生成标准
	 *
	 * @param string $srcImagePath 源图象路径
	 * @param string $dstImagePath 生成的缩略图路径
	 * @param int    $dstX         生成的缩略图宽
	 * @param int    $dstY         生成的缩略图高
	 * @param string $type         生成的缩略图类型,默认为jpg，注意为auto时表示与源文件相同
	 * 
	 * @return array 源图象信息的关联数组(宽和高)
	 */
	static function makeThumb($srcImagePath, $dstImagePath, $dstX, $dstY, $type = 'jpg')
	{
		$imageArray = getimagesize($srcImagePath);
		$srcX = $imageArray[0];
		$srcY = $imageArray[1];

		if($srcX <= $dstX and $srcY <= $dstY) {
			copy($srcImagePath, $dstImagePath);
			return;
		}else if($dstX <= $dstY){
			//以宽为标准
			$srcImage = Image::openImage($srcImagePath);
			$percent  = $dstX/$srcX;
			$tempY    = $percent*$srcY;
			$dstY     = round($tempY);
		}else{
			//以高为标准
			$srcImage = Image::openImage($srcImagePath);
			$percent  = $dstY/$srcY;
			$tempX    = $percent*$srcX;
			$dstX     = round($tempX);
		}

		//不要使用imagecreate，创建的图象会失真
		$dstImage = imagecreatetruecolor($dstX, $dstY);
		//尽量用imagecopyresampled代替imagecopyresized，imagecopyresampled会重新采样，输出质量明显要好很多的
		imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $dstX, $dstY, $srcX, $srcY);

		if($type){
			$imageType = substr($srcImagePath, strrpos($srcImagePath, '.') + 1);
			$imageType = strtolower($imageType);
			switch($type){
				case 'gif':
					imagegif($dstImage, $dstImagePath);
					break;
				case 'png':
					imagepng($dstImage, $dstImagePath);
					break;
				default:
					imagejpeg($dstImage, $dstImagePath);
					break;
			}
		}

		$return['width']  = $srcX;
		$return['height'] = $srcY;

		return $return;
	}
	
   /**
    * PHP图片水印 (水印支持图片或文字)
    *
    * @example Image::makeWaterMark($srcImagePath, 9, ROOT_PATH.'/images/logo2.png');
    * 
    * @param string $groundImage    背景图片，即需要加水印的图片，暂只支持GIF,JPG,PNG格式；
    * @param int    $waterPos       水印位置，有10种状态，0为随机位置；
    *                               1为顶端居左，2为顶端居中，3为顶端居右；
	*                               4为中部居左，5为中部居中，6为中部居右；
	*                               7为底端居左，8为底端居中，9为底端居右；
    * @param string $waterImage     图片水印，即作为水印的图片，暂只支持GIF,JPG,PNG格式；
    * @param string $waterText      文字水印，即把文字作为为水印，支持ASCII码，不支持中文；
    * @param string $waterTextFile  字体文件
    * @param int    $textFont       文字大小，值为1、2、3、4或5，默认为5；
    * @param string $textColor      文字颜色，值为十六进制颜色值，默认为#FF0000(红色)；
    */
	static function makeWaterMark($groundImage, $waterPos = 0, $waterImage = "", $waterText = "", $waterTextFile = "", $textFont = 5, $textColor = "#FF0000")
	{
		$isWaterImage = FALSE;
		
		//读取水印文件
		if(!empty($waterImage) && file_exists($waterImage)){
			$isWaterImage = TRUE;
			$waterInfo   = getimagesize($waterImage);
			$waterW 	  = $waterInfo[0];//取得水印图片的宽
			$waterH 	  = $waterInfo[1];//取得水印图片的高
			//取得水印图片的格式
			switch($waterInfo[2]){
				case 1:
				    $waterIm = imagecreatefromgif($waterImage);
				    break;
				case 2:
				    $waterIm = imagecreatefromjpeg($waterImage);
				    break;
				case 3:
				    $waterIm = imagecreatefrompng($waterImage);
				    break;
				default:
					return;
			}
		}
		//读取背景图片
		if(!empty($groundImage) && file_exists($groundImage)){
			$groundInfo = getimagesize($groundImage);
			$groundW = $groundInfo[0];//取得背景图片的宽
			$groundH = $groundInfo[1];//取得背景图片的高
			//取得背景图片的格式
			switch($groundInfo[2])
			{
				case 1:
					$groundIm = imagecreatefromgif($groundImage);
					break;
				case 2:
					$groundIm = imagecreatefromjpeg($groundImage);
					break;
				case 3:
					$groundIm = imagecreatefrompng($groundImage);
					break;
				default:
					return;
			}
		}
		//水印位置
		if($isWaterImage){
			//图片水印
			$w = $waterW;
			$h = $waterH;
		}else{
			//文字水印
			$temp = imagettfbbox(ceil($textFont*5), 0, $waterTextFile, $waterText);//取得使用 TrueType 字体的文本的范围
			$w = $temp[2] - $temp[6];
			$h = $temp[3] - $temp[7];
			unset($temp);
		}
		if(($groundW < $w) || ($groundH < $h)){
			//echo "需要加水印的图片的长度或宽度比水印".$label."还小，无法生成水印！";
			return;
		}
		switch($waterPos){
			case 0://随机
    			$posX = rand(0,($groundW - $w));
    			$posY = rand(0,($groundH - $h));
    			break;
			case 1://1为顶端居左
    			$posX = 0;
    			$posY = 0;
    			break;
			case 2://2为顶端居中
    			$posX = ($groundW - $w) / 2;
    			$posY = 0;
    			break;
			case 3://3为顶端居右
    			$posX = $groundW - $w;
    			$posY = 0;
    			break;
			case 4://4为中部居左
    			$posX = 0;
    			$posY = ($groundH - $h) / 2;
    			break;
			case 5://5为中部居中
    			$posX = ($groundW - $w) / 2;
    			$posY = ($groundH - $h) / 2;
    			break;
			case 6://6为中部居右
    			$posX = $groundW - $w;
    			$posY = ($groundH - $h) / 2;
    			break;
			case 7://7为底端居左
    			$posX = 0;
    			$posY = $groundH - $h;
    			break;
			case 8://8为底端居中
    			$posX = ($groundW - $w) / 2;
    			$posY = $groundH - $h;
    			break;
			case 9://9为底端居右
    			$posX = $groundW - $w;
    			$posY = $groundH - $h;
    			break;
			default://随机
    			$posX = rand(0,($groundW - $w));
    			$posY = rand(0,($groundH - $h));
    			break;
		}
		
		//设定图像的混色模式
		imagealphablending($groundIm, true);
		if($isWaterImage){
		    //图片水印
			imagecopy($groundIm, $waterIm, $posX, $posY, 0, 0, $waterW,$waterH);//拷贝水印到目标文件
		}else{
			//文字水印
			if(!empty($textColor) && (strlen($textColor)==7)){
				$R = hexdec(substr($textColor, 1, 2));
				$G = hexdec(substr($textColor, 3, 2));
				$B = hexdec(substr($textColor, 5));
			}else{
				//die("水印文字颜色格式不正确！");
				return;
			}
			imagestring($groundIm, $textFont, $posX, $posY, $waterText, imagecolorallocate($groundIm, $R, $G, $B));
		}
		
		//生成水印后的图片
		@unlink($groundImage);
		//取得背景图片的格式
		switch($groundInfo[2]){
			case 1:
				imagegif($groundIm, $groundImage);
				break;
			case 2:
				imagejpeg($groundIm, $groundImage);
				break;
			case 3:
				imagepng($groundIm, $groundImage);
				break;
			default:
				return;
		}
		//释放内存
		if(isset($waterInfo)){
			unset($waterInfo);
		}
		if(isset($waterIm)){
			imagedestroy($waterIm);
		}
		unset($groundInfo);
		imagedestroy($groundIm);
	}
}
?>