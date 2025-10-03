<div class="<?php rayforce_print_archive_entry_class('wp-block wp-block-kubio-query-loop-item  position-relative wp-block-kubio-query-loop-item__container rayforce-index__k__QtetVXHJ9I-container rayforce-local-371-container d-flex   '); ?>"" data-kubio="kubio/query-loop-item">
	<div class="position-relative wp-block-kubio-query-loop-item__inner rayforce-index__k__QtetVXHJ9I-inner rayforce-local-371-inner d-flex h-flex-basis h-px-lg-3 v-inner-lg-3 h-px-md-3 v-inner-md-3 h-px-3 v-inner-3">
		<div class="position-relative wp-block-kubio-query-loop-item__align rayforce-index__k__QtetVXHJ9I-align rayforce-local-371-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
			<div class="wp-block wp-block-kubio-post-meta  position-relative wp-block-kubio-post-meta__metaDataContainer rayforce-index__k__in2mlwF4a-metaDataContainer rayforce-local-372-metaDataContainer h-blog-meta" data-kubio="kubio/post-meta">
				<span class="metadata-item">
					<a href="<?php echo esc_url(get_day_link(get_post_time( 'Y' ),get_post_time( 'm' ),get_post_time( 'j' ))); ?>">
						<?php echo esc_html(get_the_date('F j, Y')); ?>
					</a>
				</span>
			</div>
			<a class="position-relative wp-block-kubio-post-title__link rayforce-index__k__tstzQ_uACq-link rayforce-local-373-link d-block" href="<?php echo esc_url(get_the_permalink()); ?>">
				<h4 class="wp-block wp-block-kubio-post-title  position-relative wp-block-kubio-post-title__container rayforce-index__k__tstzQ_uACq-container rayforce-local-373-container" data-kubio="kubio/post-title">
					<?php the_title(); ?>
				</h4>
			</a>
			<p class="wp-block wp-block-kubio-post-excerpt  position-relative wp-block-kubio-post-excerpt__text rayforce-index__k__-hWWlFyCEF-text rayforce-local-374-text" data-kubio="kubio/post-excerpt">
				<?php rayforce_post_excerpt(array (
  'max_length' => 16,
)); ?>
			</p>
			<div class="position-relative wp-block-kubio-read-more-button__spacing rayforce-index__k__7TrnS1SQ70-spacing rayforce-local-375-spacing">
				<span class="wp-block wp-block-kubio-read-more-button  position-relative wp-block-kubio-read-more-button__outer rayforce-index__k__7TrnS1SQ70-outer rayforce-local-375-outer kubio-button-container" data-kubio="kubio/read-more-button">
					<a class="position-relative wp-block-kubio-read-more-button__link rayforce-index__k__7TrnS1SQ70-link rayforce-local-375-link h-w-100 h-global-transition" href="<?php echo esc_url(get_the_permalink()); ?>">
						<span class="position-relative wp-block-kubio-read-more-button__text rayforce-index__k__7TrnS1SQ70-text rayforce-local-375-text kubio-inherit-typography">
							<?php esc_html_e('Read more', 'rayforce'); ?>
						</span>
						<span class="h-svg-icon wp-block-kubio-read-more-button__icon rayforce-index__k__7TrnS1SQ70-icon rayforce-local-375-icon" name="font-awesome/caret-right">
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="caret-right" viewBox="0 0 720.451 1896.0833">
								<path d="M576 896q0 26-19 45l-448 448q-19 19-45 19t-45-19-19-45V448q0-26 19-45t45-19 45 19l448 448q19 19 19 45z"/></svg>
							</span>
						</a>
					</span>
				</div>
				<figure class="wp-block wp-block-kubio-post-featured-image  position-relative wp-block-kubio-post-featured-image__container rayforce-index__k__iE82N7AEu-container rayforce-local-376-container kubio-post-featured-image--has-image h-aspect-ratio--16-9 <?php rayforce_post_missing_featured_image_class(); ?>" data-kubio="kubio/post-featured-image" data-kubio-settings="{{kubio_settings_value}}">
					<?php if(has_post_thumbnail()): ?>
					<img class='position-relative wp-block-kubio-post-featured-image__image rayforce-index__k__iE82N7AEu-image rayforce-local--image' src='<?php echo esc_url(get_the_post_thumbnail_url());?>' />
					<?php endif; ?>
					<div class="position-relative wp-block-kubio-post-featured-image__inner rayforce-index__k__iE82N7AEu-inner rayforce-local-376-inner">
						<div class="position-relative wp-block-kubio-post-featured-image__align rayforce-index__k__iE82N7AEu-align rayforce-local-376-align h-y-container align-self-lg-center align-self-md-center align-self-center"></div>
					</div>
				</figure>
			</div>
		</div>
	</div>
