<?php
/**
 * Default Fields
 *
 * @package   Tpfw/Corefields
 * @category  Functions
 * @author    quangdung
 * @license   GPLv3
 * @version   1.0.0
 */
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Field Textfield.
 *
 * @param $settings
 * @param string $value
 *
 * @since 1.0.0
 * @return string - html string.
 */
function tpfw_form_textfield( $settings, $value ) {

	$attrs = array();

	if ( !empty( $settings['name'] ) ) {
		$attrs[] = 'name="' . $settings['name'] . '"';
	}

	if ( !empty( $settings['id'] ) ) {
		$attrs[] = 'id="' . $settings['id'] . '"';
	}

	$attrs[] = 'data-type="' . $settings['type'] . '"';

	$multiple = empty( $settings['multiple'] ) ? 0 : 1;

	if ( !empty( $settings['customize_link'] ) ) {
		$attrs[] = $settings['customize_link'];
	}

	if ( !$multiple ) {

		$el_class = 'widefat';

		if ( !empty( $settings['size'] ) ) {
			if ( $settings['size'] == 'small' ) {
				$el_class = 'text-size-small';
			} else if ( $settings['size'] == 'medium' ) {
				$el_class = 'text-size-medium';
			}
		}

		return sprintf( '<input type="text" class="tpfw-field tpfw-textfield tpfw_value %s" value="%s" %s/>', $el_class, htmlspecialchars( $value ), implode( ' ', $attrs ) );
	} else {
		/**
		 * Support textfield multiple since 1.0.9
		 */
		$data = $value;

		if ( is_string( $value ) && !empty( $value ) ) {
			$data = json_decode( urldecode( $value ) );
		}

		if ( is_array( $value ) ) {
			$value = urlencode( json_encode( $value ) );
		}

		ob_start();
		?>
		<div class="tpfw-field tpfw-textfield tpfw-textfield-multiple">
			<?php printf( '<input type="hidden" class="tpfw_value" value="%s" %s/>', esc_attr( $value ), implode( ' ', $attrs ) ); ?>
			<ul>
				<?php
				if ( !empty( $data ) && count( $data ) ) {
					foreach ( $data as $val ) {
						?>
						<li class="multitext-item">
							<input type="text" class="widefat" value="<?php echo esc_attr( $val ) ?>"/>
							<a class="remove" href="#" title="<?php echo esc_attr__( 'Remove', 'tp-framework' ) ?>"><?php echo esc_html__( 'Remove', 'tp-framework' ) ?></a>
							<a class="short" href="#" title="<?php echo esc_attr__( 'Short', 'tp-framework' ) ?>"><?php echo esc_html__( 'Short', 'tp-framework' ) ?></a>
						</li>
						<?php
					}
				} else {
					?>
					<li class="multitext-item">
						<input type="text" class="widefat" value=""/>
						<a class="remove" href="#" title="<?php echo esc_attr__( 'Remove', 'tp-framework' ) ?>"><?php echo esc_html__( 'Remove', 'tp-framework' ) ?></a>
						<a class="short" href="#" title="<?php echo esc_attr__( 'Short', 'tp-framework' ) ?>"><?php echo esc_html__( 'Short', 'tp-framework' ) ?></a>
					</li>
					<?php
				}
				?>
			</ul>
			<div class="bottom-row">
				<a href="#" class="addnew"><?php echo esc_html__( 'Add new', 'tp-framework' ) ?></a>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}

/**
 * Field Textarea
 *
 * @param $settings
 * @param string $value
 *
 * @since 1.0.0
 * @return string - html string.
 */
function tpfw_form_textarea( $settings, $value ) {

	$attrs = array();

	if ( !empty( $settings['name'] ) ) {
		$attrs[] = 'name="' . $settings['name'] . '"';
	}

	if ( !empty( $settings['id'] ) ) {
		$attrs[] = 'id="' . $settings['id'] . '"';
	}

	$attrs[] = 'data-type="' . $settings['type'] . '"';

	return sprintf( '<textarea class="tpfw-field tpfw-textarea widefat tpfw_value" %s>%s</textarea>', implode( ' ', $attrs ), esc_textarea( $value ) );
}

/**
 * Field Checkbox
 *
 * @param $settings
 * @param string $value
 *
 * @since 1.0.0
 * @return string - html string.
 */
function tpfw_form_checkbox( $settings, $value = '' ) {

	$attrs = array();

	if ( !empty( $settings['name'] ) ) {
		$attrs[] = 'name="' . $settings['name'] . '"';
	}

	if ( !empty( $settings['id'] ) ) {
		$attrs[] = 'id="' . $settings['id'] . '"';
	}

	$attrs[] = 'data-type="' . $settings['type'] . '"';

	/**
	 * Support Customizer
	 */
	if ( !empty( $settings['customize_link'] ) ) {

		$attrs[] = $settings['customize_link'];
	}

	if ( is_array( $value ) ) {
		$value = implode( ',', $value );
	}

	$multiple = isset( $settings['multiple'] ) && $settings['multiple'] ? 1 : 0;

	$output = '';

	if ( $multiple ) {

		if ( is_array( $settings['options'] ) ) {

			$inline = isset( $settings['display_inline'] ) && absint( $settings['display_inline'] ) ? 'inline' : '';

			$arr_values = !empty( $value ) ? explode( ',', $value ) : array();

			$output .= sprintf( '<input type="hidden" class="tpfw_value" value="%s" %s/>', $value, implode( ' ', $attrs ) );

			$output .= sprintf( '<ul class="tpfw-field tpfw-checkboxes %s">', $inline );

			foreach ( $settings['options'] as $checkbox_key => $checkbox_value ) {

				$checked = in_array( $checkbox_key, $arr_values ) ? 'checked' : '';

				$output .= sprintf( '<li><label><input %s type="checkbox" value="%s"/><span>%s</span></label></li>', $checked, $checkbox_key, $checkbox_value );
			}

			$output .= '</ul>';
		}
	} else {

		if ( $value ) {
			$attrs[] = 'checked';
		}
		$output .= sprintf( '<input type="checkbox" value="1" class="tpfw-field tpfw-checkbox tpfw_value" %s/>', implode( ' ', $attrs ) );
	}

	return $output;
}

/**
 * Field Select
 *
 * @param $settings
 * @param string $value
 *
 * @since 1.0.0
 * @return string - html string.
 */
function tpfw_form_select( $settings, $value = '' ) {
	
	$multiple = isset( $settings['multiple'] ) && $settings['multiple'] ? 'multiple' : '';

	$attrs = array();

	if ( !empty( $settings['name'] ) ) {
		$attrs[] = 'name="' . $settings['name'] . '"';
	}

	if ( !empty( $settings['id'] ) ) {
		$attrs[] = 'id="' . $settings['id'] . '"';
	}

	$attrs[] = 'data-type="' . $settings['type'] . '"';

	/**
	 * Support Customizer
	 */
	if ( !empty( $settings['customize_link'] ) ) {
		$attrs[] = $settings['customize_link'];
	}

	$css_class = 'tpfw-field tpfw-select tpfw-select-multiple';
	if ( !empty( $settings['el_class'] ) ) {
		$css_class .= ' ' . $settings['el_class'];
	}

	if ( is_array( $value ) ) {
		$value = implode( ',', $value );
	}

	$output = '';
	if ( !empty( $multiple ) ) {
		$output .= sprintf( '<input type="hidden" class="tpfw_value" value="%s" %s/>', esc_attr( $value ), implode( ' ', $attrs ) );
		$output .= '<select multiple="" class="' . $css_class . '">';
		$value = !empty( $value ) ? explode( ',', $value ) : array();
	} else {
		$output .= sprintf( '<select class="tpfw-field tpfw-select tpfw_value" %s>', implode( ' ', $attrs ) );
	}

	if ( is_array( $settings['options'] ) ) {
		foreach ( $settings['options'] as $option_key => $option_value ) {

			if ( is_array( $value ) ) {
				$selected = in_array( $option_key, $value ) ? 'selected' : '';
			} else {
				$selected = $option_key == $value ? 'selected' : '';
			}

			$output .= sprintf( '<option %s value="%s">%s</option>', $selected, $option_key, $option_value );
		}
	}

	$output .= '</select>';

	return $output;
}

/**
 * Field Radio
 *
 * @param $settings
 * @param string $value
 *
 * @since 1.0.0
 * @return string - html string.
 */
function tpfw_form_radio( $settings, $value ) {

	$attrs = array();

	if ( !empty( $settings['name'] ) ) {
		$attrs[] = 'name="' . $settings['name'] . '"';
	}

	if ( !empty( $settings['id'] ) ) {
		$attrs[] = 'id="' . $settings['id'] . '"';
	}

	$attrs[] = 'data-type="' . $settings['type'] . '"';

	$output = '';

	if ( is_array( $settings['options'] ) ) {

		$output .= sprintf( '<input type="hidden" class="tpfw_value" value="%s" %s/>', $value, implode( ' ', $attrs ) );

		$inline = isset( $settings['display_inline'] ) && absint( $settings['display_inline'] ) ? 'inline' : '';

		$output .= sprintf( '<ul class="tpfw-field tpfw-radios %s">', $inline );

		foreach ( $settings['options'] as $radio_key => $radio_value ) {

			$checked = $radio_key === $value ? 'checked' : '';

			$output .= sprintf( '<li><label><input type="radio" %s value="%s"/><span>%s</span></label></li>', $checked, $radio_key, $radio_value );
		}

		$output .= '</ul>';
	}

	return $output;
}
