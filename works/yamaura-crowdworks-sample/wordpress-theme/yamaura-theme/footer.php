<!-- BEGIN: Footer -->
<footer class="bg-surface py-unit-xl px-margin-desktop w-full border-t border-outline-variant/30" data-purpose="site-footer">
  <div class="max-w-container-max mx-auto flex flex-col items-center gap-4 text-center">
    <div class="flex flex-col md:flex-row justify-between items-center gap-6 w-full">
      <div class="font-serif text-xl tracking-widest text-primary uppercase font-bold"><?php bloginfo( 'name' ); ?></div>
      <div class="flex flex-wrap justify-center gap-6 text-sm text-on-surface-variant">
        <a class="hover:text-primary underline transition-all whitespace-nowrap" href="#">プライバシーポリシー</a>
        <a class="hover:text-primary underline transition-all whitespace-nowrap" href="#">利用規約</a>
        <a class="hover:text-primary underline transition-all whitespace-nowrap" href="#contact">お問い合わせ</a>
      </div>
      <p class="text-xs opacity-50 whitespace-nowrap">© <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. ALL RIGHTS RESERVED.</p>
    </div>
    <?php if ( current_user_can( 'edit_posts' ) ) : ?>
      <a class="text-[10px] text-on-surface-variant/60 hover:text-primary underline" href="<?php echo esc_url( admin_url( 'edit.php?post_type=work' ) ); ?>">
        管理画面で施工事例・お客様の声を編集する
      </a>
    <?php endif; ?>
  </div>
</footer>
<!-- END: Footer -->
<script data-purpose="scroll-reveal">
  document.addEventListener('DOMContentLoaded', function () {
    const menuButton = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    if (menuButton && mobileMenu) {
      menuButton.setAttribute('type', 'button');
      menuButton.setAttribute('aria-controls', 'mobile-menu');
      menuButton.setAttribute('aria-expanded', 'false');
      menuButton.addEventListener('click', function () {
        const isOpen = !mobileMenu.classList.contains('hidden');
        mobileMenu.classList.toggle('hidden', isOpen);
        menuButton.setAttribute('aria-expanded', String(!isOpen));
      });
      mobileMenu.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
          mobileMenu.classList.add('hidden');
          menuButton.setAttribute('aria-expanded', 'false');
        });
      });
    }

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) entry.target.classList.add('active');
      });
    }, { root: null, rootMargin: '0px', threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));
  });
</script>
<?php wp_footer(); ?>
</body>
</html>
