/////* Notify.js - http://notifyjs.com/ Copyright (c) 2015 MIT */
////(function (factory) {
////	// UMD start
////	// https://github.com/umdjs/umd/blob/master/jqueryPluginCommonjs.js
////	if (typeof define === 'function' && define.amd) {
////		// AMD. Register as an anonymous module.
////		define(['jquery'], factory);
////	} else if (typeof module === 'object' && module.exports) {
////		// Node/CommonJS
////		module.exports = function( root, jQuery ) {
////			if ( jQuery === undefined ) {
////				// require('jQuery') returns a factory that requires window to
////				// build a jQuery instance, we normalize how we use modules
////				// that require this pattern but the window provided is a noop
////				// if it's defined (how jquery works)
////				if ( typeof window !== 'undefined' ) {
////					jQuery = require('jquery');
////				}
////				else {
////					jQuery = require('jquery')(root);
////				}
////			}
////			factory(jQuery);
////			return jQuery;
////		};
////	} else {
////		// Browser globals
////		factory(jQuery);
////	}
////}(function ($) {
////	//IE8 indexOf polyfill
////	var indexOf = [].indexOf || function(item) {
////		for (var i = 0, l = this.length; i < l; i++) {
////			if (i in this && this[i] === item) {
////				return i;
////			}
////		}
////		return -1;
////	};

////	var pluginName = "notify";
////	var pluginClassName = pluginName + "js";
////	var blankFieldName = pluginName + "!blank";

////	var positions = {
////		t: "top",
////		m: "middle",
////		b: "bottom",
////		l: "left",
////		c: "center",
////		r: "right"
////	};
////	var hAligns = ["l", "c", "r"];
////	var vAligns = ["t", "m", "b"];
////	var mainPositions = ["t", "b", "l", "r"];
////	var opposites = {
////		t: "b",
////		m: null,
////		b: "t",
////		l: "r",
////		c: null,
////		r: "l"
////	};

////	var parsePosition = function(str) {
////		var pos;
////		pos = [];
////		$.each(str.split(/\W+/), function(i, word) {
////			var w;
////			w = word.toLowerCase().charAt(0);
////			if (positions[w]) {
////				return pos.push(w);
////			}
////		});
////		return pos;
////	};

////	var styles = {};

////	var coreStyle = {
////		name: "core",
////		html: "<div class=\"" + pluginClassName + "-wrapper\">\n	<div class=\"" + pluginClassName + "-arrow\"></div>\n	<div class=\"" + pluginClassName + "-container\"></div>\n</div>",
////		css: "." + pluginClassName + "-corner {\n	position: fixed;\n	margin: 5px;\n	z-index: 1050;\n}\n\n." + pluginClassName + "-corner ." + pluginClassName + "-wrapper,\n." + pluginClassName + "-corner ." + pluginClassName + "-container {\n	position: relative;\n	display: block;\n	height: inherit;\n	width: inherit;\n	margin: 3px;\n}\n\n." + pluginClassName + "-wrapper {\n	z-index: 1;\n	position: absolute;\n	display: inline-block;\n	height: 0;\n	width: 0;\n}\n\n." + pluginClassName + "-container {\n	display: none;\n	z-index: 1;\n	position: absolute;\n}\n\n." + pluginClassName + "-hidable {\n	cursor: pointer;\n}\n\n[data-notify-text],[data-notify-html] {\n	position: relative;\n}\n\n." + pluginClassName + "-arrow {\n	position: absolute;\n	z-index: 2;\n	width: 0;\n	height: 0;\n}"
////	};

////	var stylePrefixes = {
////		"border-radius": ["-webkit-", "-moz-"]
////	};

////	var getStyle = function(name) {
////		return styles[name];
////	};

////	var removeStyle = function(name) {
////		if (!name) {
////			throw "Missing Style name";
////		}
////		if (styles[name]) {
////			delete styles[name];
////		}
////	};

////	var addStyle = function(name, def) {
////		if (!name) {
////			throw "Missing Style name";
////		}
////		if (!def) {
////			throw "Missing Style definition";
////		}
////		if (!def.html) {
////			throw "Missing Style HTML";
////		}
////		//remove existing style
////		var existing = styles[name];
////		if (existing && existing.cssElem) {
////			if (window.console) {
////				console.warn(pluginName + ": overwriting style '" + name + "'");
////			}
////			styles[name].cssElem.remove();
////		}
////		def.name = name;
////		styles[name] = def;
////		var cssText = "";
////		if (def.classes) {
////			$.each(def.classes, function(className, props) {
////				cssText += "." + pluginClassName + "-" + def.name + "-" + className + " {\n";
////				$.each(props, function(name, val) {
////					if (stylePrefixes[name]) {
////						$.each(stylePrefixes[name], function(i, prefix) {
////							return cssText += "	" + prefix + name + ": " + val + ";\n";
////						});
////					}
////					return cssText += "	" + name + ": " + val + ";\n";
////				});
////				return cssText += "}\n";
////			});
////		}
////		if (def.css) {
////			cssText += "/* styles for " + def.name + " */\n" + def.css;
////		}
////		if (cssText) {
////			def.cssElem = insertCSS(cssText);
////			def.cssElem.attr("id", "notify-" + def.name);
////		}
////		var fields = {};
////		var elem = $(def.html);
////		findFields("html", elem, fields);
////		findFields("text", elem, fields);
////		def.fields = fields;
////	};

////	var insertCSS = function(cssText) {
////		var e, elem, error;
////		elem = createElem("style");
////		elem.attr("type", 'text/css');
////		$("head").append(elem);
////		try {
////			elem.html(cssText);
////		} catch (_) {
////			elem[0].styleSheet.cssText = cssText;
////		}
////		return elem;
////	};

////	var findFields = function(type, elem, fields) {
////		var attr;
////		if (type !== "html") {
////			type = "text";
////		}
////		attr = "data-notify-" + type;
////		return find(elem, "[" + attr + "]").each(function() {
////			var name;
////			name = $(this).attr(attr);
////			if (!name) {
////				name = blankFieldName;
////			}
////			fields[name] = type;
////		});
////	};

////	var find = function(elem, selector) {
////		if (elem.is(selector)) {
////			return elem;
////		} else {
////			return elem.find(selector);
////		}
////	};

////	var pluginOptions = {
////		clickToHide: true,
////		autoHide: true,
////		autoHideDelay: 5000,
////		arrowShow: true,
////		arrowSize: 5,
////		breakNewLines: true,
////		elementPosition: "bottom",
////		globalPosition: "top right",
////		style: "bootstrap",
////		className: "error",
////		showAnimation: "slideDown",
////		showDuration: 400,
////		hideAnimation: "slideUp",
////		hideDuration: 200,
////		gap: 5
////	};

////	var inherit = function(a, b) {
////		var F;
////		F = function() {};
////		F.prototype = a;
////		return $.extend(true, new F(), b);
////	};

////	var defaults = function(opts) {
////		return $.extend(pluginOptions, opts);
////	};

////	var createElem = function(tag) {
////		return $("<" + tag + "></" + tag + ">");
////	};

////	var globalAnchors = {};

////	var getAnchorElement = function(element) {
////		var radios;
////		if (element.is('[type=radio]')) {
////			radios = element.parents('form:first').find('[type=radio]').filter(function(i, e) {
////				return $(e).attr("name") === element.attr("name");
////			});
////			element = radios.first();
////		}
////		return element;
////	};

////	var incr = function(obj, pos, val) {
////		var opp, temp;
////		if (typeof val === "string") {
////			val = parseInt(val, 10);
////		} else if (typeof val !== "number") {
////			return;
////		}
////		if (isNaN(val)) {
////			return;
////		}
////		opp = positions[opposites[pos.charAt(0)]];
////		temp = pos;
////		if (obj[opp] !== undefined) {
////			pos = positions[opp.charAt(0)];
////			val = -val;
////		}
////		if (obj[pos] === undefined) {
////			obj[pos] = val;
////		} else {
////			obj[pos] += val;
////		}
////		return null;
////	};

////	var realign = function(alignment, inner, outer) {
////		if (alignment === "l" || alignment === "t") {
////			return 0;
////		} else if (alignment === "c" || alignment === "m") {
////			return outer / 2 - inner / 2;
////		} else if (alignment === "r" || alignment === "b") {
////			return outer - inner;
////		}
////		throw "Invalid alignment";
////	};

////	var encode = function(text) {
////		encode.e = encode.e || createElem("div");
////		return encode.e.text(text).html();
////	};

////	function Notification(elem, data, options) {
////		if (typeof options === "string") {
////			options = {
////				className: options
////			};
////		}
////		this.options = inherit(pluginOptions, $.isPlainObject(options) ? options : {});
////		this.loadHTML();
////		this.wrapper = $(coreStyle.html);
////		if (this.options.clickToHide) {
////			this.wrapper.addClass(pluginClassName + "-hidable");
////		}
////		this.wrapper.data(pluginClassName, this);
////		this.arrow = this.wrapper.find("." + pluginClassName + "-arrow");
////		this.container = this.wrapper.find("." + pluginClassName + "-container");
////		this.container.append(this.userContainer);
////		if (elem && elem.length) {
////			this.elementType = elem.attr("type");
////			this.originalElement = elem;
////			this.elem = getAnchorElement(elem);
////			this.elem.data(pluginClassName, this);
////			this.elem.before(this.wrapper);
////		}
////		this.container.hide();
////		this.run(data);
////	}

////	Notification.prototype.loadHTML = function() {
////		var style;
////		style = this.getStyle();
////		this.userContainer = $(style.html);
////		this.userFields = style.fields;
////	};

////	Notification.prototype.show = function(show, userCallback) {
////		var args, callback, elems, fn, hidden;
////		callback = (function(_this) {
////			return function() {
////				if (!show && !_this.elem) {
////					_this.destroy();
////				}
////				if (userCallback) {
////					return userCallback();
////				}
////			};
////		})(this);
////		hidden = this.container.parent().parents(':hidden').length > 0;
////		elems = this.container.add(this.arrow);
////		args = [];
////		if (hidden && show) {
////			fn = "show";
////		} else if (hidden && !show) {
////			fn = "hide";
////		} else if (!hidden && show) {
////			fn = this.options.showAnimation;
////			args.push(this.options.showDuration);
////		} else if (!hidden && !show) {
////			fn = this.options.hideAnimation;
////			args.push(this.options.hideDuration);
////		} else {
////			return callback();
////		}
////		args.push(callback);
////		return elems[fn].apply(elems, args);
////	};

////	Notification.prototype.setGlobalPosition = function() {
////		var p = this.getPosition();
////		var pMain = p[0];
////		var pAlign = p[1];
////		var main = positions[pMain];
////		var align = positions[pAlign];
////		var key = pMain + "|" + pAlign;
////		var anchor = globalAnchors[key];
////		if (!anchor || !document.body.contains(anchor[0])) {
////			anchor = globalAnchors[key] = createElem("div");
////			var css = {};
////			css[main] = 0;
////			if (align === "middle") {
////				css.top = '45%';
////			} else if (align === "center") {
////				css.left = '45%';
////			} else {
////				css[align] = 0;
////			}
////			anchor.css(css).addClass(pluginClassName + "-corner");
////			$("body").append(anchor);
////		}
////		return anchor.prepend(this.wrapper);
////	};

////	Notification.prototype.setElementPosition = function() {
////		var arrowColor, arrowCss, arrowSize, color, contH, contW, css, elemH, elemIH, elemIW, elemPos, elemW, gap, j, k, len, len1, mainFull, margin, opp, oppFull, pAlign, pArrow, pMain, pos, posFull, position, ref, wrapPos;
////		position = this.getPosition();
////		pMain = position[0];
////		pAlign = position[1];
////		pArrow = position[2];
////		elemPos = this.elem.position();
////		elemH = this.elem.outerHeight();
////		elemW = this.elem.outerWidth();
////		elemIH = this.elem.innerHeight();
////		elemIW = this.elem.innerWidth();
////		wrapPos = this.wrapper.position();
////		contH = this.container.height();
////		contW = this.container.width();
////		mainFull = positions[pMain];
////		opp = opposites[pMain];
////		oppFull = positions[opp];
////		css = {};
////		css[oppFull] = pMain === "b" ? elemH : pMain === "r" ? elemW : 0;
////		incr(css, "top", elemPos.top - wrapPos.top);
////		incr(css, "left", elemPos.left - wrapPos.left);
////		ref = ["top", "left"];
////		for (j = 0, len = ref.length; j < len; j++) {
////			pos = ref[j];
////			margin = parseInt(this.elem.css("margin-" + pos), 10);
////			if (margin) {
////				incr(css, pos, margin);
////			}
////		}
////		gap = Math.max(0, this.options.gap - (this.options.arrowShow ? arrowSize : 0));
////		incr(css, oppFull, gap);
////		if (!this.options.arrowShow) {
////			this.arrow.hide();
////		} else {
////			arrowSize = this.options.arrowSize;
////			arrowCss = $.extend({}, css);
////			arrowColor = this.userContainer.css("border-color") || this.userContainer.css("border-top-color") || this.userContainer.css("background-color") || "white";
////			for (k = 0, len1 = mainPositions.length; k < len1; k++) {
////				pos = mainPositions[k];
////				posFull = positions[pos];
////				if (pos === opp) {
////					continue;
////				}
////				color = posFull === mainFull ? arrowColor : "transparent";
////				arrowCss["border-" + posFull] = arrowSize + "px solid " + color;
////			}
////			incr(css, positions[opp], arrowSize);
////			if (indexOf.call(mainPositions, pAlign) >= 0) {
////				incr(arrowCss, positions[pAlign], arrowSize * 2);
////			}
////		}
////		if (indexOf.call(vAligns, pMain) >= 0) {
////			incr(css, "left", realign(pAlign, contW, elemW));
////			if (arrowCss) {
////				incr(arrowCss, "left", realign(pAlign, arrowSize, elemIW));
////			}
////		} else if (indexOf.call(hAligns, pMain) >= 0) {
////			incr(css, "top", realign(pAlign, contH, elemH));
////			if (arrowCss) {
////				incr(arrowCss, "top", realign(pAlign, arrowSize, elemIH));
////			}
////		}
////		if (this.container.is(":visible")) {
////			css.display = "block";
////		}
////		this.container.removeAttr("style").css(css);
////		if (arrowCss) {
////			return this.arrow.removeAttr("style").css(arrowCss);
////		}
////	};

////	Notification.prototype.getPosition = function() {
////		var pos, ref, ref1, ref2, ref3, ref4, ref5, text;
////		text = this.options.position || (this.elem ? this.options.elementPosition : this.options.globalPosition);
////		pos = parsePosition(text);
////		if (pos.length === 0) {
////			pos[0] = "b";
////		}
////		if (ref = pos[0], indexOf.call(mainPositions, ref) < 0) {
////			throw "Must be one of [" + mainPositions + "]";
////		}
////		if (pos.length === 1 || ((ref1 = pos[0], indexOf.call(vAligns, ref1) >= 0) && (ref2 = pos[1], indexOf.call(hAligns, ref2) < 0)) || ((ref3 = pos[0], indexOf.call(hAligns, ref3) >= 0) && (ref4 = pos[1], indexOf.call(vAligns, ref4) < 0))) {
////			pos[1] = (ref5 = pos[0], indexOf.call(hAligns, ref5) >= 0) ? "m" : "l";
////		}
////		if (pos.length === 2) {
////			pos[2] = pos[1];
////		}
////		return pos;
////	};

////	Notification.prototype.getStyle = function(name) {
////		var style;
////		if (!name) {
////			name = this.options.style;
////		}
////		if (!name) {
////			name = "default";
////		}
////		style = styles[name];
////		if (!style) {
////			throw "Missing style: " + name;
////		}
////		return style;
////	};

////	Notification.prototype.updateClasses = function() {
////		var classes, style;
////		classes = ["base"];
////		if ($.isArray(this.options.className)) {
////			classes = classes.concat(this.options.className);
////		} else if (this.options.className) {
////			classes.push(this.options.className);
////		}
////		style = this.getStyle();
////		classes = $.map(classes, function(n) {
////			return pluginClassName + "-" + style.name + "-" + n;
////		}).join(" ");
////		return this.userContainer.attr("class", classes);
////	};

////	Notification.prototype.run = function(data, options) {
////		var d, datas, name, type, value;
////		if ($.isPlainObject(options)) {
////			$.extend(this.options, options);
////		} else if ($.type(options) === "string") {
////			this.options.className = options;
////		}
////		if (this.container && !data) {
////			this.show(false);
////			return;
////		} else if (!this.container && !data) {
////			return;
////		}
////		datas = {};
////		if ($.isPlainObject(data)) {
////			datas = data;
////		} else {
////			datas[blankFieldName] = data;
////		}
////		for (name in datas) {
////			d = datas[name];
////			type = this.userFields[name];
////			if (!type) {
////				continue;
////			}
////			if (type === "text") {
////				d = encode(d);
////				if (this.options.breakNewLines) {
////					d = d.replace(/\n/g, '<br/>');
////				}
////			}
////			value = name === blankFieldName ? '' : '=' + name;
////			find(this.userContainer, "[data-notify-" + type + value + "]").html(d);
////		}
////		this.updateClasses();
////		if (this.elem) {
////			this.setElementPosition();
////		} else {
////			this.setGlobalPosition();
////		}
////		this.show(true);
////		if (this.options.autoHide) {
////			clearTimeout(this.autohideTimer);
////			this.autohideTimer = setTimeout(this.show.bind(this, false), this.options.autoHideDelay);
////		}
////	};

////	Notification.prototype.destroy = function() {
////		this.wrapper.data(pluginClassName, null);
////		this.wrapper.remove();
////	};

////	$[pluginName] = function(elem, data, options) {
////		if ((elem && elem.nodeName) || elem.jquery) {
////			$(elem)[pluginName](data, options);
////		} else {
////			options = data;
////			data = elem;
////			new Notification(null, data, options);
////		}
////		return elem;
////	};

////	$.fn[pluginName] = function(data, options) {
////		$(this).each(function() {
////			var prev = getAnchorElement($(this)).data(pluginClassName);
////			if (prev) {
////				prev.destroy();
////			}
////			var curr = new Notification($(this), data, options);
////		});
////		return this;
////	};

////	$.extend($[pluginName], {
////		defaults: defaults,
////		addStyle: addStyle,
////		removeStyle: removeStyle,
////		pluginOptions: pluginOptions,
////		getStyle: getStyle,
////		insertCSS: insertCSS
////	});

////	//always include the default bootstrap style
////	addStyle("bootstrap", {
////		html: "<div>\n<span data-notify-text></span>\n</div>",
////		classes: {
////			base: {
////				"font-weight": "bold",
////				"padding": "8px 15px 8px 14px",
////				"text-shadow": "0 1px 0 rgba(255, 255, 255, 0.5)",
////				"background-color": "#fcf8e3",
////				"border": "1px solid #fbeed5",
////				"border-radius": "4px",
////				"white-space": "nowrap",
////				"padding-left": "25px",
////				"background-repeat": "no-repeat",
////				"background-position": "3px 7px"
////			},
////			error: {
////				"color": "#B94A48",
////				"background-color": "#F2DEDE",
////				"border-color": "#EED3D7",
////				"background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAtRJREFUeNqkVc1u00AQHq+dOD+0poIQfkIjalW0SEGqRMuRnHos3DjwAH0ArlyQeANOOSMeAA5VjyBxKBQhgSpVUKKQNGloFdw4cWw2jtfMOna6JOUArDTazXi/b3dm55socPqQhFka++aHBsI8GsopRJERNFlY88FCEk9Yiwf8RhgRyaHFQpPHCDmZG5oX2ui2yilkcTT1AcDsbYC1NMAyOi7zTX2Agx7A9luAl88BauiiQ/cJaZQfIpAlngDcvZZMrl8vFPK5+XktrWlx3/ehZ5r9+t6e+WVnp1pxnNIjgBe4/6dAysQc8dsmHwPcW9C0h3fW1hans1ltwJhy0GxK7XZbUlMp5Ww2eyan6+ft/f2FAqXGK4CvQk5HueFz7D6GOZtIrK+srupdx1GRBBqNBtzc2AiMr7nPplRdKhb1q6q6zjFhrklEFOUutoQ50xcX86ZlqaZpQrfbBdu2R6/G19zX6XSgh6RX5ubyHCM8nqSID6ICrGiZjGYYxojEsiw4PDwMSL5VKsC8Yf4VRYFzMzMaxwjlJSlCyAQ9l0CW44PBADzXhe7xMdi9HtTrdYjFYkDQL0cn4Xdq2/EAE+InCnvADTf2eah4Sx9vExQjkqXT6aAERICMewd/UAp/IeYANM2joxt+q5VI+ieq2i0Wg3l6DNzHwTERPgo1ko7XBXj3vdlsT2F+UuhIhYkp7u7CarkcrFOCtR3H5JiwbAIeImjT/YQKKBtGjRFCU5IUgFRe7fF4cCNVIPMYo3VKqxwjyNAXNepuopyqnld602qVsfRpEkkz+GFL1wPj6ySXBpJtWVa5xlhpcyhBNwpZHmtX8AGgfIExo0ZpzkWVTBGiXCSEaHh62/PoR0p/vHaczxXGnj4bSo+G78lELU80h1uogBwWLf5YlsPmgDEd4M236xjm+8nm4IuE/9u+/PH2JXZfbwz4zw1WbO+SQPpXfwG/BBgAhCNZiSb/pOQAAAAASUVORK5CYII=)"
////			},
////			success: {
////				"color": "#468847",
////				"background-color": "#DFF0D8",
////				"border-color": "#D6E9C6",
////				"background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAutJREFUeNq0lctPE0Ecx38zu/RFS1EryqtgJFA08YCiMZIAQQ4eRG8eDGdPJiYeTIwHTfwPiAcvXIwXLwoXPaDxkWgQ6islKlJLSQWLUraPLTv7Gme32zoF9KSTfLO7v53vZ3d/M7/fIth+IO6INt2jjoA7bjHCJoAlzCRw59YwHYjBnfMPqAKWQYKjGkfCJqAF0xwZjipQtA3MxeSG87VhOOYegVrUCy7UZM9S6TLIdAamySTclZdYhFhRHloGYg7mgZv1Zzztvgud7V1tbQ2twYA34LJmF4p5dXF1KTufnE+SxeJtuCZNsLDCQU0+RyKTF27Unw101l8e6hns3u0PBalORVVVkcaEKBJDgV3+cGM4tKKmI+ohlIGnygKX00rSBfszz/n2uXv81wd6+rt1orsZCHRdr1Imk2F2Kob3hutSxW8thsd8AXNaln9D7CTfA6O+0UgkMuwVvEFFUbbAcrkcTA8+AtOk8E6KiQiDmMFSDqZItAzEVQviRkdDdaFgPp8HSZKAEAL5Qh7Sq2lIJBJwv2scUqkUnKoZgNhcDKhKg5aH+1IkcouCAdFGAQsuWZYhOjwFHQ96oagWgRoUov1T9kRBEODAwxM2QtEUl+Wp+Ln9VRo6BcMw4ErHRYjH4/B26AlQoQQTRdHWwcd9AH57+UAXddvDD37DmrBBV34WfqiXPl61g+vr6xA9zsGeM9gOdsNXkgpEtTwVvwOklXLKm6+/p5ezwk4B+j6droBs2CsGa/gNs6RIxazl4Tc25mpTgw/apPR1LYlNRFAzgsOxkyXYLIM1V8NMwyAkJSctD1eGVKiq5wWjSPdjmeTkiKvVW4f2YPHWl3GAVq6ymcyCTgovM3FzyRiDe2TaKcEKsLpJvNHjZgPNqEtyi6mZIm4SRFyLMUsONSSdkPeFtY1n0mczoY3BHTLhwPRy9/lzcziCw9ACI+yql0VLzcGAZbYSM5CCSZg1/9oc/nn7+i8N9p/8An4JMADxhH+xHfuiKwAAAABJRU5ErkJggg==)"
////			},
////			info: {
////				"color": "#3A87AD",
////				"background-color": "#D9EDF7",
////				"border-color": "#BCE8F1",
////				"background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QYFAhkSsdes/QAAA8dJREFUOMvVlGtMW2UYx//POaWHXg6lLaW0ypAtw1UCgbniNOLcVOLmAjHZolOYlxmTGXVZdAnRfXQm+7SoU4mXaOaiZsEpC9FkiQs6Z6bdCnNYruM6KNBw6YWewzl9z+sHImEWv+vz7XmT95f/+3/+7wP814v+efDOV3/SoX3lHAA+6ODeUFfMfjOWMADgdk+eEKz0pF7aQdMAcOKLLjrcVMVX3xdWN29/GhYP7SvnP0cWfS8caSkfHZsPE9Fgnt02JNutQ0QYHB2dDz9/pKX8QjjuO9xUxd/66HdxTeCHZ3rojQObGQBcuNjfplkD3b19Y/6MrimSaKgSMmpGU5WevmE/swa6Oy73tQHA0Rdr2Mmv/6A1n9w9suQ7097Z9lM4FlTgTDrzZTu4StXVfpiI48rVcUDM5cmEksrFnHxfpTtU/3BFQzCQF/2bYVoNbH7zmItbSoMj40JSzmMyX5qDvriA7QdrIIpA+3cdsMpu0nXI8cV0MtKXCPZev+gCEM1S2NHPvWfP/hL+7FSr3+0p5RBEyhEN5JCKYr8XnASMT0xBNyzQGQeI8fjsGD39RMPk7se2bd5ZtTyoFYXftF6y37gx7NeUtJJOTFlAHDZLDuILU3j3+H5oOrD3yWbIztugaAzgnBKJuBLpGfQrS8wO4FZgV+c1IxaLgWVU0tMLEETCos4xMzEIv9cJXQcyagIwigDGwJgOAtHAwAhisQUjy0ORGERiELgG4iakkzo4MYAxcM5hAMi1WWG1yYCJIcMUaBkVRLdGeSU2995TLWzcUAzONJ7J6FBVBYIggMzmFbvdBV44Corg8vjhzC+EJEl8U1kJtgYrhCzgc/vvTwXKSib1paRFVRVORDAJAsw5FuTaJEhWM2SHB3mOAlhkNxwuLzeJsGwqWzf5TFNdKgtY5qHp6ZFf67Y/sAVadCaVY5YACDDb3Oi4NIjLnWMw2QthCBIsVhsUTU9tvXsjeq9+X1d75/KEs4LNOfcdf/+HthMnvwxOD0wmHaXr7ZItn2wuH2SnBzbZAbPJwpPx+VQuzcm7dgRCB57a1uBzUDRL4bfnI0RE0eaXd9W89mpjqHZnUI5Hh2l2dkZZUhOqpi2qSmpOmZ64Tuu9qlz/SEXo6MEHa3wOip46F1n7633eekV8ds8Wxjn37Wl63VVa+ej5oeEZ/82ZBETJjpJ1Rbij2D3Z/1trXUvLsblCK0XfOx0SX2kMsn9dX+d+7Kf6h8o4AIykuffjT8L20LU+w4AZd5VvEPY+XpWqLV327HR7DzXuDnD8r+ovkBehJ8i+y8YAAAAASUVORK5CYII=)"
////			},
////			warn: {
////				"color": "#C09853",
////				"background-color": "#FCF8E3",
////				"border-color": "#FBEED5",
////				"background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAABJlBMVEXr6eb/2oD/wi7/xjr/0mP/ykf/tQD/vBj/3o7/uQ//vyL/twebhgD/4pzX1K3z8e349vK6tHCilCWbiQymn0jGworr6dXQza3HxcKkn1vWvV/5uRfk4dXZ1bD18+/52YebiAmyr5S9mhCzrWq5t6ufjRH54aLs0oS+qD751XqPhAybhwXsujG3sm+Zk0PTwG6Shg+PhhObhwOPgQL4zV2nlyrf27uLfgCPhRHu7OmLgAafkyiWkD3l49ibiAfTs0C+lgCniwD4sgDJxqOilzDWowWFfAH08uebig6qpFHBvH/aw26FfQTQzsvy8OyEfz20r3jAvaKbhgG9q0nc2LbZxXanoUu/u5WSggCtp1anpJKdmFz/zlX/1nGJiYmuq5Dx7+sAAADoPUZSAAAAAXRSTlMAQObYZgAAAAFiS0dEAIgFHUgAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfdBgUBGhh4aah5AAAAlklEQVQY02NgoBIIE8EUcwn1FkIXM1Tj5dDUQhPU502Mi7XXQxGz5uVIjGOJUUUW81HnYEyMi2HVcUOICQZzMMYmxrEyMylJwgUt5BljWRLjmJm4pI1hYp5SQLGYxDgmLnZOVxuooClIDKgXKMbN5ggV1ACLJcaBxNgcoiGCBiZwdWxOETBDrTyEFey0jYJ4eHjMGWgEAIpRFRCUt08qAAAAAElFTkSuQmCC)"
////			}
////		}
////	});

////	$(function() {
////		insertCSS(coreStyle.css).attr("id", "core-notify");
////		$(document).on("click", "." + pluginClassName + "-hidable", function(e) {
////			$(this).trigger("notify-hide");
////		});
////		$(document).on("notify-hide", "." + pluginClassName + "-wrapper", function(e) {
////			var elem = $(this).data(pluginClassName);
////			if(elem) {
////				elem.show(false);
////			}
////		});
////	});

////}));

!function (t) { "function" == typeof define && define.amd ? define(["jquery"], t) : "object" == typeof module && module.exports ? module.exports = function (i, e) { return void 0 === e && (e = "undefined" != typeof window ? require("jquery") : require("jquery")(i)), t(e), e } : t(jQuery) }(function (t) { var i = [].indexOf || function (t) { for (var i = 0, e = this.length; i < e; i++)if (i in this && this[i] === t) return i; return -1 }, e = "notifyjs", n = { t: "top", m: "middle", b: "bottom", l: "left", c: "center", r: "right" }, o = ["l", "c", "r"], r = ["t", "m", "b"], s = ["t", "b", "l", "r"], a = { t: "b", m: null, b: "t", l: "r", c: null, r: "l" }, l = {}, h = { name: "core", html: '<div class="' + e + '-wrapper">\n\t<div class="' + e + '-arrow"></div>\n\t<div class="' + e + '-container"></div>\n</div>', css: "." + e + "-corner {\n\tposition: fixed;\n\tmargin: 5px;\n\tz-index: 1050;\n}\n\n." + e + "-corner ." + e + "-wrapper,\n." + e + "-corner ." + e + "-container {\n\tposition: relative;\n\tdisplay: block;\n\theight: inherit;\n\twidth: inherit;\n\tmargin: 3px;\n}\n\n." + e + "-wrapper {\n\tz-index: 1;\n\tposition: absolute;\n\tdisplay: inline-block;\n\theight: 0;\n\twidth: 0;\n}\n\n." + e + "-container {\n\tdisplay: none;\n\tz-index: 1;\n\tposition: absolute;\n}\n\n." + e + "-hidable {\n\tcursor: pointer;\n}\n\n[data-notify-text],[data-notify-html] {\n\tposition: relative;\n}\n\n." + e + "-arrow {\n\tposition: absolute;\n\tz-index: 2;\n\twidth: 0;\n\theight: 0;\n}" }, A = { "border-radius": ["-webkit-", "-moz-"] }, c = function (i, n) { if (!i) throw "Missing Style name"; if (!n) throw "Missing Style definition"; if (!n.html) throw "Missing Style HTML"; var o = l[i]; o && o.cssElem && (window.console && console.warn("notify: overwriting style '" + i + "'"), l[i].cssElem.remove()), n.name = i, l[i] = n; var r = ""; n.classes && t.each(n.classes, function (i, o) { return r += "." + e + "-" + n.name + "-" + i + " {\n", t.each(o, function (i, e) { return A[i] && t.each(A[i], function (t, n) { return r += "\t" + n + i + ": " + e + ";\n" }), r += "\t" + i + ": " + e + ";\n" }), r += "}\n" }), n.css && (r += "/* styles for " + n.name + " */\n" + n.css), r && (n.cssElem = d(r), n.cssElem.attr("id", "notify-" + n.name)); var s = {}, a = t(n.html); p("html", a, s), p("text", a, s), n.fields = s }, d = function (i) { var e; (e = m("style")).attr("type", "text/css"), t("head").append(e); try { e.html(i) } catch (t) { e[0].styleSheet.cssText = i } return e }, p = function (i, e, n) { var o; return "html" !== i && (i = "text"), u(e, "[" + (o = "data-notify-" + i) + "]").each(function () { var e; (e = t(this).attr(o)) || (e = "notify!blank"), n[e] = i }) }, u = function (t, i) { return t.is(i) ? t : t.find(i) }, f = { clickToHide: !0, autoHide: !0, autoHideDelay: 5e3, arrowShow: !0, arrowSize: 5, breakNewLines: !0, elementPosition: "bottom", globalPosition: "top right", style: "bootstrap", className: "error", showAnimation: "slideDown", showDuration: 400, hideAnimation: "slideUp", hideDuration: 200, gap: 5 }, g = function (i, e) { var n; return (n = function () { }).prototype = i, t.extend(!0, new n, e) }, m = function (i) { return t("<" + i + "></" + i + ">") }, w = {}, y = function (i) { var e; return i.is("[type=radio]") && (e = i.parents("form:first").find("[type=radio]").filter(function (e, n) { return t(n).attr("name") === i.attr("name") }), i = e.first()), i }, b = function (t, i, e) { var o; if ("string" == typeof e) e = parseInt(e, 10); else if ("number" != typeof e) return; if (!isNaN(e)) return o = n[a[i.charAt(0)]], i, void 0 !== t[o] && (i = n[o.charAt(0)], e = -e), void 0 === t[i] ? t[i] = e : t[i] += e, null }, v = function (t, i, e) { if ("l" === t || "t" === t) return 0; if ("c" === t || "m" === t) return e / 2 - i / 2; if ("r" === t || "b" === t) return e - i; throw "Invalid alignment" }, C = function (t) { return C.e = C.e || m("div"), C.e.text(t).html() }; function E(i, n, o) { "string" == typeof o && (o = { className: o }), this.options = g(f, t.isPlainObject(o) ? o : {}), this.loadHTML(), this.wrapper = t(h.html), this.options.clickToHide && this.wrapper.addClass(e + "-hidable"), this.wrapper.data(e, this), this.arrow = this.wrapper.find("." + e + "-arrow"), this.container = this.wrapper.find("." + e + "-container"), this.container.append(this.userContainer), i && i.length && (this.elementType = i.attr("type"), this.originalElement = i, this.elem = y(i), this.elem.data(e, this), this.elem.before(this.wrapper)), this.container.hide(), this.run(n) } E.prototype.loadHTML = function () { var i; i = this.getStyle(), this.userContainer = t(i.html), this.userFields = i.fields }, E.prototype.show = function (t, i) { var e, n, o, r, s, a; if (a = this, n = function () { if (t || a.elem || a.destroy(), i) return i() }, s = this.container.parent().parents(":hidden").length > 0, o = this.container.add(this.arrow), e = [], s && t) r = "show"; else if (s && !t) r = "hide"; else if (!s && t) r = this.options.showAnimation, e.push(this.options.showDuration); else { if (s || t) return n(); r = this.options.hideAnimation, e.push(this.options.hideDuration) } return e.push(n), o[r].apply(o, e) }, E.prototype.setGlobalPosition = function () { var i = this.getPosition(), o = i[0], r = i[1], s = n[o], a = n[r], l = o + "|" + r, h = w[l]; if (!h || !document.body.contains(h[0])) { h = w[l] = m("div"); var A = {}; A[s] = 0, "middle" === a ? A.top = "45%" : "center" === a ? A.left = "45%" : A[a] = 0, h.css(A).addClass(e + "-corner"), t("body").append(h) } return h.prepend(this.wrapper) }, E.prototype.setElementPosition = function () { var e, l, h, A, c, d, p, u, f, g, m, w, y, C, E, x, S, F, M, D, k, B, H, Q, R, U, X, z; for (H = (U = this.getPosition())[0], B = U[1], U[2], m = this.elem.position(), u = this.elem.outerHeight(), w = this.elem.outerWidth(), f = this.elem.innerHeight(), g = this.elem.innerWidth(), z = this.wrapper.position(), c = this.container.height(), d = this.container.width(), F = n[H], (p = {})[k = n[D = a[H]]] = "b" === H ? u : "r" === H ? w : 0, b(p, "top", m.top - z.top), b(p, "left", m.left - z.left), C = 0, x = (X = ["top", "left"]).length; C < x; C++)Q = X[C], (M = parseInt(this.elem.css("margin-" + Q), 10)) && b(p, Q, M); if (y = Math.max(0, this.options.gap - (this.options.arrowShow ? h : 0)), b(p, k, y), this.options.arrowShow) { for (h = this.options.arrowSize, l = t.extend({}, p), e = this.userContainer.css("border-color") || this.userContainer.css("border-top-color") || this.userContainer.css("background-color") || "white", E = 0, S = s.length; E < S; E++)R = n[Q = s[E]], Q !== D && (A = R === F ? e : "transparent", l["border-" + R] = h + "px solid " + A); b(p, n[D], h), i.call(s, B) >= 0 && b(l, n[B], 2 * h) } else this.arrow.hide(); if (i.call(r, H) >= 0 ? (b(p, "left", v(B, d, w)), l && b(l, "left", v(B, h, g))) : i.call(o, H) >= 0 && (b(p, "top", v(B, c, u)), l && b(l, "top", v(B, h, f))), this.container.is(":visible") && (p.display = "block"), this.container.removeAttr("style").css(p), l) return this.arrow.removeAttr("style").css(l) }, E.prototype.getPosition = function () { var e, a, l, h, A, c, d; if (0 === (e = function (i) { var e; return e = [], t.each(i.split(/\W+/), function (t, i) { var o; if (o = i.toLowerCase().charAt(0), n[o]) return e.push(o) }), e }(this.options.position || (this.elem ? this.options.elementPosition : this.options.globalPosition))).length && (e[0] = "b"), a = e[0], i.call(s, a) < 0) throw "Must be one of [" + s + "]"; return (1 === e.length || (l = e[0], i.call(r, l) >= 0 && (h = e[1], i.call(o, h) < 0)) || (A = e[0], i.call(o, A) >= 0 && (c = e[1], i.call(r, c) < 0))) && (e[1] = (d = e[0], i.call(o, d) >= 0 ? "m" : "l")), 2 === e.length && (e[2] = e[1]), e }, E.prototype.getStyle = function (t) { var i; if (t || (t = this.options.style), t || (t = "default"), !(i = l[t])) throw "Missing style: " + t; return i }, E.prototype.updateClasses = function () { var i, n; return i = ["base"], t.isArray(this.options.className) ? i = i.concat(this.options.className) : this.options.className && i.push(this.options.className), n = this.getStyle(), i = t.map(i, function (t) { return e + "-" + n.name + "-" + t }).join(" "), this.userContainer.attr("class", i) }, E.prototype.run = function (i, e) { var n, o, r, s, a; if (t.isPlainObject(e) ? t.extend(this.options, e) : "string" === t.type(e) && (this.options.className = e), !this.container || i) { if (this.container || i) { for (r in o = {}, t.isPlainObject(i) ? o = i : o["notify!blank"] = i, o) n = o[r], (s = this.userFields[r]) && ("text" === s && (n = C(n), this.options.breakNewLines && (n = n.replace(/\n/g, "<br/>"))), a = "notify!blank" === r ? "" : "=" + r, u(this.userContainer, "[data-notify-" + s + a + "]").html(n)); this.updateClasses(), this.elem ? this.setElementPosition() : this.setGlobalPosition(), this.show(!0), this.options.autoHide && (clearTimeout(this.autohideTimer), this.autohideTimer = setTimeout(this.show.bind(this, !1), this.options.autoHideDelay)) } } else this.show(!1) }, E.prototype.destroy = function () { this.wrapper.data(e, null), this.wrapper.remove() }, t.notify = function (i, e, n) { return i && i.nodeName || i.jquery ? t(i).notify(e, n) : (n = e, new E(null, e = i, n)), i }, t.fn.notify = function (i, n) { return t(this).each(function () { var o = y(t(this)).data(e); o && o.destroy(); new E(t(this), i, n) }), this }, t.extend(t.notify, { defaults: function (i) { return t.extend(f, i) }, addStyle: c, removeStyle: function (t) { if (!t) throw "Missing Style name"; l[t] && delete l[t] }, pluginOptions: f, getStyle: function (t) { return l[t] }, insertCSS: d }), c("bootstrap", { html: "<div>\n<span data-notify-text></span>\n</div>", classes: { base: { "font-weight": "bold", padding: "8px 15px 8px 14px", "text-shadow": "0 1px 0 rgba(255, 255, 255, 0.5)", "background-color": "#fcf8e3", border: "1px solid #fbeed5", "border-radius": "4px", "white-space": "nowrap", "padding-left": "25px", "background-repeat": "no-repeat", "background-position": "3px 7px" }, error: { color: "#B94A48", "background-color": "#F2DEDE", "border-color": "#EED3D7", "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAtRJREFUeNqkVc1u00AQHq+dOD+0poIQfkIjalW0SEGqRMuRnHos3DjwAH0ArlyQeANOOSMeAA5VjyBxKBQhgSpVUKKQNGloFdw4cWw2jtfMOna6JOUArDTazXi/b3dm55socPqQhFka++aHBsI8GsopRJERNFlY88FCEk9Yiwf8RhgRyaHFQpPHCDmZG5oX2ui2yilkcTT1AcDsbYC1NMAyOi7zTX2Agx7A9luAl88BauiiQ/cJaZQfIpAlngDcvZZMrl8vFPK5+XktrWlx3/ehZ5r9+t6e+WVnp1pxnNIjgBe4/6dAysQc8dsmHwPcW9C0h3fW1hans1ltwJhy0GxK7XZbUlMp5Ww2eyan6+ft/f2FAqXGK4CvQk5HueFz7D6GOZtIrK+srupdx1GRBBqNBtzc2AiMr7nPplRdKhb1q6q6zjFhrklEFOUutoQ50xcX86ZlqaZpQrfbBdu2R6/G19zX6XSgh6RX5ubyHCM8nqSID6ICrGiZjGYYxojEsiw4PDwMSL5VKsC8Yf4VRYFzMzMaxwjlJSlCyAQ9l0CW44PBADzXhe7xMdi9HtTrdYjFYkDQL0cn4Xdq2/EAE+InCnvADTf2eah4Sx9vExQjkqXT6aAERICMewd/UAp/IeYANM2joxt+q5VI+ieq2i0Wg3l6DNzHwTERPgo1ko7XBXj3vdlsT2F+UuhIhYkp7u7CarkcrFOCtR3H5JiwbAIeImjT/YQKKBtGjRFCU5IUgFRe7fF4cCNVIPMYo3VKqxwjyNAXNepuopyqnld602qVsfRpEkkz+GFL1wPj6ySXBpJtWVa5xlhpcyhBNwpZHmtX8AGgfIExo0ZpzkWVTBGiXCSEaHh62/PoR0p/vHaczxXGnj4bSo+G78lELU80h1uogBwWLf5YlsPmgDEd4M236xjm+8nm4IuE/9u+/PH2JXZfbwz4zw1WbO+SQPpXfwG/BBgAhCNZiSb/pOQAAAAASUVORK5CYII=)" }, success: { color: "#468847", "background-color": "#DFF0D8", "border-color": "#D6E9C6", "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAutJREFUeNq0lctPE0Ecx38zu/RFS1EryqtgJFA08YCiMZIAQQ4eRG8eDGdPJiYeTIwHTfwPiAcvXIwXLwoXPaDxkWgQ6islKlJLSQWLUraPLTv7Gme32zoF9KSTfLO7v53vZ3d/M7/fIth+IO6INt2jjoA7bjHCJoAlzCRw59YwHYjBnfMPqAKWQYKjGkfCJqAF0xwZjipQtA3MxeSG87VhOOYegVrUCy7UZM9S6TLIdAamySTclZdYhFhRHloGYg7mgZv1Zzztvgud7V1tbQ2twYA34LJmF4p5dXF1KTufnE+SxeJtuCZNsLDCQU0+RyKTF27Unw101l8e6hns3u0PBalORVVVkcaEKBJDgV3+cGM4tKKmI+ohlIGnygKX00rSBfszz/n2uXv81wd6+rt1orsZCHRdr1Imk2F2Kob3hutSxW8thsd8AXNaln9D7CTfA6O+0UgkMuwVvEFFUbbAcrkcTA8+AtOk8E6KiQiDmMFSDqZItAzEVQviRkdDdaFgPp8HSZKAEAL5Qh7Sq2lIJBJwv2scUqkUnKoZgNhcDKhKg5aH+1IkcouCAdFGAQsuWZYhOjwFHQ96oagWgRoUov1T9kRBEODAwxM2QtEUl+Wp+Ln9VRo6BcMw4ErHRYjH4/B26AlQoQQTRdHWwcd9AH57+UAXddvDD37DmrBBV34WfqiXPl61g+vr6xA9zsGeM9gOdsNXkgpEtTwVvwOklXLKm6+/p5ezwk4B+j6droBs2CsGa/gNs6RIxazl4Tc25mpTgw/apPR1LYlNRFAzgsOxkyXYLIM1V8NMwyAkJSctD1eGVKiq5wWjSPdjmeTkiKvVW4f2YPHWl3GAVq6ymcyCTgovM3FzyRiDe2TaKcEKsLpJvNHjZgPNqEtyi6mZIm4SRFyLMUsONSSdkPeFtY1n0mczoY3BHTLhwPRy9/lzcziCw9ACI+yql0VLzcGAZbYSM5CCSZg1/9oc/nn7+i8N9p/8An4JMADxhH+xHfuiKwAAAABJRU5ErkJggg==)" }, info: { color: "#3A87AD", "background-color": "#D9EDF7", "border-color": "#BCE8F1", "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QYFAhkSsdes/QAAA8dJREFUOMvVlGtMW2UYx//POaWHXg6lLaW0ypAtw1UCgbniNOLcVOLmAjHZolOYlxmTGXVZdAnRfXQm+7SoU4mXaOaiZsEpC9FkiQs6Z6bdCnNYruM6KNBw6YWewzl9z+sHImEWv+vz7XmT95f/+3/+7wP814v+efDOV3/SoX3lHAA+6ODeUFfMfjOWMADgdk+eEKz0pF7aQdMAcOKLLjrcVMVX3xdWN29/GhYP7SvnP0cWfS8caSkfHZsPE9Fgnt02JNutQ0QYHB2dDz9/pKX8QjjuO9xUxd/66HdxTeCHZ3rojQObGQBcuNjfplkD3b19Y/6MrimSaKgSMmpGU5WevmE/swa6Oy73tQHA0Rdr2Mmv/6A1n9w9suQ7097Z9lM4FlTgTDrzZTu4StXVfpiI48rVcUDM5cmEksrFnHxfpTtU/3BFQzCQF/2bYVoNbH7zmItbSoMj40JSzmMyX5qDvriA7QdrIIpA+3cdsMpu0nXI8cV0MtKXCPZev+gCEM1S2NHPvWfP/hL+7FSr3+0p5RBEyhEN5JCKYr8XnASMT0xBNyzQGQeI8fjsGD39RMPk7se2bd5ZtTyoFYXftF6y37gx7NeUtJJOTFlAHDZLDuILU3j3+H5oOrD3yWbIztugaAzgnBKJuBLpGfQrS8wO4FZgV+c1IxaLgWVU0tMLEETCos4xMzEIv9cJXQcyagIwigDGwJgOAtHAwAhisQUjy0ORGERiELgG4iakkzo4MYAxcM5hAMi1WWG1yYCJIcMUaBkVRLdGeSU2995TLWzcUAzONJ7J6FBVBYIggMzmFbvdBV44Corg8vjhzC+EJEl8U1kJtgYrhCzgc/vvTwXKSib1paRFVRVORDAJAsw5FuTaJEhWM2SHB3mOAlhkNxwuLzeJsGwqWzf5TFNdKgtY5qHp6ZFf67Y/sAVadCaVY5YACDDb3Oi4NIjLnWMw2QthCBIsVhsUTU9tvXsjeq9+X1d75/KEs4LNOfcdf/+HthMnvwxOD0wmHaXr7ZItn2wuH2SnBzbZAbPJwpPx+VQuzcm7dgRCB57a1uBzUDRL4bfnI0RE0eaXd9W89mpjqHZnUI5Hh2l2dkZZUhOqpi2qSmpOmZ64Tuu9qlz/SEXo6MEHa3wOip46F1n7633eekV8ds8Wxjn37Wl63VVa+ej5oeEZ/82ZBETJjpJ1Rbij2D3Z/1trXUvLsblCK0XfOx0SX2kMsn9dX+d+7Kf6h8o4AIykuffjT8L20LU+w4AZd5VvEPY+XpWqLV327HR7DzXuDnD8r+ovkBehJ8i+y8YAAAAASUVORK5CYII=)" }, warn: { color: "#C09853", "background-color": "#FCF8E3", "border-color": "#FBEED5", "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAABJlBMVEXr6eb/2oD/wi7/xjr/0mP/ykf/tQD/vBj/3o7/uQ//vyL/twebhgD/4pzX1K3z8e349vK6tHCilCWbiQymn0jGworr6dXQza3HxcKkn1vWvV/5uRfk4dXZ1bD18+/52YebiAmyr5S9mhCzrWq5t6ufjRH54aLs0oS+qD751XqPhAybhwXsujG3sm+Zk0PTwG6Shg+PhhObhwOPgQL4zV2nlyrf27uLfgCPhRHu7OmLgAafkyiWkD3l49ibiAfTs0C+lgCniwD4sgDJxqOilzDWowWFfAH08uebig6qpFHBvH/aw26FfQTQzsvy8OyEfz20r3jAvaKbhgG9q0nc2LbZxXanoUu/u5WSggCtp1anpJKdmFz/zlX/1nGJiYmuq5Dx7+sAAADoPUZSAAAAAXRSTlMAQObYZgAAAAFiS0dEAIgFHUgAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfdBgUBGhh4aah5AAAAlklEQVQY02NgoBIIE8EUcwn1FkIXM1Tj5dDUQhPU502Mi7XXQxGz5uVIjGOJUUUW81HnYEyMi2HVcUOICQZzMMYmxrEyMylJwgUt5BljWRLjmJm4pI1hYp5SQLGYxDgmLnZOVxuooClIDKgXKMbN5ggV1ACLJcaBxNgcoiGCBiZwdWxOETBDrTyEFey0jYJ4eHjMGWgEAIpRFRCUt08qAAAAAElFTkSuQmCC)" } } }), t(function () { d(h.css).attr("id", "core-notify"), t(document).on("click", "." + e + "-hidable", function (i) { t(this).trigger("notify-hide") }), t(document).on("notify-hide", "." + e + "-wrapper", function (i) { var n = t(this).data(e); n && n.show(!1) }) }) });