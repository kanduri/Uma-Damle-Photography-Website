<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script type="text/JavaScript" src="home.js"></script> 	
<link rel="stylesheet" href="style.css" type="text/css"/>
<title>Uma Damle Photography</title>

</head>
<body class="home">

<?php
/** SET NAME OF FOLDER HERE **/
$images_dir = 'home/';

/** generate photo gallery **/
$image_files = get_files($images_dir);
if(count($image_files)) {
	$index = 0;
	echo '<div class="fadein">';
	echo "\r\n";

	foreach($image_files as $index=>$file) {
		$index++;
		$image = $images_dir.$file;

		echo '<img src="',$image,'" />';

	}
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

<!-- /* Navigation Elements Begin */ -->


<?php include 'navigation.php';?>