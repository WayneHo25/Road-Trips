<?php
		require $this->base_dir . "inc/data/plugins-data.php";
		require_once $this->base_dir . "inc/data/guides-data.php";
?>

<div class="spbhlpr__superb__helper__wrapper">
	<div class="spbhlpr__superb__helper__inner">
		<div class="name-container"><img src="<?php echo $this->base_url.'assets/img/'; ?>superbhelper-icon.png" width="45"> <span><?php echo esc_html_e('Superb Helper', 'superb-helper') ?></span></div>
		<div class="spbhlpr-plugin-events"><?php $this->spbhlpr_eventHandler(); ?></div>


		<ul class="tabs" role="tablist">
			<li><input type="radio" name="tabs" id="tab1" checked /><label for="tab1" role="tab" aria-selected="true" aria-controls="panel1" tabindex="0"><?php echo esc_html_e('Plugins', 'superb-helper') ?></label><div id="tab-content1" class="tab-content" role="tabpanel" aria-labelledby="description" aria-hidden="false">


				<ul>
					<?php
					foreach($recommended_plugins as &$plugin){ 
						$name = esc_attr($plugin['name']);
						$desc = esc_attr($plugin['desc']);
						$path = esc_attr($plugin['path']);
						$slug = esc_attr($plugin['slug']);
						$url = isset($plugin['url']) ? esc_url($plugin['url']) : null;
						$img = esc_attr($plugin['img']);
						?>

					<li class="spbhlpr__superb__helper__tab__plugin__recomendation__item">
						<div class="spbhlpr__superb__helper__tab__plugin__recomendation__item__left">
							<img src="<?php echo $this->base_url.'assets/img/'.$img; ?>" width="45">
						</div>
						<div class="spbhlpr__superb__helper__tab__plugin__recomendation__item__middle">
							<h3><?php echo $name ?></h3>
							<p><?php echo $desc ?></p>
						</div>
						<div class="spbhlpr__superb__helper__tab__plugin__recomendation__item__right">
							<?php 
							if(is_plugin_active($path)){
								echo "<p class='spbhlpr__superb__helper__tab__plugin__recomendation__item__right_button_activated'><i class='fas fa-toggle-on'></i> Activated</p>";
								if (isset($url)) {
									$plugin_data = get_plugin_data($this->plugin_dir.$path);
									$plugin_version = $plugin_data['Version'];
									echo $plugin_version < 100 ? "<span><a href='".$url."' target='_blank'>Check out the Premium Version</a></span>" : "<span>Premium Features Installed</span>";
								}

							} else {
								echo '<form method="post"><input type="hidden" name="path" value="'.$path.'" />';
								echo $this->is_plugin_installed($path)?
								'<input type="hidden" name="spbhlprq" value="activate" />'.wp_nonce_field('spbhlpr_activate_plugin','_wpnonce_spbhlpr',true,false).'<button type="submit" onclick="spbhlpr_LoadSpinner(\'Activating..\',\''.$name.'..\')" class="spbhlpr__superb__helper__tab__plugin__recomendation__item__right_button"><i class="fas fa-toggle-off"></i> Activate</button>':
								'<input type="hidden" name="spbhlprq" value="install" /><input type="hidden" name="slug" value="'.$slug.'" />'.wp_nonce_field('spbhlpr_install_plugin','_wpnonce_spbhlpr',true,false).'<button type="submit" onclick="spbhlpr_LoadSpinner(\'Installing..\',\''.$name.'..\')" class="spbhlpr__superb__helper__tab__plugin__recomendation__item__right_button"><i class="fas fa-download"></i> Install</button>';
								echo '</form>';
							}

							?>

						</div>
					</li>
					<?php } ?>

				</ul>



			</div>
		</li>

		<li class="spbhlpr__superb__helper__tab__article__recomendation">
			<input type="radio" name="tabs" id="tab2" />
			<label for="tab2" role="tab" aria-selected="false" aria-controls="panel2" tabindex="0"><span><?php echo esc_html_e('Guides', 'superb-helper') ?></label> <div id="tab-content2" class="tab-content" role="tabpanel" aria-labelledby="specification" aria-hidden="true">

			<ul>

				<?php
				foreach($recommended_guides as &$guide){ 
					$name = esc_attr($guide['name']);
					$path = esc_url($guide['path']);
					$desc = esc_attr($guide['desc']);
					$btn = esc_attr($guide['btn']);
					?>
				<li class="spbhlpr__superb__helper__tab__plugin__recomendation__item">
					<div class="spbhlpr__superb__helper__tab__plugin__recomendation__item__middle">
						<h3><?php echo $name; ?></h3>
						<p><?php echo $desc; ?></p>
					</div>
					<div class="spbhlpr__superb__helper__tab__plugin__recomendation__item__right">
						<a href="<?php echo $path; ?>" target="_blank" rel="nofollow" class="spbhlpr__superb__helper__tab__plugin__recomendation__item__right_button"><i class="fas fa-external-link-alt"></i> <?php echo $btn; ?></a>
					</div>
				</li>
				<?php } ?>
			</ul>

		</div>
	</li>
</ul>


</div>
</div>