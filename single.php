<?php

get_header();

$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>


	<?php
		if ( et_builder_is_product_tour_enabled() ):
			// load fullwidth page in Product Tour mode
			while ( have_posts() ): the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
					<div class="entry-content">
					

					<?php
						the_content();
					?>
					</div> <!-- .entry-content -->

				</article> <!-- .et_pb_post -->

		<?php endwhile;
		else:
	?>
	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
				<div id="main-content">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				/**
				 * Fires before the title and post meta on single posts.
				 *
				 * @since 3.18.8
				 */
				do_action( 'et_before_post' );
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
					<?php if ( ( 'off' !== $show_default_title && $is_page_builder_used ) || ! $is_page_builder_used ) { ?>
						<div class="et_post_meta_wrapper">
							<h1 class="entry-title"><?php the_title(); ?></h1>

						<?php
							if ( ! post_password_required() ) :

								et_divi_post_meta();

								$thumb = '';

								$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

								$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
								$classtext = 'et_featured_image';
								$titletext = get_the_title();
								$alttext = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
								$thumbnail = get_thumbnail( $width, $height, $classtext, $alttext, $titletext, false, 'Blogimage' );
								$thumb = $thumbnail["thumb"];

								$post_format = et_pb_post_format();

								if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) {
									printf(
										'<div class="et_main_video_container">
											%1$s
										</div>',
										et_core_esc_previously( $first_video )
									);
								} else if ( ! in_array( $post_format, array( 'gallery', 'link', 'quote' ) ) && 'on' === et_get_option( 'divi_thumbnails', 'on' ) && '' !== $thumb ) {
									print_thumbnail( $thumb, $thumbnail["use_timthumb"], $alttext, $width, $height );
								} else if ( 'gallery' === $post_format ) {
									et_pb_gallery_images();
								}
							?>

							<?php
								$text_color_class = et_divi_get_post_text_color();

								$inline_style = et_divi_get_post_bg_inline_style();

								switch ( $post_format ) {
									case 'audio' :
										$audio_player = et_pb_get_audio_player();

										if ( $audio_player ) {
											printf(
												'<div class="et_audio_content%1$s"%2$s>
													%3$s
												</div>',
												esc_attr( $text_color_class ),
												et_core_esc_previously( $inline_style ),
												et_core_esc_previously( $audio_player )
											);
										}

										break;
									case 'quote' :
										printf(
											'<div class="et_quote_content%2$s"%3$s>
												%1$s
											</div> <!-- .et_quote_content -->',
											et_core_esc_previously( et_get_blockquote_in_content() ),
											esc_attr( $text_color_class ),
											et_core_esc_previously( $inline_style )
										);

										break;
									case 'link' :
										printf(
											'<div class="et_link_content%3$s"%4$s>
												<a href="%1$s" class="et_link_main_url">%2$s</a>
											</div> <!-- .et_link_content -->',
											esc_url( et_get_link_url() ),
											esc_html( et_get_link_url() ),
											esc_attr( $text_color_class ),
											et_core_esc_previously( $inline_style )
										);

										break;
								}

							endif;
						?>
					</div> <!-- .et_post_meta_wrapper -->
				<?php  } ?>

					<div class="entry-content">
						<div class="fiyat">
							
						</div><?php if ( is_singular( 'dukkanlar', 'daire' ) ); { ?>
<h3>Fiyat:<?php the_field('fiyat'); ?></h3>
						<?php } ?> </div>
					<?php
    //Get the images ids from the post_metadata
    $images = acf_photo_gallery('galeri', $post->ID);
    //Check if return array has anything in it
    if( count($images) ):
        //Cool, we got some data so now let's loop over it
        foreach($images as $image):
            $id = $image['id']; // The attachment id of the media
            $title = $image['title']; //The title
            $caption= $image['caption']; //The caption
            $full_image_url= $image['full_image_url']; //Full size image url
            $full_image_url = acf_photo_gallery_resize_image($full_image_url, 1024, 768); //Resized size to 262px width by 160px height image url
            $thumbnail_image_url= $image['thumbnail_image_url']; //Get the thumbnail size image url 150px by 150px
			$thumbnail_image_url = acf_photo_gallery_resize_image($thumbnail_image_url, 200, 200);
            $url= $image['url']; //Goto any link when clicked
            $target= $image['target']; //Open normal or new tab
            $alt = get_field('photo_gallery_alt', $id); //Get the alt which is a extra field (See below how to add extra fields)
            $class = get_field('photo_gallery_class', $id); //Get the class which is a extra field (See below how to add extra fields)
?>
<div class="col-xs-6 col-md-3">
    <div class="thumbnail">
        <?php if( !empty($url) ){ ?><a href="<?php echo $url; ?>" <?php echo ($target == 'true' )? 'target="_blank"': ''; ?>><?php } ?>
            <a href="<?php echo $full_image_url; ?>" class="fancybox">
                <img src="<?php echo $thumbnail_image_url; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>">
            </a>
        <?php if( !empty($url) ){ ?></a><?php } ?>
    </div>
</div>
<?php endforeach; endif; ?>

<?php if ( is_singular( 'daire' ) ) { ?>		
<div class="ozel_alanlar1">
<ul>
<li><strong>Oda Sayısı:</strong> <?php the_field('oda_sayisi'); ?></li>
<li><strong>Metrekare:</strong> <?php the_field('metrekare'); ?></li>
<li><strong>Emlak Durumu:</strong> <?php the_field('emlak_durumu'); ?></li>
<li><strong>Bina Yaşı:</strong> <?php the_field('bina_yasi'); ?></li>
<li><strong>Bulunduğu Kat:</strong> <?php the_field('bulundugu_kat'); ?></li>
<li><strong>Eşyalı:</strong> <?php the_field('esyali'); ?></li>
<li><strong>Banyo Sayısı:</strong> <?php the_field('banyo_sayisi'); ?></li>
<li><strong>Balkon:</strong> <?php the_field('balkon'); ?></li>	
</div>
<div class="ozel_alanlar2">	
<li><strong>Isınma Tipi:</strong> <?php the_field('isinma_tipi'); ?></li>
<li><strong>Kat Sayısı:</strong> <?php the_field('kat_sayisi'); ?></li>
<li><strong>Krediye Uygunluk:</strong> <?php the_field('krediye_uygunluk'); ?></li>
<li><strong>Bina Cephesi:</strong> <?php the_field('bina_cephesi'); ?></li>
<li><strong>Kullanım Durumu:</strong> <?php the_field('kullanim_durumu'); ?></li>
<li><strong>Site İçerisinde:</strong> <?php the_field('site_icerisinde'); ?></li>
<li><strong>Aidat:</strong> <?php the_field('aidat'); ?></li>	
</ul>	
</div>
	
						
<?php } ?>
						
<?php if ( is_singular( 'dukkanlar' ) ) { ?>		
<div class="ozel_alanlar1">
<ul>
<li><strong>Bölüm Sayısı:</strong> <?php the_field('bolum_sayisi'); ?></li>
<li><strong>Metrekare:</strong> <?php the_field('metrekare'); ?></li>
<li><strong>Emlak Durumu:</strong> <?php the_field('emlak_durumu'); ?></li>
<li><strong>Bina Yaşı:</strong> <?php the_field('bina_yasi'); ?></li>
<li><strong>Bulunduğu Kat:</strong> <?php the_field('bulundugu_kat'); ?></li>
	</div>
<div class="ozel_alanlar2">	
<li><strong>Isınma Tipi:</strong> <?php the_field('isinma_tipi'); ?></li>
<li><strong>Kat Sayısı:</strong> <?php the_field('kat_sayisi'); ?></li>
<li><strong>Krediye Uygunluk:</strong> <?php the_field('krediye_uygunluk'); ?></li>
<li><strong>Bina Cephesi:</strong> <?php the_field('bina_cephesi'); ?></li>
</ul>
</div>
</div>
						
<?php } ?>						

					<?php
						do_action( 'et_before_content' );

						the_content();

						wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->
					<div class="et_post_meta_wrapper">
					<?php
					if ( et_get_option('divi_468_enable') === 'on' ){
						echo '<div class="et-single-post-ad">';
						if ( et_get_option('divi_468_adsense') !== '' ) echo et_core_intentionally_unescaped( et_core_fix_unclosed_html_tags( et_get_option('divi_468_adsense') ), 'html' );
						else { ?>
							<a href="<?php echo esc_url(et_get_option('divi_468_url')); ?>"><img src="<?php echo esc_attr(et_get_option('divi_468_image')); ?>" alt="468" class="foursixeight" /></a>
				<?php 	}
						echo '</div> <!-- .et-single-post-ad -->';
					}

					/**
					 * Fires after the post content on single posts.
					 *
					 * @since 3.18.8
					 */
					do_action( 'et_after_post' );

						if ( ( comments_open() || get_comments_number() ) && 'on' === et_get_option( 'divi_show_postcomments', 'on' ) ) {
							comments_template( '', true );
						}
					?>
					</div> <!-- .et_post_meta_wrapper -->
				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>
			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->
	<?php endif; ?>
</div> <!-- #main-content -->

<?php

get_footer();
