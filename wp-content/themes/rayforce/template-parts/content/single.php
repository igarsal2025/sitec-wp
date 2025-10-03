<div id="post-<?php the_ID(); ?>" class=" <?php echo esc_attr( implode( ' ', get_post_class() ) ); ?> wp-block wp-block-kubio-query-layout  position-relative wp-block-kubio-query-layout__outer rayforce-single__k__single-lAFSH8Xo9x-outer rayforce-local-710-outer d-flex h-section-global-spacing align-items-lg-center align-items-md-center align-items-center" data-kubio="kubio/query-layout" id="blog-layout">
	<div class="position-relative wp-block-kubio-query-layout__inner rayforce-single__k__single-lAFSH8Xo9x-inner rayforce-local-710-inner h-section-grid-container h-section-boxed-container">
		<div class="wp-block wp-block-kubio-row  position-relative wp-block-kubio-row__container rayforce-single__k__single-baLWB4dRKjp-container rayforce-local-711-container gutters-row-lg-0 gutters-row-v-lg-0 gutters-row-md-0 gutters-row-v-md-1 gutters-row-2 gutters-row-v-2" data-kubio="kubio/row">
			<div class="position-relative wp-block-kubio-row__inner rayforce-single__k__single-baLWB4dRKjp-inner rayforce-local-711-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-0 gutters-col-v-lg-0 gutters-col-md-0 gutters-col-v-md-1 gutters-col-2 gutters-col-v-2">
				<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container rayforce-single__k__single-kxeqsSpdy-n-container rayforce-local-712-container d-flex h-col-lg h-col-md h-col-auto" data-kubio="kubio/column">
					<div class="position-relative wp-block-kubio-column__inner rayforce-single__k__single-kxeqsSpdy-n-inner rayforce-local-712-inner d-flex h-flex-basis h-px-lg-2 v-inner-lg-2 h-px-md-2 v-inner-md-2 h-px-2 v-inner-2">
						<div class="position-relative wp-block-kubio-column__align rayforce-single__k__single-kxeqsSpdy-n-align rayforce-local-712-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
							<div class="wp-block wp-block-kubio-row  position-relative wp-block-kubio-row__container rayforce-single__k__57noHnWPS-container rayforce-local-713-container gutters-row-lg-0 gutters-row-v-lg-0 gutters-row-md-0 gutters-row-v-md-0 gutters-row-0 gutters-row-v-0" data-kubio="kubio/row">
								<div class="position-relative wp-block-kubio-row__inner rayforce-single__k__57noHnWPS-inner rayforce-local-713-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-0 gutters-col-v-lg-0 gutters-col-md-0 gutters-col-v-md-0 gutters-col-0 gutters-col-v-0">
									<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container rayforce-single__k__jN8KkXHu7t-container rayforce-local-714-container d-flex h-col-lg-auto h-col-md-auto h-col-auto" data-kubio="kubio/column">
										<div class="position-relative wp-block-kubio-column__inner rayforce-single__k__jN8KkXHu7t-inner rayforce-local-714-inner d-flex h-flex-basis h-px-lg-3 v-inner-lg-3 h-px-md-3 v-inner-md-3 h-px-3 v-inner-3">
											<div class="position-relative wp-block-kubio-column__align rayforce-single__k__jN8KkXHu7t-align rayforce-local-714-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
												<figure class="wp-block wp-block-kubio-post-featured-image  position-relative wp-block-kubio-post-featured-image__container rayforce-single__k__iE82N7AEu-container rayforce-local-715-container kubio-post-featured-image--has-image h-aspect-ratio--16-9 <?php rayforce_post_missing_featured_image_class(); ?>" data-kubio="kubio/post-featured-image" data-kubio-settings="{{kubio_settings_value}}">
													<?php if(has_post_thumbnail()): ?>
													<img class='position-relative wp-block-kubio-post-featured-image__image rayforce-single__k__iE82N7AEu-image rayforce-local--image' src='<?php echo esc_url(get_the_post_thumbnail_url());?>' />
													<?php endif; ?>
													<div class="position-relative wp-block-kubio-post-featured-image__inner rayforce-single__k__iE82N7AEu-inner rayforce-local-715-inner">
														<div class="position-relative wp-block-kubio-post-featured-image__align rayforce-single__k__iE82N7AEu-align rayforce-local-715-align h-y-container align-self-lg-center align-self-md-center align-self-center"></div>
													</div>
												</figure>
												<div class="wp-block wp-block-kubio-post-meta  position-relative wp-block-kubio-post-meta__metaDataContainer rayforce-single__k__in2mlwF4a-metaDataContainer rayforce-local-716-metaDataContainer h-blog-meta" data-kubio="kubio/post-meta" id="post-metadata">
													<span class="metadata-item">
														<span class="metadata-prefix">
															<?php esc_html_e('Written by', 'rayforce'); ?>
														</span>
														<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta("ID"))); ?>">
															<?php echo esc_html(get_the_author_meta("display_name",get_post_field("post_author"))); ?>
														</a>
													</span>
													<span class="metadata-separator">
														|
													</span>
													<span class="metadata-item">
														<span class="metadata-prefix">
															<?php esc_html_e('on', 'rayforce'); ?>
														</span>
														<a href="<?php echo esc_url(get_day_link(get_post_time( 'Y' ),get_post_time( 'm' ),get_post_time( 'j' ))); ?>">
															<?php echo esc_html(get_the_date('F j, Y')); ?>
														</a>
													</span>
												</div>
												<?php the_content(); ?>
												<div class="wp-block wp-block-kubio-row  position-relative wp-block-kubio-row__container rayforce-single__k__single-1uGRU27HVz-container rayforce-local-717-container gutters-row-lg-0 gutters-row-v-lg-0 gutters-row-md-0 gutters-row-v-md-0 gutters-row-0 gutters-row-v-0" data-kubio="kubio/row">
													<div class="position-relative wp-block-kubio-row__inner rayforce-single__k__single-1uGRU27HVz-inner rayforce-local-717-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-start justify-content-md-start justify-content-start gutters-col-lg-0 gutters-col-v-lg-0 gutters-col-md-0 gutters-col-v-md-0 gutters-col-0 gutters-col-v-0">
														<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container rayforce-single__k__single-K4Akm2YNqS-container rayforce-local-718-container d-flex h-col-lg-auto h-col-md-auto h-col-auto" data-kubio="kubio/column">
															<div class="position-relative wp-block-kubio-column__inner rayforce-single__k__single-K4Akm2YNqS-inner rayforce-local-718-inner d-flex h-flex-basis h-px-lg-0 v-inner-lg-0 h-px-md-0 v-inner-md-0 h-px-0 v-inner-0">
																<div class="position-relative wp-block-kubio-column__align rayforce-single__k__single-K4Akm2YNqS-align rayforce-local-718-align h-y-container h-column__content h-column__v-align flex-basis-auto align-self-lg-start align-self-md-start align-self-start">
																	<div class="wp-block wp-block-kubio-icon  position-relative wp-block-kubio-icon__outer rayforce-single__k__oy67H3XiVge-outer rayforce-local-719-outer" data-kubio="kubio/icon">
																		<span class="h-svg-icon wp-block-kubio-icon__inner rayforce-single__k__oy67H3XiVge-inner rayforce-local-719-inner h-global-transition" name="font-awesome/tags">
																			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="tags" viewBox="0 0 1920 1896.0833">
																				<path d="M448 448q0-53-37.5-90.5T320 320t-90.5 37.5T192 448t37.5 90.5T320 576t90.5-37.5T448 448zm1067 576q0 53-37 90l-491 492q-39 37-91 37-53 0-90-37L91 890q-38-37-64.5-101T0 672V256q0-52 38-90t90-38h416q53 0 117 26.5T763 219l715 714q37 39 37 91zm384 0q0 53-37 90l-491 492q-39 37-91 37-36 0-59-14t-53-45l470-470q37-37 37-90 0-52-37-91L923 219q-38-38-102-64.5T704 128h224q53 0 117 26.5t102 64.5l715 714q37 39 37 91z"/></svg>
																			</span>
																		</div>
																	</div>
																</div>
															</div>
															<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container rayforce-single__k__e8T3Hm0BV-container rayforce-local-720-container d-flex h-col-lg h-col-md h-col" data-kubio="kubio/column">
																<div class="position-relative wp-block-kubio-column__inner rayforce-single__k__e8T3Hm0BV-inner rayforce-local-720-inner d-flex h-flex-basis h-px-lg-0 v-inner-lg-0 h-px-md-0 v-inner-md-0 h-px-0 v-inner-0">
																	<div class="position-relative wp-block-kubio-column__align rayforce-single__k__e8T3Hm0BV-align rayforce-local-720-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-center align-self-md-center align-self-center">
																		<div class="wp-block wp-block-kubio-post-tags  position-relative wp-block-kubio-post-tags__container rayforce-single__k__single-tlSt_AyBi-container rayforce-local-721-container kubio-post-tags-container" data-kubio="kubio/post-tags">
																			<div class="position-relative wp-block-kubio-post-tags__placeholder rayforce-single__k__single-tlSt_AyBi-placeholder rayforce-local-721-placeholder kubio-post-tags-placeholder"></div>
																			<div class="position-relative wp-block-kubio-post-tags__tags rayforce-single__k__single-tlSt_AyBi-tags rayforce-local-721-tags">
																				<?php rayforce_tags_list(__('No tags', 'rayforce')); ?>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="wp-block wp-block-kubio-row  position-relative wp-block-kubio-row__container rayforce-single__k__oBH0ABWoeL-container rayforce-local-722-container gutters-row-lg-0 gutters-row-v-lg-0 gutters-row-md-0 gutters-row-v-md-0 gutters-row-0 gutters-row-v-0" data-kubio="kubio/row">
														<div class="position-relative wp-block-kubio-row__inner rayforce-single__k__oBH0ABWoeL-inner rayforce-local-722-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-0 gutters-col-v-lg-0 gutters-col-md-0 gutters-col-v-md-0 gutters-col-0 gutters-col-v-0">
															<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container rayforce-single__k__wETEbWZUNc-container rayforce-local-723-container d-flex h-col-lg-auto h-col-md-auto h-col-auto" data-kubio="kubio/column">
																<div class="position-relative wp-block-kubio-column__inner rayforce-single__k__wETEbWZUNc-inner rayforce-local-723-inner d-flex h-flex-basis h-px-lg-0 v-inner-lg-0 h-px-md-0 v-inner-md-0 h-px-0 v-inner-0">
																	<div class="position-relative wp-block-kubio-column__align rayforce-single__k__wETEbWZUNc-align rayforce-local-723-align h-y-container h-column__content h-column__v-align flex-basis-auto align-self-lg-start align-self-md-start align-self-start">
																		<div class="wp-block wp-block-kubio-icon  position-relative wp-block-kubio-icon__outer rayforce-single__k__mv1YR9xA3-outer rayforce-local-724-outer" data-kubio="kubio/icon">
																			<span class="h-svg-icon wp-block-kubio-icon__inner rayforce-single__k__mv1YR9xA3-inner rayforce-local-724-inner h-global-transition" name="font-awesome/folder-open">
																				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="folder-open" viewBox="0 0 1920 1896.0833">
																					<path d="M1879 952q0 31-31 66l-336 396q-43 51-120.5 86.5T1248 1536H160q-34 0-60.5-13T73 1480q0-31 31-66l336-396q43-51 120.5-86.5T704 896h1088q34 0 60.5 13t26.5 43zm-343-344v160H704q-94 0-197 47.5T343 935L6 1331l-5 6q0-4-.5-12.5T0 1312V352q0-92 66-158t158-66h320q92 0 158 66t66 158v32h544q92 0 158 66t66 158z"/></svg>
																				</span>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container rayforce-single__k__kVi3OQ_XHq-container rayforce-local-725-container d-flex h-col-lg h-col-md h-col" data-kubio="kubio/column">
																	<div class="position-relative wp-block-kubio-column__inner rayforce-single__k__kVi3OQ_XHq-inner rayforce-local-725-inner d-flex h-flex-basis h-px-lg-0 v-inner-lg-0 h-px-md-0 v-inner-md-0 h-px-0 v-inner-0">
																		<div class="position-relative wp-block-kubio-column__align rayforce-single__k__kVi3OQ_XHq-align rayforce-local-725-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
																			<div class="wp-block wp-block-kubio-post-categories  position-relative wp-block-kubio-post-categories__container rayforce-single__k__up5pQ_Cww-container rayforce-local-726-container kubio-post-categories-container" data-kubio="kubio/post-categories">
																				<div class="position-relative wp-block-kubio-post-categories__placeholder rayforce-single__k__up5pQ_Cww-placeholder rayforce-local-726-placeholder kubio-post-categories-placeholder"></div>
																				<div class="position-relative wp-block-kubio-post-categories__tags rayforce-single__k__up5pQ_Cww-tags rayforce-local-726-tags">
																					<?php rayforce_categories_list(__('No category', 'rayforce')); ?>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php if(rayforce_has_pagination()): ?>
									<div class="wp-block wp-block-kubio-query-pagination  position-relative wp-block-kubio-query-pagination__container rayforce-single__k__single-nqLiVZCaYo-container rayforce-local-727-container gutters-row-lg-0 gutters-row-v-lg-3 gutters-row-md-0 gutters-row-v-md-3 gutters-row-0 gutters-row-v-3" data-kubio="kubio/query-pagination">
										<div class="position-relative wp-block-kubio-query-pagination__inner rayforce-single__k__single-nqLiVZCaYo-inner rayforce-local-727-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-0 gutters-col-v-lg-3 gutters-col-md-0 gutters-col-v-md-3 gutters-col-0 gutters-col-v-3">
											<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container rayforce-single__k__single-3ndM77FkZV-container rayforce-local-728-container d-flex h-col-lg h-col-md h-col-auto" data-kubio="kubio/column">
												<div class="position-relative wp-block-kubio-column__inner rayforce-single__k__single-3ndM77FkZV-inner rayforce-local-728-inner d-flex h-flex-basis h-px-lg-0 v-inner-lg-2 h-px-md-0 v-inner-md-2 h-px-0 v-inner-2">
													<div class="position-relative wp-block-kubio-column__align rayforce-single__k__single-3ndM77FkZV-align rayforce-local-728-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
														<?php if(rayforce_has_pagination_button(true)): ?>
														<div class="position-relative wp-block-kubio-pagination-nav-button__spacing rayforce-single__k__ELgmeRXRD--spacing rayforce-local-729-spacing">
															<span class="wp-block wp-block-kubio-pagination-nav-button  position-relative wp-block-kubio-pagination-nav-button__outer rayforce-single__k__ELgmeRXRD--outer rayforce-local-729-outer kubio-button-container" data-kubio="kubio/pagination-nav-button">
																<a class="position-relative wp-block-kubio-pagination-nav-button__link rayforce-single__k__ELgmeRXRD--link rayforce-local-729-link h-w-100 h-global-transition" href="<?php rayforce_get_navigation_button_link(true); ?>">
																	<span class="position-relative wp-block-kubio-pagination-nav-button__text rayforce-single__k__ELgmeRXRD--text rayforce-local-729-text kubio-inherit-typography">
																		<?php esc_html_e('Previous', 'rayforce'); ?>
																	</span>
																</a>
															</span>
														</div>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container rayforce-single__k__single-mMPMCQqWfs-container rayforce-local-730-container d-flex h-col-lg h-col-md h-col-auto" data-kubio="kubio/column">
												<div class="position-relative wp-block-kubio-column__inner rayforce-single__k__single-mMPMCQqWfs-inner rayforce-local-730-inner d-flex h-flex-basis h-px-lg-0 v-inner-lg-2 h-px-md-0 v-inner-md-2 h-px-0 v-inner-2">
													<div class="position-relative wp-block-kubio-column__align rayforce-single__k__single-mMPMCQqWfs-align rayforce-local-730-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
														<?php if(rayforce_has_pagination_button()): ?>
														<div class="position-relative wp-block-kubio-pagination-nav-button__spacing rayforce-single__k__ELgmeRXRD--spacing rayforce-local-731-spacing">
															<span class="wp-block wp-block-kubio-pagination-nav-button  position-relative wp-block-kubio-pagination-nav-button__outer rayforce-single__k__ELgmeRXRD--outer rayforce-local-731-outer kubio-button-container" data-kubio="kubio/pagination-nav-button">
																<a class="position-relative wp-block-kubio-pagination-nav-button__link rayforce-single__k__ELgmeRXRD--link rayforce-local-731-link h-w-100 h-global-transition" href="<?php rayforce_get_navigation_button_link(); ?>">
																	<span class="position-relative wp-block-kubio-pagination-nav-button__text rayforce-single__k__ELgmeRXRD--text rayforce-local-731-text kubio-inherit-typography">
																		<?php esc_html_e('Next', 'rayforce'); ?>
																	</span>
																</a>
															</span>
														</div>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php endif; ?>
									<div class="wp-block wp-block-kubio-post-comments kubio-migration--1 position-relative wp-block-kubio-post-comments__commentsContainer rayforce-single__k__single-s5UQRGEAN-commentsContainer rayforce-local-732-commentsContainer" data-kubio="kubio/post-comments">
										<?php rayforce_post_comments(array (
  'none' => __('No responses yet', 'rayforce'),
  'one' => __('One response', 'rayforce'),
  'multiple' => __('{COMMENTS-COUNT} Responses', 'rayforce'),
  'disabled' => __('Comments are closed', 'rayforce'),
  'avatar_size' => __('32', 'rayforce'),
)); ?>
									</div>
									<div class="wp-block wp-block-kubio-post-comments-form  position-relative wp-block-kubio-post-comments-form__container rayforce-single__k__single-oXoikmHxB-container rayforce-local-733-container" data-kubio="kubio/post-comments-form">
										<?php comment_form(); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
