<?php
define('HOME', 'http://localhost/manutencao_lira/projeto_final_manutencao_lira_04');
define('THEMES', 'manutencaolira');
define('INCLUDE_PATH', HOME . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . THEMES);
define('REQUIRE_PATH', 'themes' . DIRECTORY_SEPARATOR . THEMES);

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBSA', 'mlmanutencaolira');

define('WS_SUCCESS', 'trigger-success');
define('WS_INFOR', 'trigger-infor');
define('WS_ALERT', 'trigger-alert');
define('WS_ERROR', 'trigger-error');

$pg_name = 'MANUTENÇÃO LIRA | Suporte Técnico em Informática';
$pg_ceo = 'Cristovão Lira Braga';
$pg_site = 'ML - Manutenção Lira';
$pg_sitekit = INCLUDE_PATH . "_img/sitekit";

function __autoload($Class) {

    $cDir = ['Conn', 'Helpers', 'Models'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . ".class.php") && !is_dir(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . ".class.php")):
            include_once (__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . ".class.php");
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir):
        trigger_error("<i class=\"icon-error\"></i>Não foi possível incluir {$Class}.class.php", E_USER_ERROR);
        die;
    endif;
}

function WSErro($ErrMsg, $ErrNo, $ErrDie = null) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));

    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}</p>";

    if ($ErrDie):
        die;
    endif;
}

function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));

    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na linha: {$ErrLine} ::</b> {$ErrMsg}</p>";
    echo "<small>{$ErrFile}</small>";
    echo "</p>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('PHPErro');

$getUrl = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
$setUrl = (empty($getUrl) ? 'index' : $getUrl);
$Url = explode("/", $setUrl);

switch ($Url[0]):
    case'index':
        $pg_title = $pg_name;
        $pg_desc = "Manutenção Lira é uma empresa de suporte técnico em informática voltado para usuários domésticos e empresas de pequeno porte.
                    Nosso Core Bussiness é baseado no relacionamento direto com o cliente ou empresa, propocionando ao mesmo serviços técnicos e acessórios
                    que podemos oferecer dentro da nossa área, procurando na medida do impossível, adaptar serviços existentes para as suas necessidades, promovendo
                    sempre a sua satisfação.";
        $pg_image = $pg_sitekit . "/index.jpg";
        $pg_url = HOME;
        break;
    
    default:
        $pg_title = 'Erro 404 Página não encontrada';
        $pg_desc = 'A página <b>' . $setUrl . '</b> que você tentou acessar está indisponível ou não existe, mas não
                    saia ainda. Temos algumas dicas para te ajudar com a pesquisa!';
        $pg_image = $pg_sitekit . "/404.jpg";
        $pg_url = HOME . '/404';
        break;
endswitch;