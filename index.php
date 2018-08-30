<?php
error_reporting(E_ALL);
/**
 * DATASUS - ESQUELETO PADRÃƒO DE SISTEMAS DO DATASUS
 *
 * DescriÃ§Ã£o do arquivo (opcional).
 *
 * @author      Marcio Paiva Barbosa <marcio.barbosa@saude.gov.br>
 * @copyright   Copyright (c) 2010, DATASUS
 * @package     Datasus_
 * @since       Arquivo disponÃ­vel desde a versÃ£o 1.0
 * @version     $Id$
 */

/**
 * Habilita a compactacao GZIP
 */
if(!ob_start("ob_gzhandler")) ob_start();

/**
 * Desabilita o cache de soap
 */
ini_set("soap.wsdl_cache_enabled", 0);

/**
 * Define o diretorio onde a aplicaÃ§Ã£o esta rodando.
 * Se nÃ£o tiver definido anteriormente, define usando
 * realpath(dirname(__FILE__) . '/../application').
 * O resultado serÃ¡ C:\<caminho_para_localhost>\<app nome>\application
 */
defined('APPLICATION_PATH') || define('APPLICATION_PATH',
realpath(dirname(__FILE__) . '/../application'));

/**
 * Define o ambiente da aplicaÃ§Ã£o.
 * Assume 'producao' como ambiente padrÃ£o se a variavel APPLICATION_ENV
 * nao tiver sido setada no arquivo .htaccess
 */
defined('APPLICATION_ENV') || define('APPLICATION_ENV',
(getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'desenvolvimento'));

/**
 * Define o diretÃ³rio de biblioteca da aplicaÃ§Ã£o.
 */
set_include_path(implode(PATH_SEPARATOR, array(
realpath(APPLICATION_PATH . '/../library'),
get_include_path(),
)));


/**
 * Classe principal do zend framework
 */
require_once 'Zend/Application.php';
require_once APPLICATION_PATH . '/Utils.php';

/**
 * Cria uma instancia de Zend_Application passando o ambiente e o caminho
 * para o arquivo de configuracÃµes.
 * Este componente irÃ¡ automatizar algumas configuraÃ§Ãµes definidas no config.ini
 */
$application = new Zend_Application(
APPLICATION_ENV,
APPLICATION_PATH . '/configs/config.ini'
);

/**
 * Carregos configuraÃ§Ãµes basicas do bootstrap
 * como layout, view, models ....
 */
$application->bootstrap();

/**
 * Inicia efetivamente a aplicacao.
 * Neste momento Ã© dado o dispatch para instanciar os controllers e actions
 */
$application->run();
