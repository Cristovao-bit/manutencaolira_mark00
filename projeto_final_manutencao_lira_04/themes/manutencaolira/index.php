<article class="bg-black border-shadow main_hero" id="particles-js">
    <header>
        <h1>SEJA BEM VINDO(a)!</h1>
        <p>Ao Seu <span class="type"></span></p>

        <div class="hero_buttons">
            <h2><a href="<?= HOME; ?>/servicos" title="SERVIÇOS | Manutenção Lira" class="cursor radius-five hero_btn">Saiba Mais</a></h2>
            <h2><a href="<?= HOME; ?>/contato" title="CONTATO | Manutenção Lira" class="cursor radius-five hero_btn_out">Fale Conosco</a></h2>
        </div>

        <a href="#servicos" class="cursor hero_icon j_hero"><i class="icon-chevron-down"></i></a>
    </header>
</article>

<section class="container text-shadow main_serv servicos">
    <header class="title-header">
        <h1 class="font-title">Nossos Serviços</h1>
        <p class="tagline">O que fazemos de melhor para você que é nosso cliente</p>
    </header>

    <article class="main_serv_item">
        <span class="bg-black radius-circle"><i class="icon-desktop"></i></span>

        <div class="main_serv_content">
            <h2>Suporte Técnico em DeskTops</h2>
            <p>Fornecemos o suporte técnico em computadores de mesa. Desde a instalação do Sistema Operacional(Formatação)
                até a substituição ou reparo de peças(Hardware). Também instalamos o computador em sua residência, cuidando
                até da parte elétrica.</p>
        </div>

        <a href="<?= HOME; ?>/servicos-desktops" title="SERVIÇOS EM DESKTOPS | Manutenção Lira" class="btn btn-yellow radius-five">Saiba Mais</a>
    </article>

    <article class="main_serv_item">
        <span class="bg-black radius-circle"><i class="icon-laptop"></i></span>

        <div class="main_serv_content">
            <h2>Suporte Técnico em Notebooks</h2>
            <p>Fornecemos o suporte técnico em notebooks, netebooks e ultrabooks em suas diferentes marcas. Desde sua formatação
                (Sistema Operacional) com instalação de utilitários e aplicativos para a usabilidade do cliente até o reparo ou 
                substituição de peças(Hardware).</p>
        </div>

        <a href="<?= HOME; ?>/servicos-notebooks" title="SERVIÇOS EM NOTEBOOKS | Manutenção Lira" class="btn btn-yellow radius-five">Saiba Mais</a>
    </article>

    <article class="main_serv_item">
        <span class="bg-black radius-circle"><i class="icon-file-code"></i></span>

        <div class="main_serv_content">
            <h2>Criação e Manutenção em WebSites</h2>
            <p>Desenvolvemos sites, blogs e portfolio online utilizando as melhores tecnologias como linguagens HTML5, CSS3, jQuery e PHP;
                Totalmente semântico e com ótima otimização para o acesso nos motores de busca, seguindo os padrões exigidos pela web(W3C).</p>
        </div>

        <a href="<?= HOME; ?>/servicos-websites" title="SERVIÇOS EM WEBSITES | Manutenção Lira" class="btn btn-yellow radius-five">Saiba Mais</a>
    </article>
</section>

<article class="bg-black">
    <div class="main_newslleter">
        <header class="title-header">
            <h1 class="font-title">Newslleter</h1>
            <p class="tagline">Receba nossas promoções, dicas e conteúdos diretamente no seu email!</p>
        </header>

        <?php
        $newslleter = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($newslleter && $newslleter['SendFormNews']):
            unset($newslleter['SendFormNews']);
            $newslleter['DestinoNome'] = 'Cristovão Lira Braga | Manutenção Lira';
            $newslleter['DestinoEmail'] = 'suporte@manutencaolira.com.br';

            $SendMail = new Email;
            $SendMail->Enviar($newslleter);

            if ($SendMail->getError()):
                WSErro($SendMail->getError()[0], $SendMail->getError()[1]);
            endif;
        endif;
        ?>

        <form method="post" name="FormNewslleter" action="" autocomplete="off">
            <input type="text" class="radius-cylinder" title="Informe seu nome completo!" name="RemetenteNome" placeholder="Informe seu nome" required/>
            <input type="email" class="radius-cylinder" title="Informe seu nome email válido!" name="RemetenteEmail" placeholder="Informe seu email" required/>

            <input type="submit" class="radius-cylinder" title="Enviar informações!" name="SendFormNews" value="Enviar"/>
        </form>
    </div>
</article>

<section class="container text-shadow blog_container">
    <header class="title-header">
        <h1 class="font-title">Blog</h1>
        <p class="tagline">Dicas e Conteúdos para você!</p>
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

<section class="container text-shadow infoproduto_content">
    <header class="title-header">
        <h1 class="font-title">Loja de Infoprodutos</h1>
        <p class="tagline">Veja as opções e escolha o que mais lhe agrada</p>
    </header>

    <div class="bg-yellow radius-five infoproduto_container">
        <article class="border-shadow radius-five infoproduto_content_item">
            <img title="Curso de eletrônica geral" alt="[Curso de eletrônica geral]" src="<?= INCLUDE_PATH; ?>/_img/curso_de_eletronica_geral.png"/>

            <p>Lorem Ipsum é simplesmente uma simulação de texto 
                da indústria tipográfica e de impressos, e vem sendo 
                utilizado desde o  século XVI.</p>
            <a href="#!" target="_blank" class="btn btn-yellow radius-five">Saiba Mais</a>
        </article>

        <article class="border-shadow radius-five infoproduto_content_item">
            <img title="Curso de eletrônica geral" alt="[Curso de eletrônica geral]" src="<?= INCLUDE_PATH; ?>/_img/curso_de_eletronica_geral.png"/>

            <p>Lorem Ipsum é simplesmente uma simulação de texto 
                da indústria tipográfica e de impressos, e vem sendo 
                utilizado desde o  século XVI.</p>
            <a href="#!" target="_blank" class="btn btn-yellow radius-five">Saiba Mais</a>
        </article>

        <article class="border-shadow radius-five infoproduto_content_item">
            <img title="Curso de eletrônica geral" alt="[Curso de eletrônica geral]" src="<?= INCLUDE_PATH; ?>/_img/curso_de_eletronica_geral.png"/>

            <p>Lorem Ipsum é simplesmente uma simulação de texto 
                da indústria tipográfica e de impressos, e vem sendo 
                utilizado desde o  século XVI.</p>
            <a href="#!" target="_blank" class="btn btn-yellow radius-five">Saiba Mais</a>
        </article>

        <article class="border-shadow radius-five infoproduto_content_item">
            <img title="Curso de eletrônica geral" alt="[Curso de eletrônica geral]" src="<?= INCLUDE_PATH; ?>/_img/curso_de_eletronica_geral.png"/>

            <p>Lorem Ipsum é simplesmente uma simulação de texto 
                da indústria tipográfica e de impressos, e vem sendo 
                utilizado desde o  século XVI.</p>
            <a href="#!" target="_blank" class="btn btn-yellow radius-five">Saiba Mais</a>
        </article>

        <article class="infoproduto_footer">
            <h2>Atenção:</h2>
            <p>Os infoprodutos oferecidos a cima e de total responsabilidade dos produtos!</p>
        </article>
    </div>
</section>

<section class="bg-black">
    <h1 class="font-zero">SlideShow</h1>

    <div class="main_slide">
        <ul class="slide">
            <li class="slide_item">
                <article class="caption">
                    <h2>Quem Somos</h2>
                    <p>Manutenção Lira é uma empresa de suporte técnico em informática voltado para usuários domésticos e empresas de pequeno porte.</p>
                </article>
            </li>

            <li class="slide_item">
                <article class="caption">
                    <h2>Nossa Missão</h2>
                    <p>Atuar com padrões de excelência no serviços prestados aos nossos clientes, aperfeiçoamendo processos, habilidades humanas e profissionais.</p>
                </article>
            </li>

            <li class="slide_item">
                <article class="caption">
                    <h2>Nossa Visão</h2>
                    <p>Ser reconhecido como uma das melhores fornecedoras de prestação de serviços na área de suporte técnico em informática, superando sempre as expectativas de nossos cliente.</p>
                </article>
            </li>

            <li class="slide_item">
                <article class="caption">
                    <h2>Nossos Valores</h2>
                    <p>Compromisso com nossos clientes; Ética profissional; Profissionalismo em nossos serviços.</p>
                </article>
            </li>

            <li class="slide_item">
                <article class="caption">
                    <h2>CEO: Cristovão Lira Braga</h2>
                    <p>"Estamos aqui para fazer alguma diferança no universo, se não, porque está aqui?"</p>
                    <span>Steve Jobs</span>
                </article>
            </li>
        </ul>

        <ol class="pagination"></ol>

        <div class="cursor button_left">
            <span class="icon-button-left"></span>
        </div>

        <div class="cursor button_right">
            <span class="icon-button-right"></span>
        </div>
    </div>
</section>

<section class="text-shadow book_online_container">
    <header class="title-header">
        <h1 class="font-title">Book Online</h1>
        <p class="tagline">Área reservada para o cliente acompanhar o historico do seu equipamento</p>
    </header>

    <div class="book_box">
        <article class="box-shadow book_login">
            <h2>Área de Login</h2>

            <form method="post" name="FormBookLogin" action="">
                <input type="email" class="radius-cylinder" name="user" title="Informe seu email!" placeholder="Informe seu email" required disabled/>
                <input type="password" class="radius-cylinder" name="pass" title="Informe sua senha!" placeholder="Informe sua senha" required disabled/>

                <input type="submit" class="cursor radius-cylinder" title="Logar" name="SendFormBookLogin" value="Logar"/>
            </form>

            <a href="#!" title="Recuperar seu login!">Esqueci minha senha</a>
        </article>

        <article class="box-shadow book_register">
            <h2>Área de Registro</h2>

            <form method="post" action="">
                <input type="text" class="radius-cylinder" title="Informe seu nome!" placeholder="Informe seu nome" required disabled/>
                <input type="email" class="radius-cylinder" title="Informe seu email!" placeholder="Informe seu email" required disabled/>
                <input type="password" class="radius-cylinder" title="Informe uma senha!" placeholder="Informe uma senha" required disabled/>
                <input type="password" class="radius-cylinder" title="Confirme a senha!" placeholder="Confirme a senha" required disabled/>

                <input type="submit" class="cursor radius-cylinder" title="Fazer registro!" value="Registrar"/>
            </form>
        </article>
    </div>
</section>

<section class="text-shadow bg-yellow main_cine">
    <div class="main_cine_background">
        <header class="title-header">
            <h1 class="font-title">Cine Lira</h1>
            <p class="tagline">Tenha um serviço de filmes e series no conforto de sua casa</p>
        </header>
    </div>
    
    <div class="cine_box radius-five">
        <article class="cine_register">
            <h2>Área de Registro</h2>
            
            <form method="post" action="">
                <input type="text" title="Informe seu nome completo" class="radius-cylinder" placeholder="Informe seu nome completo" required/>
                <input type="email" title="Informe seu email" class="radius-cylinder" placeholder="Informe seu email" required/>
                
                <input type="submit" title="Registar" class="radius-cylinder" value="Registrar"/>
            </form>
            
            <a href="" title="Recuperar login de acesso">Recuperar login de acesso</a>
        </article>
        
        <article class="cine_login">
            <h2>Área do Cliente</h2>
            
            <button class="radius-cylinder">Acessar</button>
        </article>
    </div>
</section>

<section class=" bg-black main_footer_content">
    <header class="title-header">
        <h1 class="font-title">Fale Conosco</h1>
        <p class="tagline">Entre em contato com a gente e estaremos indo até você ou venha ao nosso encontro</p>
    </header>
    
    <div class="container">
        <article class="main_email">
            <form method="post" action="">
                <h2 class="font-zero">Entre em contato por email</h2>
                
                <div class="main_email_info">
                    <div class="bloc_infor_01">
                        <label class="inputBox">
                            <input type="text" autocomplete="false" title="Informe seu nome" name="" required placeholder="Informe seu nome"/>
                            <span>Nome</span>
                        </label>
                        
                        <label class="inputBox">
                            <select name="location" title="Informe onde nos encontrou!" required>
                                <option>Google+</option>
                                <option>Facebook</option>
                                <option>Instagran</option>
                                <option>Twitter</option>
                                <option>Linkedin</option>
                            </select>
                            <span>Como encontrou nosso site?</span>
                        </label>
                    </div>
                    
                    <div class="bloc_infor_02">
                        <label class="inputBox">
                            <input title="Informe seu email!" type="email" name="email" autocomplete="false" required placeholder="Informe um email válido"/>
                            <span>Email</span>
                        </label>
                        
                        <label class="inputBox">
                            <input title="Informe seu número de telefone!" type="tel" name="numero" autocomplete="false" required placeholder="(xx)x xxxx-xxxx"/>
                            <span>Fone</span>
                        </label>
                    </div>
                </div>
                
                <div class="main_email_textarea">
                    <label class="inputBox">
                        <textarea title="Informe o seu assunto a ser tratado" autocomplete="false" name="Mensagem" placeholder="Informe o seu assunto a ser tratado"></textarea>
                        <span>Mensagem</span>
                    </label>
                </div>
                
                <div class="main_email_btn">
                    <input type="reset" class="btn radius-five btn_input" title="Limpar dados dos campos" value="Limpar Dados"/>
                    <input type="submit" class="btn radius-five btn_input" title="Enviar dados dos campos" value="Enviar Dados"/>
                </div>
            </form>
        </article>
        
        <article class="main_map">
            <h2 class="font-zero">Encontre nós pelo mapa</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.9009661330383!2d-35.85579427645072!3d-7.020926276314439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7ac28936505bed9%3A0xe09c8e497278a4b0!2sR.+Dr.+Silvino+Ol%C3%A1vo%2C+38%2C+Esperan%C3%A7a+-+PB%2C+58135-000!5e0!3m2!1spt-BR!2sbr!4v1548017418940" frameborder="0" allowfullscreen></iframe>
        </article>
        
        <article class="main_contact">
            <h2 class="font-zero">Formas de contato</h2>
            <ul>
                <li><b>Horário de Atendimento:</b> 08:00 às 17:00 hrs</li>
                <li><b>E-mail:</b> <a href="mailto:suporte@manutencaolira.com.br?subject=Fale Conosco - Manutenção Lira">suporte@manutencaolira.com.br</a></li>
                <li><b>Fone(Whatsapp):</b> (83)9 9837-9516</li>
                <li><b>Endereço:</b> Rua Dr. Silvino Olavo, nº 38</li>
                <li>58135000 Esperança/PB</li>
                <li>Brasil</li>
                <ul class="contact_redes">
                    <li><a class="radius-circle" target="_blank" href="#!" title="Facebook | Manutenção Lira!"><i class="icon icon-facebook"></i></a></li>
                    <li><a class="radius-circle" target="_blank" href="#!" title="Instagram | Manutenção Lira!"><i class="icon icon-instagram"></i></a></li>
                    <li><a class="radius-circle" target="_blank" href="#!" title="Twitter | Manutenção Lira!"><i class="icon icon-twitter"></i></a></li>
                    <li><a class="radius-circle" target="_blank" href="#!" title="Google+ | Manutenção Lira!"><i class="icon icon-google-plus"></i></a></li>
                    <li><a class="radius-circle" target="_blank" href="#!" title="Linkedin | Manutenção Lira!"><i class="icon icon-linkedin"></i></a></li>
                </ul>
            </ul>
        </article>
    </div>
</section>

<section class="aba_contato">
    <div class="toggle"></div>
    <h2>Reclamação e Sugestão</h2>
    <form method="post" action="">
        <input type="text" class="radius-five" name="" placeholder="Nome" required/>
        <input type="email" class="radius-five" name="" placeholder="Email" required/>
        <input type="rel" class="radius-five" name="" placeholder="Número de Telefone (Whatsapp-preferência)" required/>
        <textarea class="radius-five" placeholder="Reclamação e Sugestão" rows="5"></textarea>
        <input type="submit" class="btn btn-yellow radius-five" value="Enviar"/>
    </form>
</section>