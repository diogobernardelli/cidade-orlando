<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'cidadeor_wordpress');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'cidadeor_site');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'melissa22');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '=Mo)d2I;%|]Y&3#bg5+^Tf{1m[l6^1C`)qs:c0^lgCL6.`A]vFfH?z{-}KC#B cg');
define('SECURE_AUTH_KEY',  'Q`Ih9PD-G;:?0tEl_|}Z`H@yI5M${L@pK^)6*fQ@LuN9*dZ>_tfXS.a`?!Rr 2K:');
define('LOGGED_IN_KEY',    '~6q+0K8}G2v*=M{_}`JEuq-e2s@C_3M@a#afYPp-Uq%m69IN7sW@yL .f{+`/%=A');
define('NONCE_KEY',        'Q:J_pzX[GK+E)k:1sWR/)az+7vCas/=J2Yk*Rq.B].k`f[J^e%dB.]iA6Phx;,61');
define('AUTH_SALT',        'SCsJ?63Z)?HUrJ#F5PQb.g#,>3QhwKHv-%AGWhR`E1u]$QM8Ad?[:kkJHM:DuSf2');
define('SECURE_AUTH_SALT', 't1>`6>lf(i[oed4R|F+@$8fQTvF)|l+ZSv>6-lT.|=Xvf{h;T[iQcA;+tOQBS^<*');
define('LOGGED_IN_SALT',   'W/)5lEM5)@MlwBs.}8Aee|<XOgM9w>~%,+O_cb6UZC7Sd^E~!%VO 4WDd{mZniO*');
define('NONCE_SALT',       'DOlkF16vruIW+C+gU$~23ky^%-AD|4aT*7S&D6MSaIqY<WI}uaf|d:R:14u}v(r{');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
