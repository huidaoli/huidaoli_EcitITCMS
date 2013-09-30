qtool.preload = function()
{
	var isIE=/*@cc_on!@*/0,
		//isFF = !!document.getBoxObjectFor || 'mozInnerScreenX' in window,
		isOP = !!window.opera && !!window.opera.toString().indexOf('Opera'),
		res = Array.prototype.slice.call(arguments);
	if(isIE||isOP)
	{
		qtool.preload = (function(){
			window["preimgs"] = {};
			var seri=1;
			return function(){
				var res=Array.prototype.slice.call(arguments),
				i=res.length;
				while(i--)
				{
					var img = window["preimgs"][i] = new Image();
					img.onload = img.onerror = function() {window["preimgs"][this.serial]=null;delete window["preimgs"][this.serial];};
					img.src = res[i];
					img.serial = seri++;
				}			
			};
		})();
	}
	/*else if(isFF)
	{
	}*/
	else
	{
		qtool.preload = function()
		{
			var res = Array.prototype.slice.call(arguments),
				i=res.length;
			if(document&&document.body)
			{
				while(i--)
				{
					var obj = document.createElement('object');
					obj.data = res[i];
					obj.width  = obj.height = 0;
					obj.onload = function() {obj.style.display="none";};
					obj.onerror = function() {obj.style.display="none";};
					document.body.appendChild(obj);
				}
			}
		}
	}
	//TODO 支持HTML草案的Link Prefetch
	//http://www.otakustay.com/prefetch-resource/
	qtool.preload.apply(qtool,res);
}
