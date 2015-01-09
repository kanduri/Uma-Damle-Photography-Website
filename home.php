<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>	
<script type="text/JavaScript" src="home.js"></script> 	
<link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>

<?php
/** SET NAME OF FOLDER HERE **/
$images_dir = 'home/';

/** generate photo gallery **/
$image_files = get_files($images_dir);
if(count($image_files)) {
	$index = 0;
	echo '<div id="slider">';
	echo "\r\n";

	echo "\r\n";
	echo '<a href="#" class="control_next"> > &nbsp;</a>';
	echo "\r\n";
	echo '<a href="#" class="control_prev"><</a>';
	echo "\r\n";
	echo '<ul>';
	foreach($image_files as $index=>$file) {
		$index++;
		$image = $images_dir.$file;

		echo '<div class="slide-link">';
		echo "\r\n";		
		echo '<li><img src="',$image,'" /></li>';
		echo "\r\n";
		echo '</div>';
		echo "\r\n";
	}
	echo '</ul>';
	echo '</div>';
	echo "\r\n";
}
else {
	echo '<p>There are no images in this gallery.</p>';
	echo "\r\n";
}

/* function:  returns files from dir */
function get_files($images_dir,$exts = array('jpg')) {
	$files = array();
	if($handle = opendir($images_dir)) {
		while(false !== ($file = readdir($handle))) {
			$extension = strtolower(get_file_extension($file));
			if($extension && in_array($extension,$exts)) {
				$files[] = $file;
			}
		}
		closedir($handle);
	}
	return $files;
}

/* function:  returns a file's extension */
function get_file_extension($file_name) {
	return substr(strrchr($file_name,'.'),1);
}
?>

/* Navigation Elements Begin */

<div id="container2">
</div>
<div id="container3">
    <div class="box">
        <div id="logo" class="box">
            <img src="/udp/images/logo.png"></img>
        </div>
        <div id="menu" class="box">
            <ul>
                <li><a href="#">fashion</a></li>
                <li><a href="#">food</a></li>
                <li><a href="#">portrait</a></li>
                <li><a href="#">film</a></li>
                <li><a href="#">wedding</a></li>

            </ul>
        </div>
    </div>
    <div id="menu" class="box">
        <ul>
            <li><a href="#" class="current">home</a></li>
            <li><a href="#">about</a></li>
            <li><a href="#">contact</a></li>
        </ul>
    </div>    
    
</div>
</body>
</html>