<?php
// post type init
function jobs_post_type_init() {
    $labels = array(
        'name'                  => _x( 'Jobs', 'Post type general name', 'jobify' ),
        'singular_name'         => _x( 'Job', 'Post type singular name', 'jobify' ),
        'menu_name'             => _x( 'Jobs', 'Admin Menu text', 'jobify' ),
        'name_admin_bar'        => _x( 'Job', 'Add New on Toolbar', 'jobify' ),
        'add_new'               => __( 'Add New', 'jobify' ),
        'add_new_item'          => __( 'Add New Job', 'jobify' ),
        'new_item'              => __( 'New Job', 'jobify' ),
        'edit_item'             => __( 'Edit Job', 'jobify' ),
        'view_item'             => __( 'View Job', 'jobify' ),
        'all_items'             => __( 'All Jobs', 'jobify' ),
        'search_items'          => __( 'Search Jobs', 'jobify' ),
        'parent_item_colon'     => __( 'Parent Jobs:', 'jobify' ),
        'not_found'             => __( 'No Jobs found.', 'jobify' ),
        'not_found_in_trash'    => __( 'No Jobs found in Trash.', 'jobify' ),
        'featured_image'        => _x( 'Job Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'jobify' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'jobify' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'jobify' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'jobify' ),
        'archives'              => _x( 'Job archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'jobify' ),
        'insert_into_item'      => _x( 'Insert into Job', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'jobify' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Job', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'jobify' ),
        'filter_items_list'     => _x( 'Filter Jobs list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'jobify' ),
        'items_list_navigation' => _x( 'Jobs list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'jobify' ),
        'items_list'            => _x( 'Jobs list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'jobify' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'job' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor','thumbnail'),
    );
 
    register_post_type( 'job', $args );
}
 
add_action( 'init', 'jobs_post_type_init' );

//taxonomy init
function jobs_custom_taxanomy() {
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name', 'jobify' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'jobify' ),
        'search_items'      => __( 'Search categories', 'jobify' ),
        'all_items'         => __( 'All categories', 'jobify' ),
        'parent_item'       => __( 'Parent category', 'jobify' ),
        'parent_item_colon' => __( 'Parent category:', 'jobify' ),
        'edit_item'         => __( 'Edit category', 'jobify' ),
        'update_item'       => __( 'Update category', 'jobify' ),
        'add_new_item'      => __( 'Add New category', 'jobify' ),
        'new_item_name'     => __( 'New category Name', 'jobify' ),
        'menu_name'         => __( 'Category', 'jobify' ),
    );
 
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'has_archive'       => true,
        'rewrite'           => array( 'slug' => 'category' ),
    );
 
    register_taxonomy( 'job_category', array( 'job' ), $args );
}
add_action( 'init', 'jobs_custom_taxanomy' );

// Meta Box

abstract class WPOrg_Meta_Box {
 
 
    /**
     * Set up and add the meta box.
     */
    public static function add() {
        $screens = [ 'job' ];
        foreach ( $screens as $screen ) {
            add_meta_box(
                'wporg_box_id',          // Unique ID
                'Other', // Box title
                [ self::class, 'html' ],   // Content callback, must be of type callable
                $screen                  // Post type
            );
        }
    }
 
 
    /**
     * Save the meta box selections.
     *
     * @param int $post_id  The post ID.
     */
    public static function save( int $post_id ) {
       // if ( array_key_exists( 'option-a', $_POST ) ) {
            update_post_meta(
                $post_id,
                '_wporg_meta_key',
                $_POST['company'],
            );
            update_post_meta(
                $post_id,
                '_wporg_meta_key_b',
                $_POST['apply-date']
            );
             update_post_meta(
                 $post_id,
                 '_wporg_meta_key_apply_link',
                 $_POST['apply-link']
            );
    }
 
 
    /**
     * Display the meta box HTML to the user.
     *
     * @param \WP_Post $post   Post object.
     */
    public static function html( $post ) {
        $company = get_post_meta( $post->ID, '_wporg_meta_key', true );
        $apply_date = get_post_meta( $post->ID, '_wporg_meta_key_b', true );
        $apply_link = get_post_meta( $post->ID, '_wporg_meta_key_apply_link', true );
        ?>
        <div class="job-others">
            <div class="left">
            <h4>Company</h4>
            </div>
            <div class="right">
            <input type="text" name="company" value="<?php
                if($company !== ''){
                    echo $company;
                }
                else{
                    echo "Enter Company";
                }
            ?>">
            </div>
        </div>
        <div class="job-others">
            <div class="left">
            <h4>Application Date</h4>
            </div>
            <div class="right">
            <input type="date" name="apply-date" value="<?php
                if($apply_date !== ''){
                    echo $apply_date;
                }
                else{
                    echo "Application Date";
                    
                }
            ?>">
            </div>
        </div>
        <div class="job-others">
            <div class="left">
            <h4>Apply Button Link</h4>
            </div>
            <div class="right">
            <input type="text" name="apply-link" value="<?php
                if($apply_link !== ''){
                    echo $apply_link;
                }
                else{
                    echo "Enter Link";
                    
                }
            ?>">
            </div>
        </div>

        <?php
    }
}
 
add_action( 'add_meta_boxes', [ 'WPOrg_Meta_Box', 'add' ] );
add_action( 'save_post', [ 'WPOrg_Meta_Box', 'save' ] );