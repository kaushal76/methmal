<?php
/**
 * @version     2.5.7
 * @package     com_confmgt
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Dr Kaushal Keraminiyage <admin@confmgt.com> - htttp://www.confmgt.com
 */
defined('_JEXEC') or die;
//ACL helper class for the confmgt. Using a specific ACL for the component as the Joomla ACL does not serve the purpose
abstract class UploadHelper {
	
    function getMimetype($tmpfilepath, $filename) {
        $arrayZips = array("application/zip", "application/x-zip", "application/x-zip-compressed", "application/vnd.ms-office");
        if (function_exists('finfo_file')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $tmpfilepath);
            finfo_close($finfo);
        } else {
            Throw new Exception(JText::_('Your PHP Version is too old for this system to work.'));
			return false;
        }
        if (in_array($mime, $arrayZips)) {
            $mime = UploadHelper::ext2mime(strtolower(preg_replace('/^.*\./', '', $filename)));
        } 
            return $mime;
    }
	
	function ext2mime($ext)
	{
		switch ($ext) {
                    
                case 'docx':
                    return 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                case 'docm':
                    return 'application/vnd.ms-word.document.macroEnabled.12';
                case 'dotx':
                    return 'application/vnd.openxmlformats-officedocument.wordprocessingml.template';
                case 'dotm':
                    return 'application/vnd.ms-word.template.macroEnabled.12';
                case 'xlsx':
                    return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
                case 'xlsm':
                    return 'application/vnd.ms-excel.sheet.macroEnabled.12';
                case 'xltx':
                    return 'application/vnd.openxmlformats-officedocument.spreadsheetml.template';
                case 'xltm':
                    return 'application/vnd.ms-excel.template.macroEnabled.12';
                case 'xlsb':
                    return 'application/vnd.ms-excel.sheet.binary.macroEnabled.12';
                case 'xlam':
                    return 'application/vnd.ms-excel.addin.macroEnabled.12';
                case 'pptx':
                    return 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
                case 'pptm':
                    return 'application/vnd.ms-powerpoint.presentation.macroEnabled.12';
                case 'ppsx':
                    return 'application/vnd.openxmlformats-officedocument.presentationml.slideshow';
                case 'ppsm':
                    return 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12';
                case 'potx':
                    return 'application/vnd.openxmlformats-officedocument.presentationml.template';
                case 'potm':
                    return 'application/vnd.ms-powerpoint.template.macroEnabled.12';
                case 'ppam':
                    return 'application/vnd.ms-powerpoint.addin.macroEnabled.12';
                case 'sldx':
                    return 'application/vnd.openxmlformats-officedocument.presentationml.slide';
                case 'sldm':
                    return 'application/vnd.ms-powerpoint.slide.macroEnabled.12';
                case 'one':
                    return 'application/msonenote';
                case 'onetoc2':
                    return 'application/msonenote';
                case 'onetmp':
                    return 'application/msonenote';
                case 'onepkg':
                    return 'application/msonenote';
                case 'thmx':
                    return 'application/vnd.ms-officetheme';
                case 'ppt':
                    return 'application/vnd.powerpoint';
				case 'doc':
					return 'application/msword';
				default:
					return false;	
				 
            }
	}
	
	/**
	 * Function to verify the file size and other errors
	 *
	 *
	*/ 
	
	function checkFile($file, $size)
	{

	  //Check if the server found any error.
	  $fileError = $file['error'];
	  $message = '';
	  if($fileError > 0 ) {
		  switch ($fileError) {
			  case 1:
				  $message = JText::_( 'File size exceeds allowed by the server');
				  break;
			  case 2:
				  $message = JText::_( 'File size exceeds allowed by the html form');
				  break;
			  case 3:
				  $message = JText::_( 'Partial upload error');
				  break;
			  case 4:
				  $message = JText::_( 'No file was uploaded ');
		  }
		  if($message != '') {
			  JError::raiseWarning( 500, $message ); 
			  return false;
		  }
	  }
	  // No errors, check the file sizes
	  else{

		  //Check for filesize
		  $fileSize = $file['size'];
		  $sizeM = $size*1024*1024;
		  if($fileSize > $sizeM){
			  JError::raiseWarning( 500, JText::_( 'File exceeded the maximum size ('.$sizeM.'MB)'));
			  return false;
		  }
	  }
	  return true;
	}
	
	/**
	 * Function to change file name
	 *
	 *
	*/ 
	
	function changeFileName($file, $prefix, $linkid)
	{

	  //Replace any special characters in the filename
	  $filename = explode('.', $file['name']);

	  //Add Timestamp MD5 to avoid overwriting
	  $filename[0] = $linkid.'-'.$prefix.'-'.time();
	  $filename = implode('.',$filename);
	  
	  return $filename;
	}
	
	/**
	 * Function to move the file
	 * call after the check and the filename change
	 *
	*/ 
	
	function uploadFile($file, $uploadpath, $override = true)
	{

	  $fileTemp = $file['tmp_name'];
	  if ($override) 
		{
		  if(!JFile::exists($uploadpath)){
			  if (!JFile::upload($fileTemp, $uploadpath)){
				  JError::raiseWarning( 500, JText::_( 'Error moving the file'));
				  return false;
			  }
		  }
		  else
		  {
			  JError::raiseWarning( 500, JText::_( 'File exists in the destination directory'));
			  return false;
		  }
			  
		}
		else
		{
			if (JFile::delete($uploadpath)) {
			  if (!JFile::upload($fileTemp, $uploadpath)){
					JError::raiseWarning( 500, JText::_('Error moving the file'));
					return false;
			  }
			}else{
				JError::raiseWarning( 500, JText::_('There is an error deleting the old file. New file is not uploaded'));
				return false;
			}		
			
		}
		return true;
	}
	
	function downloadFile($file, $path, $mime) 
	{
	set_time_limit(0);
	$fext = strtolower(substr(strrchr($file,"."),1)); 
	$mtype = UploadHelper::getmtype($fext);	
	header("Pragma:no-cache");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-type: $mtype");
	header("Content-Transfer-Encoding: binary"); 
	header("Content-Disposition: attachment; filename=\"".basename($file)."\"");
	header("Accept-Ranges: bytes");
	ob_clean();
	flush();
	@readfile("$path");
  	exit();
	}

	function getmtype($fext) 
	{
		$mime_types = array (
		'zip'		=> 'application/zip',
		'pdf'		=> 'application/pdf',
		'doc'		=> 'application/msword',
		'docx'		=> 'application/msword',
		'xls'		=> 'application/vnd.ms-excel',
		'ppt'		=> 'application/vnd.ms-powerpoint',
		'exe' 		=> 'application/octet-stream',
		'gif' 		=> 'image/gif',
		'png'		=> 'image/png',
		'jpg'		=> 'image/jpeg',
		'jpeg'		=> 'image/jpeg',
		'mp3'		=> 'audio/mpeg',
		'wav'		=> 'audio/x-wav',
		'mpeg'		=> 'video/mpeg',
		'mpg'		=> 'video/mpeg',
		'mpe'		=> 'video/mpeg',
		'mov'		=> 'video/quicktime',
		'avi'		=> 'video/x-msvideo'
		);
		if ($mime_types[$fext] == '') {
			$mtype = '';
			if (function_exists('mime_content_type')) {
		  	$mtype = mime_content_type($file);
			}
			else 
			{
		 	 $mtype = "application/force-download";
			}
		}
		else
		{
			$mtype = $mime_types[$fext];
		}
		return $mtype;
	}
}