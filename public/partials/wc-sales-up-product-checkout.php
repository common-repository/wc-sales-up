<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    WC_Sales_Up
 * @subpackage WC_Sales_Up/public/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wsp_preview">
<style>
	.wsp_cho_title {
		background: <?php echo esc_attr( $wsp_cho_offer_title_bg_color ); ?>;
		color: <?php echo esc_attr( $wsp_cho_offer_title_color ); ?>;
	}

	.wsp_preview {
		background: <?php echo esc_attr( $wsp_cho_box_bg ); ?>;
	}

	#wsp_cho_content, #wsp_cho_content * {
		color: <?php echo esc_attr( $wsp_cho_offer_text_color ); ?>;
	}

	.wsp_cho_price>span, .wsp_cho_price del span {
		color: <?php echo esc_attr( $wsp_cho_price_color ); ?>;
	}

	.woocommerce-cart .wsp_preview {
		width : <?php echo esc_attr($wsp_cho_box_width); ?><?php echo esc_attr($wsp_cho_box_width_pre); ?>
	}
</style>

	<div class="wsp_cho_title">
		<input
		<?php
		if ( $product_data->is_type( 'variable' ) ) {
			echo 'disabled=""';
			echo 'class="disabled"'; }
		?>
		type="checkbox" name="wsp_c_check" id="wsp_c_check" /><label for="wsp_c_check"><?php echo esc_attr( $wsp_cho_title ); ?></label>
	</div>
	<div class="wsp_cho_content">
		<div class="wsp_c_img_cover" id="wsp_c_img_cover"
		<?php
		if ( 'no' == $wsp_cho_display_image ) {
																echo "style='display:none'";
		}
		?>
															>
			<?php
			if ( 'yes' == $wsp_cho_display_link ) {
				?>
				<a target='_blank' href="<?php echo esc_url( get_the_permalink( $product_data->get_id() ) ); ?>">
				<?php
			}
			?>
				<img class="wsp_c_img_src" src="<?php echo esc_url( $wsp_cho_img_src ); ?>" alt="" />
				<?php
				if ( 'yes' == $wsp_cho_display_link ) {
					?>
				</a>
					<?php
				}
				?>
		</div>
		<div class="wsp_c_content_cover">
			<div id='wsp_cho_content'>
				<?php echo wp_kses( $wsp_cho_content, wsp_args_kses() ); ?>
				<?php
				if ( $product_data->is_type( 'variable' ) ) {
					$available_variations = WC_Sales_Up_Product::get_variations_from_product( $product_data );
					if ( is_array( $available_variations ) && ! empty( $available_variations ) ) {
						?>
						<select name="wsp_attribute_<?php echo esc_attr( $product_data->get_id() ); ?>" class="wsp_attribute_select wsp_attribute_<?php echo esc_attr( $product_data->get_id() ); ?>">
							<option disabled='disabled' selected='selected' value=''>
								<?php echo esc_html( WC_Sales_Up_Product::get_attribute_placeholder( $product_data ) ); ?>
							</option>
							<?php
							foreach ( $available_variations as $available_variation ) {
								$option_attributes = array();
								foreach ( $available_variation['attributes'] as $attribute_key => $attribute_value ) {
									$option_attributes[] = $attribute_value;
								}
								$option_string = implode( ' - ', $option_attributes );
								?>
									<option
										value='<?php echo esc_attr( $available_variation['variation_id'] ); ?>'
										data-attributes="<?php echo esc_attr( wp_json_encode( $available_variation['attributes'] ) ); ?>">
									<?php echo esc_attr( $option_string ); ?>
									</option>
									<?php
							}
							?>
						</select>
						<?php
					}
					$product_id = '';
				} else {
					$product_id = $product_data->get_id();
				}
				?>
				<input type="hidden" id="wsp_cho_pro" name="wsp_cho_pro" value="<?php echo esc_attr( $product_id ); ?>" />
			</div>
			<div class="wsp_cho_price">
				<del><?php echo wp_kses( $original_price, wsp_args_kses() ); ?></del> <span class="wsp_d_price"><?php echo wp_kses( $off_price, wsp_args_kses() ); ?></span>
			</div>
		</div>
	</div>
</div>
