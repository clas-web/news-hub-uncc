


jQuery(document).ready( function()
{
	
	jQuery('.related-taxonomies .results').each(
		function()
		{
			var self = this;
			var links = jQuery(self).find('a');
			var more_link = null;
			
			if( links.length > 10 )
			{
				more_link = jQuery('<div class="more-link">LESS</div>');
				jQuery(self).append(more_link);
				
				jQuery(more_link)
					.click( function()
					{
						switch( jQuery(more_link).html() )
						{
							case 'MORE': jQuery(more_link).html('LESS'); break;
							case 'LESS': jQuery(more_link).html('MORE'); break;
						}
						for( var i = 10; i < links.length; i++ )
						{
							jQuery(links[i]).toggle();
						}
					})
					.click();
			}
		}
	);
	
});


