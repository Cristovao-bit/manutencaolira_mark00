<section>
    <div class="header-style" id="particles-js">
        <header>
            <span class="icon-style"><i class="icon-blog"></i></span>
            <h1>Blog</h1>
        </header>
    </div>

    <section class="container text-shadow blog_container">
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

        <?php
        $View = new View;
        $tpl_g = $View->Load('article_g');
        $tpl_m = $View->Load('article_m');
        ?>

        <section class="blog_content_destaque">
            <h1 class="line-title"><span class="title-color">Confira Nossas Atualizações:</span></h1>

            <?php
            $cat = Check::CatByName('Artigos');
            $poste = new Read;
            $poste->ExeRead("ml_posts", "WHERE post_status = 1 AND (post_cat_parent = :cat OR post_category = :cat) ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "cat={$cat}&limit=1&offset=0");
            if (!$poste->getResult()):
                WSErro("Desculpe, ainda não existe artigos no site!", WS_INFOR);
            else:
                $new = $poste->getResult()[0];
                $new['post_title'] = Check::Words($new['post_title'], 12);
                $new['post_content'] = Check::Words($new['post_content'], 38);
                $new['datetime'] = date('Y-m-d', strtotime($new['post_date']));
                $new['pubdate'] = date('d/m/Y', strtotime($new['post_date']));
                $View->Show($new, $tpl_g);
            endif;
            ?>
        </section>

        <aside class="blog_content_aside">
            <h1 class="line-title"><span class="title-color">Artigos Mais Vistos:</span></h1>

            <?php
            $asidepostes = new Read;
            $asidepostes->ExeRead("ml_posts", "WHERE post_status = 1 ORDER BY post_views DESC, post_date DESC LIMIT 2");
            if (!$asidepostes->getResult()):
                WSErro('Desculpe, ainda não existes postes na coluna dos mais vistos do site!', WS_INFOR);
            else:
                foreach ($asidepostes->getResult() as $apostes):
                    $apostes['post_title'] = Check::Words($apostes['post_title'], 12);
                    $apostes['datetime'] = date('Y-m-d', strtotime($apostes['post_date']));
                    $apostes['pubdate'] = date('d/m/Y', strtotime($apostes['post_date']));
                    $View->Show($apostes, $tpl_m);
                endforeach;
            endif;
            ?>
        </aside>
    </section>
</section>

<article class="bg-yellow">
    <h1 class="font-zero">Divulgação do Site</h1>

    <ul class="container text-shadow main_divulg">
        <li class="radius-five main_divulg_item">
            <a href="#!" title="Compartilhe no Facebook!">
                <i class="icon-facebook"></i>
                <h2>Facebook <span>0</span></h2>
            </a>
        </li>

        <li class="radius-five main_divulg_item">
            <a href="#!" title="Publique no Instagram!">
                <i class="icon-instagram"></i>
                <h2>Instagram <span>0</span></h2>
            </a>
        </li>
        <li class="radius-five main_divulg_item">
            <a href="#!" title="Recomende no Google+!">
                <i class="icon-google-plus"></i>
                <h2>Google+ <span>0</span></h2>
            </a>
        </li>
        <li class="radius-five main_divulg_item">
            <a href="#!" title="Compartilhe no Twitter!">
                <i class="icon-twitter"></i>
                <h2>Twitter <span>0</span></h2>
            </a>
        </li>
        <li class="radius-five main_divulg_item">
            <a href="#!" title="Compartilhe no Linkedin!">
                <i class="icon-linkedin"></i>
                <h2>Linkedin <span>0</span></h2>
            </a>
        </li>
    </ul>
</article>