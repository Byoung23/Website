<?php 
    $category_action = 'WHERE object_type LIKE "Menu"';

    global $wpdb;
    $table_name = $wpdb->prefix . AIOS_AUDIT_LOGS_NAME;
    $query = "(SELECT * FROM $table_name $category_action)";

    $total_query = "SELECT COUNT(id) FROM (${query}) AS combined_table";
    $total = $wpdb->get_var( $total_query );

    $items_per_page = 25;
    $paged = isset( $_REQUEST['paged'] ) ? max( 0, intval( $_REQUEST['paged'] ) - 1) : 0;
    $paginated = $paged + 1;
    $offset = ( $page * $items_per_page ) - $items_per_page;

    $orderby = 'created_at';
    $order = 'DESC';

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
            $id 			= get_the_ID();
			$author 		= empty( $row->author )     ? 'Visitor' : get_the_author_meta( 'display_name', $row->author );
			$content 		= empty( $row->content )    ? '-' : $row->content;
			$date 			= empty( $row->date )       ? '-' : $row->date;
			$action 		= empty( $row->action )     ? '-' : $row->action;
			$object_type 	= empty( $row->object_type )? '-' : $row->object_type;
			$local_ip 		= empty( $row->local_ip )   ? '-' : $row->local_ip;
            $network_ip 	= empty( $row->network_ip ) ? '-' : '<a href="http://iplocation.com/?ip=' . $row->network_ip . '">' . $row->network_ip . '</a>';
            
            echo '<div class="wpui-row wpui-row-box list-of-logs">
                <div class="wpui-col-md-2">
                    <div class="list-of-log-time"><p class="my-0">' . $date . '</p></div>
                </div>
                <div class="wpui-col-md-1">
                    <p class="my-0">' . $local_ip . '</p>
                </div>
                <div class="wpui-col-md-1">
                    <p class="my-0">' . $network_ip . '</p>
                </div>
                <div class="wpui-col-md-2">
                    <p class="my-0">' . $action . '</p>
                </div>
                <div class="wpui-col-md-1">
                    <p class="my-0">' . $author . '</p>
                </div>
                <div class="wpui-col-md-5">
                    <p class="my-0">' . $content . '</p>
                </div>
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
			<div class="wpui-col-md-2">
				<p>No Activity Logs to Display</p>
			</div>
		</div>';
	}
?>