

<?php global $ns_config, $ns_mobile_support, $ns_template_vars; ?>
<?php if( $ns_config->show_template_part('footer') ): ?>

<?php
function ns_footer_search()
{
	?>
	<div class="search">
		<form action="http://search.uncc.edu/" method="get" id="uncc-searchform" class="searchform">
			<script>var uncc_search_used = false;</script>
			<input type="text" name="s" id="footer-search" size="30" value="<?php if( is_search() ) { the_search_query(); } else { echo "Search UNCC"; } ?>" onfocus="if (!uncc_search_used) { this.value = ''; uncc_search_used = true; }" /><input type="image" name="op" value="Search" id="edit-submit" alt="search" title="Search this site" src="<?php print get_stylesheet_directory_uri() ?>/images/search-button.png">
		</form>
	</div>
	<?php
}

function ns_footer_links()
{
	global $ns_config, $ns_mobile_support;
	?>
	<div class="links">
	
		<ul> 
			<?php if( !$ns_mobile_support->use_mobile_site ): ?>
				<li><?php ns_image( $ns_config->get_value('footer', 'uncc-logo') ); ?></li>
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

function ns_footer_follow()
{
	global $ns_config;
	?>
	<div class="follow"> 
		<div>Follow UNC Charlotte</div> 
		<span class="tm-facebook social-icons"><?php ns_image( $ns_config->get_value('footer', 'facebook') ); ?></span>  
		<span class="tm-blog social-icons"><?php ns_image( $ns_config->get_value('footer', 'blogger') ); ?></span> 
		<span class="tm-twitter social-icons"><?php ns_image( $ns_config->get_value('footer', 'twitter') ); ?></span> 
		<span class="tm-flickr social-icons"><?php ns_image( $ns_config->get_value('footer', 'flickr') ); ?></span> 
		<span class="tm-youtube social-icons"><?php ns_image( $ns_config->get_value('footer', 'youtube') ); ?></span> 
	</div>  <!-- .follow --> 
	<?php
}

function ns_footer_address()
{
	global $ns_mobile_support;
	if( $ns_mobile_support->use_mobile_site ):
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
	<?php ns_use_widget( 'footer', 'top' ); ?>
	
		<div class="bar top">
			<?php if( !$ns_mobile_support->use_mobile_site ): ns_footer_links(); ns_footer_search(); endif; ?>
		</div>
		
		<div class="line top"></div>
		
		<div class="body clearfix">

			<?php if( $ns_mobile_support->use_mobile_site ): ns_footer_search(); endif; ?>
		
			<?php if( $ns_mobile_support->use_mobile_site ): ns_footer_links(); endif; ?>

			<?php ns_footer_follow(); ?>

			<?php ns_footer_address(); ?>

		</div>
		
		<?php
		if( $ns_mobile_support->is_mobile ):
		
			?>
			<div class="line bottom"></div>

			<div class="bar bottom">
				
				<?php if( $ns_mobile_support->use_mobile_site ): ?>
					<a href="<?php echo explode('?', $_SERVER['REQUEST_URI'], 2)[0]; ?>?use_mobile_site=0">Full Site</a> | Mobile Site
				<?php else: ?>
					Full Site | <a href="<?php echo explode('?', $_SERVER['REQUEST_URI'], 2)[0]; ?>?use_mobile_site=1">Mobile Site</a>
				<?php endif; ?>
			</div>
			<?php
			
		endif;
		?>
			
	<?php ns_use_widget( 'footer', 'bottom' ); ?>
	</div><!-- #footer -->

</div><!-- #footer-wrapper -->


<?php endif; ?>




