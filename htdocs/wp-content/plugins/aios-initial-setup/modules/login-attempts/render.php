<!-- BEGIN: Main Container -->
<div id="wpui-container-minimalist">
	<!-- BEGIN: Container -->
	<div class="wpui-container">
		<h4>Login Attempts</h4>
		<!-- BEGIN: Tabs -->
		<div class="wpui-tabs">
			<!-- BEGIN: Header -->
			<div class="wpui-tabs-header">
                <ul>
                    <li><a data-id="attempts">Details</a></li>
                </ul>
			</div>
			<!-- END: Header -->
			<!-- BEGIN: Body -->
			<div class="wpui-tabs-body">
				<!-- Loader -->
				<div class="wpui-tabs-body-loader"><i class="ai-font-loading-b"></i></div>
				<!-- BEGIN: Contents -->
                <div data-id="attempts" class="wpui-tabs-content">
                    <div class="wpui-tabs-container">
                        <div class="wpui-row wpui-row-box list-of-logs-heading">
                            <div class="wpui-col-md-4">
                                <p><strong>Date</strong></p>
                            </div>
                            <div class="wpui-col-md-4">
                                <p><strong>ISP</strong></p>
                            </div>
                            <div class="wpui-col-md-4">
                                <p><strong>Tried to log in as</strong></p>
                            </div>
                        </div>
                        <?php 
                            $paged = isset( $_GET['paged'] ) ? $_GET['paged'] : 1;
                            
                            $args = array(
                                'post_type' 	=> 'aios-login-attempts',
                                'post_status' 	=> 'publish',
                                'showposts' 	=> 25,
                                'paged'			=> $paged
                            );

                            $login_attempts = new WP_Query( $args );
                            if ( $login_attempts->have_posts() ) {
                                while( $login_attempts->have_posts() ) {
                                    $login_attempts->the_post();

                                    $id         = get_the_ID();
                                    $title      = get_the_title();
                                    $date       = get_post_meta( $id, 'tried_date', true );
                                    $username   = get_post_meta( $id, 'username', true );
                                    ?>
                                        <div class="wpui-row wpui-row-box list-of-logs">
                                            <div class="wpui-col-md-4">
                                                <p class="my-0"><?=$title?></p>
                                            </div>
                                            <div class="wpui-col-md-4">
                                                <p class="my-0"><?=$date?></p>
                                            </div>
                                            <div class="wpui-col-md-4">
                                                <p class="my-0"><?=$username?></p>
                                            </div>
                                        </div>
                                    <?php
                                } 
                            } else {
                                echo '<div class="wpui-row wpui-row-box list-of-logs">
                                    <div class="wpui-col-md-2">
                                        <p>No blocked isp.</p>
                                    </div>
                                </div>';
                            }
                        ?>
                        <?php if ( $login_attempts->found_posts > 25 ): ?>
                            <div class="wpui-pagination">
                                <?php
                                    $big = 999999999; // need an unlikely integer
                                    echo paginate_links( array(
                                        'base' 			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                        'format' 		=> '?paged=%#%',
                                        'current' 		=> max( 1, $paged ),
                                        'prev_text'		=> ( isset( $prev_link_text ) && !empty( $prev_link_text ) )? $prev_link_text : '<span class="p-prev">Previous</span>',
                                        'next_text'		=> ( isset( $next_link_text ) && !empty( $next_link_text ) )? $next_link_text : '<span class="p-next">Next</span>',
                                        'total' 		=> $login_attempts->max_num_pages,
                                    ) );
                                    wp_reset_postdata();
                                ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <!-- END: Contents -->
			</div>
			<!-- END: Body -->
		</div>
		<!-- END: Tabs -->
	</div>
	<!-- END: Container -->
</div>
<!-- END: Main Container -->