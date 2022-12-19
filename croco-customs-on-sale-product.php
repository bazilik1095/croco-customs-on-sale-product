<?php
/**
 * Plugin Name: Croco Customs On Sale Product
 * Plugin URI:
 * Description: Сhecking on sale product 
 * Version:     1.0.0
 * Author:
 * Author URI:
 * Text Domain: croco-csp
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

class Croco_Customs_On_Sale_Product{

    /**
     * Plugin constructor.
    */
    public function __construct() {
        add_filter('jet-smart-filters/query/final-query', array( $this, 'get_query_has_sale_product'));
    }

    /**
     * Add custom meta query args
     *
     * @since  1.0.0
     * @access public 
     */
    public function get_query_has_sale_product( $query = [] ){

        if( ! empty($query['meta_query'])){

            foreach ($query['meta_query'] as $index => $row) {

                if( false !== strpos($row['key'], '_sale_product' )){

                    unset($query['meta_query'][$index]);

                    $query['post__in'] = wc_get_product_ids_on_sale();
                }
            }
        }

        return $query;
    }

}


new Croco_Customs_On_Sale_Product();