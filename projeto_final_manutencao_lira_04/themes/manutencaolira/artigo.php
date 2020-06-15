<section>
    <div class="header-style" id="particles-js">
        <header>
            <span class="icon-style"><i class="icon-blog"></i></span>
            <h1>Artigo</h1>
        </header>
    </div>

    <section class="container text-shadow">
        <header class="main_lastnews_menu">
            <nav class="radius-five">
                <ul>
                    <li><a href="<?= HOME; ?>/blog">Home</a></li>
                    <li><a href="<?= HOME; ?>/hardware">Hardware</a></li>
                    <li><a href="<?= HOME; ?>/software">Software</a></li>
                    <li><a href="<?= HOME; ?>/web">Web</a></li>
                    <li><a href="<?= HOME; ?>/atualidades">Atualidades</a></li>
                </ul>

                <div class="radius-cylinder main_search">
                    <input type="text" class="search" name="" placeholder="Pesquise aqui!"/>
                    <a href="#!" class="search_btn radius-circle"><i class="icon-pesquisa"></i></a>
                </div>
            </nav>
        </header>

        <article class="artigo_content">
            <header class="artigo_header">
                <div class="artigo_title">
                    <h1><?= $post_title; ?></h1>
                    <time datetime="<?= date('Y-m-d', strtotime($post_date)); ?>" pubdate><?= date('d/m/Y \à\s H:i', strtotime($post_date)); ?>Hs</time>
                </div>

                <div class="artigo_button">
                    <button class="btn_facebook">Facebook</button>
                    <button class="btn-twitter">Twitter</button>
                </div>
            </header>

            <div class="artigo_capa radius-five">
                <?= Check::Image('uploads' . DIRECTORY_SEPARATOR . $post_cover, $post_title, 750, 400); ?>
            </div>

            <p><?= $post_content; ?></p>
        </article>
    </section>

    <?php
    $readMore = new Read;
    $readMore->ExeRead("ml_posts", "WHERE post_status = 1 AND post_id != :id AND post_category = :cat ORDER BY rand() LIMIT 2", "id={$post_id}&cat={$post_category}");
    if ($readMore->getResult()):
        $View = new View;
        $tpl_footer = $View->Load('article_footer');
        ?>
        <section class="bg-yellow text-shadow artigo_footer_container">
            <header class="title-header">
                <h1 class="font-title">Artigos Relacionados</h1>
                <p class="tagline">Veja alguns artigos relacionados com o que você está lendo</p>
            </header>

            <div class="container artigo_footer_content">
                <?php
                foreach ($readMore->getResult() as $more):
                    $View->Show($more, $tpl_footer);
                endforeach;
                ?>
            </div>
        </section>
        <?php
    endif;
    ?>
</section>