<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$field = $data->field;
$key = $data->key;
?>
<div class="select-input disabled-first-option">
<input type="text" 
	class="input-text" 

	name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>"
	<?php if ( isset( $field['autocomplete'] ) && false === $field['autocomplete'] ) { echo ' autocomplete="off"'; } ?> 
	id="<?php echo esc_attr( $key ); ?>" 
	placeholder="<?php echo isset( $field['placeholder'] ) ? esc_attr( $field['placeholder'] ) : ''; ?>" 
	value="<?php echo isset( $field['value'] ) ? esc_attr( $field['value'] ) : ''; ?>" 
	maxlength="<?php echo ! empty( $field['maxlength'] ) ? $field['maxlength'] : ''; ?>" 
	<?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> 
	<?php if ( isset( $field['unit'] ) ) echo 'data-unit="'.$field['unit'].'"'; ?> 

	/>
	</div>