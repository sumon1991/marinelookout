<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * This function is used for output of the array
 * @param array
 * @param print option optional
 * @return String
 */
if ( ! function_exists('pr'))
{
	function pr($arr,$e=1)
	{
		if(is_array($arr))
		{
			echo "<pre>";
			print_r($arr);
			echo "</pre>";
		}
		else
		{
			echo "<br>Not an array...<br>";
			echo "<pre>";
			var_dump($arr);
			echo "</pre>";
	
		}
		if($e==1)
		    exit();
		else
		    echo "<br>";
	}
}

/*
 * This function is used for output a string with certain limit
 * @param strings : input_string, limit
 * @return String
 */

if ( ! function_exists('sub_word'))
{
    function sub_word($str, $limit)
    {
            $text = explode(' ', $str, $limit);
            if (count($text)>=$limit)
            {
                    array_pop($text);
                    $text = implode(" ",$text).'...';
            }
            else
            {
                    $text = implode(" ",$text);
            }
            $text = preg_replace('`\[[^\]]*\]`','',$text);
            return strip_tags($text);
    }
}

/*
 * This function is used for sending mail
 * @param arrays : mail_array and attachment_array
 * @param strings : cc and bcc optional
 * @return Boolean TRUE||FALSE
 */

if (!function_exists('send_email'))
{
	function send_email(&$mail_config, &$attachment_file = array(), $cc='', $bcc='') //$to, $from, $from_name, $subject, $message,
	{
		$CI = & get_instance();
		$CI->load->library('email');
		$CI->email->clear();
		
		$to		= $mail_config['to'];
		$from		= $mail_config['from'];
		$from_name	= $mail_config['from_name'];
		$subject	= $mail_config['subject'];
		$message	= $mail_config['message'];
		$config['mailtype']='html';
		$CI->email->initialize($config);
		$CI->email->to($to);
		$CI->email->from($from, $from_name);
		$CI->email->subject($subject);
		$CI->email->message($message);
		
		if($cc != '') {
			$CI->email->cc($cc);
		}
		
		if($bcc != '') {
			$CI->email->bcc($bcc);
		}
		
		if(is_array($attachment_file)) {
			$attach_file_path = '';
			for($a=0;$a<count($attachment_file);$a++)
			{
				$attach_file_path = $attachment_file[$a];
				$CI->email->attach($attach_file_path);
			}
		}
		
		$i_email = $CI->email->send();
		
		return $i_email;
	}
}

/*
 * This function is used for file upload
 * @param array : upload_array
 * @return String 
 */
if (!function_exists('file_upload'))
{
	function file_upload(&$file_upload_config)
	{
		$CI = & get_instance();
		$CI->load->library('Upload');
		
		$field_name 		= $file_upload_config['field_name'];
		$file_upload_path 	= $file_upload_config['file_upload_path'];
		$max_size 		= $file_upload_config['max_size'];
		$allowed_types 		= $file_upload_config['allowed_types'];
		
		$config['upload_path'] 	= FILE_UPLOAD_ABSOLUTE_PATH.$file_upload_path;
		
		if($allowed_types != '')
		{
			$config['allowed_types'] 	= $allowed_types;
		}
		
		if($max_size != '')
		{
			$config['max_size']		= $max_size;
		}
		
		if(isset($file_upload_config['encrypt_name']))
		{
			$config['encrypt_name']		= $file_upload_config['encrypt_name'];
		}
		else
		{
			$config['encrypt_name']		= true;
		}
		
		$uploaded_file_name = '';
		$CI->upload->set_config($config);
		$i_upload = $CI->upload->do_upload($field_name,true);
		
		$CI->session->set_userdata('upload_err',$CI->upload->display_errors());
		
		echo $data['upload_err'] = $CI->upload->display_errors();
		
		if($i_upload) {
			$uploaded_file_name = $CI->upload->file_name;
			
		} 
		return $uploaded_file_name;
	}
}

/*
 * This function is used for image upload
 * @param arrays : upload_array and thumb_array
 * allowed_types, encrypt_name
 * @return String 
 */
if (!function_exists('image_upload'))
{
	function image_upload(&$upload_config, &$thumb_config,$diff_url='')
	{
		$CI = & get_instance();
		
		$CI->load->library('Upload');
		
		$field_name 		= $upload_config['field_name'];
		$file_upload_path 	= $upload_config['file_upload_path'];
		if(isset($upload_config['max_size']))
			$max_size 		= $upload_config['max_size'];
		else
			$max_size 		= '';
		if(isset($upload_config['max_width']))
			$max_width 		= $upload_config['max_width'];
		else
			$max_width 		= '';
		if(isset($upload_config['max_height']))
			$max_height 		= $upload_config['max_height'];
		else
			$max_height 		= '';
		
		
		$allowed_types 		= $upload_config['allowed_types'];
		$thumb_create 		= $thumb_config['thumb_create'];
		$thumb_file_upload_path = $thumb_config['thumb_file_upload_path'];
		$thumb_width 		= $thumb_config['thumb_width'];
		$thumb_height 		= $thumb_config['thumb_height'];
		
		if($diff_url != '')
			$config['upload_path'] 	= $diff_url.$file_upload_path;
		else	
			$config['upload_path'] 	= FILE_UPLOAD_ABSOLUTE_PATH.$file_upload_path;
		
		
		if($allowed_types != '') {
			$config['allowed_types'] 	= $allowed_types;
		}
		
		if($max_size != '') {
			$config['max_size']		= $max_size;
		} else {
			$config['max_size']		= '';
		}
		
		if($max_width != '') {
			$config['max_width']		= $max_width;
		} else {
			$config['max_width']		= '';
		}
		
		if($max_height != '') {
			$config['max_height']		= $max_height;
		} else {
			$config['max_height']		= '';
		}
		
		if(isset($upload_config['encrypt_name'])) {
			$config['encrypt_name']		= $upload_config['encrypt_name'];
		} else {
			$config['encrypt_name']		= true;
		}
                
		if(isset($upload_config['thumb_marker'])){
			$config['thumb_marker'] = $upload_config['thumb_marker'];
		} else {
			$config['thumb_marker'] = '';
		}
		
		$uploaded_file_name = '';
		$CI->upload->set_config($config);
		$i_upload = $CI->upload->do_upload($field_name,true);
		
		$CI->session->set_userdata('upload_err',$CI->upload->display_errors());
		
		$data['upload_err'] = $CI->upload->display_errors();
		//echo $data['upload_err'];
		//die();
		
		if($i_upload) {
			$uploaded_file_name = $CI->upload->file_name;
			if($thumb_create) {
				if($diff_url != '')
				{
					$config['source_image'] 	= $diff_url.$file_upload_path.$uploaded_file_name;
				}
				else
				{
					$config['source_image']		= FILE_UPLOAD_ABSOLUTE_PATH.$file_upload_path.$uploaded_file_name;
				}
				
				if($diff_url != '')
				{
					$config['new_image'] 		= $diff_url.$file_upload_path.$thumb_file_upload_path.$uploaded_file_name;
				}
				else
				{
					$config['new_image'] 		= FILE_UPLOAD_ABSOLUTE_PATH.$file_upload_path.$thumb_file_upload_path.$uploaded_file_name;
				}
				
				$config['create_thumb'] 	= TRUE;
				$config['maintain_ratio']	= TRUE;
				$config['width']	 	= $thumb_width;
				$config['height']		= $thumb_height;
				
				$CI->load->library('image_lib', $config); 
				$CI->image_lib->resize();
				
				//echo $CI->upload->display_errors();exit;

			}
			else {
				//return true;
			}
		} else {
			return false;
		}
		return $uploaded_file_name;
	}
}

/* This function is used for Download File
 * @param strings : file_name_path, original_file_name
 * @return NULL
*/
if (!function_exists('file_download'))
{
	function file_download($file_name_path, $original_file_name='') 
	{
		if(isset($original_file_name)) {
			$file_name = $original_file_name;
		} else {
			$file_name = $file_name_path;
		}
		$mime = 'application/force-download';
		header('Pragma: public');    
		header('Expires: 0');        
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Cache-Control: private',false);
		header('Content-Type: '.$mime);
		header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
		header('Content-Transfer-Encoding: binary');
		header('Connection: close');
		readfile($file_name_path);
		return true;
		
	}
}

/* This function is used for creation of PDF
 * @param  strings : view_file_name, output_file_name_path, output_option,
 * landscape_portrait and paper_size
 * @return NULL
 */
if (!function_exists('generate_pdf'))
{
	function generate_pdf($view_file_name, $output_file_name_path='', $output_option, $landscape_portrait='', $paper_size='')
	{
		$CI = & get_instance();
		$CI->load->library('pdf');
		
		// set document information
		$CI->pdf->SetAuthor('Author');
		$CI->pdf->SetTitle('Title');
		$CI->pdf->SetSubject('Subject');
		$CI->pdf->SetKeywords('keywords');
		
		// set font
		$CI->pdf->SetFont('helvetica', 'N', 6);
		
                $CI->pdf->setPrintHeader(false);
		$CI->pdf->setPrintFooter(false);
                
                // add a page
                if($landscape_portrait != '' && $paper_size != '')
                {
			// set default monospaced font
			$CI->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			// set margins
			//$CI->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$CI->pdf->SetMargins(10, 10, 10);
			// set auto page breaks
			$CI->pdf->SetAutoPageBreak(TRUE, 0);
			$CI->pdf->AddPage($landscape_portrait, $paper_size);
                }
                else
                {
                    $CI->pdf->AddPage();
                }
		
		// write html on PDF
		$CI->pdf->writeHTML($view_file_name, true, false, true, false, '');
		ob_clean();
		
		//Close and output PDF document
		$CI->pdf->Output($output_file_name_path, $output_option);
	}
}

/* This function is used for removing special character
 * @param  String
 * @return String
 */
if (!function_exists('removeSpecialChar'))
{
	function removeSpecialChar($psString)
	{
            return preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%-]/s', '', $psString);
	}
}

/* This function is used for creating thumbnail
 * @param  String
 * @return String
 */
if (!function_exists('image_thumbnail'))
{
	function image_thumbnail($source_image, $new_image, $width, $height, $maintain_ratio = TRUE)
	{
		$config['image_library']	= 'gd2';
		$config['source_image']		= $source_image;
		$config['new_image'] 		= $new_image;
		$config['create_thumb'] 	= FALSE;
		$config['maintain_ratio']	= $maintain_ratio;
		$config['width']	 	= $width;
		$config['height']		= $height;
		
		$CI = & get_instance();
		$CI->load->library('image_lib');
		
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		$CI->image_lib->clear();
    
		return true;
	}
}


if(!function_exists('distance_from_arr')){
	function distance_from_arr($cur = ''){
		$arr =  array('1 minute walking','2 minutes walking','3 minutes walking','5 minutes walking','7 minutes walking','10 minutes walking','15 minutes walking','20 minutes walking','25 minutes walking','30 minutes walking','1 minute driving','2 minutes driving','3 minutes driving','4 minutes driving','5 minutes driving','7 minutes driving','10 minutes driving','15 minutes driving','20 minutes driving','25 minutes driving','30 minutes driving','35 minutes driving','40 minutes driving','45 minutes driving','50 minutes driving','55 minutes driving','Over 1 hour driving');
		$str = '';
		$sel = '';
		foreach($arr as $val){
			if($val == $cur)
				$sel = 'selected="selected"';
				
			$str .='<option value="'.$val.'" '.$sel.'> '.$val.' </option>';
			$sel = '';
		}
		return $str;
	}
}

if(!function_exists('array_sort_by_column')){
	function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
	    $sort_col = array();
	    foreach ($arr as $key=> $row) {
		$sort_col[$key] = $row[$col];
	    }	
	    array_multisort($sort_col, $dir, $arr);
	}
}

function chk_login(){
	$CI = & get_instance();
	$admin_id = $CI->nsession->userdata('admin_id');
	if( !$admin_id || empty($admin_id) )
	{
		redirect(base_url());
		return false;
	}
	return true;
}

function chk_not_login(){
	$CI = & get_instance();
	$admin_id = $CI->nsession->userdata('admin_id');
	if( $admin_id && $admin_id != '' )
	{
		redirect(base_url()."dashboard");
		return false;
	}
	return true;
}