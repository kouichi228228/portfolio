<?php get_header(); ?>

<main>
<!-- BEGIN: Hero -->
<section class="relative h-screen flex items-center overflow-hidden">
  <img alt="Modern luxury living room" class="absolute inset-0 w-full h-full object-cover" src="<?php echo esc_url( yamaura_asset_image_url( 'hero.jpg' ) ); ?>"/>
  <div class="absolute inset-0 bg-black/40"></div>
  <div class="relative z-10 w-full px-margin-desktop max-w-container-max mx-auto text-white">
    <div class="animate-fade-in-up">
      <h1 class="font-serif text-5xl md:text-8xl mb-6 leading-tight">Space Design<br/>That Inspires.</h1>
      <p class="text-lg md:text-xl mb-10 font-light tracking-wide leading-relaxed">
        住まいの魅力を最大限に引き出す<br/>
        空間デザイン・ホームステージング
      </p>
      <div class="flex flex-col sm:flex-row gap-4">
        <a class="bg-primary hover:bg-opacity-90 text-white px-10 py-4 text-center transition-all flex items-center justify-center gap-3" href="#works">
          施工事例を見る <span>→</span>
        </a>
        <a class="bg-transparent border border-white hover:bg-white/10 text-white px-10 py-4 text-center transition-all" href="#contact">
          お問い合わせ
        </a>
      </div>
    </div>
  </div>
  <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2">
    <span class="text-[10px] tracking-widest text-white uppercase">Scroll</span>
    <div class="w-[1px] h-12 bg-white/50 relative overflow-hidden">
      <div class="absolute top-0 left-0 w-full h-full bg-white animate-bounce"></div>
    </div>
  </div>
</section>
<!-- END: Hero -->

<!-- BEGIN: About -->
<section class="py-section-padding px-margin-desktop max-w-container-max mx-auto reveal" id="about">
  <div class="grid lg:grid-cols-2 gap-12 items-center">
    <div>
      <img alt="Luxury dining room" class="w-full h-auto rounded-sm shadow-lg" src="<?php echo esc_url( yamaura_asset_image_url( 'about.jpg' ) ); ?>"/>
    </div>
    <div class="space-y-6">
      <span class="text-primary font-serif tracking-[0.2em] text-sm uppercase">About</span>
      <h2 class="text-3xl md:text-4xl font-bold leading-snug">空間をデザインし、価値を高める。</h2>
      <p class="text-on-surface-variant leading-relaxed">
        YAMAURAは、ホームステージング・インテリアコーディネート・民泊デザインを<br/>
        通して、住まいの魅力を最大限に引き出します。<br/>
        不動産の販売・賃貸・民泊運営など、それぞれの目的に合わせて、<br/>
        「ここに住みたい」と思える空間をトータルでご提案します。
      </p>
      <a class="inline-flex items-center gap-4 border border-on-surface/20 px-8 py-3 hover:bg-primary hover:text-white transition-all duration-300" href="#about">
        私たちについて <span>→</span>
      </a>
    </div>
  </div>
</section>
<!-- END: About -->

<!-- BEGIN: Service -->
<section class="py-section-padding bg-white" id="services">
  <div class="px-margin-desktop max-w-container-max mx-auto">
    <div class="text-center mb-16">
      <h2 class="text-3xl font-serif tracking-widest uppercase reveal">Service</h2>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php
      $services = array(
        array( 'icon' => 'home',      'title' => 'ホームステージング',        'desc' => '物件の魅力を最大限に引き出し、早期成約をサポートします。', 'img' => 'service-1.jpg' ),
        array( 'icon' => 'chair',     'title' => 'インテリアコーディネート',   'desc' => '理想の暮らしを叶える空間づくりをご提案します。', 'img' => 'service-2.jpg' ),
        array( 'icon' => 'bed',       'title' => '民泊デザイン',              'desc' => '宿泊者に選ばれる空間で、収益向上をサポートします。', 'img' => 'service-3.jpg' ),
        array( 'icon' => 'inventory', 'title' => '家具レンタル・販売',         'desc' => 'シーンに合わせた家具をレンタル・販売しています。', 'img' => 'service-4.jpg' ),
      );
      foreach ( $services as $s ) :
      ?>
      <div class="bg-surface rounded-sm overflow-hidden hover-lift reveal">
        <img alt="<?php echo esc_attr( $s['title'] ); ?>" class="w-full h-48 object-cover" src="<?php echo esc_url( yamaura_asset_image_url( $s['img'] ) ); ?>"/>
        <div class="p-6 text-center">
          <div class="w-12 h-12 border border-primary/30 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="material-icons text-primary"><?php echo esc_html( $s['icon'] ); ?></span>
          </div>
          <h3 class="font-bold text-lg mb-3"><?php echo esc_html( $s['title'] ); ?></h3>
          <p class="text-sm text-on-surface-variant leading-relaxed"><?php echo esc_html( $s['desc'] ); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- END: Service -->

<!-- BEGIN: Works（WordPress投稿タイプ「施工事例」から取得） -->
<section class="py-section-padding px-margin-desktop max-w-container-max mx-auto" id="works">
  <div class="text-center mb-16">
    <h2 class="text-3xl font-serif tracking-widest uppercase reveal">Works</h2>
  </div>
  <div class="grid md:grid-cols-3 gap-8">
    <?php
    $works_query = new WP_Query( array(
      'post_type'      => 'work',
      'posts_per_page' => 3,
      'orderby'        => 'date',
      'order'          => 'DESC',
    ) );
    if ( $works_query->have_posts() ) :
      while ( $works_query->have_posts() ) : $works_query->the_post();
        $label = get_post_meta( get_the_ID(), '_yamaura_label', true );
        ?>
        <div class="group cursor-pointer reveal active">
          <div class="relative overflow-hidden mb-4">
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail( 'large', array( 'class' => 'w-full transition-transform duration-700 group-hover:scale-110' ) ); ?>
            <?php else : ?>
              <div class="w-full h-64 bg-surface-dim flex items-center justify-center text-on-surface-variant text-sm">画像未設定</div>
            <?php endif; ?>
            <?php if ( $label ) : ?>
              <div class="absolute bottom-4 left-4 bg-white/90 px-3 py-1 text-[10px] tracking-tighter"><?php echo esc_html( $label ); ?></div>
            <?php endif; ?>
          </div>
          <h3 class="font-bold border-b border-primary/20 pb-4"><?php the_title(); ?></h3>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
    <?php else : ?>
      <p class="text-on-surface-variant col-span-3 text-center">まだ施工事例が登録されていません。管理画面の「施工事例」から追加してください。</p>
    <?php endif; ?>
  </div>
  <div class="mt-12 text-right">
    <a class="inline-flex items-center gap-2 text-sm font-bold hover:text-primary transition-colors" href="<?php echo esc_url( get_post_type_archive_link( 'work' ) ); ?>">
      すべての施工事例を見る <span class="material-icons text-sm">arrow_forward</span>
    </a>
  </div>
</section>
<!-- END: Works -->

<!-- BEGIN: Strength -->
<section class="py-section-padding bg-surface-dim/20" id="strength">
  <div class="px-margin-desktop max-w-container-max mx-auto">
    <div class="text-center mb-16">
      <h2 class="text-3xl font-serif tracking-widest uppercase reveal">Strength</h2>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
      <?php
      $strengths = array(
        array( 'no' => '01', 'icon' => 'domain',        'title' => '豊富な実績',        'desc' => '住宅・民泊・モデルルームなど多種多様な実績があります。' ),
        array( 'no' => '02', 'icon' => 'public',        'title' => '全国対応',          'desc' => '全国エリアでの対応が可能。遠方の案件もお任せください。' ),
        array( 'no' => '03', 'icon' => 'psychology',    'title' => 'プロによる提案力',   'desc' => '経験豊富なプロが、最適なプランをご提案します。' ),
        array( 'no' => '04', 'icon' => 'shopping_cart', 'title' => '家具搬入まで対応',   'desc' => 'プランニングから家具の搬入・設置までワンストップで対応。' ),
      );
      foreach ( $strengths as $s ) :
      ?>
      <div class="text-center reveal">
        <span class="block text-primary font-serif text-3xl mb-2"><?php echo esc_html( $s['no'] ); ?></span>
        <div class="w-12 h-12 mx-auto mb-4">
          <span class="material-icons text-primary text-4xl"><?php echo esc_html( $s['icon'] ); ?></span>
        </div>
        <h4 class="font-bold mb-2"><?php echo esc_html( $s['title'] ); ?></h4>
        <p class="text-xs text-on-surface-variant"><?php echo esc_html( $s['desc'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- END: Strength -->

<!-- BEGIN: Flow -->
<section class="py-section-padding px-margin-desktop max-w-container-max mx-auto" id="process">
  <div class="text-center mb-16">
    <h2 class="text-3xl font-serif tracking-widest uppercase reveal">Flow</h2>
  </div>
  <div class="relative">
    <div class="absolute top-1/2 left-0 w-full h-[1px] bg-primary/20 -translate-y-1/2 hidden md:block"></div>
    <div class="grid grid-cols-2 md:grid-cols-6 gap-8 relative z-10">
      <?php
      $flow = array(
        array( '01', 'お問い合わせ',       'フォームまたはお電話にてお気軽にご相談ください。' ),
        array( '02', 'ヒアリング',          'ご要望や物件の状況を詳しくお伺いします。' ),
        array( '03', 'プラン提案・お見積り', '最適なプランとお見積りをご提案します。' ),
        array( '04', 'ご契約・準備',        'ご契約後、スケジュール調整・準備を行います。' ),
        array( '05', '施工・設置',          '家具の搬入・設置まで丁寧に対応します。' ),
        array( '06', '完成・フォロー',      '設置後のサポートもお任せください。' ),
      );
      foreach ( $flow as $f ) :
      ?>
      <div class="text-center reveal">
        <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4 border border-primary/20">
          <span class="text-primary font-serif"><?php echo esc_html( $f[0] ); ?></span>
        </div>
        <h4 class="font-bold text-sm mb-2"><?php echo esc_html( $f[1] ); ?></h4>
        <p class="text-[10px] text-on-surface-variant"><?php echo esc_html( $f[2] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- END: Flow -->

<!-- BEGIN: Voice（WordPress投稿タイプ「お客様の声」から取得） -->
<section class="py-section-padding bg-surface" id="voice">
  <div class="px-margin-desktop max-w-container-max mx-auto">
    <div class="text-center mb-16">
      <h2 class="text-3xl font-serif tracking-widest uppercase reveal">Voice</h2>
    </div>
    <div class="grid md:grid-cols-3 gap-8">
      <?php
      $voices_query = new WP_Query( array(
        'post_type'      => 'voice',
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC',
      ) );
      if ( $voices_query->have_posts() ) :
        while ( $voices_query->have_posts() ) : $voices_query->the_post();
          ?>
          <div class="bg-white p-8 rounded shadow-sm reveal active">
            <div class="flex items-center gap-4 mb-6">
              <div class="w-12 h-12 bg-surface-dim rounded-full flex items-center justify-center">
                <span class="material-icons text-on-surface-variant">person</span>
              </div>
              <span class="text-xs font-bold"><?php the_title(); ?></span>
            </div>
            <p class="text-sm leading-relaxed text-on-surface-variant"><?php the_content(); ?></p>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
      <?php else : ?>
        <p class="text-on-surface-variant col-span-3 text-center">まだお客様の声が登録されていません。管理画面の「お客様の声」から追加してください。</p>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- END: Voice -->

<!-- BEGIN: CTA Section -->
<section class="relative py-24 overflow-hidden" id="contact">
  <div class="absolute inset-0 bg-black/60 z-10"></div>
  <img alt="Contact Background" class="absolute inset-0 w-full h-full object-cover grayscale opacity-30" src="<?php echo esc_url( yamaura_asset_image_url( 'hero.jpg' ) ); ?>"/>
  <div class="relative z-20 px-margin-desktop max-w-container-max mx-auto text-white">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div class="reveal">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">まずはお気軽にご相談ください</h2>
        <p class="opacity-80">空間の価値を最大限に引き出すお手伝いをいたします。</p>
      </div>
      <div class="space-y-6 reveal">
        <a class="flex items-center justify-between bg-primary text-white p-6 w-full hover:bg-opacity-90 transition-all font-bold" href="#">
          <div class="flex items-center gap-4">
            <span class="material-icons">mail</span>
            <span>お問い合わせはこちら</span>
          </div>
          <span class="material-icons">arrow_forward</span>
        </a>
        <div class="flex flex-col items-start gap-1">
          <a class="text-3xl font-serif hover:text-primary transition-colors" href="tel:03-1234-5678">03-1234-5678</a>
          <span class="text-sm opacity-60">受付時間 10:00-18:00（土日祝除く）</span>
        </div>
      </div>
      <div class="bg-white text-on-surface p-6 md:p-8 reveal">
        <form class="space-y-4" action="mailto:mizobuchi.web.create@gmail.com" method="post" enctype="text/plain">
          <div>
            <label class="block text-sm font-bold mb-2" for="yamaura-name">お名前</label>
            <input class="w-full border border-surface-dim px-4 py-3 focus:border-primary focus:ring-primary" id="yamaura-name" name="yamaura_name" type="text" autocomplete="name" required>
          </div>
          <div>
            <label class="block text-sm font-bold mb-2" for="yamaura-email">メールアドレス</label>
            <input class="w-full border border-surface-dim px-4 py-3 focus:border-primary focus:ring-primary" id="yamaura-email" name="yamaura_email" type="email" autocomplete="email" required>
          </div>
          <div>
            <label class="block text-sm font-bold mb-2" for="yamaura-message">ご相談内容</label>
            <textarea class="w-full border border-surface-dim px-4 py-3 focus:border-primary focus:ring-primary" id="yamaura-message" name="yamaura_message" rows="5" required></textarea>
          </div>
          <button class="w-full bg-primary text-white py-4 font-bold hover:bg-opacity-90 transition-all" type="submit">送信する</button>
          <p class="text-xs text-on-surface-variant leading-relaxed">内容を確認後、担当者よりご連絡いたします。物件写真や間取り図がある場合は、初回相談時にあわせてご共有ください。</p>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- END: CTA Section -->
</main>

<?php get_footer(); ?>
