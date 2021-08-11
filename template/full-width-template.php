<?php
/**
 * Template Name: Home Page Template
 */

get_header();
?>
<div class="jobs-archive">
    <div class="container">
        <h2>Recent Jobs</h2>
        <div class="row">
            <div class="col-md-12">
                <ul class="job-lists">
                <?php
                $the_query = new WP_Query( array('posts_per_page'=>20,
                                 'post_type'=>'job',
                                 'orderby'   => 'meta_value',
                                 'order' => 'DESC',
                                 'paged' => get_query_var('paged') ? get_query_var('paged') : 1) 
                            ); 
                            ?>
                        <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                            <li class="job-item">
                                <div class="left">
                                    <?php the_post_thumbnail( 'thumbnail' ); ?>
                                </div>
                                <div class="right">
                                    <div class="content">
                                        <h3><?php echo get_the_title(); ?></h3>
                                        <p><?php echo get_post_meta( $post->ID, '_wporg_meta_key', true );?></p>
                                        <p class="application-date">
                                            <?php
                                            $apply_date = get_post_meta( $post->ID, '_wporg_meta_key_b', true );
                                            $given_date = new \DateTime($apply_date);
                                            if ($given_date < new \DateTime('today')) {
                                                echo "Expired";
                                            }else{
                                                echo "Active";
                                            }
                                            
                                            ?>
                                        </p>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="btn job-details-btn">Details</a>
                                </div>
                            </li>
                        
                        <?php
                        endwhile;
                        wp_reset_postdata();
                ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
    

get_footer();
