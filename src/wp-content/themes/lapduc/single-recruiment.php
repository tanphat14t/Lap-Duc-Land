<?php get_header(); ?>

<?php the_post(); ?>
<main class="single-detail">
    <div class="section-banner-detail ">
        <div class="box-image d-none d-lg-block">
            <?php
            $image = get_field('background_banner_post', 'option');
            $size = 'large'; // (thumbnail, medium, large, full or custom size)
            if ($image) {
                echo wp_get_attachment_image($image, $size, "", array("class" => "img-fluid"));
            }
            ?>
        </div>
        <div class="box-image d-block d-lg-none">
            <?php
            $imageMobile = get_field('background_banner_post_mobile', 'option');
            $size = 'large'; // (thumbnail, medium, large, full or custom size)
            if ($imageMobile) {
                echo wp_get_attachment_image($imageMobile, $size, "", array("class" => "img-fluid"));
            }
            ?>
        </div>
    </div>
    <div class="section-body">
        <div class="page-container">
            <div class="row">
                <div class="col-12">
                    <h1 class="title"><?php echo esc_html(the_title()) ?></h1>
                    <div class="date">
                        <span class="icon">
                            <?php include get_stylesheet_directory() . '/assets/imgs/icons/calendar.svg'; ?>
                        </span>
                        <p><?php echo get_the_date('d/m/Y'); ?></p>
                    </div>
                    <div class="content">
                        <?php the_content() ?>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-contact">
                        <h2 class="heading">Form Apply</h2>
                        <?php echo do_shortcode('[contact-form-7 id="9659447" title="Form Apply"]') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>