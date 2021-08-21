<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jobify
 */

get_header();
$term = get_queried_object();
$args = array(
    'post_type' => 'job',
    'job_category' => $term->slug
);
$query = new WP_Query( $args );
?>

<div class="jobs-archive">
    <div class="container">
        <h2><?php echo $term->name; ?></h2>
        <div class="row">
            <div class="col-md-12">
                <ul class="job-lists">
                        <?php while ($query -> have_posts()) : $query -> the_post(); ?>
                            <li class="job-item">
                                <div class="left">
                                    <?php 
                                        $get_title =  get_the_title(); 
                                        $ltr_group = substr($get_title, 0, 1);
                                        echo $ltr_group;
                                    ?>
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
