<?php
/**
 * The template for displaying product content in the quickview-product.php template
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;
$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_image_ids();

?>
<div class="htmove-modal-row htmove-mb-n30">

    <!-- Product Images Start -->
    <div class="htmove-modal-col htmove-mb-30">
        <div class="product-images">
            <div class="product-gallery-slider">

                <?php if ( has_post_thumbnail() ): ?>
                    <div class="product-gallery-item">
                        <?php 
                            $html = wc_get_gallery_image_html( $post_thumbnail_id, true );
                            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );
                        ?>
                    </div>
                <?php endif; 
                    if ( $attachment_ids ) {
                        foreach ( $attachment_ids as $attachment_id ) {
                            ?>
                                <div class="product-gallery-item">
                                    <?php 
                                        $html = wc_get_gallery_image_html( $attachment_id, true );
                                        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
                                    ?>
                                </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- Product Images End -->

    <!-- Product Summery Start -->
    <div class="htmove-modal-col htmove-mb-30">
        <div class="htmove-product-summery htmove-custom-scroll">
            <?php woocommerce_template_single_rating(); ?>
            <h3 class="product-title"><?php echo $product->get_title(); ?></h3>
            <div class="product-price"><?php echo $product->get_price_html(); ?></div>
            <div class="product-description">
                <?php echo $product->get_description();?>
            </div>
            <div class="product-buttons">
                <?php woocommerce_template_single_add_to_cart(); ?>
            </div>
            <div class="product-meta">
                <?php woocommerce_template_single_meta(); ?>
            </div>
        </div>
    </div>
    <!-- Product Summery End -->

</div>
 