<?php
/**
 * YAMAURA Original Theme functions
 */

// ---------------------------------------------------
// テーマの基本セットアップ
// ---------------------------------------------------
function yamaura_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'yamaura_theme_setup' );

// ---------------------------------------------------
// CSS / フォントの読み込み（Tailwind CDN + Google Fonts）
// 本番運用ではビルド済みCSSへの差し替えを推奨
// ---------------------------------------------------
function yamaura_enqueue_assets() {
    wp_enqueue_script( 'tailwindcss', 'https://cdn.tailwindcss.com', array(), null, false );
    wp_enqueue_style( 'yamaura-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Noto+Sans+JP:wght@300;400;500;700&display=swap', array(), null );
    wp_enqueue_style( 'material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', array(), null );
    wp_enqueue_style( 'yamaura-style', get_stylesheet_uri(), array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'yamaura_enqueue_assets' );

// Tailwind config をheadに直接出力（CDN版はscriptタグの後に設定が必要）
function yamaura_tailwind_config() {
    ?>
    <script>
      window.addEventListener('DOMContentLoaded', function() {
        if (window.tailwind) {
          tailwind.config = {
            theme: {
              extend: {
                colors: {
                  primary: '#a67843',
                  surface: '#faf8f5',
                  'surface-dim': '#dcd9d9',
                  'on-surface': '#2c2c2c',
                  'on-surface-variant': '#666666',
                },
                fontFamily: {
                  serif: ['"Playfair Display"', 'serif'],
                  sans: ['"Noto Sans JP"', 'sans-serif'],
                },
                spacing: {
                  'margin-desktop': '5%',
                  'section-padding': '5rem',
                  'unit-xl': '2.5rem',
                  'unit-lg': '1.5rem',
                },
                maxWidth: { 'container-max': '1280px' }
              }
            }
          }
        }
      });
    </script>
    <?php
}
add_action( 'wp_head', 'yamaura_tailwind_config' );

// ---------------------------------------------------
// カスタム投稿タイプ：施工事例（works）
// 管理画面の「施工事例」メニューから タイトル・本文・アイキャッチ画像 を編集可能
// ---------------------------------------------------
function yamaura_register_works_cpt() {
    register_post_type( 'work', array(
        'labels' => array(
            'name'          => '施工事例',
            'singular_name' => '施工事例',
            'add_new_item'  => '施工事例を追加',
            'edit_item'     => '施工事例を編集',
            'all_items'     => 'すべての施工事例',
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-camera',
        'supports'     => array( 'title', 'thumbnail' ),
        'show_in_rest' => true,
        'rewrite'      => array( 'slug' => 'works' ),
    ) );
}
add_action( 'init', 'yamaura_register_works_cpt' );

// 施工事例の「ラベル」メタボックス（例: Before / After）
function yamaura_work_label_metabox() {
    add_meta_box( 'yamaura_work_label', 'ラベル（例：Before / After）', function ( $post ) {
        $value = get_post_meta( $post->ID, '_yamaura_label', true );
        wp_nonce_field( 'yamaura_save_work_label', 'yamaura_work_label_nonce' );
        echo '<input type="text" name="yamaura_label" value="' . esc_attr( $value ) . '" class="widefat" placeholder="Before / After" />';
    }, 'work', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'yamaura_work_label_metabox' );

function yamaura_save_work_label( $post_id ) {
    if ( ! isset( $_POST['yamaura_work_label_nonce'] ) || ! wp_verify_nonce( $_POST['yamaura_work_label_nonce'], 'yamaura_save_work_label' ) ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( isset( $_POST['yamaura_label'] ) ) {
        update_post_meta( $post_id, '_yamaura_label', sanitize_text_field( $_POST['yamaura_label'] ) );
    }
}
add_action( 'save_post_work', 'yamaura_save_work_label' );

// ---------------------------------------------------
// カスタム投稿タイプ：お客様の声（voices）
// タイトル = お客様属性（例：不動産会社様（東京都））
// 本文 = コメント
// ---------------------------------------------------
function yamaura_register_voices_cpt() {
    register_post_type( 'voice', array(
        'labels' => array(
            'name'          => 'お客様の声',
            'singular_name' => 'お客様の声',
            'add_new_item'  => 'お客様の声を追加',
            'edit_item'     => 'お客様の声を編集',
            'all_items'     => 'すべてのお客様の声',
        ),
        'public'       => true,
        'has_archive'  => false,
        'menu_icon'    => 'dashicons-format-quote',
        'supports'     => array( 'title', 'editor' ),
        'show_in_rest' => true,
        'rewrite'      => array( 'slug' => 'voices' ),
    ) );
}
add_action( 'init', 'yamaura_register_voices_cpt' );

// 管理画面の「本文」ラベルを「コメント」に分かりやすく変更
function yamaura_change_editor_label( $messages ) {
    return $messages;
}

// 投稿タイプ一覧で「タイトル」欄のプレースホルダーを分かりやすくする
function yamaura_title_placeholder( $title, $post ) {
    if ( $post->post_type === 'voice' ) {
        $title = 'お客様の属性・地域（例：不動産会社様（東京都））';
    } elseif ( $post->post_type === 'work' ) {
        $title = '事例タイトル（例：モダンリビングのある住まい）';
    }
    return $title;
}
add_filter( 'enter_title_here', 'yamaura_title_placeholder', 10, 2 );

// 投稿編集画面のメニュー位置調整（管理画面で見つけやすくする）
function yamaura_cpt_menu_position() {
    global $menu;
}

function yamaura_asset_image_url( $filename ) {
    $fallbacks = array(
        'hero.jpg'      => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDNxtqT_2Rd0EX9gQp6W9ZBDlOIqGmaPBD7cAD4-doysVypp3OZRiHWymOfWNzztU0uyX-_xN1r9OCyN0gReNVfMUXD6rcqwacY5wT67M9x1O-6ry9XmdO2w1gYPspt3tppKysyJY4O5g6LE3N7hZG4QKdykpmlcnFTY4d5QrKMcFGPbDhCc7Arukhd8uAV34eh4jmgl683LhYtkxjI75XpdZ78wgyhTz3OdWPxw7G89WaEJn6yE7-VsAetQQbD1-NzlLNK_o3x04g',
        'about.jpg'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAtk92sTSNmY38BlAMyE0xwly_CKQVHiqY8yznJ68PxTfVHmTq3w_aTdhd7p0IWPTitnnXP-2cJ_fL1H8MTHP2nLTs3AuFtFoVzgfB40ZyGKDBSZC3LxefP67-ZcqJUbARJ1BZ603GAdiO6wHLGcoMrld9ybr7AjX0Z_R6uaLIBFnXEZ8Ho8jRLe86h26RqPwv4oPRYewxJ0bixocNbJpVi6538GjYTxaIyLz9zg9ZrqU7QXMMvFSHGsCBSbf_R1erCavxJxv0pNVQ',
        'service-1.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDhGEuINivR8gYFSGbnDH2VZbVlL6qNmRnOlndfCzl72RHu58zKNPLm36px06bT2iEkMyFLqAv0izhsUR-uugSV6cYvjtTK4V5kFsafxXV6cHOMwlz1l3FgSNO1FHkP9b9VbDi1d_Yso5sctzPcmTb6Ioz_eavruZuXaT2KK-mKX8rwBzSlrRFOjksmZm5uGBtmhaJ993DtuRvRlt5cI4Iv1iTBFC1wqSdLTsD2hONb-NpaDFISPSG7eQbMRPLgHDnKXFbI27NHN-E',
        'service-2.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDW1mVTTJC5-ThOf1LX07KnpTA3xE4JGQEj6MEJZ4kzb0zW1PhpJpdGdXIJlidSOEpqKrghSx2Zzf7VshxM2QsA3NMJkJKNjgvhLtVzYA96DVp7wziNzEKcXzur52Hswe2lXXjsDU_PP5S4-oDV_sR7VJwmIIJ3mXv9BmKTGoXY1cTq2XYxcHUfbFJvzlOAwAD5Wrf01nyuKeb5O8G5tzUNHsS7lwCQnb0MwIl48ElGCIe3nW-y-_qAJNe4n2Fum5gBel2lsWEon7g',
        'service-3.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCK_T159Cxiud-BV6qTocsqkuZK5ul2hzrF-LR-jEzTV5Qr7U1C8BsRuUiVkLwGmk8XRtVcJgH5RMkEnxTLszGHG3PovhHyboMoZytFBsHw4rviDMjkQ4EciRK0gUFjP9aWxiX0JIsq-leewr-Q6kOtETbhkNq1e1zxkIEsa-Q_O6xFyFIlwf1SUTe5tk7W0Zv7RBnwL6E2d7puuqUzdyIjw7mIZ9jFM1h99idpVlbWsA-YvgC9qENDIhb43Ou6xjWroybKBAXtyUg',
        'service-4.jpg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAmJCGp7FaOmoD80dE4goraAM3jOtIlb2Vrj38w4booIH28E_q4edPum3w1Jk05MjtJoxZmb1VMbiXIh3UGSr07syIQL61ey8KbPAelrfO-ECYkPPqGQv23IRShn4nd7di-St_FST6K-UgUCgWwyzxd3uR3CxXHUjbNHI6PKGgaAjvlIfUbSogfJvsbBEHhQUGtvJP1YTygE7LWf-Usay2rEGpEKl6vtQn7L9uLwtp2efNuO5_ycPVS6lSiZAdGBsvQu2lT-t49puI',
    );

    $local_path = get_template_directory() . '/assets/img/' . $filename;
    if ( file_exists( $local_path ) ) {
        return get_template_directory_uri() . '/assets/img/' . $filename;
    }

    return isset( $fallbacks[ $filename ] ) ? $fallbacks[ $filename ] : '';
}
