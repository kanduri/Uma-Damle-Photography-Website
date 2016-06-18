<?php

$images_dir = $page_name.'/';
$thumbs_dir = 'thumbs/'.$page_name.'/';
$slideview_page = $page_name.'_slideview.php';
$thumbnail_page = $page_name.'_thumbnails.php';

echo '
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="jquery.unveil.js"></script>
<script>
    $(function() {
        $("li img").unveil(300);
    });
</script>';

echo '<body class="',$page_name,'">';

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
		echo '<a name="',$index,'" href="',$images_dir.$file,'" rel="gallery"><img src="',$image,'" /></a>';
		echo "\r\n";
		echo '</div>';
		echo "\r\n";

	}
	echo '</div>';
	echo "\r\n";

	echo '<div id="container2">
	<div id="display-mode">
		<ul>
			<li><a href="',$slideview_page,'" class="current">Slideview</a></li>
			<li> | </li>
			<li><a href="',$thumbnail_page,'">Thumbnails</a></li>
		</ul>
	</div>
</div>
';

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
