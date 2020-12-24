<style type="text/css">
form{ margin:0; }
textarea{ display:block;}
</style>
<link rel="stylesheet" href="/static/admin/assets/libs/kindeditor/themes/default/default.css" />
<if condition="$type eq simple">
<link rel="stylesheet" href="/static/admin/assets/libs/kindeditor/themes/simple/simple.css" />
</if>
<script type="text/javascript" src="/static/admin/assets/libs/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript" src="/static/admin/assets/libs/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
(function(){
	var editor;
	var items = {
		simple :
			['source', 'preview', 'plainpaste', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', 'indent', 'outdent', 'quickformat', '|', 'link']
		,
		default :
			['source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
			'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
			'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
			'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
			'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
			'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
			'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
			'anchor', 'link', 'unlink', '|', 'about']

	};

	var options = {
		allowFileManager : true,
		width : "{{$editorWidth}}",
		height : {{$editorHeight}},
		designMode : true,
		fullscreenMode : false,
		filterMode : true,
		wellFormatMode : true,
		shadowMode : true,
		loadStyleMode : true,
		themeType : '{{$editorType}}',
		langType : 'zh_CN',
		urlType : '',
		newlineTag : 'p',
		resizeType : 2,
		syncType : 'form',
		pasteType : 2,
		dialogAlignType : 'page',
		useContextmenu : true,
		fullscreenShortcut : false,
		bodyClass : 'ke-content',
		indentChar : '\t',
		cssPath : '',
		cssData : '',
		minWidth : 650,
		minHeight : 100,
		minChangeSize : 50,
		zIndex : 811213,
		items : items['{{$editorType}}'],
		noDisableItems : ['source', 'fullscreen'],
		colorTable : [
			['#E53333', '#E56600', '#FF9900', '#64451D', '#DFC5A4', '#FFE500'],
			['#009900', '#006600', '#99BB00', '#B8D100', '#60D978', '#00D5FF'],
			['#337FE5', '#003399', '#4C33E5', '#9933E5', '#CC33E5', '#EE33EE'],
			['#FFFFFF', '#CCCCCC', '#999999', '#666666', '#333333', '#000000']
		],
		fontSizeTable : ['9px', '10px', '12px', '14px', '16px', '18px', '24px', '32px'],
		htmlTags : {
			font : ['id', 'class', 'color', 'size', 'face', '.background-color'],
			span : [
				'id', 'class', '.color', '.background-color', '.font-size', '.font-family', '.background',
				'.font-weight', '.font-style', '.text-decoration', '.vertical-align', '.line-height'
			],
			div : [
				'id', 'class', 'align', '.border', '.margin', '.padding', '.text-align', '.color',
				'.background-color', '.font-size', '.font-family', '.font-weight', '.background',
				'.font-style', '.text-decoration', '.vertical-align', '.margin-left'
			],
			table: [
				'id', 'class', 'border', 'cellspacing', 'cellpadding', 'width', 'height', 'align', 'bordercolor',
				'.padding', '.margin', '.border', 'bgcolor', '.text-align', '.color', '.background-color',
				'.font-size', '.font-family', '.font-weight', '.font-style', '.text-decoration', '.background',
				'.width', '.height', '.border-collapse'
			],
			'td,th': [
				'id', 'class', 'align', 'valign', 'width', 'height', 'colspan', 'rowspan', 'bgcolor',
				'.text-align', '.color', '.background-color', '.font-size', '.font-family', '.font-weight',
				'.font-style', '.text-decoration', '.vertical-align', '.background', '.border'
			],
			a : ['id', 'class', 'href', 'target', 'name'],
			embed : ['id', 'class', 'src', 'width', 'height', 'type', 'loop', 'autostart', 'quality', '.width', '.height', 'align', 'allowscriptaccess'],
			img : ['id', 'class', 'src', 'width', 'height', 'border', 'alt', 'title', 'align', '.width', '.height', '.border'],
			'p,ol,ul,li,blockquote,h1,h2,h3,h4,h5,h6' : [
				'id', 'class', 'align', '.text-align', '.color', '.background-color', '.font-size', '.font-family', '.background',
				'.font-weight', '.font-style', '.text-decoration', '.vertical-align', '.text-indent', '.margin-left'
			],
			pre : ['id', 'class'],
			hr : ['id', 'class', '.page-break-after'],
			'br,tbody,tr,strong,b,sub,sup,em,i,u,strike,s,del' : ['id', 'class'],
			iframe : ['id', 'class', 'src', 'frameborder', 'width', 'height', '.width', '.height']
		},
		layout : '<div class="container"><div class="toolbar"></div><div class="edit"></div><div class="statusbar"></div></div>',
		afterBlur: function () { editor.sync(); }
	};

	KindEditor.ready(function(K) {
		editor = K.create('textarea[name="{{$editorName}}"]', options);
	});
})();
</script>
