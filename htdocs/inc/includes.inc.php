<?php

if(!file_exists('config.inc.php') || !is_readable('config.inc.php')) {
  exit('The application is not configured.');
}

if(version_compare(PHP_VERSION, '5', 'lt') || (PHP_SAPI == 'cli') || (@$_SERVER['HTTP_X_moz'] === 'prefetch') /* http://www.google.com/webmasters/faq.html#prefetchblock */) {
  exit;
}

ini_set('ignore_repeated_errors', 1);
#ini_set('session.cookie_httponly', 1);
ini_set('mbstring.func_overload', 0); # http://bugs.php.net/bug.php?id=30766
#ini_set('session.use_trans_sid', 0);

# Fixing HTTP_HOST issues
if(isset($_SERVER['HTTP_HOST'])) {
  if(strstr($_SERVER['HTTP_HOST'], ',')) {
    $_SERVER['HTTP_HOST'] = trim(substr($_SERVER['HTTP_HOST'], 0, strpos($_SERVER['HTTP_HOST'], ',')));
  }
}
# HTTP/0.1 - Proxy - Apache !ExtendedStatus
else {
  $_SERVER['HTTP_HOST'] = (isset($_SERVER['HTTP_X_FORWARDED_SERVER']) ? $_SERVER['HTTP_X_FORWARDED_SERVER'] : $_SERVER['HTTP_X_FORWARDED_HOST']);
}

# Fixing IIS issues
if(!isset($_SERVER['REQUEST_URI'])) {
  if(isset($_SERVER['SCRIPT_NAME'])) {
    $_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
  }
  else {
    $_SERVER['REQUEST_URI'] = $_SERVER['PHP_SELF'];
  }
  if(isset($_SERVER['QUERY_STRING'])) {
    $_SERVER['REQUEST_URI'] .= ('?' . $_SERVER['QUERY_STRING']);
  }
}

# PHP < 5.0.2
if(!defined('PHP_EOL')) {
  if(stristr(PHP_OS, 'WIN')) {
    define('PHP_EOL', "\r\n");
  }
  elseif(stristr(PHP_OS, 'DAR')) {
    define('PHP_EOL', "\r");
  }
  else {
    define('PHP_EOL', "\n");
  }
}

# PHP < 5.3.x
if(!defined('__DIR__')) {
  define('__DIR__', dirname(__FILE__));
}

#$_SERVER['REQUEST_URI'] = htmlentities(mb_substr(@$_SERVER['REQUEST_URI'], 0, 1024), ENT_QUOTES, 'UTF-8');

# configurazione
include_once 'config.inc.php';
include_once 'inc/defrepo.inc.php';
include_once 'inc/repolist.inc.php';
# librerie
include_once 'libs/utils.inc.php';
include_once 'libs/database.inc.php';
include_once 'libs/mysql.inc.php';
include_once 'libs/internet.inc.php';
include_once 'libs/repository.inc.php';
include_once 'libs/package.inc.php';
include_once 'libs/filelist.inc.php';
include_once 'libs/xml.inc.php';
include_once 'libs/history.inc.php';
include_once 'libs/guestbook.inc.php';
include_once 'libs/stats.inc.php';
