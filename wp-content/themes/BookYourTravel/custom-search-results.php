<?php/* Template Name: Custom Search Results *//* The template for displaying the custom search results page. * * @package WordPress * @subpackage BookYourTravel * @since Book Your Travel 1.0 */ global $current_url, $byt_theme_globals, $current_user, $frontend_submit, $byt_reviews_post_type, $byt_accommodations_post_type, $byt_car_rentals_post_type, $byt_cruises_post_type, $byt_tours_post_type;get_header();  BYT_Theme_Utils::breadcrumbs();get_sidebar('under-header');$enable_reviews = $byt_theme_globals->enable_reviews();$enable_accommodations = $byt_theme_globals->enable_accommodations();$current_user = wp_get_current_user();$user_info = get_userdata($current_user->ID);$price_decimal_places = $byt_theme_globals->get_price_decimal_places();$default_currency_symbol = $byt_theme_globals->get_default_currency_symbol();$show_currency_symbol_after = $byt_theme_globals->show_currency_symbol_after();$default_results_view = $byt_theme_globals->get_search_results_default_view();$custom_search_results_page = $byt_theme_globals->get_custom_search_results_page_url();$request_car_types = BYT_Theme_Utils::retrieve_array_of_values_from_query_string('car_types', true);$request_car_rental_tags = BYT_Theme_Utils::retrieve_array_of_values_from_query_string('car_rental_tags', true);$request_tour_types = BYT_Theme_Utils::retrieve_array_of_values_from_query_string('tour_types', true);$request_tour_tags= BYT_Theme_Utils::retrieve_array_of_values_from_query_string('tour_tags', true);$request_cruise_types = BYT_Theme_Utils::retrieve_array_of_values_from_query_string('cruise_types', true);$request_cruise_tags = BYT_Theme_Utils::retrieve_array_of_values_from_query_string('cruise_tags', true);$request_accommodation_types = BYT_Theme_Utils::retrieve_array_of_values_from_query_string('accommodation_types', true);$request_accommodation_tags = BYT_Theme_Utils::retrieve_array_of_values_from_query_string('accommodation_tags', true);$request_cabin_types = BYT_Theme_Utils::retrieve_array_of_values_from_query_string('cabin_types', true);$request_prices = BYT_Theme_Utils::retrieve_array_of_values_from_query_string('price', true);$search_term = isset($_GET['term']) ? wp_kses($_GET['term'], '') : '';$location_id = isset($_GET['l']) ? intval(wp_kses($_GET['l'], '')) : 0; $age = isset($_GET['age']) ? intval(wp_kses($_GET['age'], '')) : 0; $stars = isset($_GET['stars']) ? intval(wp_kses($_GET['stars'], '')) : 0; $rating = isset($_GET['rating']) ? intval(wp_kses($_GET['rating'], '')) : 0; $guests = isset($_GET['guests']) ? intval(wp_kses($_GET['guests'], '')) : 0; $cabins = isset($_GET['cabins']) ? intval(wp_kses($_GET['cabins'], '')) : 0; $rooms = isset($_GET['rooms']) ? intval(wp_kses($_GET['rooms'], '')) : 0; $what = isset($_GET['what']) ? intval(wp_kses($_GET['what'], '')) : 1; $is_self_catered = ($what == 2);$sort_by = isset($_GET['sb']) ? intval(wp_kses($_GET['sb'], '')) : 1; $sort_order = isset($_GET['so']) ? intval(wp_kses($_GET['so'], '')) : 1;$date_from = isset($_GET['from']) && !empty($_GET['from'])  ? date('Y-m-d', strtotime(wp_kses($_GET['from'], ''))) : null;$date_to = isset($_GET['to']) && !empty($_GET['to']) ? date('Y-m-d', strtotime(wp_kses($_GET['to'], ''))) : null;$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;$posts_per_page = $byt_theme_globals->get_search_results_posts_per_page();$search_args = array();$search_args['date_from'] = $date_from;$search_args['date_to'] = $date_to;$search_args['keyword'] = $search_term;$search_args['prices'] = $request_prices;$search_args['price_range_bottom'] = $byt_theme_globals->get_price_range_bottom();$search_args['price_range_increment'] = $byt_theme_globals->get_price_range_increment();$search_args['price_range_count'] = $byt_theme_globals->get_price_range_count();$search_args['search_only_available'] = $byt_theme_globals->search_only_available_properties();if ($what == 1 || $what == 2) {	$sort_order = $sort_order == '1' ? 'ASC' : 'DESC';	if (isset($sort_by)) {		switch ($sort_by) {			case '1' : $sort_by = 'min_price';break;// price			case '2' : $sort_by = 'star_count';break;// star count			case '3' : $sort_by = 'review_score';break;// star count			default : $sort_by = 'accommodations.post_title';break;		}	} else {		$sort_by = 'accommodations.post_title';	}	$search_args['rating'] = $rating;	$search_args['rooms'] = $rooms;	$search_args['stars'] = $stars;		$results = $byt_accommodations_post_type->list_accommodations ( $paged, $posts_per_page, $sort_by, $sort_order, $location_id, $request_accommodation_types, array(), $search_args, false, $is_self_catered);	$current_url = $custom_search_results_page . '?from=' . urlencode($date_from) . '&to=' . urlencode($date_to) . '&term=' . $search_term . '&what=' . $what;} else if ($what == 3) {	$search_args['age'] = $age;	$sort_by = $sort_by == '1' ? 'price' : 'car_rentals.post_title';	$sort_order = $sort_order == '1' ? 'ASC' : 'DESC';		$results = $byt_car_rentals_post_type->list_car_rentals($paged, $posts_per_page, $sort_by, $sort_order, $location_id, $request_car_types, array(), $search_args);	$current_url = $custom_search_results_page . '?from=' . urlencode($date_from) . '&to=' . urlencode($date_to) . '&term=' . $search_term . '&what=' . $what;} else if ($what == 4) {	$search_args['guests'] = $guests;	$sort_by = $sort_by == '1' ? 'tours.ID' : 'tours.post_title';	$sort_order = $sort_order == '1' ? 'ASC' : 'DESC';	$results = $byt_tours_post_type->list_tours($paged, $posts_per_page, $sort_by, $sort_order, $location_id,$request_tour_types, array(), $search_args);	$current_url = $custom_search_results_page . '?from=' . urlencode($date_from) . '&term=' . $search_term . '&what=' . $what;	} else if ($what == 5) {	$search_args['guests'] = $guests;	$search_args['cabins'] = $cabins;	$sort_by = $sort_by == '1' ? 'cruises.ID' : 'cruises.post_title';	$sort_order = $sort_order == '1' ? 'ASC' : 'DESC';	$results = $byt_cruises_post_type->list_cruises($paged, $posts_per_page, $sort_by, $sort_order, $location_id, $request_cruise_types, array(), $search_args);	$current_url = $custom_search_results_page . '?from=' . urlencode($date_from) . '&what=' . $what;	}$page_id = $post->ID;$page_custom_fields = get_post_custom( $page_id);$page_sidebar_positioning = null;if (isset($page_custom_fields['page_sidebar_positioning'])) {	$page_sidebar_positioning = $page_custom_fields['page_sidebar_positioning'][0];	$page_sidebar_positioning = empty($page_sidebar_positioning) ? '' : $page_sidebar_positioning;}$section_class = 'full';if ($page_sidebar_positioning == 'both')	$section_class = 'one-half';else if ($page_sidebar_positioning == 'left' || $page_sidebar_positioning == 'right') 	$section_class = 'three-fourth';if ($page_sidebar_positioning == 'both' || $page_sidebar_positioning == 'left')	get_sidebar('left');?>	<section class="<?php echo esc_attr($section_class); ?>">		<div class="sort-by">			<h3><?php _e('Sort by', 'bookyourtravel'); ?></h3>			<ul class="sort">				<li><?php _e('Price', 'bookyourtravel'); ?> <a href="<?php echo esc_url($current_url) . '&sb=1&so=1'; ?>" title="<?php esc_attr_e('ascending', 'bookyourtravel'); ?>" class="ascending"><?php _e('ascending', 'bookyourtravel'); ?></a><a href="<?php echo esc_url($current_url) . '&sb=1&so=2'; ?>" title="<?php esc_attr_e('descending', 'bookyourtravel'); ?>" class="descending"><?php _e('descending', 'bookyourtravel'); ?></a></li>				<?php if ($what == 1 || $what == 2) { ?>				<li><?php _e('Stars', 'bookyourtravel'); ?> <a href="<?php echo esc_url($current_url) . '&sb=2&so=1'; ?>" title="<?php esc_attr_e('ascending', 'bookyourtravel'); ?>" class="ascending"><?php _e('ascending', 'bookyourtravel'); ?></a><a href="<?php echo esc_url($current_url) . '&sb=2&so=2'; ?>" title="<?php esc_attr_e('descending', 'bookyourtravel'); ?>" class="descending"><?php _e('descending', 'bookyourtravel'); ?></a></li>				<li><?php _e('Rating', 'bookyourtravel'); ?> <a href="<?php echo esc_url($current_url) . '&sb=3&so=1'; ?>" title="<?php esc_attr_e('ascending', 'bookyourtravel'); ?>" class="ascending"><?php _e('ascending', 'bookyourtravel'); ?></a><a href="<?php echo esc_url($current_url) . '&sb=3&so=2'; ?>" title="<?php esc_attr_e('descending', 'bookyourtravel'); ?>" class="descending"><?php _e('descending', 'bookyourtravel'); ?></a></li>				<?php } ?>			</ul>						<ul class="view-type">				<script>					window.defaultResultsView = <?php echo $default_results_view; ?>;				</script>				<li class="grid-view <?php echo ($default_results_view === 0) ? 'active' : ''; ?>"><a href="#" title="grid view"><?php _e('grid view', 'bookyourtravel'); ?></a></li>				<li class="list-view <?php echo ($default_results_view === 1) ? 'active' : ''; ?>"><a href="#" title="list view"><?php _e('list view', 'bookyourtravel'); ?></a></li>			</ul>		</div>			<div class="deals clearfix">			<!--deal-->			<?php 			if (count($results) > 0 && $results['total'] > 0) { ?>				<div class="inner-wrap">				<?php				foreach ($results['results'] as $result) { 					global $post, $tour_class, $car_rental_class, $accommodation_class, $cruise_class;					$post = $result;					setup_postdata( $post ); 					if ($what == 1 || $what == 2) {						$accommodation_class = 'one-fourth';						get_template_part('includes/parts/accommodation', 'item');					} elseif ($what == 3) {						$car_rental_class = 'one-fourth';						get_template_part('includes/parts/car_rental', 'item');					} elseif ($what == 4) {						$tour_class = 'one-fourth';						get_template_part('includes/parts/tour', 'item');					} elseif ($what == 5) {						$cruise_class = 'one-fourth';						get_template_part('includes/parts/cruise', 'item');					}				} ?>				</div>				<nav class="page-navigation bottom-nav">					<!--back up button-->					<a href="#" class="scroll-to-top" title="<?php esc_attr_e('Back up', 'bookyourtravel'); ?>"><?php _e('Back up', 'bookyourtravel'); ?></a> 					<!--//back up button-->					<div class="pager">					<?php 						$total_results = $results['total'];						BYT_Theme_Utils::display_pager( ceil($total_results/$posts_per_page) );					?>					</div>				</nav>			<?php } else { ?>				<p><?php _e('Unfortunately no results match your search criteria. Please try searching for something else.', 'bookyourtravel'); ?></p>			<?php } ?>		</div>	</section><?php wp_reset_postdata();wp_reset_query();if ($page_sidebar_positioning == 'both' || $page_sidebar_positioning == 'right')	get_sidebar('right');get_footer();