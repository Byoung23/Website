<?php
/**
 * Displays page and sub-pages and contents
 * @since 3.0.0
 */
?>
<!-- BEGIN: Force page to scroll top before load -->
<script>window.onbeforeunload = function () {window.scrollTo(0, 0);}</script>
<!-- END: Force page to scroll top before load -->

<!-- BEGIN: Main Container -->
<div id="wpui-container-minimalist">
	<!-- BEGIN: Container -->
	<div class="wpui-container">
		<h4 class="wpui-title">Form Submissions - Contact Form 7</h4>
		<!-- BEGIN: Tabs -->
		<div class="wpui-tabs">
			<!-- BEGIN: Header -->
			<div class="wpui-tabs-header">
				<?php
                    $forms = new WP_Query( array( 'post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC' ) );
                    $tabs = array(
                        'all' => array(
                            'url' 		    => 'all',
                            'header-title' 	=> 'All Messages',
                            'body-title' 	=> 'All Messages',
                            'category'      => 'all'
                        )
                    );
                    
                    if ( $forms->have_posts() ) {
                        while ( $forms->have_posts() ) {
                            $forms->the_post();
                            $title              = trim( preg_replace( '/\s*\([^)]*\)/', '', get_the_title() ) );
							// $header_title       = mb_strimwidth( $title, 0, 20, '...' );
							$header_title       = $title;
                            $category           = preg_replace( "![^a-z0-9]+!i", "-", $title );
                            $tabs[$category]    = array(
                                'url' 		    => $category,
                                'header-title' 	=> $header_title,
                                'body-title' 	=> get_the_title(),
                                'category'  	=> $category
                            );
                        }
                    }
                    array_filter( $tabs );

					/** Create main tabs */
					echo '<ul>';  foreach ( $tabs as $tab ) echo '<li><a data-id="' . $tab['url'] . '">' . $tab['header-title'] . '</a></li>'; echo '</ul>';
				?>
			</div>
			<!-- END: Header -->
			<!-- BEGIN: Body -->
			<div class="wpui-tabs-body">
				<!-- Loader -->
				<div class="wpui-tabs-body-loader"><i class="ai-font-loading-b"></i></div>
				<!-- Contents -->
				<?php
					foreach ( $tabs as $tab ) {
						echo '<div data-id="' . $tab['url'] . '" class="wpui-tabs-content">';
							/** Title */ 
							echo '<div class="wpui-tabs-title">' . $tab['body-title'] . '</div>';
							/** Check if child is an array to create a child sub pages else only main page will be created. */
                            echo '<div class="wpui-tabs-container">';
								echo '<div class="wpui-row wpui-row-box list-of-logs-heading">
									<div class="wpui-col-md-2">
										<p><strong>Name</strong></p>
									</div>
									<div class="wpui-col-md-2">
										<p><strong>Email</strong></p>
									</div>
									<div class="wpui-col-md-2">
										<p><strong>Form</strong></p>
									</div>
									<div class="wpui-col-md-2">
										<p><strong>Page Source</strong></p>
									</div>
									<div class="wpui-col-md-2">
										<p><strong>Date</strong></p>
									</div>
									<div class="wpui-col-md-1">
										<p><strong>View More</strong></p>
									</div>
								</div>';
                                
                                global $wpdb;
                                $table_name = $wpdb->prefix . AIOS_LEADS_NAME;
                                if ( $tab['category'] != 'all' ) {
                                    $fromCategory = $tab['category'];
                                    $query = "(SELECT * FROM $table_name WHERE category LIKE '$fromCategory')";
                                } else {
                                    $query = "(SELECT * FROM $table_name)";
                                }

                                $total_query = "SELECT COUNT(id) FROM (${query}) AS combined_table";
                                $total = $wpdb->get_var( $total_query );

                                $items_per_page = 25;
                                $paged = isset( $_REQUEST['paged'] ) ? max( 0, intval( $_REQUEST['paged'] ) - 1) : 0;
                                $paginated = $paged + 1;
                                $offset = ( $page * $items_per_page ) - $items_per_page;

                                $orderby = 'created_at';
                                $order = 'ASC';

                                $prepare = $wpdb->prepare( "
                                    $query
                                    ORDER BY $orderby $order
                                    LIMIT %d OFFSET %d", 
                                    $items_per_page, 
                                    $paged
                                );
                                $results = $wpdb->get_results( $prepare, OBJECT );

                                if( ! empty( $results ) ) {
                                    foreach( $results as $row ) {
                                        echo '<div class="wpui-row wpui-row-box list-of-logs">
											<div class="wpui-col-md-2">
												<p><strong>' . $row->client_name . '</strong></p>
											</div>
											<div class="wpui-col-md-2">
												<p><strong>' . $row->client_email . '</strong></p>
											</div>
											<div class="wpui-col-md-2">
												<p><strong>' . $row->title . '</strong></p>
											</div>
											<div class="wpui-col-md-2">
												<p><strong>' . $row->page_source . '</strong></p>
											</div>
											<div class="wpui-col-md-2">
												<p><strong>' . $row->date . '</strong></p>
											</div>
											<div class="wpui-col-md-1">
												<p><a href="" class="view-full-logs-details">View Details</a></p>
											</div>
											<!-- BEGIN: Full Details -->
											<div class="wpui-col-md-12 full-logs-details">' . $row->client_body . '</div>
											<!-- END: Full Details -->
										</div>';
                                    }
                                    
                                    if ( $total > 25 ): ?>
                                        <div class="wpui-pagination">
                                            <?php
                                                $big = 999999999; // need an unlikely integer
                                                echo paginate_links( array(
                                                    'base' 			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                                    'format' 		=> '?paged=%#%',
                                                    'current' 		=> max( 1, $paginated ),
                                                    'prev_text'		=> ( isset( $prev_link_text ) && !empty( $prev_link_text ) )? $prev_link_text : '<span class="p-prev">Previous</span>',
                                                    'next_text'		=> ( isset( $next_link_text ) && !empty( $next_link_text ) )? $next_link_text : '<span class="p-next">Next</span>',
                                                    'total' 		=> ceil( $total / $items_per_page ),
                                                ) );
                                            ?>
                                        </div>
                                    <?php endif;
                                } else {
                                    echo '<div class="wpui-row wpui-row-box list-of-logs">
										<div class="wpui-col-md-12">
											<p>No Submitted Form.</p>
										</div>
									</div>';
                                } 
                                
                                echo '</div>';
						echo '</div>';
					}
				?>
			</div>
			<!-- END: Body -->
		</div>
		<!-- END: Tabs -->
	</div>
	<!-- END: Container -->
</div>
<!-- END: Main Container -->