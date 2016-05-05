/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#000';
    
    config.extraAllowedContent = 'span div i table tr td th colgroup col style[*]{*}';
    config.format_p = {element: 'p', attributes: {'class': 'normalPara'}};
    config.pasteFromWordPromptCleanup = false;
    config.pasteFromWordRemoveFontStyles = false;
    config.pasteFromWordRemoveStyles=false;
    config.forcePasteAsPlainText = false;
    config.ignoreEmptyParagraph = false;
    config.removeFormatAttributes = false;
    config.tabSpaces = 4;
    config.image2_captionedClass = 'captionedImage';
};
