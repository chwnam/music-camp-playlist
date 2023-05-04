<?php
/**
 * Playlist template
 *
 * @var string                                $music_icon_url
 * @var string                                $video_icon_url
 * @var array<string, MCPL_Object_Playlist[]> $items
 * @var string                                $next
 * @var string                                $prev
 */
include __DIR__ . '/header.php';

$is_mobile = wp_is_mobile();
?>

<?php if ( $items ): ?>
	<div class="row">
		<div id="calendar" class="col col-12 col-sm-5 col-md-4 col-lg-3 pt-2"></div>
		<div id="playlist" class="col col-12 col-sm-7 col-md-8 col-lg-9">
			<?php foreach ( $items as $date => $daily_playlist ) : ?>
				<?php $d = date_create_immutable( $date ); ?>
				<h5 class="mt-3 mb-2">
					<?php echo esc_html( $d ? $d->format( 'Y년 m월 d일' ) : '' ); ?>
				</h5>
				<ul class="list-unstyled mb-2">
					<?php foreach ( $daily_playlist as $idx => $item ): ?>
						<li>
							<div class="row m-0">
								<div
									class="col-12 col-md-10 col-lg-8 my-1 py-2 border  border-secondary-subtle border-top-0 border-start-0 border-end-0">
									<div class="row">
										<div class="col fs-6 text-primary">
											<small
												title="순서">#<?php echo esc_html( sprintf( '%02d', $idx + 1 ) ); ?></small>
											<span title="곡명"><?php echo esc_html( $item->title ); ?></span>
											- <span title="아티스트 이름"><?php echo esc_html( $item->artist_name ); ?></span>
										</div>
									</div>
									<div class="row justify-content-md-end">
										<div class="col col-8 col-md-5 col-lg-4 col-xl-3 fs-6 mt-2 mt-md-0">
											<div class="d-flex justify-content-between">
												<?php
												$query  = urlencode( sprintf( '%s %s', $item->title, $item->artist_name ) );
												$target = $is_mobile ? '_self' : '_blank';

												$video_search = add_query_arg( 'q', $query, 'https://music.youtube.com/search' );
												$music_search = add_query_arg( 'search_query', $query, 'https://www.youtube.com/results' );
												?>

												<a href="<?php echo esc_url( $video_search ); ?>"
												   class="text-decoration-none link-danger"
												   target="<?php echo esc_attr( $target ); ?>">
													<img src="<?php echo esc_url( $video_icon_url ); ?>" alt="유튜브 아이콘"
													     class="yt-icon"/>
													<small>검색</small>
												</a>

												<a href="<?php echo esc_url( $music_search ); ?>"
												   class="text-decoration-none link-danger"
												   target="<?php echo esc_attr( $target ); ?>">
													<img src="<?php echo esc_url( $music_icon_url ); ?>"
													     alt="유튜브 뮤직 아이콘"
													     class="yt-icon"/>
													<small>검색</small>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
				<div class="col-12 col-md-10 col-lg-8 d-flex justify-content-between mb-5 px-4">
					<?php if ( $next ) : ?>
						<a href="<?php echo esc_url( add_query_arg( 'date', $next ) ); ?>"
						   class="text-decoration-none">
							다음 날짜
						</a>
					<?php else: ?>
						<span>&nbsp;</span>
					<?php endif; ?>

					<?php if ( $prev ) : ?>
						<a href="<?php echo esc_url( add_query_arg( 'date', $prev ) ); ?>"
						   class="text-decoration-none">
							이전 날짜
						</a>
					<?php else: ?>
						<span>&nbsp;</span>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php else: ?>
	<p>아직 플레이리스트 수집이 되지 않았습니다.</p>
<?php endif; ?>

<?php
include __DIR__ . '/footer.php';
