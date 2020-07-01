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
