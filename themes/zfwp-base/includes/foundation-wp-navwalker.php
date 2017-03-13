<?php
//Custom Walker for Foundation, adds dropdown and has-dropdown classes to NAV menu
class Foundation_Walker_Nav_Menu extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		if($args->has_children) {
			$output	   .= "\n$indent<ul class=\"dropdown\">\n";
		} else {
			$output	   .= "\n$indent<ul>\n";
		}
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = ($item->current) ? 'active' : '';
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		if ($args->has_children && $depth > 0) {
			$class_names .= ' has-dropdown';
		} else if($args->has_children && $depth === 0) {
			$class_names .= ' has-dropdown';
		}
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		$output .= $indent . '<li' . $class_names .'>';
		$attributes = ! empty( $item->attr_title ) ? 'title="' . esc_attr( $item->attr_title     ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( !$element ) {
			return;
		}
		$id_field = $this->db_fields['id'];
		//display this element
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
		}
		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}
