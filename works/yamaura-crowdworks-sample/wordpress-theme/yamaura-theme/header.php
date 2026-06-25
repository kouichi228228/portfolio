<!DOCTYPE html>
<html lang="ja" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
<?php wp_head(); ?>
<style data-purpose="custom-animations">
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
    .reveal { opacity: 0; }
    .reveal.active { animation: fadeInUp 0.8s ease-out forwards; }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover {
      transform: translateY(-8px);
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body <?php body_class( 'bg-surface text-on-surface font-sans selection:bg-primary selection:text-white' ); ?>>
<?php wp_body_open(); ?>
<!-- BEGIN: TopAppBar -->
<header class="fixed top-0 w-full z-50 bg-surface/85 backdrop-blur-md border-b border-outline-variant/30 h-20 flex justify-between items-center px-margin-desktop max-w-container-max mx-auto" data-purpose="main-header">
  <div class="flex items-center gap-4">
    <button class="p-2 lg:hidden" id="menu-toggle">
      <span class="material-icons text-primary">menu</span>
    </button>
    <div class="font-serif text-2xl tracking-widest text-on-surface uppercase font-bold"><?php bloginfo( 'name' ); ?></div>
  </div>
  <nav class="hidden lg:flex items-center gap-8 font-medium text-sm">
    <a class="hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a>
    <a class="hover:text-primary transition-colors" href="#services">サービス</a>
    <a class="hover:text-primary transition-colors" href="#works">施工事例</a>
    <a class="hover:text-primary transition-colors" href="#about">私たちについて</a>
    <a class="hover:text-primary transition-colors" href="#process">ご利用の流れ</a>
    <a class="hover:text-primary transition-colors" href="#voice">お客様の声</a>
  </nav>
  <a class="bg-primary text-white px-6 py-2 h-full flex items-center gap-2 hover:bg-opacity-90 transition-all font-bold" href="#contact">
    <span class="material-icons text-sm">mail</span>
    お問い合わせ
  </a>
</header>
<nav class="hidden fixed left-0 right-0 top-20 z-40 bg-white border-b border-surface-dim px-margin-desktop py-4 shadow-lg lg:hidden" id="mobile-menu">
  <a class="block py-3 text-sm font-medium border-b border-surface-dim/40 hover:text-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a>
  <a class="block py-3 text-sm font-medium border-b border-surface-dim/40 hover:text-primary" href="#services">サービス</a>
  <a class="block py-3 text-sm font-medium border-b border-surface-dim/40 hover:text-primary" href="#works">施工事例</a>
  <a class="block py-3 text-sm font-medium border-b border-surface-dim/40 hover:text-primary" href="#about">私たちについて</a>
  <a class="block py-3 text-sm font-medium border-b border-surface-dim/40 hover:text-primary" href="#process">ご利用の流れ</a>
  <a class="block py-3 text-sm font-medium hover:text-primary" href="#voice">お客様の声</a>
</nav>
<!-- END: TopAppBar -->
