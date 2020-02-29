
<?php
require_once('../model/database/DbOperations.php');
session_start();

/*********************************************************************
     Purpose            : update image.
     Parameters         : null
     Returns            : integer
     ***********************************************************************/
	 $post = isset($_POST) ? $_POST: array();
	 if (isset($_SESSION['defaultPassword'])){
	 	if (strcmp($_SESSION['defaultPassword'],"defaultPassword") === 0){
	 		$post['action']='changePassword';
	 	}
	 	else {
	 		
	 		
	 	}
	 	
	 }
	 else {
	 	
	 	
	 }
	 //print_R($post);die;
	 switch($post['action']) {
	  case 'save' :
		saveAvatarTmp();
		break;
		
	  case 'changePassword' :
	  	$oldPassword=filter_input(INPUT_POST, 'oldPassword');
	  	$newPassword=filter_input(INPUT_POST, 'newPassword');
	  	$confirmPassword=filter_input(INPUT_POST, 'confirmPassword');
	  	$username=$_SESSION['username'];
	  	//echo "change ps $newPassword $oldPassword $confirmPassword $username";
	  	//$error_message="<div class=\"alert alert-success\"><strong>Success!</strong> Indicates a successful or positive action.</div>";
	  	$error_message="";
	  	$error_message_passwordmatch="<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
    <strong>Error!</strong> New password should match Confirm password.
</div>";
	  	
	  	$error_message_oldpasswordmatch="<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
    <strong>Error!</strong> Old password should match our record.
</div>";
	  	
	  	$error_message_update_Error="<div class=\"alert alert-danger fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
    <strong>Error!</strong> An error occurred while saving your password.
</div>";
	  	
	  	$error_message_success="<div class=\"alert alert-success fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
    <strong>Success!</strong> Your Password was changed successfully.
</div>";
	  	
	  	$dbOperation= new DbOperation();
	  	$oldPasswordInDb=$dbOperation->oldPasswordInDb($username);
	  	$oldPasswordHashed=md5($username.$oldPassword);
	  	if(strcmp($oldPasswordInDb,$oldPasswordHashed) != 0){
	  		$error_message.=$error_message_oldpasswordmatch;
	  	}else {
	  		
	  		if (strcmp($newPassword, $confirmPassword) != 0){
	  			$error_message.=$error_message_passwordmatch;
	  			
	  		}else {
	  			$newHashedPassword=md5($username.$newPassword);
	  			$saving_status=$dbOperation->changePassword($newHashedPassword, $username);
	  			
	  			if ($saving_status > 0){
	  				$error_message.=$error_message_success;
	  				$_SESSION['defaultPassword']=null;
	  				
	  			}else {
	  				$error_message.=$error_message_update_Error;
	  			}
	  			//echo $newHashedPassword;
	  			
	  		}
	  	}
	  	if (isset($_SESSION['defaultPassword'])){
	  		if (strcmp($_SESSION['defaultPassword'],"defaultPassword") === 0){
	  			include('p.php');
	  		}
	  		else {
	  			include('profile.php');
	  		}
	  		
	  	}
	  	else {
	  	include('profile.php');
	  	}
	  	break;
	  	
	  default:
		changeAvatar();
		
	 }
	
	 function changeAvatar() {
        $post = isset($_POST) ? $_POST: array();
        $max_width = "500"; 
        $userId = isset($post['hdn-profile-id']) ? intval($post['hdn-profile-id']) : 0;
        $path = '../images/profile';
        $valid_formats =array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/x-png'=>"png",'image/gif'=>"gif");
       // $valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
        $name = $_FILES['photoimg']['name'];
        $size = $_FILES['photoimg']['size'];
        if(strlen($name))
        {
        list($txt, $ext) = explode(".", $name);
        if(in_array($ext,$valid_formats))
        {
        if($size<(1024*1024)) // Image size max 1 MB
        {
        	//$actual_image_name = 'avatar' .'_'.$userId .'.'.$ext;
        	$actual_image_name = $_SESSION['username'].'.'.$ext;
        $filePath = $path .'/'.$actual_image_name;
        $tmp = $_FILES['photoimg']['tmp_name'];
        
        if(move_uploaded_file($tmp, $filePath))
        {
        $width = getWidth($filePath);
            $height = getHeight($filePath);
            //Scale the image if it is greater than the width set above
            if ($width > $max_width){
                $scale = $max_width/$width;
                $uploaded = resizeImage($filePath,$width,$height,$scale);
            }else{
                $scale = 1;
                $uploaded = resizeImage($filePath,$width,$height,$scale);
            }
        /*$res = saveAvatar(array(
                        'userId' => isset($userId) ? intval($userId) : 0,
                                                'avatar' => isset($actual_image_name) ? $actual_image_name : '',
                        ));*/
                        
        //mysql_query("UPDATE users SET profile_image='$actual_image_name' WHERE uid='$session_id'");
        
           
        
        echo "<img id='photo' file-name='".$actual_image_name."' class='' src='".$filePath.'?'.time()."' class='preview'/>";
        }
        else
        echo "failed";
        }
        else
        echo "Image file size max 1 MB"; 
        }
        else
        echo "Invalid file format.."; 
        }
        else
        echo "Please select image..!";
        exit;
        
        
    }
    /*********************************************************************
     Purpose            : update image.
     Parameters         : null
     Returns            : integer
     ***********************************************************************/
     function saveAvatarTmp() {
        $post = isset($_POST) ? $_POST: array();
        $userId = isset($post['id']) ? intval($post['id']) : 0;
        $path ='\\images\uploads\tmp';
        $t_width = 300; // Maximum thumbnail width
        $t_height = 300;    // Maximum thumbnail height
		
        //previous
        
   /*  if(isset($_POST['t']) and $_POST['t'] == "ajax")
    {
        extract($_POST);
        
        //$img = get_user_meta($userId, 'user_avatar', true);
        $imagePath = 'images/tmp/'.$_POST['image_name'];
        $ratio = ($t_width/$w1); 
        $nw = ceil($w1 * $ratio);
        $nh = ceil($h1 * $ratio);
        $nimg = imagecreatetruecolor($nw,$nh);
        $im_src = imagecreatefromjpeg($imagePath);
        imagecopyresampled($nimg,$im_src,0,0,$x1,$y1,$nw,$nh,$w1,$h1);
        imagejpeg($nimg,$imagePath,90);
        
    } */
        
        //johnson edit
        
        if(isset($_POST['t']) and $_POST['t'] == "ajax")
        {
        	extract($_POST);
        	
        	//$img = get_user_meta($userId, 'user_avatar', true);
        	$imagePath = '../images/profile/'.$_POST['image_name'];
        	$ratio = ($t_width/$w1);
        	$nw = ceil($w1 * $ratio);
        	$nh = ceil($h1 * $ratio);
        	$nimg = imagecreatetruecolor($nw,$nh);
        	
        	//herr
        	list($imagewidth, $imageheight, $imageType) = getimagesize($imagePath);
        	$imageType = image_type_to_mime_type($imageType);
        	switch($imageType) {
        		case "image/gif":
        			$im_src=imagecreatefromgif($imagePath);
        			break;
        		case "image/pjpeg":
        		case "image/jpeg":
        		case "image/jpg":
        			$im_src=imagecreatefromjpeg($imagePath);
        			break;
        		case "image/png":
        		case "image/x-png":
        			$im_src=imagecreatefrompng($imagePath);
        			break;
        	}
        	
        	//i comment
        	//$im_src = imagecreatefromjpeg($imagePath);
        	imagecopyresampled($nimg,$im_src,0,0,$x1,$y1,$nw,$nh,$w1,$h1);
        	
        	//then here
        	switch($imageType) {
        		case "image/gif":
        			imagegif($nimg,$imagePath);
        			break;
        		case "image/pjpeg":
        		case "image/jpeg":
        		case "image/jpg":
        			imagejpeg($nimg,$imagePath,90);
        			break;
        		case "image/png":
        		case "image/x-png":
        			imagepng($nimg,$imagePath);
        			break;
        	}
        	
        	
        	
        }
        
        //save new profile picture in db
        
        $dbOperation= new DbOperation();
        $profile_picture="images/profile/".$_POST['image_name'];
        $username=$_SESSION['username'];
      
        $saving_status=$dbOperation->changeProfilePicture($profile_picture, $username);
        $_SESSION['profile_picture']=$profile_picture;
    echo $imagePath.'?'.time();;
    //header('Location: admin');
    exit(0);  
   
    }
    
    /*********************************************************************
     Purpose            : resize image.
     Parameters         : null
     Returns            : image
     ***********************************************************************/
    
    //johnson try
    
    function resizeImage($image,$width,$height,$scale) {
    	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
    	$imageType = image_type_to_mime_type($imageType);
    	$newImageWidth = ceil($width * $scale);
    	$newImageHeight = ceil($height * $scale);
    	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
    	switch($imageType) {
    		case "image/gif":
    			$source=imagecreatefromgif($image);
    			break;
    		case "image/pjpeg":
    		case "image/jpeg":
    		case "image/jpg":
    			$source=imagecreatefromjpeg($image);
    			break;
    		case "image/png":
    		case "image/x-png":
    			$source=imagecreatefrompng($image);
    			break;
    	}
    	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
    	
    	switch($imageType) {
    		case "image/gif":
    			imagegif($newImage,$image);
    			break;
    		case "image/pjpeg":
    		case "image/jpeg":
    		case "image/jpg":
    			imagejpeg($newImage,$image,90);
    			break;
    		case "image/png":
    		case "image/x-png":
    			imagepng($newImage,$image);
    			break;
    	}
    	
    	chmod($image, 0777);
    	return $image;
    }
    
    
    
    
    
    
 /*    function resizeImage($image,$width,$height,$scale) {
    $newImageWidth = ceil($width * $scale);
    $newImageHeight = ceil($height * $scale);
    $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
    $source = imagecreatefromjpeg($image);
    imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
    imagejpeg($newImage,$image,90);
    chmod($image, 0777);
    return $image;
} */
    
    
    
    
/*********************************************************************
     Purpose            : get image height.
     Parameters         : null
     Returns            : height
     ***********************************************************************/
function getHeight($image) {
    $sizes = getimagesize($image);
    $height = $sizes[1];
    return $height;
}
/*********************************************************************
     Purpose            : get image width.
     Parameters         : null
     Returns            : width
     ***********************************************************************/
function getWidth($image) {
    $sizes = getimagesize($image);
    $width = $sizes[0];
    return $width;
}
?>
