

<?php global $ns_config, $ns_mobile_support, $ns_template_vars; ?>
<?php if( $ns_config->show_template_part('header') ): ?>

<?php 
$header_wrapper_bg = ns_get_image_url( $ns_config->get_value('header', 'header-wrapper-bg', 'url') );
$header_bg = ns_get_image_url( $ns_config->get_value('header', 'header-bg', 'url') );

$title = $ns_config->get_value('header', 'title');
$description = $ns_config->get_value('header', 'description');
?>

<div id="header-wrapper" class="clearfix" style="background-image:url('<?php echo $header_wrapper_bg; ?>');">

	<div id="header" class="clearfix">
	<?php ns_use_widget( 'header', 'top' ); ?>

	<div class="masthead" style="background-image:url('<?php echo $header_bg; ?>');">
	
		<?php ns_image( $ns_config->get_value('header', 'logo') ); ?>

		<?php if( !$ns_mobile_support->use_mobile_site ): ?>
			
			<?php 
			$title_box_info = $ns_config->get_value('header', 'title-box'); 
			?>
			<div class="title-box-wrapper" style="height:100px">
			<div class="title-box <?php echo $title['position']; ?>">
				<?php echo ns_get_anchor( $title['url'], $title['text'], 'title', '<div>'.$title['text'].'</div>' ); ?>
				<?php echo ns_get_anchor( $description['url'], $description['text'], 'description', '<div>'.$description['text'].'</div>' ); ?>
			</div>
			</div>
		
			<div id="links">
				<a href="<?php echo home_url( '/' ); ?>" title="">Home</a>
				<a href="<?php echo home_url( '/' ); ?>contact-us/" title="">Contact Us</a>
			</div>
			<div id="header-utility">
				<form id="site-searchform" class="searchform" method="get" action="<?php echo home_url( '/' ); ?>">
					<script>var main_search_used = false;</script>
					<input type="text" name="s" id="header-search" class="s" size="30" value="<?php if( is_search() ) { the_search_query(); } else { echo "Search ".get_bloginfo('name'); } ?>" onfocus="if (!main_search_used) { this.value = ''; main_search_used = true; }" /><input type="image" name="op" value="Search" id="edit-submit" alt="search" title="Search this site" src="<?php print get_stylesheet_directory_uri() ?>/images/search-button.png">
				</form>
			</div><!-- #header-utility -->
			
		<?php endif; ?>
	
	</div><!-- .masthead -->
	
	<?php ns_use_widget( 'header', 'bottom' ); ?>
	</div><!-- #header -->

</div><!-- #header-wrapper -->


<?php endif; ?>

