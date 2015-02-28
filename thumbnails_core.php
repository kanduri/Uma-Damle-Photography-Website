
<?php
$images_dir = $page_name.'/';
$thumbs_dir = $page_name.'-thumbs/';
$slideview_page = $page_name.'_slideview.php';
$thumbnail_page = $page_name.'_thumbnails.php';
echo '<body class="',$page_name,'">';

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
		//For linking Directly to file
		//echo '<a href="',$images_dir.$file,'" class="photo-link" rel="gallery"><img src="',$thumbnail_image,'" /></a>';
		//For linking to the image in the slideview mode
		echo '<a href="',$slideview_page,'#',$index,'" class="photo-link" rel="gallery"><img src="',$thumbnail_image,'" /></a>';
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

	echo '<div id="container2">
	<div id="display-mode">
		<ul>
			<li><a href="',$slideview_page,'">Slideview</a></li>
			<li> | </li>
			<li><a href="',$thumbnail_page,'" class="current">Thumbnails</a></li>
		</ul>
	</div>
</div>
';

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
