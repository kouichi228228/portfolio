<?php get_header(); ?>

<main class="pt-32 pb-section-padding px-margin-desktop max-w-container-max mx-auto">
  <?php if ( have_posts() ) : ?>
    <div class="grid md:grid-cols-3 gap-8">
      <?php while ( have_posts() ) : the_post(); ?>
        <article class="bg-white rounded-sm overflow-hidden shadow-sm">
          <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium', array( 'class' => 'w-full h-48 object-cover' ) ); ?></a>
          <?php endif; ?>
          <div class="p-6">
            <h2 class="font-bold text-lg mb-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="text-sm text-on-surface-variant leading-relaxed"><?php the_excerpt(); ?></div>
          </div>
        </article>
      <?php endwhile; ?>
    </div>
  <?php else : ?>
    <p class="text-center text-on-surface-variant">まだ投稿がありません。</p>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
