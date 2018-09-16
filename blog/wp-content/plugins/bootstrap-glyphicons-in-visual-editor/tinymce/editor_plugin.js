// JavaScript Document
(function() {

tinymce.create('tinymce.plugins.bgiiwpve', {

init : function(ed, url) {

ed.addCommand('mcebgiiwpve', function() {
ed.windowManager.open({
// call content via admin-ajax, no need to know the full plugin path
file : ajaxurl + '?action=bgiiwpve_tinymce',
width : 500 + ed.getLang('bgiiwpve.delta_width', 0),
height : 500 + ed.getLang('bgiiwpve.delta_height', 0),
inline : 1
}, {
plugin_url : url // Plugin absolute URL
});
});

// Register example button
ed.addButton('bgiiwpve', {
title : 'Add Glyphicons',
cmd : 'mcebgiiwpve',
image : url + '/key_t.png'
});

// Add a node change handler, selects the button in the UI when a image is selected
ed.onNodeChange.add(function(ed, cm, n) {
cm.setActive('bgiiwpve', n.nodeName === 'IMG');
});
},

getInfo : function() {
return {
longname  : 'Bootstrap Glyphicons in WordPress Visual Editor',
author    : 'Jon@509Tech',
authorurl : 'http://www.509tech.com/',
infourl   : 'http://509tech.com/bootstrap-glyphicons-wordpress-plugin/',
version   : "1.0"
};
}
});

// Register plugin
tinymce.PluginManager.add('bgiiwpve', tinymce.plugins.bgiiwpve);
})();