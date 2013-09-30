var lunarInfo=new Array(0x04bd8,0x04ae0,0x0a570,0x054d5,0x0d260,0x0d950,0x16554,0x056a0,0x09ad0,0x055d2,0x04ae0,0x0a5b6,0x0a4d0,0x0d250,0x1d255,0x0b540,0x0d6a0,0x0ada2,0x095b0,0x14977,0x04970,0x0a4b0,0x0b4b5,0x06a50,0x06d40,0x1ab54,0x02b60,0x09570,0x052f2,0x04970,0x06566,0x0d4a0,0x0ea50,0x06e95,0x05ad0,0x02b60,0x186e3,0x092e0,0x1c8d7,0x0c950,0x0d4a0,0x1d8a6,0x0b550,0x056a0,0x1a5b4,0x025d0,0x092d0,0x0d2b2,0x0a950,0x0b557,0x06ca0,0x0b550,0x15355,0x04da0,0x0a5d0,0x14573,0x052d0,0x0a9a8,0x0e950,0x06aa0,0x0aea6,0x0ab50,0x04b60,0x0aae4,0x0a570,0x05260,0x0f263,0x0d950,0x05b57,0x056a0,0x096d0,0x04dd5,0x04ad0,0x0a4d0,0x0d4d4,0x0d250,0x0d558,0x0b540,0x0b5a0,0x195a6,0x095b0,0x049b0,0x0a974,0x0a4b0,0x0b27a,0x06a50,0x06d40,0x0af46,0x0ab60,0x09570,0x04af5,0x04970,0x064b0,0x074a3,0x0ea50,0x06b58,0x055c0,0x0ab60,0x096d5,0x092e0,0x0c960,0x0d954,0x0d4a0,0x0da50,0x07552,0x056a0,0x0abb7,0x025d0,0x092d0,0x0cab5,0x0a950,0x0b4a0,0x0baa4,0x0ad50,0x055d9,0x04ba0,0x0a5b0,0x15176,0x052b0,0x0a930,0x07954,0x06aa0,0x0ad50,0x05b52,0x04b60,0x0a6e6,0x0a4e0,0x0d260,0x0ea65,0x0d530,0x05aa0,0x076a3,0x096d0,0x04bd7,0x04ad0,0x0a4d0,0x1d0b6,0x0d250,0x0d520,0x0dd45,0x0b5a0,0x056d0,0x055b2,0x049b0,0x0a577,0x0a4b0,0x0aa50,0x1b255,0x06d20,0x0ada0);

var solarMonth=new Array(31,28,31,30,31,30,31,31,30,31,30,31);
var Gan=new Array("甲","乙","丙","丁","戊","己","庚","辛","壬","癸");
var Zhi=new Array("子","丑","寅","卯","辰","巳","午","未","申","酉","戌","亥");
var Animals=new Array("鼠","牛","虎","兔","龙","蛇","马","羊","猴","鸡","狗","猪");
var solarTerm = new Array("小寒","大寒","立春","雨水","惊蛰","春分","清明","谷雨","立夏","小满","芒种","夏至","小暑","大暑","立秋","处暑","白露","秋分","寒露","霜降","立冬","小雪","大雪","冬至");
var solarTermAdjust = {"21" : 1};
var sTermInfo = new Array(0,21208,42467,63836,85337,107014,128867,150921,173149,195551,218072,240693,263343,285989,308563,331033,353350,375494,397447,419210,440795,462224,483532,504758)
var nStr1 = new Array('日','一','二','三','四','五','六','七','八','九','十')
var nStr2 = new Array('初','十','廿','卅','　')
var monthName = new Array("1 月","2 月","3 月","4 月","5 月","6 月","7 月","8 月","9 月","10 月","11 月","12 月");

//国历节日 *表示放假日
var sFtv = new Array(
"0101*元旦",
"0102*元旦放假",
"0103*元旦放假",
"0204*春节放假",
"0205*春节放假",
"0206*春节放假",
"0207*春节放假",
"0208*春节放假",
"0214 情人节",
"0308 妇女节",
"0312 植树节",
"0401 愚人节",
"0403*清明放假",
"0404*清明放假",
"0430*劳动节放假",
"0501*劳动节",
"0502*劳动节放假",
"0504 中国青年节",
"0601 国际儿童节",
"0604*端午放假",
"0605*端午放假",
"0701 建党日",
"0707 中国人民抗日战争纪念日",
"0801 八一建军节",
"0910*中秋放假",
"0910 教师节",
"0911*中秋放假",
"1001*国庆节",
"1002*国庆放假",
"1003*国庆放假",
"1004*国庆放假",
"1004 世界动物日",
"1005*国庆放假",
"1006*国庆放假",
"1007*国庆放假",
"1031 万圣节",
"1117 国际大学生节",
"1124 感恩节",
"1209 世界足球日",
"1225 圣诞节");

//农历节日 *表示放假日
var lFtv = new Array("0101*春节","0102 初二","0103 初三","0104 初四","0105 初五","0106 初六" ,"0115 元宵节","0505*端午节" ,"0707 七夕情人节","0815*中秋节","0909 重阳节" ,"0100*除夕");

//放假日,2011-12-06
var holidaysInLaw = {
    "2011" : {
	    "4" : {
		    "5" : "清明节"
		}
	},
    "2012" : {"1" : {
		"1" : "元旦放假*" ,
		"2" : "元旦放假" ,
		"3" : "元旦放假" ,
        "22" : "春节放假" ,		
        "23" : "春节放假*" ,	
        "24" : "春节放假" ,	
        "25" : "春节放假" ,		
        "26" : "春节放假" ,	
        "27" : "春节放假" ,
        "28" : "春节放假" 		
	} , "4" : {
		"2" : "清明节放假" ,
		"3" : "清明节放假" ,
		"4" : "清明节放假*" ,		
		"29" : "劳动节放假" ,
		"30" : "劳动节放假" 
	} , "5" : {
	    "1" : "劳动节放假*"
	},  "6" : {
	    "22" : "端午节放假",
		"23" : "端午节放假*",
		"24" : "端午节放假"	
	},  "9" : {
	    "30" : "中秋节放假*"
	},  "10" : {
	    "1" : "国庆节放假*",
	    "2" : "国庆节放假",	
	    "3" : "国庆节放假",
	    "4" : "国庆节放假",	
	    "5" : "国庆节放假",
	    "6" : "国庆节放假",		
	    "7" : "国庆节放假"			
	}	     
  }
};


//某月的第几个星期几
var wFtv = new Array("0520 母亲节","0630 父亲节");

/*****************************************************************************
                                      日期计算
*****************************************************************************/

//====================================== 传回农历 y年的总天数
function lYearDays(y) {
   var i, sum = 348
   for(i=0x8000; i>0x8; i>>=1) sum += (lunarInfo[y-1900] & i)? 1: 0
   return(sum+leapDays(y))
}

//====================================== 传回农历 y年闰月的天数
function leapDays(y) {
   if(leapMonth(y))  return((lunarInfo[y-1900] & 0x10000)? 30: 29)
   else return(0)
}

//====================================== 传回农历 y年闰哪个月 1-12 , 没闰传回 0
function leapMonth(y) {
   return(lunarInfo[y-1900] & 0xf)
}

//====================================== 传回农历 y年m月的总天数
function monthDays(y,m) {
   return( (lunarInfo[y-1900] & (0x10000>>m))? 30: 29 )
}

//====================================== 算出农历, 传入日期物件, 传回农历日期物件
//                                       该物件属性有 .year .month .day .isLeap .yearCyl .dayCyl .monCyl
function Lunar(objDate) {

   var i, leap=0, temp=0
   var baseDate = new Date(1900,0,31)
   var offset   = (objDate - baseDate)/86400000

   this.dayCyl = offset + 40
   this.monCyl = 14

   for(i=1900; i<2050 && offset>0; i++) {
      temp = lYearDays(i)
      offset -= temp
      this.monCyl += 12
   }

   if(offset<0) {
      offset += temp;
      i--;
      this.monCyl -= 12
   }

   this.year = i
   this.yearCyl = i-1864

   leap = leapMonth(i) //闰哪个月
   this.isLeap = false

   for(i=1; i<13 && offset>0; i++) {
     //闰月
      if(leap>0 && i==(leap+1) && this.isLeap==false)
         { --i; this.isLeap = true; temp = leapDays(this.year); }
      else
         { temp = monthDays(this.year, i); }

      //解除闰月
      if(this.isLeap==true && i==(leap+1)) this.isLeap = false

      offset -= temp
      if(this.isLeap == false) this.monCyl ++
   }

   if(offset==0 && leap>0 && i==leap+1)
      if(this.isLeap)
         { this.isLeap = false; }
      else
         { this.isLeap = true; --i; --this.monCyl;}

   if(offset<0){ offset += temp; --i; --this.monCyl; }

   this.month = i
   this.day = offset + 1
}

//==============================传回国历 y年某m+1月的天数
function solarDays(y,m) {
   if(m==1)
      return(((y%4 == 0) && (y%100 != 0) || (y%400 == 0))? 29: 28)
   else
      return(solarMonth[m])
}
//============================== 传入 offset 传回干支, 0=甲子
function cyclical(num) {
   return(Gan[num%10]+Zhi[num%12])
}

//============================== 月历属性
function calElement(sYear,sMonth,sDay,week,lYear,lMonth,lDay,isLeap,cYear,cMonth,cDay) {

      this.isToday    = false;
       //国历
      this.sYear      = sYear;
      this.sMonth     = sMonth;
      this.sDay       = sDay;
      this.week       = week;
      //农历
      this.lYear      = lYear;
      this.lMonth     = lMonth;
      this.lMonth     = lMonth;
      this.lDay       = lDay;
      this.isLeap     = isLeap;
      //干支
      this.cYear      = cYear;
      this.cMonth     = cMonth;
      this.cDay       = cDay;

      this.color      = '';

      this.lunarFestival = ''; //农历节日
      this.solarFestival = ''; //国历节日
      this.solarTerms    = ''; //节气
	  
	  this.animal = Animals[(this.lYear - 4) % 12 ] ;

}

//===== 某年的第n个节气为几日(从0小寒起算)
function sTerm(y,n) {
   if (typeof (solarTermAdjust[n]) == "undefined"){ 
	  var offDate = new Date( ( 31556925974.7*(y-1900) + sTermInfo[n]*60000  ) + Date.UTC(1900,0,6,2,5) )
   }
   else {
      var offDate = new Date( ( 31556925974.7*(y-1900) + sTermInfo[n]*60000 + solarTermAdjust[n] * 86400000) + Date.UTC(1900,0,6,2,5) )
   }   
   return(offDate.getUTCDate())
}

//============================== 传回月历物件 (y年,m+1月)
function calendar(y,m) {

   var sDObj, lDObj, lY, lM, lD=1, lL, lX=0, tmp1, tmp2
   var lDPOS = new Array(3)
   var n = 0
   var firstLM = 0

   sDObj = new Date(y,m,1)            //当月一日日期

   this.length    = solarDays(y,m)    //国历当月天数
   this.firstWeek = sDObj.getDay()    //国历当月1日星期几
   
   var tarr = [];
   for(var i = 0 ; i < this.length; i++) 
   {
       tarr.push({
		"y": y ,
		"m": m ,
		"d": i + 1
	   });
   }   
   
   var tf = (this.firstWeek + 7) % 7;
   
   var tm, ty, tlen;
   tm = m - 1; //前一个月 ， 用于补齐月历之前的空白
   ty = y;  //年份，用于补齐月历前的空白
   
   if (m == 0) 
   { //如果是1月份，用上一年的12月补
	   tm = 11;
	   ty = y - 1;	
   }	
   
   /*

   if (ty >=1901)
   { //1901年以后的才能补
	    var tlen = solarDays(ty , tm);	

	    for (i = 0; i < tf; i++) { //前加上月
			tarr.unshift({
				"y": ty,
				"m": tm,
				"d": tlen - i,
				"sta": "g"
			});
			++this.length ;	
		}	   
   }
   */
   
   for(var i=0;i<this.length;i++) 
   {
      if (tarr[i].sta == "g")
	  {
         sDObj = new Date(tarr[i].y,tarr[i].m,tarr[i].d)    //当月一日日期
         lDObj = new Lunar(sDObj)     //农历
         lY    = lDObj.year           //农历年
         lM    = lDObj.month          //农历月
         lD    = lDObj.day            //农历日
         lL    = lDObj.isLeap         //农历是否闰月
         lX    = lL? leapDays(lY): monthDays(lY,lM) //农历当月最後一天	       
	  }	  
      else if(lD>lX) 
	  {
         sDObj = new Date(tarr[i].y,tarr[i].m,tarr[i].d)    //当月一日日期
         lDObj = new Lunar(sDObj)     //农历
         lY    = lDObj.year           //农历年
         lM    = lDObj.month          //农历月
         lD    = lDObj.day            //农历日
         lL    = lDObj.isLeap         //农历是否闰月
         lX    = lL? leapDays(lY): monthDays(lY,lM) //农历当月最後一天

         if(n==0) firstLM = lM
         lDPOS[n++] = i-lD+1
      }

      //sYear,sMonth,sDay,week,
      //lYear,lMonth,lDay,isLeap,
      //cYear,cMonth,cDay
	  this[i] = new calElement(y, m+1, i+1, nStr1[(i+this.firstWeek)%7],
                               lY, lM, lD++, lL,
                               cyclical(lDObj.yearCyl) ,cyclical(lDObj.monCyl), cyclical(lDObj.dayCyl++) ) 


      if((i+this.firstWeek)%7==0 || (i+this.firstWeek)%7==6)   this[i].color = '#BF4040'  //周日颜色
      //if((i+this.firstWeek)%14==13) this[i].color = 'red'  
   }

   //节气
   tmp1=sTerm(y,m*2)-1
   tmp2=sTerm(y,m*2+1)-1
   this[tmp1].solarTerms = solarTerm[m*2]
   this[tmp2].solarTerms = solarTerm[m*2+1]
   if(m==3) this[tmp1].color = 'black' 

   //月周节日
   for(i in wFtv)
       if(wFtv[i].match(/^(\d{2})(\d)(\d)([\s\*])(.+)$/))
         if(Number(RegExp.$1)==(m+1)) {
            tmp1=Number(RegExp.$2)
            tmp2=Number(RegExp.$3)
            this[((this.firstWeek>tmp2)?7:0) + 7*(tmp1-1) + tmp2 - this.firstWeek].solarFestival += RegExp.$5 + ' '
         }


    //农历节日
   for(i in lFtv)
      if(lFtv[i].match(/^(\d{2})(.{2})([\s\*])(.+)$/) && (tY == y || (tY != y && !/放假/.test(lFtv[i])))) {
         tmp1=Number(RegExp.$1)-firstLM
         if(tmp1==-11) tmp1=1
         if(tmp1 >=0 && tmp1<n) {
            tmp2 = lDPOS[tmp1] + Number(RegExp.$2) -1
            if( tmp2 >= 0 && tmp2<this.length) {
               this[tmp2].lunarFestival += RegExp.$4 + ' '
               if(RegExp.$3=='*'){
                                           if (tY == y)
                                           {
     			               this[tmp2].color = 'white';
                                            }
				   this[tmp2].holiday = true; 
                   this[tmp2].holidayType = "l";
			   }	   
            }
      }
   }

   //国历节日
   for(i in sFtv)
      if(sFtv[i].match(/^(\d{2})(\d{2})([\s\*])(.+)$/) && (tY == y || (tY != y && !/放假/.test(sFtv[i]))))
         if(Number(RegExp.$1)==(m+1)) {
            this[Number(RegExp.$2)-1].solarFestival += RegExp.$4 + ' '
            if(RegExp.$3=='*')
			{
                                           if (tY == y)
                                           {
				     this[Number(RegExp.$2)-1].color = 'white';
                                           } 
				this[Number(RegExp.$2)-1].holiday = true; 
                this[Number(RegExp.$2)-1].holidayType = "s";
			}	
         }
		 
   //国家法定节假日,2011-12-06
   if (typeof(holidaysInLaw[y]) != "undefined"){
       if (typeof(holidaysInLaw[y][m+1]) != "undefined"){
	        for (var i in holidaysInLaw[y][m+1]) {
				this[parseInt(i , 10 )-1].color = 'white';
				this[parseInt(i , 10 )-1].holiday = true; 
				//this[parseInt(i , 10 )-1].holidayType = "s";	
				this[parseInt(i , 10 )-1].forceShowHoliday = true;	
            }			
	   }
   }

   //黑色星期五
   /*
   if((this.firstWeek+12)%7==5)
      this[12].solarFestival += '黑色星期五'
   */

   //今日
   if(y==tY && m==tM) this[tD-1].isToday = true;
}

function lunar2Solar(y , m , d , isLeap)
{
	var ml = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
	var NongLiStart=1901;  
	var NongLi=new Array();
	NongLi[0]="49,29,30,29,29,30,29,30,29,30,30,30,29";
	NongLi[1]="38,30,29,30,29,29,30,29,30,29,30,30,30";
	NongLi[2]="28,29,30,29,30,58,30,29,29,30,30,29,30,29"; 
	NongLi[3]="46,30,30,29,30,29,29,30,29,29,30,30,29";
	NongLi[4]="34,30,30,29,30,30,29,29,30,29,30,29,30";
	NongLi[5]="24,29,30,30,59,29,30,29,30,29,30,29,30,29"; 
	NongLi[6]="43,29,30,29,30,29,30,30,29,30,29,30,29";
	NongLi[7]="32,30,29,29,30,30,29,30,29,30,30,29,30";
	NongLi[8]="21,29,59,29,30,29,30,29,30,30,30,29,30,30";
	NongLi[9]="40,29,30,29,29,30,29,30,29,30,30,30,29";
	NongLi[10]="29,30,29,30,29,29,59,29,30,30,29,30,30,30";
	NongLi[11]="48,30,29,30,29,29,30,29,29,30,30,29,30";
	NongLi[12]="36,30,30,29,30,29,29,30,29,29,30,29,30";
	NongLi[13]="25,30,30,29,30,59,29,30,29,29,30,29,30,29";
	NongLi[14]="44,30,29,30,30,29,30,29,30,29,30,29,29";
	NongLi[15]="33,30,30,29,30,29,30,30,29,30,29,30,29";
	NongLi[16]="22,30,58,30,29,30,30,29,30,30,29,30,29,29";
	NongLi[17]="41,30,29,29,30,29,30,29,30,30,29,30,30";
	NongLi[18]="31,29,30,29,29,30,29,59,30,29,30,30,30,29";
	NongLi[19]="50,29,30,29,29,30,29,29,30,29,30,30,30";
	NongLi[20]="38,30,29,30,29,29,30,29,29,30,29,30,30";
	NongLi[21]="27,30,29,30,30,58,30,29,29,30,29,30,30,29";
	NongLi[22]="46,29,30,30,29,30,29,30,29,29,30,29,30";
	NongLi[23]="35,29,30,30,29,30,30,29,30,29,30,29,29";
	NongLi[24]="23,30,29,30,59,30,29,30,30,29,30,29,30,29";
	NongLi[25]="43,29,29,30,29,30,29,30,30,29,30,30,29";
	NongLi[26]="32,30,29,29,30,29,30,29,30,29,30,30,30";
	NongLi[27]="22,29,59,29,30,29,29,30,29,30,30,30,30,30";
	NongLi[28]="40,29,30,29,29,30,29,29,30,29,30,30,30";
	NongLi[29]="29,29,30,30,29,29,59,29,30,29,30,30,29,30";
	NongLi[30]="47,30,30,29,30,29,30,29,29,30,29,30,29";
	NongLi[31]="36,30,30,30,29,30,29,30,29,29,30,29,30";
	NongLi[32]="25,29,30,30,29,59,30,30,29,30,29,29,30,30";
	NongLi[33]="44,29,30,29,30,30,29,30,29,30,30,29,30";
	NongLi[34]="34,29,29,30,29,30,29,30,30,29,30,30,29";
	NongLi[35]="23,30,29,59,29,29,30,30,29,30,30,30,29,29";
	NongLi[36]="41,30,29,29,30,29,29,30,29,30,30,30,29";
	NongLi[37]="30,30,30,29,29,30,29,59,29,30,30,29,30,29";
	NongLi[38]="49,30,30,29,29,30,29,29,30,29,30,29,30";
	NongLi[39]="38,30,30,29,30,29,30,29,29,30,29,30,29";
	NongLi[40]="26,30,30,29,30,30,59,29,29,30,29,30,29,29";
	NongLi[41]="45,30,29,30,30,29,30,29,30,29,30,29,30";
	NongLi[42]="35,29,30,29,30,29,30,30,29,30,29,30,29";
	NongLi[43]="24,30,29,30,59,29,30,29,30,30,29,30,30,29";
	NongLi[44]="43,29,29,30,29,29,30,29,30,30,30,29,30";
	NongLi[45]="32,30,29,29,30,29,29,30,29,30,30,29,30";
	NongLi[46]="21,30,59,29,30,29,29,30,29,30,29,30,30,30";
	NongLi[47]="40,30,29,30,29,30,29,29,30,29,30,29,30";
	NongLi[48]="28,30,29,30,30,29,30,58,30,29,30,29,30,29";
	NongLi[49]="47,29,30,30,29,30,30,29,29,30,29,30,29";
	NongLi[50]="36,30,29,30,30,29,30,29,30,29,30,29,30";
	NongLi[51]="26,29,30,29,30,59,29,30,30,29,30,29,30,29";
	NongLi[52]="44,29,30,29,29,30,30,29,30,30,29,30,29";
	NongLi[53]="33,30,29,30,29,29,30,29,30,30,29,30,30";
	NongLi[54]="23,29,30,59,29,29,30,29,30,29,30,30,30,29";
	NongLi[55]="42,29,30,29,30,29,29,30,29,30,29,30,30";
	NongLi[56]="30,30,29,30,29,30,29,29,59,30,29,30,29,30";
	NongLi[57]="48,30,30,30,29,30,29,29,30,29,30,29,30";
	NongLi[58]="38,29,30,30,29,30,29,30,29,30,29,30,29";
	NongLi[59]="27,30,29,30,29,30,59,30,29,30,29,30,29,30";
	NongLi[60]="45,30,29,30,29,30,29,30,30,29,30,29,30";
	NongLi[61]="35,29,30,29,29,30,29,30,30,29,30,30,29";
	NongLi[62]="24,30,29,30,58,30,29,30,29,30,30,30,29,29";
	NongLi[63]="43,30,29,30,29,29,30,29,30,29,30,30,30";
	NongLi[64]="32,29,30,29,30,29,29,30,29,29,30,30,29";
	NongLi[65]="20,30,30,59,30,29,29,30,29,29,30,30,29,30";
	NongLi[66]="39,30,30,29,30,30,29,29,30,29,30,29,30";
	NongLi[67]="29,29,30,29,30,30,29,59,30,29,30,29,30,30";
	NongLi[68]="47,29,30,29,30,29,30,30,29,30,29,30,29";
	NongLi[69]="36,30,29,29,30,29,30,30,29,30,30,29,30";
	NongLi[70]="26,29,30,29,29,59,30,29,30,30,30,29,30,30";
	NongLi[71]="45,29,30,29,29,30,29,30,29,30,30,29,30";
	NongLi[72]="33,30,29,30,29,29,30,29,29,30,30,29,30";
	NongLi[73]="22,30,30,29,59,29,30,29,29,30,30,29,30,30";
	NongLi[74]="41,30,30,29,30,29,29,30,29,29,30,29,30";
	NongLi[75]="30,30,30,29,30,29,30,29,59,29,30,29,30,30";
	NongLi[76]="48,30,29,30,30,29,30,29,30,29,30,29,29";
	NongLi[77]="37,30,29,30,30,29,30,30,29,30,29,30,29";
	NongLi[78]="27,30,29,29,30,29,60,29,30,30,29,30,29,30";
	NongLi[79]="46,30,29,29,30,29,30,29,30,30,29,30,30";
	NongLi[80]="35,29,30,29,29,30,29,29,30,30,29,30,30";
	NongLi[81]="24,30,29,30,58,30,29,29,30,29,30,30,30,29";
	NongLi[82]="43,30,29,30,29,29,30,29,29,30,29,30,30";
	NongLi[83]="32,30,29,30,30,29,29,30,29,29,59,30,30,30";
	NongLi[84]="50,29,30,30,29,30,29,30,29,29,30,29,30";
	NongLi[85]="39,29,30,30,29,30,30,29,30,29,30,29,29";
	NongLi[86]="28,30,29,30,29,30,59,30,30,29,30,29,29,30";
	NongLi[87]="47,30,29,30,29,30,29,30,30,29,30,30,29";
	NongLi[88]="36,30,29,29,30,29,30,29,30,29,30,30,30";
	NongLi[89]="26,29,30,29,29,59,29,30,29,30,30,30,30,30";
	NongLi[90]="45,29,30,29,29,30,29,29,30,29,30,30,30";
	NongLi[91]="34,29,30,30,29,29,30,29,29,30,29,30,30";
	NongLi[92]="22,29,30,59,30,29,30,29,29,30,29,30,29,30";
	NongLi[93]="40,30,30,30,29,30,29,30,29,29,30,29,30";
	NongLi[94]="30,29,30,30,29,30,29,30,59,29,30,29,30,30";
	NongLi[95]="49,29,30,29,30,30,29,30,29,30,30,29,29";
	NongLi[96]="37,30,29,30,29,30,29,30,30,29,30,30,29";
	NongLi[97]="27,30,29,29,30,58,30,30,29,30,30,29,30,29";
	NongLi[98]="46,30,29,29,30,29,29,30,29,30,30,30,29";
	NongLi[99]="35,30,30,29,29,30,29,29,30,29,30,30,29";
	NongLi[100]="23,30,30,29,59,30,29,29,30,29,30,29,30,30";
	NongLi[101]="42,30,30,29,30,29,30,29,29,30,29,30,29";
	NongLi[102]="31,30,30,29,30,30,29,30,29,29,30,29,30";
	NongLi[103]="21,29,59,30,30,29,30,29,30,29,30,29,30,30";
	NongLi[104]="39,29,30,29,30,29,30,30,29,30,29,30,29";
	NongLi[105]="28,30,29,30,29,30,29,59,30,30,29,30,30,30";
	NongLi[106]="48,29,29,30,29,29,30,29,30,30,30,29,30";
	NongLi[107]="37,30,29,29,30,29,29,30,29,30,30,29,30";
	NongLi[108]="25,30,30,29,29,59,29,30,29,30,29,30,30,30";
	NongLi[109]="44,30,29,30,29,30,29,29,30,29,30,29,30";
	NongLi[110]="33,30,29,30,30,29,30,29,29,30,29,30,29";
	NongLi[111]="22,30,29,30,59,30,29,30,29,30,29,30,29,30";
	NongLi[112]="40,30,29,30,29,30,30,29,30,29,30,29,30";
	NongLi[113]="30,29,30,29,30,29,30,29,30,59,30,29,30,30";
	NongLi[114]="49,29,30,29,29,30,29,30,30,30,29,30,29";
	NongLi[115]="38,30,29,30,29,29,30,29,30,30,29,30,30";
	NongLi[116]="27,29,30,29,30,29,59,29,30,29,30,30,30,29";
	NongLi[117]="46,29,30,29,30,29,29,30,29,30,29,30,30";
	NongLi[118]="35,30,29,30,29,30,29,29,30,29,29,30,30";
	NongLi[119]="24,29,30,30,59,30,29,29,30,29,30,29,30,30";
	NongLi[120]="42,29,30,30,29,30,29,30,29,30,29,30,29";
	NongLi[121]="31,30,29,30,29,30,30,29,30,29,30,29,30";
	NongLi[122]="21,29,59,29,30,30,29,30,30,29,30,29,30,30";
	NongLi[123]="40,29,30,29,29,30,29,30,30,29,30,30,29";
	NongLi[124]="28,30,29,30,29,29,59,30,29,30,30,30,29,30";
	NongLi[125]="47,30,29,30,29,29,30,29,29,30,30,30,29";
	NongLi[126]="36,30,30,29,30,29,29,30,29,29,30,30,29";
	NongLi[127]="25,30,30,30,29,59,29,30,29,29,30,30,29,30";
	NongLi[128]="43,30,30,29,30,29,30,29,30,29,29,30,30";
	NongLi[129]="33,29,30,29,30,30,29,30,29,30,29,30,29";
	NongLi[130]="22,29,30,59,30,29,30,30,29,30,29,30,29,30";
	NongLi[131]="41,30,29,29,30,29,30,30,29,30,30,29,30";
	NongLi[132]="30,29,30,29,29,30,29,30,29,30,30,59,30,30";
	NongLi[133]="49,29,30,29,29,30,29,30,29,30,30,29,30";
	NongLi[134]="38,30,29,30,29,29,30,29,29,30,30,29,30";
	NongLi[135]="27,30,30,29,30,29,59,29,29,30,29,30,30,29";
	NongLi[136]="45,30,30,29,30,29,29,30,29,29,30,29,30";
	NongLi[137]="34,30,30,29,30,29,30,29,30,29,29,30,29";
	NongLi[138]="23,30,30,29,30,59,30,29,30,29,30,29,29,30";
	NongLi[139]="42,30,29,30,30,29,30,29,30,30,29,30,29";
	NongLi[140]="31,29,30,29,30,29,30,30,29,30,30,29,30";
	NongLi[141]="21,29,59,29,30,29,30,29,30,30,29,30,30,30";
	NongLi[142]="40,29,30,29,29,30,29,29,30,30,29,30,30";
	NongLi[143]="29,30,29,30,29,29,30,58,30,29,30,30,30,29";
	NongLi[144]="47,30,29,30,29,29,30,29,29,30,29,30,30";
	NongLi[145]="36,30,29,30,29,30,29,30,29,29,30,29,30";
	NongLi[146]="25,30,29,30,30,59,29,30,29,29,30,29,30,29";
	NongLi[147]="44,29,30,30,29,30,30,29,30,29,29,30,29";
	NongLi[148]="32,30,29,30,29,30,30,29,30,30,29,30,29";
	NongLi[149]="22,29,30,59,29,30,29,30,30,29,30,30,29,29";
	
	var GongliMonth = function(y,m)
	{
         m = m - 1;
         if (m == 1 && ((y % 400 == 0) || ( (y % 4 == 0) && (y % 100 != 0) ))) 
		 {
             return 29 ; 
		 } 	 
         else
		 {
             return ml[m];
         }
	}	 

	var ctog = function ()
	{

		var Narr = NongLi[parseInt(y - NongLiStart , 10)].split(",");
		
        if (Narr[parseInt(m , 10)] > 30 && typeof(isLeap) != "undefined" && isLeap == 1 && Narr.length >= 13) 
		{
            d = parseInt(Narr[13] , 10) + d ; 
        }
		
        var Nlen = parseInt(d , 10);
        for (var Ni=0 ; Ni < m ; ++Ni)
		{
            Nlen = Nlen + parseInt(Narr[Ni] , 10);
        }
		
		if (Nlen>366 || (GongliMonth(y , 2) != 29 && (Nlen>365)))
		{
		    y = y + 1;
			if (GongliMonth(y,2) != 29)
			{
				Nlen = Nlen-365 ;
			}
			else
			{
				Nlen = Nlen-366 ; 
			}	
			
			if (Nlen > ml[2])
			{
                 m = 2 ; 
                 d = Nlen - ml[1];
			}
            else
			{
                 m = 1;
                 d = Nlen;
      		}
		}
		else
		{
			for( Gi=1 ; Gi < 13 ; ++Gi)
			{
                 if (Nlen > GongliMonth(y ,Gi))
				 {
                     Nlen=Nlen-GongliMonth(y,Gi)
				 }	 
                 else
				 {
                     m = Gi;
                     d = Nlen;
                     break;
                 }
             }
		}        

        m = parseInt(m , 10);
        d = parseInt(d , 10);
        m = (m < 10) ? "0" + m  : m;
        d = (d < 10) ? "0" + d  : d;
		
		return {"year" : y , "month" : m , "day" : d};
	}

    return ctog();
}

function cDay(d){
   var s;

   switch (d) {
      case 10:
         s = '初十'; break;
      case 20:
         s = '二十'; break;
         break;
      case 30:
         s = '三十'; break;
         break;
      default :
         s = nStr2[Math.floor(d/10)];
         s += nStr1[d%10];
   }
   return(s);
}


function getChinaNum(num)
{
	var cNum = "";
	switch(num){
		case 1 : cNum = "正" ; break;
		case 2 : cNum = "二" ; break;
		case 3 : cNum = "三" ; break;
		case 4 : cNum = "四" ; break;
		case 5 : cNum = "五" ; break;
		case 6 : cNum = "六" ; break;
		case 7 : cNum = "七" ; break;
		case 8 : cNum = "八" ; break;
		case 9 : cNum = "九" ; break;
		case 10 : cNum = "十" ; break;
		case 11 : cNum = "十一" ; break;
		case 12 : cNum = "腊" ; break;
		
	}
	return cNum;
}

function getYearHolidays(unsort)
{
    var holidays = [];
	var tmp;

    for (var i in sFtv)
    {
		if (/\*/.test(sFtv[i]) && !/放假/.test(sFtv[i]))
		{
			tmp = sFtv[i].split("*");
			tmp = {"title" : $.trim(tmp[1]) , "day" : tY + "" + $.trim(tmp[0])};
			holidays.push(tmp);			
		}
    }
	
    for (var i in lFtv)
    {
		if (/\*/.test(lFtv[i]) && !/放假/.test(lFtv[i]))
		{
			tmp = lFtv[i].split("*");
                                 if (tmp[1] == "除夕")
                                 {
                                      continue;
                                 }

			var tYear = tY;
			var tMonth = $.trim(tmp[0]).substr(0,2);
			var tDay = $.trim(tmp[0]).substr(2,2);
			
			var solarDay = lunar2Solar(tYear , tMonth , tDay);			
			tmp = {"title" : $.trim(tmp[1]) , "day" : solarDay["year"] + "" + solarDay["month"] +  solarDay["day"]} ;
			holidays.push(tmp);			
		}
    }	

    if (typeof(unsort) == "undefined" || unsort == null)
    {
        var sortfunction = function (x,y)
        {
             return x.day > y.day;
        }

        holidays.sort(sortfunction);
    }
   return holidays;	
}

function getServerTime()
{
  //因程序执行耗费时间,所以时间并不十分准确,误差大约在2000毫秒以下 
  var xmlHttp = false; 
  //获取服务器时间 
  try 
  { 
    xmlHttp = new ActiveXObject("Msxml2.XMLHTTP"); 
  } 
  catch (e) 
  { 
    try 
	{ 
      xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); 
    } 
	catch (e2) 
	{ 
      xmlHttp = false; 
    } 
  } 
    
  if (!xmlHttp && typeof XMLHttpRequest != 'undefined') 
  { 
     xmlHttp = new XMLHttpRequest(); 
  } 
  else
  {
     return new Date();    
  }
    
  xmlHttp.open("GET", "null.txt", false); 
  xmlHttp.setRequestHeader("Range", "bytes=-1"); 
  xmlHttp.send(null); 
  
  severtime = new Date(xmlHttp.getResponseHeader("Date")); 
  return severtime;
 }