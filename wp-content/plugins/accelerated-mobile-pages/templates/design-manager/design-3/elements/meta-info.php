
<?php do_action('ampforwp_before_meta_info_hook',$this); ?>
<?php global $redux_builder_amp;
if ( is_single() || (is_page() && $redux_builder_amp['meta_page']) ) : ?>
<div class="amp-wp-content amp-wp-article-header ampforwp-meta-info">
	<div class="amp-wp-content post-title-meta">

	<ul class="amp-wp-meta amp-meta-wrapper">
<?php $post_author = $this->get( 'post_author' ); ?>
<?php if ( $post_author ) : ?>
  <li>
	<div class="amp-wp-meta amp-wp-byline">
  <?php if ( is_single() ) { 
    echo ampforwp_get_author_details( $post_author , 'meta-info' ); 
  } ?>
<?php if( is_page() && $redux_builder_amp['meta_page'] ) {
    echo ampforwp_get_author_details( $post_author , 'meta-info' );
    } ?>
<?php 
if( isset($redux_builder_amp['ampforwp-cats-single']) && $redux_builder_amp['ampforwp-cats-single']) {
  $ampforwp_categories = get_the_terms( $this->ID, 'category' );
  if ( $ampforwp_categories ) : ?>
  	<span class="amp-wp-meta amp-wp-tax-category ampforwp-tax-category  ">
      <?php
        global $redux_builder_amp; printf( esc_attr(ampforwp_translation($redux_builder_amp['amp-translator-in-designthree'] , 'in' ) .' ')); 

        foreach ($ampforwp_categories as $cat ) {
            $term_id   = $cat->term_id;
            $term_name   = $cat->name;
            $term_url   = get_category_link( $cat->term_id );
          if(false == ampforwp_get_setting('ampforwp-cats-tags-links-single')){
                $term_url =  false;
              } 
          elseif( true == ampforwp_get_setting('ampforwp-archive-support') && true == ampforwp_get_setting('ampforwp-cats-tags-links-single')) {    
              // #934
                       $term_url   = ampforwp_url_controller( $term_url );
                }
                echo ('<span class="amp-cat amp-cat-'. esc_attr($term_id) . '" >
                '. (!empty($term_url)? ' <a href="'. esc_url( $term_url)  . '" > ':'').  esc_html($term_name). (!empty($term_url)?  '</a> ':'').' </span>');
       }
			?>
  	</span>
<?php endif;  } ?>

<?php if ( $redux_builder_amp['amp-design-3-date-feature'] ) : ?>
	<span class="ampforwp-design3-single-date"><?php global $redux_builder_amp;
  $date = get_the_date( get_option( 'date_format' ));
  if( 2 == $redux_builder_amp['ampforwp-post-date-global'] ){
    $date = get_the_modified_date( get_option( 'date_format' ) ) . ', ' . get_the_modified_time() ;
  }

  echo esc_attr(apply_filters('ampforwp_modify_post_date', ampforwp_translation($redux_builder_amp['amp-translator-on-text'], 'On') . ' ' . $date )) ?></span>
<?php endif; ?>

	</div>
<?php endif; ?>

      </li>
			</ul>
	</div>
</div>
<?php endif; ?>
<?php do_action('ampforwp_after_meta_info_hook',$this);
