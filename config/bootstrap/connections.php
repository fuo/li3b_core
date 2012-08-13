<?php
use lithium\core\Libraries;

/**
 * This includes all connection configurations added in the `config/connections`
 * directory of the main application.
 * 
 * This allows for this file to remain coflict free and allows the li3 console
 * command to create new files in that directory rather than trying to modify
 * this one, which could also lead to conflicts and other issues.
 * 
 * These connection configuration files are included in alphabetical order.
 * 
 * Lithium Bootstrap will put conventional emphasis on the following
 * connection configuration names:
 * li3b_mongodb
 * li3b_mysql
 * li3b_redis
 * 
 * and so on...
 * 
 * So add on libraries wishing to use Lithium Bootstrap, should consider
 * using these connection names in their models. They should also consider
 * prefixing their model $_meta['source'] values to use prefixed names for
 * tables/collections to avoid conflicts since using a conventional/default
 * connection will mean multiple libraries using the same database.
 * For example, if two libraries have a `User` model, they would conflict
 * if both used the default `users` table/collection. A better idea would
 * be to set $_meta['source'] = 'libName.users' or 'libName_users' etc.
 * Not only does this avoid conflict (since there can not be two library
 * directories by the same name), but it also immediately clues a developer
 * into which tables/collections are used by which library when looking
 * at the database.
 * 
*/

$appConfig =  Libraries::get(true);
$connd = $appConfig['path'] . '/config/bootstrap/connections/*.php';

foreach (asort(glob($connd)) as $filename) {
	include $filename;
}
?>