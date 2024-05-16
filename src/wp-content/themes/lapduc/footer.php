<?php
$footer_nav_menu = wp_nav_menu([
    'theme_location' => 'footer',
    'fallback_cb' => false,
    'echo' => false,
]);

$logo_footer = get_field('logo_footer', 'option');
$size = 'full';

$desc_footer = get_field('description_footer', 'option');
$headquarters = get_field('headquarters', 'option');
if ($headquarters) {
    $address_footer = !empty($headquarters["address_footer"]) ? $headquarters["address_footer"] : '';
    $phonenumber_footer = !empty($headquarters["phone_number_footer"]) ? $headquarters["phone_number_footer"] : '';
    $email_footer = !empty($headquarters["email_footer"]) ? $headquarters["email_footer"] : '';
}
$hotline = get_field('hotline_footer', 'option');
if ($hotline) {
    $phonenumber_hotline = !empty($hotline["phone_numer_hotline"]) ? $hotline["phone_numer_hotline"] : '';
    $email_hotline = !empty($hotline["email_hotline"]) ? $hotline["email_hotline"] : '';
}
?>
<footer id="footer">
    <div class="page-container">
        <div class="inner">
            <div class="footer-left">
                <a class="logo-footer" href="/">
                    <?php
                    if ($logo_footer) {
                        echo wp_get_attachment_image($logo_footer, $size, "", array("class" => "img-fluid", "alt" => "header logo"));
                    } ?>
                </a>
                <?php if ($desc_footer) : ?>
                    <div class="desc-footer">
                        <p>
                            <?php echo $desc_footer; ?>
                        </p>
                    </div>
                <?php endif; ?>
                <?php if (have_rows('list_social_footer', 'option')) : ?>
                    <ul class="list-social d-flex d-lg-none justify-content-center">
                        <?php while (have_rows('list_social_footer', 'option')) : the_row(); ?>
                            <li class="item-social">
                                <?php
                                $link = get_sub_field('link_social');
                                if ($link) : ?>
                                    <a class="button" target="_blank" href="<?php echo esc_url($link); ?>">
                                        <?php echo get_sub_field('icon_svg_social'); ?>
                                    </a>
                                <?php endif; ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="footer-right">
                <div class="box-content">
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
                        <?php
                        wp_nav_menu(array(
                            'theme_location'    => 'footer',
                            'depth'             => 3,
                            'menu_class'        => 'footer__menu',
                        ));
                        ?>
                    </div>
                    <div class="item-content">
                        <div class="item-title"><?php echo __('Hotline', 'lapduc') ?></div>
                        <div class="item-submenu">
                            <?php if (!empty($phonenumber_hotline)) : ?>
                                <div class="submenu-item phone">
                                    <span class="icon">
                                        <?php include get_stylesheet_directory() . '/assets/imgs/icons/contact.svg'; ?>
                                    </span>
                                    <a class="color-primary" href="tel:<?php echo $phonenumber_hotline; ?>"><?php echo $phonenumber_hotline; ?></a>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($email_hotline)) : ?>
                                <div class="submenu-item email">
                                    <span class="icon">
                                        <?php include get_stylesheet_directory() . '/assets/imgs/icons/email.svg'; ?>
                                    </span>
                                    <a class="color-primary" href="mailto:<?php echo $email_hotline; ?>"><?php echo $email_hotline; ?></a>
                                </div>
                            <?php endif; ?>
                            <?php if (have_rows('list_social_footer', 'option')) : ?>
                                <ul class="list-social d-none d-lg-flex">
                                    <?php while (have_rows('list_social_footer', 'option')) : the_row(); ?>
                                        <li class="item-social">
                                            <?php
                                            $link = get_sub_field('link_social');
                                            if ($link) : ?>
                                                <a class="button" target="_blank" href="<?php echo esc_url($link); ?>">
                                                    <?php echo get_sub_field('icon_svg_social'); ?>
                                                </a>
                                            <?php endif; ?>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (get_field('content_copyright', 'option')) : ?>
        <div class="copy-right">
            <div class="page-container">
                <div class="copy-right-wrap">
                    <?php echo get_field('content_copyright', 'option'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</footer>

<?php wp_footer(); ?>

</body>

</html>