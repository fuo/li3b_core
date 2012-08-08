<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

/**
 * This is the primary bootstrap file of your application, and is loaded immediately after the front
 * controller (`webroot/index.php`) is invoked. It includes references to other feature-specific
 * bootstrap files that you can turn on and off to configure the services needed for your
 * application.
 *
 * Besides global configuration of external application resources, these files also include
 * configuration for various classes to interact with one another, usually through _filters_.
 * Filters are Lithium's system of creating interactions between classes without tight coupling. See
 * the `Filters` class for more information.
 *
 * If you have other services that must be configured globally for the entire application, create a
 * new bootstrap file and `require` it here.
 *
 * @see lithium\util\collection\Filters
 */

/**
 * The libraries file contains the loading instructions for all plugins, frameworks and other class
 * libraries used in the application, including the Lithium core, and the application itself. These
 * instructions include library names, paths to files, and any applicable class-loading rules. This
 * file also statically loads common classes to improve bootstrap performance.
 */
require __DIR__ . '/bootstrap/libraries.php';

/**
 * The error configuration allows you to use the filter system along with the advanced matching
 * rules of the `ErrorHandler` class to provide a high level of control over managing exceptions in
 * your application, with no impact on framework or application code.
 */
require __DIR__ . '/bootstrap/errors.php';

/**
 * This file contains configurations for connecting to external caching resources, as well as
 * default caching rules for various systems within your application
 */
//require __DIR__ . '/bootstrap/cache.php';

/**
 * This file contains configuration for session (and/or cookie) storage, and user or web service
 * authentication.
 */
require __DIR__ . '/bootstrap/session.php';

/**
 * This file contains your application's globalization rules, including inflections,
 * transliterations, localized validation, and how localized text should be loaded. Uncomment this
 * line if you plan to globalize your site.
 */
// require __DIR__ . '/bootstrap/g11n.php';

/**
 * This file contains configurations for handling different content types within the framework,
 * including converting data to and from different formats, and handling static media assets.
 */
require __DIR__ . '/bootstrap/media.php';

/**
 * This file configures console filters and settings, specifically output behavior and coloring.
 */
// require __DIR__ . '/bootstrap/console.php';

/**
 * This file contains confiuration for logging.
 * Log files will be written to /resources/tmp/logs
 */
require __DIR__ . '/bootstrap/logging.php';

/**
 * Sets up additional menus and/or modifies default menus.
 * Feel free to use this file if you like for your own application.
 */
// require __DIR__ . '/bootstrap/menu.php';

/**
 * Last, but not least, the template override filter.
 * It allows you to override any library's templates with your own.
 * This way, you can take any given library that may contain the 
 * functionality you want and simply redesign it to fit your app
 * without modifying the templates in the library.
 * 
 * You do this through configuration options passed when the 
 * library is added. By deafult it will first look for templates
 * in the `views/_libraries/library_name` and then 
 * `views/_libraries/layouts/library_name`directories.
 * 
 * Don't forget, if the library requires extensive modification to
 * work with your application, you can always branch it =)
 */
require __DIR__ . '/bootstrap/templates.php';
?>