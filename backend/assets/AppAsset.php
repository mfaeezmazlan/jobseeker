<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "_theme/assets/css/font-awesome.css",
        "_theme/assets/css/ace-fonts.css",
        "_theme/assets/css/ace.css",
    ];
    public $js = [
        "_theme/assets/js/ace-extra.js",
        "_theme/assets/js/ace/elements.scroller.js",
        "_theme/assets/js/ace/elements.fileinput.js",
        "_theme/assets/js/ace/elements.typeahead.js",
        "_theme/assets/js/ace/elements.wizard.js",
        "_theme/assets/js/ace/elements.aside.js",
        "_theme/assets/js/custom/menuhandler.js",
        "_theme/assets/js/bootstrap.js",
        "_theme/assets/js/ace/ace.js",
        "_theme/assets/js/ace/ace.ajax-content.js",
        "_theme/assets/js/ace/ace.touch-drag.js",
        "_theme/assets/js/ace/ace.sidebar.js",
        "_theme/assets/js/ace/ace.sidebar-scroll-1.js",
        "_theme/assets/js/ace/ace.submenu-hover.js",
        "_theme/assets/js/ace/ace.widget-box.js",
        "_theme/assets/js/ace/ace.settings.js",
        "_theme/assets/js/ace/ace.settings-rtl.js",
        "_theme/assets/js/ace/ace.settings-skin.js",
        "_theme/assets/js/ace/ace.widget-on-reload.js",
        "_theme/assets/js/ace/ace.searchbox-autocomplete.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
