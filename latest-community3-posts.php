<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

widget_css();

$icon_url = widget_data_url( $widget_config['code'], 'icon' );

$file_headers = @get_headers($icon_url);

if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
    $icon_url = null;
}

if( $widget_config['title'] ) $title = $widget_config['title'];
else $title = 'no title';

if( $widget_config['forum1'] ) $_bo_table = $widget_config['forum1'];
else $_bo_table = $widget_config['default_forum_id'];


$limit = 4;

$list = g::posts( array(
			"bo_table" 	=>	$_bo_table,
			"limit"		=>	$limit,
			"select"	=>	"idx,domain,bo_table,wr_id,wr_parent,wr_is_comment,wr_comment,ca_name,wr_datetime,wr_hit,wr_good,wr_nogood,wr_name,mb_id,wr_subject,wr_content"
				)
		);	
?>

<div class="community3-posts" >
		<div class='title'>
			<table width='100%'>
				<tr valign='top'>
					<td align='left'>
						<img src="<?=x::url()?>/widget/<?=$widget_config['name']?>/img/my-posts.png">
						<span class='label'><a href='<?=G5_BBS_URL?>/board.php?bo_table=<?=$_bo_table?>'><?=cut_str($title,15,"...")?></a></span>
					</td>
					<td align='right'>
						<div class='posts-more'><a href="<?=g::url()?>/bbs/board.php?bo_table=<?=$_bo_table?>" >자세히</a></div>
					</td>
				</tr>
			</table>
		</div>
	<div class='community3-posts-items'>
		<table cellspacing=0 cellpadding=0 width='100%'>
	<?php
		if( $list ) { 
			$i = 1;
			$no_of_posts = count($list);
			foreach ( $list as $li ) {

				$post_subject = $li['subject'];
				$url = $li['href'];
				$no_comment = '';
				if ( !$comment_count = strip_tags($li['wr_comment']) ) {
					$comment_count = 0;
					$no_comment = 'no-comment';
				}
		?>	
			<tr <? if( $i == $no_of_posts ) echo "class='last-item'"; ?> valign='top'>				
				<?
					?><td width='10' valign='middle'>
						<div class='posts-square'>
							<img src='<?=x::url()?>/widget/<?=$widget_config['name']?>/img/square-icon.png'>
						</div>
						</td>
						<td>
							<a href='<?=$li['url']?>' class='content-community-3'><?=$post_subject?></a>
						</td>
						<td align='right'>
							<span class='no-of-comments $no_comment'>
							[<?=$comment_count?>]
						</span>
						</td>				
				<?$i++;?>
			</tr>	
		<?}
		}
		else {?>
			<tr>
			<td width='10' valign='middle'><div class='posts-square'><img src='<?=x::url()?>/widget/<?=$widget_config['name']?>/img/square-icon.png'></div></td><td width='120'><a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=4' class='content-community-3'>블로그 만들기</a></td><td width='40' align='right'><a href='$url'> <span class='no-of-comments $no_comment'>[99]</span></a></td>
			</tr>
			<tr>
			<td width='10' valign='middle'><div class='posts-square'><img src='<?=x::url()?>/widget/<?=$widget_config['name']?>/img/square-icon.png'></div></td><td width='120'><a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=3' class='content-community-3'>커뮤니티 사이트 만들기</a></td><td width='40' align='right'><a href='$url'> <span class='no-of-comments $no_comment'>[99]</span></a></td>
			</tr>
			<tr>
			<td width='10' valign='middle'><div class='posts-square'><img src='<?=x::url()?>/widget/<?=$widget_config['name']?>/img/square-icon.png'></div></td><td width='120'><a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=3' class='content-community-3'>여행사 사이트 만들기 안내</a></td><td width='40' align='right'><a href='$url'> <span class='no-of-comments $no_comment'>[99]</span></a></td>
			</tr>
			<tr class='last-item'>
			<td width='10' valign='middle'><div class='posts-square'><img src='<?=x::url()?>/widget/<?=$widget_config['name']?>/img/square-icon.png'></div></td><td width='120'><a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=1' class='content-community-3'>(모바일)홈페이지, 스마트폰 앱</a></td><td width='40' align='right'><a href='$url'> <span class='no-of-comments $no_comment'>[99]</span></a></td>
			</tr>
		<?}?>
		</table>
		
	</div>
</div>