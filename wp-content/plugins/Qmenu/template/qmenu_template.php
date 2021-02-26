<div id="prd-cate-list">
	<div class="main-cate">
		<ul>
		<?php
		$options = get_option( 'qmenu_options', false );
		pr($options);
		foreach ( $options as $menu_item )
		{ ?>
			<li class=""><a title="<?=esc_attr($menu_item['menu_item'])?>" href="<?=esc_url($menu_item['menu_link'])?>"><img class="" width="25" height="25" alt="Firewall" src="<?=esc_url($menu_item['menu_pic'])?>"><span class="mc_title"><?=esc_html($menu_item['menu_item'])?></span></a>
				<ul >
					<?php
					foreach ( $menu_item['submenu_group'] as $sub )
					{ ?>
					<li><a title="<?=esc_attr($sub['menu_subitem'])?>" href="<?=esc_url($sub['menu_sublink'])?>"><img class="" width="85" height="auto" alt="cisco firewall" src="<?=esc_url($sub['menu_subpic'])?>" ><span class="mc_title"><?=esc_html($sub['menu_subitem'])?></span></a></li>
					<?php
					} ?>
				</ul>
			</li>
		<?php 
		} ?>
		</ul>
	</div>
</div>

