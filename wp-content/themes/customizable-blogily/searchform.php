<form method="get" id="searchform" class="search-form" action="<?php echo esc_url( home_url() ); ?>" _lpchecked="1">
	<fieldset>
		<input type="text" name="s" id="s" value="<?php esc_attr_e('Search this site...','customizable-blogily'); ?>" onblur="if (this.value == '') {this.value = '<?php esc_attr_e('Search this site...','customizable-blogily'); ?>';}" onfocus="if (this.value == '<?php esc_attr_e('Search this site...','customizable-blogily'); ?>') {this.value = '';}" >
		<input type="submit" value="<?php esc_attr_e( 'Search', 'customizable-blogily' ); ?>" />
	</fieldset>
</form>
