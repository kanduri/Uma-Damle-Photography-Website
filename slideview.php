<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>

<?php
/** settings **/
$images_dir = 'fashion/';
$thumbs_dir = 'fashion-thumbs/';
/*
$images_dir = 'preload-images/';
$thumbs_dir = 'preload-images-thumbs/';
*/
$thumbs_width = 360;
$num_col = 3;

/** generate photo gallery **/
$image_files = get_files($images_dir);
if(count($image_files)) {
	$index = 0;
	echo '<div id="container">';
	echo "\r\n";
	foreach($image_files as $index=>$file) {
		$index++;
		$image = $images_dir.$file;
		echo '<div class="slide-link">';
		echo "\r\n";
		echo '<a href="',$images_dir.$file,'" rel="gallery"><img src="',$image,'" /></a>';
		echo "\r\n";
		echo '</div>';
		echo "\r\n";

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

/* Navigation Elements Begin */

<div id="container2">
	<div id="display-mode">
		<ul>
			<li><a href="slideview.php" class="current">Slideview</a></li>
			<li> | </li>
			<li><a href="thumbnails.php">Thumbnails</a></li>
		</ul>
	</div>
</div>
<div id="container3">
    <div class="box">
        <div id="logo" class="box">
            <img src="/images/logo.png"></img>
        </div>
        <div id="menu" class="box">
            <ul>
                <li><a href="#" class="current">fashion</a></li>
                <li><a href="#">food</a></li>
                <li><a href="#">portrait</a></li>
                <li><a href="#">film</a></li>
                <li><a href="#">wedding</a></li>

            </ul>
        </div>
    </div>
    <div id="description" class="box">
        <p>
            Minimalist Comic Book Wallpapers </br>
            View more from this project on <a href="#">Behance</a></br>
            View film from this project on <a href="#">Vimeo</a>
        </p>    
    </div>
    <div id="menu" class="box">
        <ul>
            <li><a href="#">home</a></li>
            <li><a href="#">about</a></li>
            <li><a href="#">contact</a></li>
        </ul>
    </div>    
    <span class="stretch"></span>
</div>
</body>
</html>