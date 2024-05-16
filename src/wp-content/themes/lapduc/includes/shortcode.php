<?php
function display_news($atts)
{
    // Attributes
    $atts = shortcode_atts(
        array(
            'posts_per_page' => 12,
        ),
        $atts,
        'news'
    );

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $atts['posts_per_page'],
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $posts = new WP_Query($args);
    // Start output buffering
    ob_start();

    // The Loop
    if (!empty($posts)) : ?>
        <div class="page-container">
            <section class="news">
                <div class="post-wrapper">
                    <ul class="list-post">
                        <?php if ($posts->have_posts()) :
                            while ($posts->have_posts()) : $posts->the_post(); ?>
                                <li class="item-post">
                                    <div class="inner-post">
                                        <div class="box-img">
                                            <?php
                                            $image = get_post_thumbnail_id(get_the_id());
                                            $size = 'large';
                                            if ($image) {
                                                echo wp_get_attachment_image($image, $size);
                                            }
                                            ?>
                                        </div>
                                        <div class="post-name">
                                            <a href="<?php echo permalink_link(get_the_id()) ?>" title="<?php echo get_the_title(get_the_id()) ?>"><?php echo get_the_title(get_the_id()) ?></a>
                                        </div>
                                        <div class="post-excerpt">
                                            <?php
                                            echo '<p>' . get_the_excerpt(get_the_id()) . '</p>';
                                            ?>
                                        </div>
                                        <div class="post-link">
                                            <a href="<?php echo permalink_link(get_the_id()) ?>" title="<?php echo get_the_title(get_the_id()) ?>">
                                                <?php include get_stylesheet_directory() . '/assets/imgs/icons/arrow-right.svg'; ?>
                                            </a>
                                        </div>
                                    </div>

                                </li>
                        <?php
                            endwhile;
                            // Restore original post data
                            wp_reset_postdata();
                        endif;
                        ?>
                    </ul>
                </div>
            </section>
        </div>
    <?php endif ?>
    <?php

    // Get the buffered content and clean the buffer
    $output = ob_get_clean();

    return $output;
}
// Register shortcode news
add_shortcode('news', 'display_news');

// section two jewelry
function display_store_image($atts)
{
    // Attributes
    $atts = shortcode_atts(
        array(
            'posts_per_page' => -1,
            'taxonomy_id' => '',
        ),
        $atts,
        'stores'
    );
    $args = array(
        'post_type' => 'stores',
        'posts_per_page' => $atts['posts_per_page'],
        'orderby' => 'date',
        'order' => 'DESC',
    );
    if (!empty($atts['taxonomy_id'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'store-category',
                'field'    => 'term_id',
                'terms'    => $atts['taxonomy_id'],
            ),
        );
    }
    $stores = new WP_Query($args);
    // Start output buffering
    ob_start();

    // The Loop
    if (!empty($stores)) : ?>
        <div class="wrapper">
            <h2 class="heading"><?php echo __('Hình ảnh cửa hàng', 'lapduc') ?></h2>
            <div class="splide splide__store">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php if ($stores->have_posts()) :
                            while ($stores->have_posts()) : $stores->the_post(); ?>
                                <li class="splide__slide gallery-image">
                                    <div class="splide splide-image__store">
                                        <div class="splide__track">
                                            <?php
                                            $gallery_image = get_field('image_galleries_store', get_the_id());
                                            $size = 'full';
                                            if ($gallery_image) : ?>
                                                <ul class="splide__list">
                                                    <?php foreach ($gallery_image as $image_id) : ?>
                                                        <li class="splide__slide">
                                                            <?php echo wp_get_attachment_image($image_id, $size); ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="splide splide-image__store--thumb">
                                        <div class="splide__track">
                                            <?php
                                            $gallery_image = get_field('image_galleries_store', get_the_id());
                                            $size = 'thumbnail';
                                            if ($gallery_image) : ?>
                                                <ul class="splide__list">
                                                    <?php foreach ($gallery_image as $image_id) : ?>
                                                        <li class="splide__slide">
                                                            <?php echo wp_get_attachment_image($image_id, $size); ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="bottom-slide">
                                        <p class="album"><?php echo __('Album', 'lapduc') ?></p>
                                        <h3 class="name__store"><?php echo get_the_title() ?></h3>
                                    </div>
                                </li>
                        <?php
                            endwhile;
                            // Restore original post data
                            wp_reset_postdata();
                        endif;
                        ?>
                    </ul>
                    <div class="page-container">
                        <div class="splide__arrows">
                            <button class="splide__arrow splide__arrow--prev" type="button" aria-label="Go to last slide">
                                <?php include get_stylesheet_directory() . '/assets/imgs/icons/arrow-left-2.svg'; ?>
                            </button>
                            <button class="splide__arrow splide__arrow--next" type="button" aria-label="Next slide">
                                <?php include get_stylesheet_directory() . '/assets/imgs/icons/arrow-left-2.svg'; ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php

    // Get the buffered content and clean the buffer
    $output = ob_get_clean();

    return $output;
}
// Register shortcode stories
add_shortcode('stores', 'display_store_image');

function display_recruiment($atts)
{
    // Attributes
    $atts = shortcode_atts(
        array(
            'posts_per_page' => 4,
        ),
        $atts,
        'recruiment'
    );

    $args = array(
        'post_type' => 'recruiment',
        'posts_per_page' => $atts['posts_per_page'],
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $recruiments = new WP_Query($args);
    // Start output buffering
    ob_start();

    // The Loop
    if (!empty($recruiments)) : ?>
        <div class="recruiment">
            <div class="page-container">
                <div class="row">
                    <?php if ($recruiments->have_posts()) :
                        while ($recruiments->have_posts()) : $recruiments->the_post(); ?>
                            <div class="col-12">
                                <div class="box">
                                    <div class="box-image">
                                        <?php
                                        $image = get_post_thumbnail_id();
                                        $size = 'large'; // (thumbnail, medium, large, full or custom size)
                                        if ($image) {
                                            echo wp_get_attachment_image($image, $size, "", array("class" => "img-fluid"));
                                        }
                                        ?>
                                    </div>
                                    <div class="box-content">
                                        <h3><a href="<?php esc_url(the_permalink()) ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="recruiment-infor">
                                            <?php $workplace = get_field('recruiment_workplace', get_the_id()) ?>
                                            <?php if ($workplace) : ?>
                                                <div class="item workplace">
                                                    <div class="icon">
                                                        <?php include get_stylesheet_directory() . '/assets/imgs/icons/location-green.svg'; ?>
                                                    </div>
                                                    <div class="content">
                                                        <span><?php echo __('Nơi làm việc', 'lapduc') ?></span>
                                                        <p><?php echo $workplace; ?></p>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="item date">
                                                <div class="icon">
                                                    <?php include get_stylesheet_directory() . '/assets/imgs/icons/calendar.svg'; ?>
                                                </div>
                                                <div class="content">
                                                    <span><?php echo __('Ngày Đăng Tuyển', 'lapduc') ?></span>
                                                    <?php
                                                    if (wp_is_mobile()) : ?>
                                                        <p><?php echo get_the_date('d / m / Y'); ?></p>
                                                    <?php else : ?>
                                                        <p><?php echo 'Ngày ' . get_the_date('d') . ' Tháng ' . get_the_date('m') . ' Năm ' . get_the_date('Y'); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-apply-btn">
                                        <a href="<?php esc_url(the_permalink()) ?>" class="btn-apply"><?php echo __('Apply', 'lapduc') ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata();
                        ?>
                    <?php endif; ?>

                </div>
                <div class="button-view-more">
                    <a class="loadmore-recruiment">
                        <?php echo __('Xem thêm', 'lapduc'); ?>
                        <span class="loader d-none"></span>
                    </a>
                </div>
            </div>
        </div>
    <?php endif ?>
<?php

    // Get the buffered content and clean the buffer
    $output = ob_get_clean();

    return $output;
}
// Register shortcode recruiment
add_shortcode('recruiment', 'display_recruiment');


function display_contact($atts)
{
    // Attributes
    $atts = shortcode_atts(
        array(),
        $atts,
        'contact'
    );
    $headquarters = get_field('headquarters', 'option');
    if ($headquarters) {
        $address_footer = !empty($headquarters["address_footer"]) ? $headquarters["address_footer"] : '';
        $phonenumber_footer = !empty($headquarters["phone_number_footer"]) ? $headquarters["phone_number_footer"] : '';
        $email_footer = !empty($headquarters["email_footer"]) ? $headquarters["email_footer"] : '';
    }
    $customer_service = get_field('customer_service_room', 'option');
    if ($customer_service) {
        $phonenumber_cs = !empty($customer_service["phone_number"]) ? $customer_service["phone_number"] : '';
        $email_cs = !empty($customer_service["email"]) ? $customer_service["email"] : '';
    }
    $accounting_department = get_field('accounting_department', 'option');
    if ($accounting_department) {
        $working_time = !empty($accounting_department["working_time"]) ? $accounting_department["working_time"] : '';
    }
    // Start output buffering
    ob_start(); ?>
    <div class="wrapper">
        <h2 class="heading"><?php echo __('Liên Hệ', 'lapduc') ?></h2>
        <div class="item-content">
            <div class="item-title"><?php echo __('Trụ sở chính', 'lapduc') ?></div>
            <div class="item-submenu">
                <?php if (!empty($address_footer)) : ?>
                    <div class="submenu-item address">
                        <span class="icon">
                            <?php include get_stylesheet_directory() . '/assets/imgs/icons/location.svg'; ?>
                        </span>
                        <span><?php echo $address_footer; ?></span>
                    </div>
                <?php endif; ?>
                <?php if (!empty($phonenumber_footer)) : ?>
                    <div class="submenu-item phone">
                        <span class="icon">
                            <?php include get_stylesheet_directory() . '/assets/imgs/icons/contact.svg'; ?>
                        </span>
                        <a href="tel: <?php echo $phonenumber_footer; ?>"><?php echo $phonenumber_footer; ?></a>
                    </div>
                <?php endif; ?>
                <?php if (!empty($email_footer)) : ?>
                    <div class="submenu-item mail">
                        <span class="icon">
                            <?php include get_stylesheet_directory() . '/assets/imgs/icons/email.svg'; ?>
                        </span>
                        <a href="mailto: <?php echo $email_footer; ?>"><?php echo $email_footer; ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="item-content">
            <div class="item-title"><?php echo __('Phòng dịch vụ khách hàng', 'lapduc') ?></div>
            <div class="item-submenu">
                <?php if (!empty($phonenumber_cs)) : ?>
                    <div class="submenu-item phone">
                        <span class="icon">
                            <?php include get_stylesheet_directory() . '/assets/imgs/icons/contact.svg'; ?>
                        </span>
                        <a href="tel: <?php echo $phonenumber_cs; ?>"><?php echo $phonenumber_cs; ?></a>
                    </div>
                <?php endif; ?>
                <?php if (!empty($email_cs)) : ?>
                    <div class="submenu-item mail">
                        <span class="icon">
                            <?php include get_stylesheet_directory() . '/assets/imgs/icons/email.svg'; ?>
                        </span>
                        <a href="mailto: <?php echo $email_cs; ?>"><?php echo $email_cs; ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="item-content">
            <div class="item-title"><?php echo __('Phòng kế toán', 'lapduc') ?></div>
            <div class="item-submenu">
                <?php if (!empty($working_time)) : ?>
                    <div class="submenu-item address">
                        <span class="icon">
                            <?php include get_stylesheet_directory() . '/assets/imgs/icons/location.svg'; ?>
                        </span>
                        <span><?php echo $working_time; ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php

    // Get the buffered content and clean the buffer
    $output = ob_get_clean();

    return $output;
}
// Register shortcode recruiment
add_shortcode('contact', 'display_contact');


function news_page($atts)
{
    // Attributes
    $atts = shortcode_atts(
        array(
            'posts_per_page' => 9,
        ),
        $atts,
        'news'
    );

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $atts['posts_per_page'],
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $posts = new WP_Query($args);
    // Start output buffering
    ob_start();

    // The Loop
    if (!empty($posts)) : ?>
        <main class="newsPage">
            <section class="outstanding">
                <div class="page-container">
                    <div class="news-wrapper">
                        <h2 class="heading text-start"><?php echo __('sự kiện nổi bật', 'lapduc') ?></h2>
                        <ul class="list-news">
                            <?php if ($posts->have_posts()) :
                                while ($posts->have_posts()) : $posts->the_post(); ?>
                                    <li class="item-news">
                                        <div class="inner-news">
                                            <div class="item-news__image">
                                                <div class="box-img">
                                                    <?php
                                                    $image = get_post_thumbnail_id(get_the_id());
                                                    $size = 'large';
                                                    if ($image) {
                                                        echo wp_get_attachment_image($image, $size);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="item-news__content">
                                                <div class="news-name">
                                                    <a href="<?php echo permalink_link(get_the_id()) ?>" title="<?php echo get_the_title(get_the_id()) ?>"><?php echo get_the_title(get_the_id()) ?></a>
                                                </div>
                                                <div class="news-excerpt">
                                                    <?php
                                                    echo '<p>' . get_the_excerpt(get_the_id()) . '</p>';
                                                    ?>
                                                </div>
                                                <div class="news-link">
                                                    <a href="<?php echo permalink_link(get_the_id()) ?>" title="<?php echo get_the_title(get_the_id()) ?>">
                                                        <?php include get_stylesheet_directory() . '/assets/imgs/icons/arrow-right.svg'; ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </li>
                            <?php
                                endwhile;
                                // Restore original post data
                                wp_reset_postdata();
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>
            </section>
            <section class="knowledge">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $argsKnowledge = array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'orderby' => 'date', // Sắp xếp theo ngày đăng
                    'order' => 'DESC',
                    'category_name' => 'kien-thuc-nganh',
                    'paged' => $paged
                );
                $postKnowledge = new WP_Query($argsKnowledge);
                ?>
                <div class="page-container">
                    <h2 class="heading text-start"><?php echo esc_html(__('Kiến thức ngành', 'lapduc')); ?></h2>
                    <div class="wrapper-post">
                        <ul class="list-news">
                            <?php if ($postKnowledge->have_posts()) :
                                while ($postKnowledge->have_posts()) : $postKnowledge->the_post(); ?>
                                    <li class="item-news">
                                        <div class="inner-news">
                                            <div class="item-news__image">
                                                <div class="box-img">
                                                    <?php
                                                    $image = get_post_thumbnail_id(get_the_ID());
                                                    $size = 'large';
                                                    if ($image) {
                                                        echo wp_get_attachment_image($image, $size);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="item-news__content">
                                                <div class="news-name">
                                                    <a href="<?php echo esc_url(get_permalink(get_the_ID())); ?>" title="<?php echo esc_attr(get_the_title(get_the_ID())); ?>"><?php echo esc_html(get_the_title(get_the_ID())); ?></a>
                                                </div>
                                                <div class="news-excerpt">
                                                    <?php
                                                    echo '<p>' . esc_html(get_the_excerpt(get_the_ID())) . '</p>';
                                                    ?>
                                                </div>
                                                <div class="news-link">
                                                    <a href="<?php echo esc_url(get_permalink(get_the_ID())); ?>" title="<?php echo esc_attr(get_the_title(get_the_ID())); ?>">
                                                        <?php include get_stylesheet_directory() . '/assets/imgs/icons/arrow-right.svg'; ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </ul>
                        <?php if ($postKnowledge->max_num_pages > 1) : ?>
                            <div class="pagination-wrapper">
                                <?php
                                // Pagination
                                $big = 999999999;
                                $icPlay = '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.6663 5.3335L20.6259 15.2931C21.0164 15.6836 21.0164 16.3167 20.6259 16.7073L10.6663 26.6668" stroke="#6F5B3A" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>';
                                echo '<div class="custom-pagination">';
                                echo paginate_links(array(
                                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                    'format' => '?paged=%#%',
                                    'current' => max(1, $paged),
                                    'total' => $postKnowledge->max_num_pages,
                                    'prev_next' => true,
                                    'prev_text' => $icPlay,
                                    'next_text' => $icPlay,
                                ));

                                echo '</div>';
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        </main>
    <?php endif ?>
<?php

    // Get the buffered content and clean the buffer
    $output = ob_get_clean();

    return $output;
}

add_shortcode('news-page', 'news_page');
