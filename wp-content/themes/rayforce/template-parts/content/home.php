<div class="wp-block wp-block-kubio-query-layout  position-relative wp-block-kubio-query-layout__outer rayforce-home__k__1MCYzfcZN-outer rayforce-local-935-outer d-flex h-section-global-spacing align-items-lg-center align-items-md-center align-items-center" data-kubio="kubio/query-layout" id="blog-layout">
	<div class="position-relative wp-block-kubio-query-layout__inner rayforce-home__k__1MCYzfcZN-inner rayforce-local-935-inner h-section-grid-container h-section-boxed-container">
		<div class="wp-block wp-block-kubio-row  position-relative wp-block-kubio-row__container rayforce-home__k__baLWB4dRKjp-container rayforce-local-936-container gutters-row-lg-0 gutters-row-v-lg-0 gutters-row-md-0 gutters-row-v-md-0 gutters-row-0 gutters-row-v-0" data-kubio="kubio/row">
			<div class="position-relative wp-block-kubio-row__inner rayforce-home__k__baLWB4dRKjp-inner rayforce-local-936-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-0 gutters-col-v-lg-0 gutters-col-md-0 gutters-col-v-md-0 gutters-col-0 gutters-col-v-0">
				<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container rayforce-home__k__kxeqsSpdy-n-container rayforce-local-937-container d-flex h-col-lg h-col-md h-col-auto" data-kubio="kubio/column">
					<div class="position-relative wp-block-kubio-column__inner rayforce-home__k__kxeqsSpdy-n-inner rayforce-local-937-inner d-flex h-flex-basis h-px-lg-0 v-inner-lg-0 h-px-md-2 v-inner-md-0 h-px-1 v-inner-0">
						<div class="position-relative wp-block-kubio-column__align rayforce-home__k__kxeqsSpdy-n-align rayforce-local-937-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
							<div class="wp-block wp-block-kubio-query  position-relative wp-block-kubio-query__container rayforce-home__k__CtKC_EuIZL-container rayforce-local-938-container" data-kubio="kubio/query">
								<div class="wp-block wp-block-kubio-query-loop  position-relative wp-block-kubio-query-loop__container rayforce-home__k__vrf0UGkWrN-container rayforce-local-939-container gutters-row-lg-2 gutters-row-v-lg-2 gutters-row-md-1 gutters-row-v-md-3 gutters-row-0 gutters-row-v-2" data-kubio="kubio/query-loop" data-kubio-component="masonry" data-kubio-settings="{&quot;enabled&quot;:&quot;1&quot;,&quot;targetSelector&quot;:&quot;.wp-block-kubio-query-loop__inner&quot;}">
									<div class="position-relative wp-block-kubio-query-loop__inner rayforce-home__k__vrf0UGkWrN-inner rayforce-local-939-inner h-row">
										<?php rayforce_theme()->get('archive-loop')->render(array (
  'view' => 'content/home/loop-item',
)); ?>
									</div>
								</div>
								<?php if(rayforce_has_pagination()): ?>
								<div class="wp-block wp-block-kubio-query-pagination  position-relative wp-block-kubio-query-pagination__container rayforce-home__k__vD7AVCTELY-container rayforce-local-949-container gutters-row-lg-2 gutters-row-v-lg-2 gutters-row-md-2 gutters-row-v-md-2 gutters-row-0 gutters-row-v-2" data-kubio="kubio/query-pagination">
									<div class="position-relative wp-block-kubio-query-pagination__inner rayforce-home__k__vD7AVCTELY-inner rayforce-local-949-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-2 gutters-col-v-lg-2 gutters-col-md-2 gutters-col-v-md-2 gutters-col-0 gutters-col-v-2">
										<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container rayforce-home__k__tBYU0uM8Xx-container rayforce-local-950-container d-flex h-col-lg-auto h-col-md-auto h-col-auto" data-kubio="kubio/column">
											<div class="position-relative wp-block-kubio-column__inner rayforce-home__k__tBYU0uM8Xx-inner rayforce-local-950-inner d-flex h-flex-basis h-px-lg-0 v-inner-lg-2 h-px-md-0 v-inner-md-2 h-px-0 v-inner-2">
												<div class="position-relative wp-block-kubio-column__align rayforce-home__k__tBYU0uM8Xx-align rayforce-local-950-align h-y-container h-column__content h-column__v-align flex-basis-auto align-self-lg-center align-self-md-center align-self-center">
													<?php if(rayforce_has_pagination_button(true)): ?>
													<div class="position-relative wp-block-kubio-pagination-nav-button__spacing rayforce-home__k__ELgmeRXRD--spacing rayforce-local-951-spacing">
														<span class="wp-block wp-block-kubio-pagination-nav-button  position-relative wp-block-kubio-pagination-nav-button__outer rayforce-home__k__ELgmeRXRD--outer rayforce-local-951-outer kubio-button-container" data-kubio="kubio/pagination-nav-button">
															<a class="position-relative wp-block-kubio-pagination-nav-button__link rayforce-home__k__ELgmeRXRD--link rayforce-local-951-link h-w-100 h-global-transition" href="<?php rayforce_get_navigation_button_link(true); ?>">
																<span class="position-relative wp-block-kubio-pagination-nav-button__text rayforce-home__k__ELgmeRXRD--text rayforce-local-951-text kubio-inherit-typography">
																	<?php esc_html_e('Previous', 'rayforce'); ?>
																</span>
															</a>
														</span>
													</div>
													<?php endif; ?>
												</div>
											</div>
										</div>
										<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container rayforce-home__k__P2OarhUKUK-container rayforce-local-952-container d-flex h-col-lg h-col-md h-col" data-kubio="kubio/column">
											<div class="position-relative wp-block-kubio-column__inner rayforce-home__k__P2OarhUKUK-inner rayforce-local-952-inner d-flex h-flex-basis h-px-lg-2 v-inner-lg-2 h-px-md-2 v-inner-md-2 h-px-1 v-inner-2">
												<div class="position-relative wp-block-kubio-column__align rayforce-home__k__P2OarhUKUK-align rayforce-local-952-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-center align-self-md-center align-self-center">
													<div class="wp-block wp-block-kubio-pagination-numbers  position-relative wp-block-kubio-pagination-numbers__outer rayforce-home__k__tRiQFlrj8q-outer rayforce-local-953-outer" data-kubio="kubio/pagination-numbers">
														<?php rayforce_pagination_numbers(); ?>
													</div>
												</div>
											</div>
										</div>
										<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container rayforce-home__k__2nd5yuWmz9-container rayforce-local-954-container d-flex h-col-lg-auto h-col-md-auto h-col-auto" data-kubio="kubio/column">
											<div class="position-relative wp-block-kubio-column__inner rayforce-home__k__2nd5yuWmz9-inner rayforce-local-954-inner d-flex h-flex-basis h-px-lg-0 v-inner-lg-2 h-px-md-0 v-inner-md-2 h-px-0 v-inner-2">
												<div class="position-relative wp-block-kubio-column__align rayforce-home__k__2nd5yuWmz9-align rayforce-local-954-align h-y-container h-column__content h-column__v-align flex-basis-auto align-self-lg-center align-self-md-center align-self-center">
													<?php if(rayforce_has_pagination_button()): ?>
													<div class="position-relative wp-block-kubio-pagination-nav-button__spacing rayforce-home__k__ELgmeRXRD--spacing rayforce-local-955-spacing">
														<span class="wp-block wp-block-kubio-pagination-nav-button  position-relative wp-block-kubio-pagination-nav-button__outer rayforce-home__k__ELgmeRXRD--outer rayforce-local-955-outer kubio-button-container" data-kubio="kubio/pagination-nav-button">
															<a class="position-relative wp-block-kubio-pagination-nav-button__link rayforce-home__k__ELgmeRXRD--link rayforce-local-955-link h-w-100 h-global-transition" href="<?php rayforce_get_navigation_button_link(); ?>">
																<span class="position-relative wp-block-kubio-pagination-nav-button__text rayforce-home__k__ELgmeRXRD--text rayforce-local-955-text kubio-inherit-typography">
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



