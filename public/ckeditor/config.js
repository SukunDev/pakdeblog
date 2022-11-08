/**
 * @license Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
  // Define changes to default configuration here.
  // For complete reference see:
  // https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

  // The toolbar groups arrangement, optimized for two toolbar rows.
  config.width = '100%'
  config.height = '70vh'
  config.extraPlugins = ['wordcount', 'codesnippet', 'codeTag']
  config.toolbar = [
    {
      name: 'clipboard',
      items: [
        'Undo',
        'Redo',
        '-',
        'Cut',
        'Copy',
        'Paste',
        'PasteText',
        'PasteFromWord',
      ],
    },
    { name: 'editing', items: ['Scayt'] },
    { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
    {
      name: 'insert',
      items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar'],
    },
    {
      name: 'code',
      items: ['Code', 'CodeSnippet'],
    },
    { name: 'tools', items: ['Maximize'] },
    { name: 'document', items: ['Source'] },
    '/',
    {
      name: 'basicstyles',
      items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat'],
    },
    {
      name: 'paragraph',
      items: [
        'NumberedList',
        'BulletedList',
        '-',
        'Outdent',
        'Indent',
        '-',
        'Blockquote',
      ],
    },
    { name: 'styles', items: ['Styles', 'Format'] },
    { name: 'about', items: ['About'] },
  ]

  // Remove some buttons provided by the standard plugins, which are
  // not needed in the Standard(s) toolbar.
  config.removeButtons = 'Underline,Subscript,Superscript'

  // Set the most common block elements.
  config.format_tags = 'p;h1;h2;h3;pre'

  // Simplify the dialog windows.
  config.removeDialogTabs = 'image:advanced;link:advanced'
  config.extraAllowedContent = 'script[src]'
}
