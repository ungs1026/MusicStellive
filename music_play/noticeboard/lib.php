<?php

/**
 * total : 게시물 총 갯수
 * limit : 한 화면 출력 갯수
 *  page_limit : 출력 페이지 수
 * page : 현 페이지
 */
function My_Pagination($total, $limit, $page_limit, $page, $param)
{
	$total_page = ceil($total / $limit);

	$start_page = ((floor(($page - 1) / $page_limit)) * $page_limit) + 1;
	$end_page = $start_page + $page_limit - 1;

	$prev_page = $start_page - 1;

	$next_page = $end_page + 1;

	if ($end_page > $total_page) {
		$end_page = $total_page;
	}


	if ($prev_page < 1) {
		$prev_page = 1;
	}

?>

	<nav aria-label="Page navigation example">
		<ul class="pagination">
			<li><span onclick="openPage('notice.php?page=1&code=<?= $param ?>')">FIRST</span></li>
			<?php if ($prev_page > 1) {	?>
				<li><span onclick="openPage('notice.php?page=<?= $prev_page ?>&code=<?= $param ?>')">PREV</span></li>
			<?php } ?>
			<?php for ($i = $start_page; $i <= $end_page; $i++) {
				if ($page == $i) { ?>
					<li><span><?= $i ?></span></li>
				<?php } else { ?>
					<li><span onclick="openPage('notice.php?page=<?= $i ?>&code=<?= $param ?>')"><?= $i ?></span></li>
			<?php }
			} ?>

			<?php if ($next_page <= $total_page) { ?>
				<li><span onclick="openPage('notice.php?page=<?= $next_page ?>&code=<?= $param ?>')">NEXT</span></li>
			<?php } ?>
			<li><span onclick="openPage('notice.php?page=<?= $total_page ?>&code=<?= $param ?>')">LAST</span></li>

		</ul>
	</nav>
<?php } ?>