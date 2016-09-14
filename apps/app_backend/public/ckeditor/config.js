/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */



CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    config.baseFloatZIndex = 1000;

    config.colorButton_colors = '00923E,F8C100,28166F';
    config.FloatingPanelsZIndex = 10000;
    config.colorButton_colors = 'blue';
    config.extraPlugins = 'sharedspace,imageuploader';
    config.removePlugins = 'floatingspace,maximize,resize';
    config.sharedSpaces = {
        top: 'toolbarLocation'
    };

        $.ajax({
            method: "GET",
            url: "http://baderflorian.at/home/getSession",

            success: function (data) {
                userfolderid = data;
                config.filebrowserImageUploadUrl = "//apps/app_backend/public/media/usermedia_" + userfolderid;
                config.filebrowserImageBrowseUrl = "//apps/app_backend/public/ckeditor/plugins/imageuploader/imgbrowser.php";


                var CKBUILDER_CONFIG = {
                    skin: 'icy_orange',
                    preset: 'full',
                    ignore: [
                        '.bender',
                        'bender.js',
                        'bender-err.log',
                        'bender-out.log',
                        'dev',
                        '.DS_Store',
                        '.editorconfig',
                        '.gitattributes',
                        '.gitignore',
                        'gruntfile.js',
                        '.idea',
                        '.jscsrc',
                        '.jshintignore',
                        '.jshintrc',
                        'less',
                        '.mailmap',
                        'node_modules',
                        'package.json',
                        'README.md',
                        'tests'
                    ],
                    plugins: {
                        'a11yhelp': 1,
                        'about': 1,
                        'basicstyles': 1,
                        'bidi': 1,
                        'blockquote': 1,
                        'clipboard': 1,
                        'colorbutton': 1,
                        'colordialog': 1,
                        'contextmenu': 1,
                        'dialogadvtab': 1,
                        'div': 1,
                        'elementspath': 1,
                        'enterkey': 1,
                        'entities': 1,
                        'filebrowser': 1,
                        'find': 1,
                        'flash': 1,
                        'floatingspace': 1,
                        'font': 1,
                        'format': 1,
                        'forms': 1,
                        'horizontalrule': 1,
                        'htmlwriter': 1,
                        'image': 1,
                        'imageuploader': 1,
                        'indentblock': 1,
                        'indentlist': 1,
                        'justify': 1,
                        'language': 1,
                        'link': 1,
                        'list': 1,
                        'liststyle': 1,
                        'magicline': 1,
                        'maximize': 1,
                        'newpage': 1,
                        'pagebreak': 1,
                        'pastefromword': 1,
                        'pastetext': 1,
                        'preview': 1,
                        'print': 1,
                        'removeformat': 1,
                        'resize': 1,
                        'save': 1,
                        'scayt': 1,
                        'selectall': 1,
                        'showblocks': 1,
                        'showborders': 1,
                        'smiley': 1,
                        'sourcearea': 1,
                        'specialchar': 1,
                        'stylescombo': 1,
                        'tab': 1,
                        'table': 1,
                        'tabletools': 1,
                        'templates': 1,
                        'toolbar': 1,
                        'undo': 1,
                        'wsc': 1
                    },
                    languages: {
                        'en': 1
                    }
                }
            }


        }).always(function (jqXHR, textStatus) {

        });


}

