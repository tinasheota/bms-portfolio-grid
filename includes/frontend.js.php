(function($) {

	$(function() {
	
		new FLBuilderBMSPortfolioGrid({
			id: '<?php echo $id ?>',
			layout: '<?php echo $settings->layout; ?>',
			pagination: '<?php echo $settings->pagination; ?>',
			postSpacing: '<?php echo $settings->post_spacing; ?>',
			postWidth: '<?php echo $settings->post_width; ?>',
			postHeight: '<?php echo $settings->post_height; ?>',
			matchHeight: '<?php echo $settings->match_height; ?>',
			showFilters: <?php echo $settings->show_filters; ?>
		});

		/* 
			There are two filter lists that are determined by the first two
			parent (top-level) categories found in frontend.php 
		*/

		var portfolioItemFilterClass1 = '',
			portfolioItemFilterClass2 = '';

		var $portfolioGrid = jQuery('.bms-portfolio-grid.fl-post-grid, .bms-portfolio-grid.fl-post-gallery');
		$portfolioGrid.isotope({ filter: portfolioItemFilterClass1 + portfolioItemFilterClass2 });


		// Filter List 1
		$('.filter-list-1 .filter-item').find('a').on('click', function(e){

			e.preventDefault();

			var	classList = $(this).parent('.filter-item').attr('class').split(/\s+/),
				filterItemClass1 = '', // filter item class use the parent category
				portfolioItemFilter1 = ''; // portfolio item filter uses the child categories

			// Get the specific filter item class (the one other than the generic '.filter-item' class)
			$.each(classList, function(index, item) {
			    if (item !== 'filter-item') {
			        filterItemClass1 = '.' + item;
			    }
			});
			
			$(filterItemClass1).removeClass('selected');
			$(this).parent().addClass('selected');

			var portfolioItemFilter1 = $(this).attr('class');
			if (portfolioItemFilter1 == 'all') {
				portfolioItemFilterClass1 = '';
			}
			else {
				portfolioItemFilterClass1 = '.' + portfolioItemFilter1;
			}

			$portfolioGrid.isotope({ filter: portfolioItemFilterClass1 + portfolioItemFilterClass2 });

			$portfolioGrid.on( 'layoutComplete', function( event, laidOutItems ) {
			    //console.log( 'Isotope layout completed on ' + laidOutItems.length + ' items' );

		    	// display message box if no filtered items are found
				if ( $portfolioGrid.data('isotope').filteredItems.length === 0 ) {
					$('.fl-post-grid-empty').show();
				}
				else {
					$('.fl-post-grid-empty').hide();
				}
			});
		});

		// Filter List 2
		$('.filter-list-2 .filter-item').find('a').on('click', function(e){

			e.preventDefault();

			var	classList = $(this).parent('.filter-item').attr('class').split(/\s+/),
				filterItemClass2 = '', // filter item class use the parent category
				portfolioItemFilter2 = ''; // portfolio item filter uses the child categories

			// Get the specific filter item class (the one other than the generic '.filter-item' class)
			$.each(classList, function(index, item) {
			    if (item !== 'filter-item') {
			        filterItemClass2 = '.' + item;
			    }
			});

			$(filterItemClass2).removeClass('selected');
			$(this).parent().addClass('selected');

			var portfolioItemFilter2 = $(this).attr('class');
			if (portfolioItemFilter2 == 'all') {
				portfolioItemFilterClass2 = '';
			}
			else {
				portfolioItemFilterClass2 = '.' + portfolioItemFilter2;
			}

			$portfolioGrid.isotope({ filter: portfolioItemFilterClass1 + portfolioItemFilterClass2 });

			$portfolioGrid.on( 'layoutComplete', function( event, laidOutItems ) {
			    //console.log( 'Isotope layout completed on ' + laidOutItems.length + ' items' );

		    	// display message box if no filtered items are found
				if ( $portfolioGrid.data('isotope').filteredItems.length === 0 ) {
					$('.fl-post-grid-empty').show();
				}
				else {
					$('.fl-post-grid-empty').hide();
				}
			});
		});


	});

	<?php if($settings->layout == 'grid') : ?>
	$(window).on('load', function() {

		var $portfolioGridContainer = $('.fl-node-<?php echo $id; ?> .bms-portfolio-grid.fl-post-<?php echo $settings->layout; ?>');
		if ( $portfolioGridContainer.data('isotope') ) { // Make sure isotope is initialized before calling reloadImages.
		   $portfolioGridContainer.isotope('reloadItems');
		   //console.log('reloadItems');
		}
		
	});
	<?php endif; ?>
	
})(jQuery);