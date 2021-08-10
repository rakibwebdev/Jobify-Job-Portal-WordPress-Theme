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
<div class="single-jobs">
    <div class="container">
        <div class="row">
            <!-- Main content -->
            <div class="col-md-8">
                <!-- Post Thumbnail -->
                <div class="post-thumb">
                    <?php the_post_thumbnail( 'thumbnail' ); ?>
                </div>
                <!-- Post Title -->
                <div class="title-container">
                    <h2><?php the_title(); ?></h2>
                    <!-- Company -->
                    <h3><?php echo $company; ?></h3>
                    <!-- Category -->
                    <div class="post-categories">
                        <?php
                        $categories = get_the_category();
                        $separator = ' ';
                        $output = '';
                        if ( ! empty( $categories ) ) {
                            foreach( $categories as $category ) {
                                $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'jobify' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                            }
                            echo trim( $output, $separator );
                        }
                        ?>
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
                <a href="<?php echo $apply_link; ?>">Apply</a>

            </div>
            <!-- Sidebar -->
            <div class="col-md-4">
                <h3>Job Summary</h3>
                <div class="summary-container">
                    <h4>Category <span>
                        <?php
                        $categories = get_the_category();
                        $separator = ' ';
                        $output = '';
                        if ( ! empty( $categories ) ) {
                            foreach( $categories as $category ) {
                                $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'jobify' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                            }
                            echo trim( $output, $separator );
                        }
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