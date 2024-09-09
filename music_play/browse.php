<?php 
include("includes/includedFiles.php");
?>

<div class="mainimg">
	<img src="source/cliche.png" class="b_bg">
	<img src="source/main-img2.png" class="b_bg" id="bg_hidden">
</div>
<h1 class="pageHeadingBig"></h1>

<div class="gridViewContainer">

	<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM albums");

		while($row = mysqli_fetch_array($albumQuery)) {

			echo "<div class='gridViewItem'>
					<span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")''>
						<img src='" . $row['artworkPath'] . "'>

						<div class='gridViewInfo'>"
							. $row['title'] .
						"</div>
					</span>

				</div>";



		}
	?>

</div>
