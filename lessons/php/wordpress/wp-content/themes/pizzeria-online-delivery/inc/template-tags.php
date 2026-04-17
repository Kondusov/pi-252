<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package pizzeria_online_delivery
 */

if ( ! function_exists( 'pizzeria_online_delivery_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function pizzeria_online_delivery_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$pizzeria_online_delivery_posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = '<span class="author vcard" itemprop="author"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
    
	echo '<span class="posted-on">' . $pizzeria_online_delivery_posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function pizzeria_online_delivery_categorized_blog() {
	if ( false === ( $pizzeria_online_delivery_all_the_cool_cats = get_transient( 'pizzeria_online_delivery_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$pizzeria_online_delivery_all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$pizzeria_online_delivery_all_the_cool_cats = count( $pizzeria_online_delivery_all_the_cool_cats );

		set_transient( 'pizzeria_online_delivery_categories', $pizzeria_online_delivery_all_the_cool_cats );
	}

	if ( $pizzeria_online_delivery_all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so pizzeria_online_delivery_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so pizzeria_online_delivery_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in pizzeria_online_delivery_categorized_blog.
 */
function pizzeria_online_delivery_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'pizzeria_online_delivery_categories' );
}
add_action( 'edit_category', 'pizzeria_online_delivery_category_transient_flusher' );
add_action( 'save_post',     'pizzeria_online_delivery_category_transient_flusher' );


if ( ! function_exists( 'pizzeria_online_delivery_category_list' ) ) :
/**
 * Prints Categories lists
*/
function pizzeria_online_delivery_category_list(){
    // Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$pizzeria_online_delivery_categories_list = get_the_category_list( esc_html__( ', ', 'pizzeria-online-delivery' ) );
		if ( $pizzeria_online_delivery_categories_list && pizzeria_online_delivery_categorized_blog() ) {
			echo '<span class="category">' . $pizzeria_online_delivery_categories_list . '</span>';
		}
	}
}
endif;