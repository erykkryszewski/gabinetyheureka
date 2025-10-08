<?php

if (is_woocommerce_activated()) {
    global $woocommerce;
    $cart_items_number = $woocommerce->cart->get_cart_contents_count();
}

$global_phone_number = get_field("global_phone_number", "options");
$global_logo = get_field("global_logo", "options");
$theme_sign = get_field("theme_sign", "options");
$global_email = get_field("global_email", "options");
$global_terms_and_conditions = get_field("global_terms_and_conditions", "options");
$global_privacy_policy = get_field("global_privacy_policy", "options");
$global_social_media = get_field("global_social_media", "options");
$header_button = get_field("header_button", "options");

$header_button_before_icon = get_field("header_button_before_icon", "options");
$header_button_after_icon = get_field("header_button_after_icon", "options");

$body_classes = get_body_class();
?>

<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet" />
        <?php wp_head(); ?>
    </head>

    <body <?php if (!is_front_page()) { body_class('theme-subpage'); } else { body_class('theme-frontpage'); } ?>>
        <div class="preloader">
            <div class="preloader__logo"><?php if (!empty($theme_sign)) { echo wp_get_attachment_image($theme_sign, 'full', '', ['class' => '']); } else { echo ''; } ?></div>
        </div>
        <header class="header <?php if (!is_front_page()) { echo 'header--subpage'; } ?>">
            <div class="top-bar">
                <div class="container">
                    <div class="top-bar__wrapper">
                        <div class="top-bar__content top-bar__content--left">
                            <a href="tel:<?php echo esc_html($global_phone_number); ?>" class="top-bar__phone ercodingtheme-phone-number"><?php echo esc_html($global_phone_number); ?></a>
                            <a href="mailto:<?php echo esc_html($global_email); ?>" class="top-bar__email"><?php echo esc_html($global_email); ?></a>
                        </div>
                        <?php if (!empty($global_social_media)): ?>
                        <div class="top-bar__content top-bar__content--right desktop-only">
                            <div class="wcag">
                                <button class="wcag__font-size" aria-label="Zwiększ czcionkę">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.966 24.966">
                                        <g>
                                            <path
                                                d="M24.966,12.466v0.961c0,0.532-0.43,0.961-0.961,0.961h-1.923v1.923c0,0.532-0.43,0.961-0.961,0.961H20.16
        c-0.532,0-0.961-0.43-0.961-0.961v-1.923h-1.923c-0.532,0-0.961-0.43-0.961-0.961v-0.961c0-0.532,0.43-0.961,0.961-0.961h1.923
        V9.582c0-0.532,0.43-0.961,0.961-0.961h0.961c0.532,0,0.961,0.43,0.961,0.961v1.923h1.923
        C24.536,11.504,24.966,11.934,24.966,12.466z M15.272,20.482c0.051,0.206,0.059,0.364,0.026,0.465
        c-0.036,0.102-0.145,0.156-0.331,0.156h-3.153c-0.288,0-0.484-0.066-0.586-0.194c-0.102-0.131-0.195-0.335-0.279-0.608
        l-0.816-3.028H4.989l-0.85,3.104c-0.086,0.276-0.195,0.468-0.331,0.57c-0.136,0.102-0.322,0.156-0.56,0.156H0.427
        c-0.187,0-0.314-0.038-0.381-0.117c-0.069-0.077-0.061-0.262,0.025-0.557L4.978,4.617c0.085-0.241,0.186-0.428,0.305-0.559
        C5.4,3.93,5.629,3.864,5.97,3.864h3.203c0.356,0,0.588,0.071,0.699,0.209c0.11,0.138,0.207,0.328,0.292,0.569L15.272,20.482z
        M9.357,14.389l-1.712-6.35H7.519l-1.74,6.35H9.357z"
                                            ></path>
                                        </g>
                                    </svg>
                                </button>

                                <button class="wcag__contrast" aria-label="Wysoki kontrast">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 405.526 405.526">
                                        <g>
                                            <path
                                                d="M202.764,0C90.958,0,0,90.958,0,202.763c0,111.809,90.958,202.764,202.763,202.764
        c111.808,0,202.763-90.955,202.763-202.764C405.526,90.958,314.571,0,202.764,0z M22.952,202.763
        c0-99.146,80.665-179.811,179.812-179.811v359.623C103.616,382.574,22.952,301.91,22.952,202.763z"
                                            ></path>
                                        </g>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <nav class="nav <?php if (!is_front_page()) { echo 'nav--subpage'; } ?>">
                    <a href="/" class="nav__logo <?php if (!is_front_page()) { echo 'nav__logo--subpage'; } ?>">
                        <?php if (!empty($global_logo)) { echo wp_get_attachment_image($global_logo, 'full', '', ['class' => '']); } else { echo 'Logo'; } ?>
                    </a>
                    <div class="nav__content <?php if (!is_front_page()) { echo 'nav__content--subpage'; } ?>">
                        <?php $menu_class = is_front_page() ? 'nav__menu' : 'nav__menu nav__menu--subpage'; echo wp_nav_menu(['theme_location' => 'Navigation', 'container' => 'ul', 'menu_class' => $menu_class]); ?> <?php if (is_woocommerce_activated()): ?>
                        <div class="nav__shop-elements <?php if (!is_front_page()) { echo 'nav__shop-elements--subpage'; } ?>">
                            <a class="nav__cart-icon <?php if (!is_front_page()) { echo 'nav__cart-icon--subpage'; } ?>" href="/koszyk">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                    <defs>
                                        <style>
                                            .cls-1 {
                                              fill: #231f20
                                            }
                                        </style>
                                    </defs>
                                    <g id="cart">
                                        <path
                                            class="cls-1"
                                            d="M29.46 10.14A2.94 2.94 0 0 0 27.1 9H10.22L8.76 6.35A2.67 2.67 0 0 0 6.41 5H3a1 1 0 0 0 0 2h3.41a.68.68 0 0 1 .6.31l1.65 3 .86 9.32a3.84 3.84 0 0 0 4 3.38h10.37a3.92 3.92 0 0 0 3.85-2.78l2.17-7.82a2.58 2.58 0 0 0-.45-2.27zM28 11.86l-2.17 7.83A1.93 1.93 0 0 1 23.89 21H13.48a1.89 1.89 0 0 1-2-1.56L10.73 11H27.1a1 1 0 0 1 .77.35.59.59 0 0 1 .13.51z"
                                        />
                                        <circle class="cls-1" cx="14" cy="26" r="2" />
                                        <circle class="cls-1" cx="24" cy="26" r="2" />
                                    </g>
                                </svg>
                                <span id="mini-cart-count"><?php echo esc_html($cart_items_number); ?></span>
                            </a>
                        </div>
                        <?php endif; ?> <?php if (!empty($header_button)): ?>
                        <a href="<?php echo esc_html($header_button['url']); ?>" class="button nav__button <?php if (!is_front_page()) { echo 'nav__button--subpage'; } ?>" target="<?php echo esc_html($header_button['target']); ?>">
                            <?php if (!empty($header_button_before_icon)): ?>
                            <span class="button__icon button__icon--before"><?php echo wp_get_attachment_image($header_button_before_icon, 'full', '', [ 'loading' => 'eager', 'decoding' => 'async', ]); ?></span>
                            <?php endif; ?> <?php echo esc_html($header_button['title']); ?> <?php if (!empty($header_button_after_icon)): ?>
                            <span class="button__icon button__icon--after"><?php echo wp_get_attachment_image($header_button_after_icon, 'full', '', [ 'loading' => 'eager', 'decoding' => 'async', ]); ?></span>
                            <?php endif; ?>
                        </a>
                        <?php endif; ?>
                        <div class="hamburger nav__hamburger <?php if (!is_front_page()) { echo 'nav__hamburger--subpage'; } ?>">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
    </body>
</html>
