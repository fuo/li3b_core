<?php
/**
 * This flash message template uses the jQuery pnotify plugin which can be themed
 * by the jQuer UI themeroller. In addition, the use of a "type" option is available
 * for convenicne to help style the flash message notification popup.
 *
 * You can choose which template to call when showing a flash message, so you
 * may want to simply rename this one and make a new "flash_message.html.php"
 * view template file if you wanted to slim this down a bit, change it,
 * or not use pnotify at all.
*/

if((isset($message)) && (!empty($message))) {

    // Alternatively, you may wish to put these within the head section.
    echo $this->html->script('/li3b_core/js/jquery/jquery.pnotify.min.js');
    echo $this->html->style('/li3b_core/css/jquery/jquery.pnotify.default.css');
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery.pnotify({
            <?php
            // No icon by default, it has to be passed in the options
            echo 'pnotify_notice_icon: false,';
            echo 'pnotify_history: false,';

            // If a type was passed
            if(isset($options['type'])) {
                switch($options['type']) {
                    case 'warn':
                    case 'warning':
                        echo 'pnotify_notice_icon: "ui-icon ui-icon-alert",';
                        break;
                    case 'info':
                        echo 'pnotify_notice_icon: "ui-icon ui-icon-info",';
                        break;
                    case 'success':
                        echo 'pnotify_notice_icon: "ui-icon ui-icon-check",';
                        break;
                    case 'failure':
                    case 'fail':
                    case 'error':
                        // will use pnotify's shortcut
                        echo 'pnotify_type: "error",';
                        break;
                    case 'tip':
                        echo 'pnotify_notice_icon: "ui-icon ui-icon-lightbulb",';
                        break;
                    case 'notify':
                    case 'notice':
                        echo 'pnotify_notice_icon: "ui-icon ui-icon-notice",';
                        break;
                    case 'growl':
                        // this one is a little different, it strips away the icons and styles
                        echo 'pnotify_closer: false,';
                        echo 'pnotify_after_init: function(pnotify){
                            pnotify.click(function(){
                            pnotify.pnotify_remove();
                            });
                        },';

                        break;
                }
            }

            if(isset($options['pnotify_opacity'])) {
                echo 'pnotify_opacity: \'' . $options['pnotify_opacity'] . '\',';
            }

            if(isset($options['title'])) {
                echo 'pnotify_title: \'' . addslashes($options['title']) . '\',';
            }

            if(isset($options['fade_delay'])) {
                echo 'pnotify_delay: ' . $options['fade_delay'] . ',';
            }

            ?>
            pnotify_text: '<?php echo addslashes($message); ?>'
        });
    });
    </script>
    <?php if((isset($options['type'])) && ($options['type'] == 'growl')) { ?>
    <style type="text/css">
    .ui-pnotify-container {
        background: #000;
        color: #fff;
        border: 0;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -khtml-border-radius: 5px;
        border-radius: 5px;
    }
    .ui-pnotify-shadow {
        background: #777;
    }
    .ui-notify {
        font-size: 11px;
    }
    .ui-pnotify-title {
        font-size: 14px;
    }
    .ui-pnotify-text {
        font-size: 11px;
    }
    </style>
    <?php } ?>

<?php
}
?>
