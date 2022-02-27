<?php
/* Template Name: Events List */

get_header(); 
date_default_timezone_set("Asia/Karachi");
?>


<div class="container">
    <div class="my-5">
        <h1>Events Listing</h1>
    </div>  
 
    <?php 
            $args = array(  
                'post_type' => 'events',
                'post_status' => 'publish',
                'posts_per_page' => -1, 
                'orderby'        => 'meta_value',  
                'meta_key'       => 'date_time', 
                'order'          => 'DESC',             

            );
        
            $loop = new WP_Query( $args ); 
            if ( $loop->have_posts()) {
            while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <div class="row">
                    <div class="col-12">
                        <h3><?php the_title(); ?></h3>
                    </div>
                
                </div>

                <div class="row">
                    <div class="col-8">
                        <?php the_content(); ?>
                        <p>Organizer: <?php the_field('organizer'); ?>, Email: <?php the_field('email_address'); ?>, Location: <?php the_field('address'); ?></p>
                        <p>Lat: <?php the_field('latitude'); ?>, long: <?php the_field('longitude'); ?>, Tags: 
                        <?php
                        	foreach(get_the_terms(get_the_ID(), 'event-tags' ) as $key => $items) { 
                               echo $items->name;
                               if( $key + 1 < count(get_the_terms(get_the_ID(), 'event-tags' ))) {
                                    echo ", ";
                               }
                            }
                        ?>
                      </p>
                    </div>
                    <div class="col-4 text-center">
                        <p>Time: 
                    
                        <?php 
                        $time_span = "Ago";
                        
                        if(get_field('date_time') > date("Y-m-d H:i:s") ) {
                            $time_span = "Remaining";
                        }
                        
                        echo human_time_diff( strtotime( get_field('date_time') ), current_time( 'timestamp', 1 ) )." ".$time_span ;?></p>

                    </div>
                </div>
            <?php endwhile;
            }
            else {
                echo "No event listing found!";
            }
            wp_reset_postdata(); 
    
    ?>
 
</div>




<?php get_footer(); ?>