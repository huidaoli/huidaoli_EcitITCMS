var cld;
var HuangLi = {};

function drawCld(SY,SM)
{
   var i,sD,s,size;
   var trs = $("#rl").find("tr");
   $(trs[5]).show();
   cld = new calendar(SY,SM);
 
   for(i=0;i<42;++i) 
   {

      sObj=$('#SD'+ i);
      lObj=$('#LD'+ i);
	  fjObj=$('#FJ' + i);
	  
	  fjObj.html("");

      sObj.parent().removeClass('bg-blue te').removeClass('bg-red te').removeClass("bg-gray").removeClass("today");

      if (cld.firstWeek == 0)
      {
          cld.firstWeek = 7;   
      }  

      sD = i - cld.firstWeek + 1;

      if(sD>-1 && sD<cld.length) 
	  { //日期内
         sObj.html(sD + 1);

		 if (true == cld[sD].holiday && false == cld[sD].isLeap && (tY == SY  || (typeof (holidaysInLaw[SY])!= "undefined" && typeof(cld[sD].forceShowHoliday) != "undefined")))
		 {
			sObj.parent().addClass('bg-red te'); //节假日颜色
		 } 
         else if(cld[sD].isToday) 
		 {
			sObj.parent().addClass('bg-blue te'); //今日颜色
		 }

          if (cld[sD].isToday)
          {
			fjObj.html("今日");
          }  


         if (typeof(cld[sD].holiday) == "undefined" || cld[sD].holiday == "" )
         {
             sObj.css({"color" : cld[sD].color}); //国定假日颜色	
         }
         else
         {
               if (SY == tY || (typeof(cld[sD].forceShowHoliday) != "undefined"))
               {
                  sObj.css({"color" : "white"}); //国定假日颜色 
               }
               else
               {
                  sObj.css({"color" : cld[sD].color});
               }
         }

         if (cld[sD].isToday)
         {
            sObj.parent().addClass('today');
         }
	 
         if(cld[sD].lDay==1) //显示农历月
		 {
            lObj.html('<b>'+(cld[sD].isLeap?'闰':'') + getChinaNum(cld[sD].lMonth) + '月' + (monthDays(cld[sD].lYear,cld[sD].lMonth)==29?'小':'大')+'</b>');
		 }
         else //显示农历日
		 {
            lObj.html(cDay(cld[sD].lDay));
		 }	
		 
		 //解决阴历或节日的显示
         var s1=cld[sD].solarFestival;
         var s2=cld[sD].lunarFestival;
         var s3=cld[sD].solarTerms;

         if (s1.length>0 || (s2.length>0 && false == cld[sD].isLeap))
         {
            if (typeof(cld[sD].holidayType) != "undefined")
            {
                if ("s" == cld[sD].holidayType)
                {
                    var size = (s1.charCodeAt(0)>0 && s1.charCodeAt(0)<128)?8:4;
                    if(s1.length>size+2)
                    {
                        s = s1.substr(0, size)+'...';
                    }		
                    else
                    {
                        s = s1;
                    }
                }
                else if ("l" == cld[sD].holidayType)
                {
				    s = (s2.length>6) ? s2.substr(0, 4)+'...' : s2;
                }
				
                if (SY == tY || (typeof (holidaysInLaw[SY])!= "undefined" && typeof(cld[sD].forceShowHoliday) != "undefined"))
                {
                    s = s.fontcolor('white');
                }
			    else
			    {
				    s = s.fontcolor('red'); 
			    }
            }
            else
            {
               if (s1.length > 0)
               {
                    var size = (s1.charCodeAt(0)>0 && s1.charCodeAt(0)<128)?8:4;
                    if(s1.length>size+2)
                    {
                        s = s1.substr(0, size)+'...';
                    }		
                    else
                    {
                        s = s1;
                    }
               } 
               else
               {
	                s = (s2.length>6) ? s2.substr(0, 4)+'...' : s2;
               }
			   
                if ((typeof (holidaysInLaw[SY])!= "undefined" && typeof(cld[sD].forceShowHoliday) != "undefined"))
                {
                    s = s.fontcolor('white');
                }
			    else
			    {
				    s = s.fontcolor('red'); 
			    }
            }    
         }
         else
         {
            s = s3;        
         }
		 
		 //解决放假的显示
         if(s.length>0)
		 {
		    if (/放假/.test(s))
			{
			    fjObj.html("放假"); 
			}
			else
			{
                lObj.html(s);
				
                if (typeof(cld[sD].holidayType) != "undefined" && tY == SY) //不是今年的不显示放假
                {
                    fjObj.html("放假");                   
                }
			}	
		 }	
		 
		 //解决法定放假日的显示
		 if (typeof (holidaysInLaw[SY])!= "undefined" && typeof(cld[sD].forceShowHoliday) != "undefined"){
		    fjObj.html("放假");  
		 }		 
          
		 sObj.parent().click(function(){
			initDayDesc(parseInt($(this).attr("id").replace("GD" , "") , 10));

            $("#rl").children().find(".bg-blue").removeClass("bg-blue te");
            $("#rl").children().find(".today").addClass("bg-gray");
            if ($(this).hasClass("today"))
            {
                $(this).children("label").css({"color" : "white"});     
            }
            else
            {
                var node = $("#rl").children().find(".today");
                node.children("label").css({"color" : "black"});
            }
            $(this).addClass("bg-blue te");
            if ($(this).hasClass("today"))
            {
                $(this).removeClass("bg-gray");
                $(".btn-today").val("今日");
            }
            else
            {
                $(".btn-today").val("返回今日");    
            }
            if ($(this).hasClass("bg-blue-hover"))
            {
                $(this).removeClass("bg-blue-hover").addClass("bg-blue");    
            }
		 });
      }
      else 
	  { //非日期
         sObj.html('');
         lObj.html('');
      }
    }
	
	var delLast = 1;
    for( var j = 35 ; j < 42 ; ++j)
	{
		if ($.trim($("#SD"+j).html()) != "" || $.trim($("#LD"+j).html()) != "")
		{
			delLast = 0;
			break;
		}
	}
	
	if (delLast)
	{
	    $(trs[5]).hide();
	}
}

function initContainer()
{
	var container = $("#calendar-container");
	
	var str = [];
	var gNum , tbl;
	str.push('<table id="rl" width="716">');
	for (var i = 0; i < 6; ++i)
	{
		str.push("<tr>");
		for(var j = 0; j < 7; ++j) 
		{
			gNum = i*7 + j;
			str.push('<td><div id="GD' + gNum + '"><span class="dateNum" id="SD' + gNum +'"></span><span id="LD' + gNum + '"></span><label id="FJ'+gNum+'"></label></div></td>');
		}
		str.push("</tr>");
	}
	str.push('</table>');
	tbl = str.join('');
	container.append($(tbl));	
}

//yearNode [上一年按钮ID ， 选择年ID ， 下一年ID]
//monthNode[上一月按钮ID ， 选择月ID ， 下一月ID]
function initSelector(yearNode , monthNode)
{
    //初始化年选择框
    var ys = $("#" + yearNode[1]);	
	var opts = [];
	
	for ( var i = 2049 ; i >= 1901 ; --i)
	{
		opts.push("<option value='"+i+"'>"+i+"年</option>");
	}
	
	ys.append($(opts.join(''))); 
	
   //初始化月选择框
    var ms = $("#" + monthNode[1]);	
	var opts = [];
	
	for ( var i = 0 ; i < 12 ; ++i)
	{
		opts.push("<option value='"+i+"'>"+parseInt(i+1 , 10)+"月</option>");
	}
	
	ms.append($(opts.join('')));
	
	//事件绑定
	
	//上一年
	$("#" + yearNode[0]).click(function(){
		$("#" + monthNode[1] + " option[value=0]").attr("selected",true);//月份归一
		
		var nowYear = ys.val();
		var newYear = parseInt(nowYear , 10) - 1;
		
		newYear = (newYear > 1900) ?  newYear : 1900 ; //不允许超越年下限
		
		$("#" + yearNode[1] + " option[value="+newYear+"]").attr("selected",true);

		//重绘日历
		drawCld(newYear , 0); 

                     $("#holiday-selector option[value=0]").attr("selected" , true);  //重置节假日
changeRightHeight();
	
	});
	
	//下一年
	$("#" + yearNode[2]).click(function(){
		$("#" + monthNode[1] + " option[value=0]").attr("selected",true);//月份归一
		
		var nowYear = ys.val();
		var newYear = parseInt(nowYear , 10) + 1;

		newYear = (newYear < 2050) ?  newYear : 2049 ; //不允许超越年上限
		
		$("#" + yearNode[1] + " option[value="+newYear+"]").attr("selected",true);	

		//重绘日历
		drawCld(newYear , 0); 
                     $("#holiday-selector option[value=0]").attr("selected" , true);  //重置节假日
changeRightHeight();
	
	
	});	
	
	//下一年
	$("#" + yearNode[1]).bind("change" , function(){
		$("#" + monthNode[1] + " option[value=0]").attr("selected",true); //月份归一
		
		var newYear = ys.val();
		//重绘日历
		drawCld(newYear , 0); 
                     $("#holiday-selector option[value=0]").attr("selected" , true);  //重置节假日	
changeRightHeight();

	
	});
	
	//上一月
	$("#" + monthNode[0]).click(function(){
		var nowMonth = ms.val();
		var newMonth = parseInt(parseInt(nowMonth , 10) - 1 , 10);
		var nowYear = ys.val();
		
		if (newMonth < 0) //跨年
		{					
			newMonth = 11; //置为12月
			
			var newYear = parseInt(nowYear , 10) - 1;			
			newYear = (newYear > 1900) ?  newYear : 1900 ; //不允许超越年下限
			//更换年
			$("#" + yearNode[1] + " option[value="+newYear+"]").attr("selected",true);	
		}
		else
		{
			newYear = nowYear;
		}			
		
		$("#" + monthNode[1] + " option[value="+newMonth+"]").attr("selected",true);
		//重绘日历
		drawCld(newYear , newMonth); 	
                      $("#holiday-selector option[value=0]").attr("selected" , true);  //重置节假日
changeRightHeight();

	});	
	
	//下一月
	$("#" + monthNode[2]).click(function(){
		var nowMonth = ms.val();
		var newMonth = parseInt(parseInt(nowMonth , 10) + 1 , 10);
		var nowYear = ys.val();
		
		if (newMonth > 11) //跨到下一年
		{					
			newMonth = 0; //置为1月
			
			var newYear = parseInt(nowYear , 10) + 1;			
			newYear = (newYear < 2050) ?  newYear : 2049 ; //不允许超越年上限
			//更换年
			$("#" + yearNode[1] + " option[value="+newYear+"]").attr("selected",true);
		}
		else
		{
			newYear = nowYear;
		}
		
		$("#" + monthNode[1] + " option[value="+newMonth+"]").attr("selected",true);
		//重绘日历
		drawCld(newYear , newMonth); 
                     $("#holiday-selector option[value=0]").attr("selected" , true);  //重置节假日	
changeRightHeight();

	});		
	
	//月份选择
	$("#" + monthNode[1]).bind("change" , function(){
		var newMonth = parseInt(ms.val() , 10);
		//重绘日历
		drawCld(ys.val() , newMonth); 	
                     $("#holiday-selector option[value=0]").attr("selected" , true);  //重置节假日
changeRightHeight();

	});	
}

/*
function addHoverEffect()
{
	$("#rl td").hover(function(){
		var tdiv = $(this).find("div");
		if(tdiv.hasClass("te"))
		{
			return;
		}	
		tdiv.addClass("bg-blue");
		
	},function(){
		var tdiv = $(this).find("div");
		if(tdiv.hasClass("te")) 
		{
			return;
		}
		tdiv.removeClass("bg-blue");
	});
}
*/

function addHoverEffect()
{
	$("#rl td").hover(function(){
		var tdiv = $(this).find("div");
		if(tdiv.hasClass("today"))
		{
            tdiv.removeClass("bg-gray");
		}	
		tdiv.addClass("bg-blue-hover");
		
	},function(){
		var tdiv = $(this).find("div");
		if(tdiv.hasClass("today") && !tdiv.hasClass("bg-blue")) 
		{
            tdiv.addClass("bg-gray");
		}
		tdiv.removeClass("bg-blue-hover");
	});
}

function initDay(year , month , day)
{
    if (arguments.length < 3)
	{
		year = tY;
		month = tM;
		day = tD;
	}	
	drawCld(year , month); 
    if (arguments.length < 3)
    {
        $("#rl").children().find(".today").children("label").css({"color" :"white"});
        $(".btn-today").val("今日");
    }
		
	
	var tds = $("#rl").children().find(".dateNum");
    var tmp;

	for(var i in tds)
	{
        tmp = tds[i].innerHTML;
		if (parseInt(day , 10) == parseInt(tmp , 10))
		{
			initDayDesc(parseInt($(tds[i]).attr("id").replace("SD" , "") , 10));
			break;
		}
	}
	
	setTimeout(function(){
		$("#year-selector option[value="+year+"]").attr("selected",true);
		$("#month-selector option[value="+month+"]").attr("selected",true);
	} , 0);
}

function initDayDesc(colOrder)
{
    var s , festival;
    var sObj = $('#SD'+ colOrder);
    var d = parseInt(sObj.html() , 10) - 1;	

    if((cld[d].solarTerms == '' && cld[d].solarFestival == '' && cld[d].lunarFestival == '') || cld[d].isLeap)
	{
               festival = '';
	}	 
          else
	{
                if ( cld[d].solarTerms == "清明" || cld[d].solarTerms == "")
                {
                   festival = "";
                }
                else
                {
                   festival =  '<p>'+cld[d].solarTerms + '</p> ';
                }
                if ("" != cld[d].solarFestival)
                {  
                      festival += '<p>' + cld[d].solarFestival + '</p>';
                } 

                 if ("" != cld[d].lunarFestival)
                 {
                     festival += '<p>' + cld[d].lunarFestival+'</p>';
                 }  
	}	 
				 
	 if (!/放假/.test(festival) && typeof (holidaysInLaw[cld[d].sYear])!= "undefined" && typeof(cld[d].forceShowHoliday) != "undefined"){
		 festival +='<p>' +holidaysInLaw[cld[d].sYear][cld[d].sMonth][cld[d].sDay].replace("*" , "")+'</p>';
	 }	

	s = []  
	s.push('<p><b>'+cld[d].sYear+' 年 '+cld[d].sMonth+' 月 '+cld[d].sDay+' 日 星期'+cld[d].week+'</b></p>');
	s.push('<p class="dateNum">'+cld[d].sDay+'</p>');
	s.push('<p>农历'+(cld[d].isLeap ? '闰 ' :' ')+getChinaNum(cld[d].lMonth)+'月' + cDay(cld[d].lDay)+' </p>');
	s.push('<p>'+cld[d].cYear+'年 '+cld[d].cMonth+'月 ' + cld[d].cDay + '日</p>');
	s.push(festival);
	s.push('<p>【'+cld[d].animal+'年】</p>');
	s.push('<p class="line"></p>');

    //黄历数据
    var parseHuangli = function (){    
		var thl = HuangLi['y'+cld[d].sYear];
		var happy="";
		var avoid ="";
		if(thl != undefined )
		{
			var fullMonth = (parseInt(cld[d].sMonth , 10) < 10) ? "0" + parseInt(cld[d].sMonth ,10) : "" + parseInt(cld[d].sMonth , 10);
			var fullDate = (parseInt(cld[d].sDay , 10) < 10) ? "0" + parseInt(cld[d].sDay , 10) : "" + parseInt(cld[d].sDay ,10) ;
			var key = "d" + fullMonth + fullDate;
			happy = thl[key].y;
			avoid = thl[key].j;
                                happyCut = happy.substr(0,50);
                                avoidCut = avoid.substr(0,50);
                                if (happy == happyCut)
                                {
			    s.push('<p><span class="happy">'+happy+'</span></p>');
                                }
                                else
                                {
			    s.push('<p><span class="happy" title="'+happy+'">'+happyCut+'...'+'</span></p>');
                                } 
                                if (avoid == avoidCut )
                                {
			    s.push('<p><span class="avoid">'+avoid+'</span></p>');
                                }
                                else
                                {
			    s.push('<p><span class="avoid" title="'+avoid+'">'+avoidCut+'...'+'</span></p>');
                                }  	
			s.push('<p class="line"></p>');		
		}	
	}    

    if (cld[d].sYear > 2007 && cld[d].sYear < 2021)
    {
        var jsonParam = 'y'+cld[d].sYear;
        if ("undefined" == typeof(HuangLi[jsonParam]))
        {
            $.getScript("http://h.qhimg.com/js/wan_nian_li/"+cld[d].sYear+".js" , function (){
                parseHuangli();
	            $("#day-desc").html(s.join(''));
changeRightHeight();
		
            });    
        }
        else
        {
            parseHuangli();
	        $("#day-desc").html(s.join(''));	
changeRightHeight();
	
        }
    }
    else
    {
	    $("#day-desc").html(s.join(''));	
               changeRightHeight();
	
    }
}

function change2Holiday(v)
{
    if (parseInt(v , 10) != 0)
    {
        var month = parseInt(parseInt(v.substr(4,2) , 10) - 1 , 10);

        var day = parseInt(v.substr(6,2) , 10);

        var year = parseInt(v.substr(0,4) , 10);

        drawCld(year  , month ); 
       
        $("#year-selector option[value="+year+"]").attr("selected" , true);  
        $("#month-selector option[value="+parseInt(month)+"]").attr("selected" , true);  
    
        changeRightHeight();

        //initDay(year , month , day);
    }
}


function initHoliday(selector)
{
	var holidays = getYearHolidays();

    var opts = [] , hs = [];
	
	var hitYear = 2012 ,str;

    opts.push('<option value="0">'+hitYear+'年放假安排</option>');
	
	for(var i in holidaysInLaw[hitYear]){
	    for (var j in holidaysInLaw[hitYear][i]){		
		    if (/\*$/.test(holidaysInLaw[hitYear][i][j])){
			    hs.push([i , j , holidaysInLaw[hitYear][i][j].replace("放假*" , "")]); 
			}
		}
	}
	
    for(var i in hs)
    {
	    str = hitYear ; 
	    str += parseInt(hs[i][0] , 10) < 10 ? "0" + hs[i][0] : hs[i][0] + "";
		str += parseInt(hs[i][1] , 10) < 10 ? "0" + hs[i][1] : hs[i][1] + "";
        opts.push('<option value="'+str+'">'+hs[i][2]+'</option>');        
    }

    $("#" + selector).append($(opts.join('')));

    $("#" + selector).bind("change" , function() {change2Holiday($("#" + selector).val());});	
}

function changeRightHeight()
{
    var lh = parseInt(($(".main").height()+"").replace('px' , '') , 10) - 10;

    var minHeight = 368;

    lh = (lh < minHeight ) ? minHeight : lh;

    $("#lr").height(lh + "px");
    
}