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
    config.extraPlugins = 'sharedspace';
    config.removePlugins = 'floatingspace,maximize,resize';
    config.sharedSpaces = {
        top: 'toolbarLocation'
    };
};