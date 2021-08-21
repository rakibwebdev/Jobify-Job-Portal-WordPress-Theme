<?php
//post thumbnail
//post title
//post description
//sidebar
get_header();
$company = get_post_meta( $post->ID, '_wporg_meta_key', true );
$apply_date = get_post_meta( $post->ID, '_wporg_meta_key_b', true );
$apply_link = get_post_meta( $post->ID, '_wporg_meta_key_apply_link', true );
?>
<div class="social-share mt-4">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>
					Social Share
					<span><?php echo do_shortcode('[xs_social_share]'); ?></span>
				</h3>
			</div>
			
		</div>
	</div>
	
</div>
<div class="single-jobs">
    <div class="container">
        <div class="row">
            <!-- Main content -->
            <div class="col-md-8">
                <div class="left">
                    <!-- Post Thumbnail -->
                    <div class="post-thumb">
                        <?php 
                                        $get_title =  get_the_title(); 
                                        $ltr_group = substr($get_title, 0, 1);
                                        echo $ltr_group;
                                    ?>
                    </div>
                    <!-- Post Title -->
                    <div class="title-container">
                        <h2><?php the_title(); ?></h2>
                        <!-- Company -->
                        <h3><?php echo $company; ?></h3>
                        <!-- Category -->
                        <div class="post-categories">
                            <?php
                            $taxonomy = 'job_category';
                            $terms = get_the_terms($post->ID, $taxonomy);
                            $categories = [];
                    
                            if( $terms ) {          
                                foreach ($terms as $category) {
                                    $categories[] = $category->name;
                                }       
                            }
                    
                            $categories = implode(', ', $categories);
                    
                            echo $categories .' <br>';
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Post Body -->
                <div class="post-body-container">
                    <?php
                    $content = apply_filters( 'the_content', get_the_content() );
                    echo $content;
                    ?>
                </div>
                <!-- apply button -->
                <a href="<?php echo $apply_link; ?>" class="btn apply-btn" target="_blank">Apply</a>

            </div>
            <!-- Sidebar -->
            <div class="col-md-4 right">
                <div class="summery-title-container">
                    <h3>Job Summary</h3>
                </div>
                <div class="summary-container">
                    <h4>Category <span>
                      
                        <?php
                            $taxonomy = 'job_category';
                            $terms = get_the_terms($post->ID, $taxonomy);
                            $categories = [];
                    
                            if( $terms ) {          
                                foreach ($terms as $category) {
                                    $categories[] = $category->name;
                                }       
                            }
                    
                            $categories = implode(', ', $categories);
                    
                            echo $categories .' <br>';
                            ?>
                    </span></h4>
                    <h4>Last Date <span><?php echo $apply_date; ?></span></h4>
                    <h4>Apply Date <span>
                        <?php
                        $given_date = new \DateTime($apply_date);
                        if ($given_date < new \DateTime('today')) {
                            echo "Expired";
                        }else{
                            echo "Active";
                        }
                        
                        ?>
                    </span></h4>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer( );