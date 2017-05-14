<?php
/**
 * 该文件是自定义的一些文件系统操作函数
 * 
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
class FileSYS
{
	/**
	 * 复制目录，将$sourcePath目录里面的文件照原样复制到$targetPath,注意目录名应该相同，即需要创建目录
	 *
	 * @param  string $sourcePath
	 * @param  string $targetPath
	 * @return boolean
	 */
	static function copyDir($sourcePath, $targetPath)
	{
	    if(!file_exists($sourcePath)){
	        return false;
	    }
	    if(!file_exists($targetPath)){
	        mkdir($targetPath, 0777, true);
	    }
		foreach (scandir($sourcePath) as $file){
			if($file=='.' || $file=='..'){
			    continue;
			}
			if(is_dir($sourcePath.'/'.$file)){
			    FileSYS::copyDir($sourcePath.'/'.$file, $targetPath.'/'.$file);
			}else{
			    copy($sourcePath.'/'.$file, $targetPath.'/'.$file);
			}
		}
		
		return true;
	}

	/**
	 * 递归删除目录(目录里面的文件也会被删除！)
	 *
	 * @param  string $sourcePath
	 * @return boolean
	 */
	static function deleteDir($sourcePath)
	{
		if(!@rmdir($sourcePath)){
		    //删除里面的文件
			foreach (scandir($sourcePath) as $file){
				if($file=='.' || $file=='..'){
				    continue;
				}
				$filePath = $sourcePath.'/'.$file;
				if(is_dir($filePath)){
				    @FileSYS::deleteDir($sourcePath);
				}else{
				    @unlink($filePath);
				}
			}
			//再删除目录
			@rmdir($sourcePath);
		}
		return true;
	}

	/**
	 * 清除目录内容(与deleteDir不同的是不会删除自身目录)
	 *
	 * @param  string $sourcePath
	 * @return boolean
	 */
	static function clearDir($sourcePath)
	{
	    //删除里面的文件
		foreach (scandir($sourcePath) as $file){
			if($file=='.' || $file=='..'){
			    continue;
			}
			$filePath = $sourcePath.'/'.$file;
			if(is_dir($filePath)){
			    @FileSYS::deleteDir($filePath);
			}else{
			    @unlink($filePath);
			}
		}
		return true;
	}

	/**
	 * 获得目录的大小
	 *
	 * @param  string $sourcePath
	 * @return int
	 */
	static function getDirSize($sourcePath)
	{
		static $dirSize = 0;
		foreach (scandir($sourcePath) as $file){
			if($file=='.' || $file=='..'){
			    continue;
			}
			$filePath = $sourcePath.'/'.$file;
			if(is_dir($filePath)){
			    FileSYS::getDirSize($filePath);
			}else{
			    $dirSize += filesize($filePath);
			}
		}
		return $dirSize;
	}

	/**
	 * 格式化文件大小
	 *
	 * @param  int $fileSize
	 * @return string
	 */
	static function formatSize($fileSize)
	{
		if($fileSize < 1024){
			$fileSize = round($fileSize/1024, 2);
			$fileSize .= ' KB';
		}else{
			$fileSize = round($fileSize/1024, 2);
			if($fileSize < 1024){
				$fileSize .= ' KB';
			}else{
				$fileSize = round($fileSize/1024, 2);
				if($fileSize < 1024){
					$fileSize .= ' MB';
				}else{
					$fileSize = round($fileSize/1024, 2);
					$fileSize .= ' GB';
				}
			}
		}
		return $fileSize;
	}

	/**
	 * 获得文件的大小并格式化单位返回字符串
	 *
	 * @param  string $filePath
	 * @return string
	 */
	static function getFileSize($filePath)
	{
		return FileSYS::formatSize(filesize($filePath));
	}

	/**
	 * 检查文件是否为文本文件(可编辑)
	 * 根据文件后缀名判断
	 *
	 * @param  string $filePath
	 * @return boolean
	 */
	static function isEditable($filePath)
	{
		$type = substr($filePath, strrpos($filePath,'.') + 1);
		$type = strtolower($type);
		switch ($type){
			case 'txt':	case 'ini':	case 'htm':	case 'html':case 'js':case 'css':case 'php':
			case 'asp':	case 'jsp': case 'htaccess':
				return true;
				break;

			default:
				return false;
				break;
		}
	}

	/**
	 * 判断文件类型是否为压缩文件
	 * 根据文件后缀名判断
	 *
	 * @param  string $filePath
	 * @return boolean
	 */
	static function isCompress($filePath)
	{
		$type = substr($filePath, strrpos($filePath, '.') + 1);
		$type = strtolower($type);
		switch($type){
			case '7z':
			case 'rar':
			case 'zip':
			case 'bz2':
			case 'tar':
			case 'rpm':
			    return true;
			    break;
			default:
			    return false;
			    break;
		}
	}

	/**
	 * 判断文件类型是否为视频文件
	 * 根据文件后缀名判断
	 *
	 * @param  string $filePath
	 * @return boolean
	 */
	static function isVideo($filePath)
	{
		$type = substr($filePath, strrpos($filePath, '.') + 1);
		$type = strtolower($type);
		switch($type){
			case 'swf':
			case 'rmvb':
			case 'flv':
			case 'wmv':
			case 'avi':
			case 'rm':
			    return true;
			    break;
			default:
			    return false;
			    break;
		}
	}

	/**
	 * 判断文件类型是否为音频文件
	 * 根据文件后缀名判断
	 *
	 * @param  string $filePath
	 * @return boolean
	 */
	static function isAudio($filePath)
	{
		$type = substr($filePath, strrpos($filePath, '.') + 1);
		$type = strtolower($type);
		switch($type){
			case 'm4a':
			case 'mp3':
			case 'wma':
			case 'mid':
			case 'ogg':
			case 'flv':
			case 'mp4':
			case 'wav':
				return true;
				break;
			default:
				return false;
				break;
		}
	}

	/**
	 * 判断文件类型是否为图象文件
	 * 根据文件后缀名判断
	 *
	 * @param  string $filePath
	 * @return boolean
	 */
	static function isImage($filePath)
	{
		$type = substr($filePath, strrpos($filePath, '.') + 1);
		$type = strtolower($type);
		switch($type){
			case 'gif':
			case 'bmp':
			case 'jpg':
			case 'jpeg':
			case 'png':
			    return true;
			    break;
			default:
			    return false;
			    break;
		}
	}

	/**
	 * 判断文件类型是否为普通文档文件
	 * 根据文件后缀名判断
	 *
	 * @param  string $filePath
	 * @return boolean
	 */
	static function isDocument($filePath)
	{
		$type = substr($filePath, strrpos($filePath, '.') + 1);
		$type = strtolower($type);
		switch($type){
			case 'doc':
			case 'txt':
			case 'ini':
			case 'chm':
			case 'reg':
			    return true;
			    break;
			default:
			    return false;
			    break;
		}
	}

    /**
     * 上传文件(到本地服务器)
     *
     * @param  array  $FILE           单个文件数组
     * @param  string $dirPath        文件目录
     * @param  string $fileName       文件名称，为空则按照时间自动命名
     * @param  bool   $replaceIfExist 如果有同名文件则覆盖，否则自动重命名文件
     * @return string
     */
	static function uploadfile($FILE, $dirPath, $fileName = null, $replaceIfExist = false)
	{
	    $type = strrchr($FILE['name'], '.');
		if(empty($fileName)){
			$name = microtime(true);
		}else{
		    $name = substr($fileName, 0, strrpos($fileName, '.'));
		}
		$fileName   = $name.$type;
		$uploadFile = $dirPath.'/'.$fileName;
		if(file_exists($uploadFile) && $replaceIfExist == false){
			$i = 1;
			while(file_exists($uploadFile))	{
				$fileName   = $name.'_'.$i++.$type;
				$uploadFile = $dirPath.'/'.$fileName;
			}
		}
		@move_uploaded_file($FILE['tmp_name'], $uploadFile);
		return $fileName;
	}
}
?>