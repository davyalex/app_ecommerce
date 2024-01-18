"use strict";
$ = jQuery.noConflict();
$("select").selectric({
  multiple: {
    separator: ', ',       // Type: String.             Description: Items separator.
    keepMenuOpen: true,    // Type: Boolean.            Description: Close after an item is selected.
    maxLabelEntries: false // Type: Boolean or Integer. Description: Max selected items do show.
  }
});
$.uploadPreview({
  input_field: "#image-upload",   // Default: .image-upload
  preview_box: "#image-preview",  // Default: .image-preview
  label_field: "#image-label",    // Default: .image-label
  label_default: "Choose File",   // Default: Choose File
  label_selected: "Change File",  // Default: Change File
  no_label: false,                // Default: false
  success_callback: null          // Default: null
});
$(".inputtags").tagsinput('items');
