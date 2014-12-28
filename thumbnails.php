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
$images_per_row = ceil(count($image_files)/$num_col);
if(count($image_files)) {
	$index = 0;
	$row = 1;
	echo '<div id="container">';
	echo "\r\n";
	echo '<div>';
	echo "\r\n";
	foreach($image_files as $index=>$file) {
		$index++;
		$thumbnail_image = $thumbs_dir.$file;
		if(!file_exists($thumbnail_image)) {
			$extension = get_file_extension($thumbnail_image);
			if($extension) {
				make_thumb($images_dir.$file,$thumbnail_image,$thumbs_width);
			}
		}
		echo '<a href="',$images_dir.$file,'" class="photo-link" rel="gallery"><img src="',$thumbnail_image,'" /></a>';
		echo "\r\n";

		if($index % $images_per_row == 0) { 
			echo '</div>'; 
			echo "\r\n"; 
			$row++; 
			if($row <= 3) {
				echo '<div>'; 
				echo "\r\n";
			} 
		}

	}
	echo '</div>';
	echo "\r\n";
	echo '</div>';
	echo "\r\n";

}
else {
	echo '<p>There are no images in this gallery.</p>';
	echo "\r\n";
}

/* function:  generates thumbnail */
function make_thumb($src,$dest,$desired_width) {
	/* read the source image */
	$source_image = imagecreatefromjpeg($src);
	$xx = imagesx($source_image);
	$yy = imagesy($source_image);
	$x=$desired_width; $y=202; // my final thumb
	$ratio_thumb=$x/$y; // ratio thumb

	$ratio_original=$xx/$yy; // ratio original

	if ($ratio_original>=$ratio_thumb) {
	    $yo=$yy; 
	    $xo=ceil(($yo*$x)/$y);
	    $xo_ini=ceil(($xx-$xo)/2);
	    $xy_ini=0;
	} else {
	    $xo=$xx; 
	    $yo=ceil(($xo*$y)/$x);
	    $xy_ini=ceil(($yy-$yo)/2);
	    $xo_ini=0;
	}
	$thumb_im = imagecreatetruecolor($x, $y);
	imagecopyresampled($thumb_im, $source_image, 0, 0, $xo_ini, $xy_ini, $x, $y, $xo, $yo);
	imagejpeg($thumb_im, $dest, 100);
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
			<li><a href="slideview.php">Slideview</a></li>
			<li> | </li>
			<li><a href="thumbnails.php" class="current">Thumbnails</a></li>
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