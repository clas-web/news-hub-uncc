

<?php global $nh_config, $nh_mobile_support, $nh_template_vars; ?>
<?php if( $nh_config->show_template_part('footer') ): ?>

<?php
function nh_footer_search()
{
	?>
	<div class="search">
		<form action="http://search.uncc.edu/website" method="get" id="uncc-searchform" class="searchform">
			<script>var uncc_search_used = false;</script>
			<input type="text" name="q" id="footer-search" size="30" value="<?php if( is_search() ) { the_search_query(); } else { echo "Search UNCC"; } ?>" onfocus="if (!uncc_search_used) { this.value = ''; uncc_search_used = true; }" /><input type="image" name="op" value="Search" id="edit-submit" alt="search" title="Search this site" src="<?php print get_stylesheet_directory_uri() ?>/images/search-button.png">
		</form>
	</div>
	<?php
}

function nh_footer_links()
{
	global $nh_config, $nh_mobile_support;
	?>
	<div class="links">
	
		<ul> 
			<?php if( !$nh_mobile_support->use_mobile_site ): ?>
				<li><?php nh_image( $nh_config->get_image_data( 'footer', 'uncc-logo' ) ); ?></li>
			<?php endif; ?>
			<li><a href="http://www.unccharlottealerts.com" title="Alerts and Advisories at UNC Charlotte" target="_blank">Alerts</a></li> 
			<li><a href="http://jobs.uncc.edu" title="Jobs at UNC Charlotte">Jobs</a></li> 
			<li><a href="http://www.uncc.edu/makeagift" title="Make a gift to UNC Charlotte">Make a Gift</a></li> 
			<li><a href="http://www.uncc.edu/directions" title="Directions to UNC Charlotte">Maps / Directions</a></li> 
			<li><a href="https://textonly.uncc.edu" title="View this page as text only">Text Only</a></li> 
			<li><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/accessibility-icon.png" id="accessibility-icon" alt="Accessibility Icon" title="" /><a href="http://www.uncc.edu/accessibility" title="Accessibility resources at UNC Charlotte">Accessibility</a></li> 
		</ul>
		
	</div>
	<?php
}

function nh_footer_follow()
{
	global $nh_config;
	?>
	<div class="follow"> 
		<div>Follow UNC Charlotte</div> 
		<span class="tm-facebook social-icons"><?php nh_image( $nh_config->get_image_data( 'footer', 'facebook' ) ); ?></span>  
		<span class="tm-blog social-icons"><?php nh_image( $nh_config->get_image_data( 'footer', 'blogger' ) ); ?></span> 
		<span class="tm-twitter social-icons"><?php nh_image( $nh_config->get_image_data( 'footer', 'twitter' ) ); ?></span> 
		<span class="tm-flickr social-icons"><?php nh_image( $nh_config->get_image_data( 'footer', 'flickr' ) ); ?></span> 
		<span class="tm-youtube social-icons"><?php nh_image( $nh_config->get_image_data( 'footer', 'youtube' ) ); ?></span> 
	</div>  <!-- .follow --> 
	<?php
}

function nh_footer_address()
{
	global $nh_mobile_support;
	if( $nh_mobile_support->use_mobile_site ):
	?>
		<div class="address">
			<span class="name"><a href="http://www.uncc.edu" title="www.uncc.edu">The University of North Carolina at Charlotte</a></span>
			<span>9201 University City Blvd., Charlotte, NC 28223-0001</span>
			<span>704-687-UNCC (8622)</span>
			<span>&copy; 2013 UNC Charlotte | All Rights Reserved</span>
			<span><a href="http://legal.uncc.edu/termsofuse/">Terms of Use</a> | <a href="http://legal.uncc.edu/policies/">Policy Statements</a> | <a href="http://www.uncc.edu/contact">Contact Us</a></span>
		</div>
	<?php
	else:
	?>
		<div class="address">
			<span class="name"><a href="http://www.uncc.edu" title="www.uncc.edu">The University of North Carolina at Charlotte</a></span>
			<span>9201 University City Blvd., Charlotte, NC 28223-0001 <b>&middot;</b> 704-687-UNCC (8622)</span>
			<span>&copy; 2013 UNC Charlotte | All Rights Reserved | <a href="http://legal.uncc.edu/termsofuse/">Terms of Use</a> | <a href="http://legal.uncc.edu/policies/">Policy Statements</a> | <a href="http://www.uncc.edu/contact">Contact Us</a></span>
		</div>
	<?php
	endif;
}

?>

<div id="footer-wrapper" class="clearfix">

	<div id="footer" class="clearfix">
	<?php nh_use_widget( 'footer', 'top' ); ?>
	
		<div class="bar top">
			<?php if( !$nh_mobile_support->use_mobile_site ): nh_footer_links(); nh_footer_search(); endif; ?>
		</div>
		
		<div class="line top"></div>
		
		<div class="body clearfix">

			<?php if( $nh_mobile_support->use_mobile_site ): nh_footer_search(); endif; ?>
		
			<?php if( $nh_mobile_support->use_mobile_site ): nh_footer_links(); endif; ?>

			<?php nh_footer_follow(); ?>

			<?php nh_footer_address(); ?>

		</div>
		
		<?php
		if( $nh_mobile_support->is_mobile || $nh_mobile_support->use_mobile_site ):
		
			?>
			<div class="line bottom"></div>

			<div class="bar bottom">
				
				<?php $exploded_uri = explode('?', $_SERVER['REQUEST_URI'], 2); ?>
				<?php if( $nh_mobile_support->use_mobile_site ): ?>
					<a href="<?php echo $exploded_uri[0]; ?>?full">Full Site</a> | Mobile Site
				<?php else: ?>
					Full Site | <a href="<?php echo $exploded_uri[0]; ?>?mobile">Mobile Site</a>
				<?php endif; ?>
			</div>
			<?php
			
		endif;
		?>
			
	<?php nh_use_widget( 'footer', 'bottom' ); ?>
	</div><!-- #footer -->

</div><!-- #footer-wrapper -->


<?php endif; ?>




