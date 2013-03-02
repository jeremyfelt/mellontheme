<<<<<<< HEAD
(function($){
	/* hoverIntent by Brian Cherne */
	$.fn.hoverIntent = function(f,g) {
		// default configuration options
		var cfg = {
			sensitivity: 7,
			interval: 100,
			timeout: 0
		};
		// override configuration options with user supplied object
		cfg = $.extend(cfg, g ? { over: f, out: g } : f );

		// instantiate variables
		// cX, cY = current X and Y position of mouse, updated by mousemove event
		// pX, pY = previous X and Y position of mouse, set by mouseover and polling interval
		var cX, cY, pX, pY;

		// A private function for getting mouse position
		var track = function(ev) {
			cX = ev.pageX;
			cY = ev.pageY;
		};

		// A private function for comparing current and previous mouse position
		var compare = function(ev,ob) {
			ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
			// compare mouse positions to see if they've crossed the threshold
			if ( ( Math.abs(pX-cX) + Math.abs(pY-cY) ) < cfg.sensitivity ) {
				$(ob).unbind("mousemove",track);
				// set hoverIntent state to true (so mouseOut can be called)
				ob.hoverIntent_s = 1;
				return cfg.over.apply(ob,[ev]);
			} else {
				// set previous coordinates for next time
				pX = cX; pY = cY;
				// use self-calling timeout, guarantees intervals are spaced out properly (avoids JavaScript timer bugs)
				ob.hoverIntent_t = setTimeout( function(){compare(ev, ob);} , cfg.interval );
			}
		};

		// A private function for delaying the mouseOut function
		var delay = function(ev,ob) {
			ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
			ob.hoverIntent_s = 0;
			return cfg.out.apply(ob,[ev]);
		};

		// A private function for handling mouse 'hovering'
		var handleHover = function(e) {
			// next three lines copied from jQuery.hover, ignore children onMouseOver/onMouseOut
			var p = (e.type == "mouseover" ? e.fromElement : e.toElement) || e.relatedTarget;
			while ( p && p != this ) { try { p = p.parentNode; } catch(e) { p = this; } }
			if ( p == this ) { return false; }

			// copy objects to be passed into t (required for event object to be passed in IE)
			var ev = jQuery.extend({},e);
			var ob = this;

			// cancel hoverIntent timer if it exists
			if (ob.hoverIntent_t) { ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t); }

			// else e.type == "onmouseover"
			if (e.type == "mouseover") {
				// set "previous" X and Y position based on initial entry point
				pX = ev.pageX; pY = ev.pageY;
				// update "current" X and Y position based on mousemove
				$(ob).bind("mousemove",track);
				// start polling interval (self-calling timeout) to compare mouse coordinates over time
				if (ob.hoverIntent_s != 1) { ob.hoverIntent_t = setTimeout( function(){compare(ev,ob);} , cfg.interval );}

			// else e.type == "onmouseout"
			} else {
				// unbind expensive mousemove event
				$(ob).unbind("mousemove",track);
				// if hoverIntent state is true, then call the mouseOut function after the specified delay
				if (ob.hoverIntent_s == 1) { ob.hoverIntent_t = setTimeout( function(){delay(ev,ob);} , cfg.timeout );}
			}
		};

		// bind the function to the two event listeners
		return this.mouseover(handleHover).mouseout(handleHover);
	};
	
})(jQuery);
=======
(function(c){var d={};d.c={menuClass:"sf-js-enabled",subClass:"sf-sub-indicator",anchorClass:"sf-with-ul"};d.defaults={hoverClass:"sfHover",pathClass:"overideThisToUse",pathLevels:1,delay:700,animIn:{opacity:"show"},animOut:{opacity:"hide"},easeIn:"swing",easeOut:"swing",speedIn:"normal",speedOut:"normal",autoArrows:true,arrow:'<span class="'+d.c.subClass+'">&#187;</span>',disableHI:false,onInit:function(){},onAfterInit:function(){},onBeforeShow:function(){},onShow:function(){},onBeforeHide:function(){},onHide:function(){}};c.fn.superfish=function(a){if(d.methods[a]){return d.methods[a].apply(this,Array.prototype.slice.call(arguments,1))}else{if(typeof a==="object"||!a){return d.methods.init.apply(this,arguments)}else{c.error("Method "+a+" does not exist on jQuery.superfish")}}};d.methods={init:function(a){return this.each(function(){var k=c(this),i=k.data("superfish"),b=c.extend({},d.defaults,a);if(!i){var l=k.find("li");var j=l.find("ul");k.data("superfish",{target:k,timer:null,uls:j,lis:l,options:b});i=k.data("superfish")}if(i.initialized){if(typeof(console)!="undefined"){console.warn("superfish already initialized on",this)}return this}i.initialized=true;if(typeof(b.speedOut)==="string"){b.speedOut=600}if(c.browser.msie&&(parseInt(c.browser.version)<=6)){return}if(i.uls.length==0){if(typeof(console)!="undefined"){console.warn("no ul's found on parent menu item, exiting")}return this}k.addClass(d.c.menuClass);b.onInit.call(null,k);if(b.autoArrows){c("li:has(ul)",i.target).addClass(d.c.anchorClass).children("A").append(b.arrow)}i.uls.hide();i.lis.delegate("a","mouseenter mouseleave",function(f){var g=c(this),e=g.parent("li");$next=e.children("UL").first();if(f.type=="mouseenter"){clearTimeout(i.timer);i.lis.not(e).not(e.parents()).removeClass(b.hoverClass);e.addClass(b.hoverClass);if($next.is(":hidden")){b.onBeforeShow.call(null,$next);$next.animate(b.animIn,b.speedIn,b.easeIn,function(){b.onShow.call(null,$next)})}}else{if(f.type=="mouseleave"){i.timer=setTimeout(function(){d.methods.close(k)},b.delay)}else{console.warn(" $(this), event.type",c(this),f.type)}}f.preventDefault();f.stopPropagation();return false});if(b.pathClass!==d.defaults.pathClass){console.warn("@TODO pathClass enabled");c("li."+b.pathClass,k).slice(0,b.pathLevels)}b.onAfterInit.call(null,k)})},close:function(a){if(typeof(a)=="undefined"){var a=c(this)}return a.each(function(){var f=a.data("superfish"),b=f.options;b.onBeforeHide.call(null,a);f.uls.animate(b.animOut,b.speedOut,b.easeOut,function(){b.onHide.call(null,c(this))});setTimeout(function(){f.uls.hide();f.lis.removeClass(b.hoverClass)},b.speedOut)})},destroy:function(){return this.each(function(){if(c(this).data("superfish")){var b=c(this).data("superfish"),a=b.options;b.target.removeClass(d.c.menuClass);b.uls.removeAttr("style");if(a.autoArrows){c("li:has(ul)",b.target).removeClass(d.c.anchorClass);c("."+d.c.subClass,b.target).remove()}b.lis.undelegate("a","mouseenter mouseleave");c(this).removeData("superfish")}else{if(typeof(console)!=="undefined"){console.warn("Superfish not initialized on that dom element")}}})}}})(jQuery);
>>>>>>> gh-pages
