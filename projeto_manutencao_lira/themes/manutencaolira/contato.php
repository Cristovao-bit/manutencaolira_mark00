<section>
    <div class="header-style" id="particles-js">
        <header>
            <span class="icon-style"><i class="icon-contato"></i></span>
            <h1>Contato</h1>
        </header>
    </div>

    <section class="container text-shadow radius-five fale_conosco_background" id="faleconosco">
        <div class="fale_conosco">
            <article>
                <header class="fale_conosco_header">
                    <h1>Formulário de Contato:</h1>
                    <p>Preencha o formulário de contato para entrar em contato conosco ou utilize
                        as formas de contato que se encontra ao lado do formulário.</p>
                </header>
                
                <?php
                $FaleConosco = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if($FaleConosco && $FaleConosco['SendFormContact']):
                    var_dump($FaleConosco);
                endif;
                ?>

                <form method="post" action="#faleconosco">
                    <div class="fale_conosco_form">
                        <div class="fale_conosco_content">
                            <label class="inputBox">
                                <input title="Informe seu nome!" type="text" name="RemetenteNome" autocomplete="false" required placeholder="Informe seu nome"/>
                                <span>Nome</span>
                            </label>

                            <label class="inputBox">
                                <input title="Informe seu email!" type="email" name="RemetenteEmail" autocomplete="false" required placeholder="Informe um email válido"/>
                                <span>Email</span>
                            </label>
                        </div>

                        <div class="fale_conosco_content">
                            <label class="inputBox">
                                <input title="Informe seu número de telefone!" type="tel" name="Numero" autocomplete="false" required placeholder="(xx)xxxxx-xxxx"/>
                                <span>Fone</span>
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
                    </div>

                    <div class="fale_conosco_textarea">
                        <label class="inputBox">
                            <textarea title="Área de Assunto!" name="Mensagem" autocomplete="false" placeholder="Informe o assunto a ser tratado"></textarea>
                            <span>Mensagem</span>
                        </label>
                    </div>

                    <div class="button_form">
                        <input class="btn btn-cyan radius-five" title="Limpar informações!" type="reset" value="Limpar Campos"/>
                        <input class="btn btn-cyan radius-five" title="Enviar informações!" name="SendFormContact" type="submit" value="Enviar Dados"/>
                    </div>
                </form>
            </article>

            <aside class="fale_conosco_sidebar">
                <h1>Formas de contato:</h1>
                <ul>
                    <li><b>Horário de Atendimento:</b> 08:00 às 17:00 hrs</li>
                    <li><b>E-mail:</b> <a href="mailto:suporte@manutencaolira.com.br?subject=Fale Conosco - Manutenção Lira">suporte@manutencaolira.com.br</a></li>
                    <li><b>Fone(Whatsapp):</b> (83)9 9837-9516</li>
                    <li><b>Endereço:</b> Rua Dr. Silvino Olavo, nº 38</li>
                    <li>58135000 Esperança/PB</li>
                    <li>Brasil</li>
                </ul>
            </aside>
        </div>
    </section>
</section>