$(function(){var jjrmodelidlist;var jjrmodeltimelist;var jjrmodelztlist;createSelectYear();createMonthSelect();getjjrszModelByYear(withID("aboluo-yearSelect").value);createTabledate(parseInt(withID("aboluo-yearSelect").value),parseInt(withID("aboluo-selectmonth").value));leftrightclick();setRigth(new Date().getFullYear(),new Date().getMonth()+1,new Date().getDate());});function stopBubble(e){if(e&&e.stopPropagation){e.stopPropagation();}else{window.event.cancelBubble=true;}}
function createSelectYear(){withClass("aboluo-calendar-select-year").innerHTML='<select name="aboluo-yearSelect" id="aboluo-yearSelect"></select>';var yearSelect=withID("aboluo-yearSelect");var Nowtime=new Date();var currYear=Nowtime.getFullYear();for(var i=0;i<=79;i++){yearSelect.options.add(new Option((i+1970),i+1970));if(currYear==i+1970){yearSelect.options[i].selected=true;}}
yearSelect.onchange=function(e){var aclick=withClass("aboluo-aclick");getjjrszModelByYear(withID("aboluo-yearSelect").value);createTabledate(withID("aboluo-yearSelect").value,withID("aboluo-selectmonth").value);if(aclick==""){var pervdays1=getCurrMonthLashDay(withID("aboluo-yearSelect").value,withID("aboluo-selectmonth").value);if(new Date().getDate()>pervdays1){setRigth(withID("aboluo-yearSelect").value,withID("aboluo-selectmonth").value,pervdays1);}else{setRigth(withID("aboluo-yearSelect").value,withID("aboluo-selectmonth").value,new Date().getDate());}}else{var adate=aclick.getAttribute("date");var aarr=adate.split("-");aarr[0]=parseInt(aarr[0]);aarr[1]=parseInt(aarr[1]);aarr[2]=parseInt(aarr[2]);var pervdays=getCurrMonthLashDay(withID("aboluo-yearSelect").value,withID("aboluo-selectmonth").value);if(aarr[2]>pervdays){aarr[2]=pervdays;}
setRigth(withID("aboluo-yearSelect").value,withID("aboluo-selectmonth").value,aarr[2]);}};}
function getjjrszModelByYear(year){jjrmodelidlist=['1','2'];jjrmodeltimelist=['2015-08-30 00:00:00','2015-08-31 00:00:00'];jjrmodelztlist=['1','2'];}
function createMonthSelect(){var selectmonth=newElement('select');selectmonth.name="aboluo-selectmonth";selectmonth.id="aboluo-selectmonth";selectmonth.onchange=function(e){var aclick=withClass("aboluo-aclick");createTabledate(withID("aboluo-yearSelect").value,selectmonth.options[selectmonth.selectedIndex].value);if(aclick==""){var pervdays1=getCurrMonthLashDay(withID("aboluo-yearSelect").value,selectmonth.options[selectmonth.selectedIndex].value);if(new Date().getDate()>pervdays1){setRigth(withID("aboluo-yearSelect").value,selectmonth.options[selectmonth.selectedIndex].value,pervdays1);}else{setRigth(withID("aboluo-yearSelect").value,selectmonth.options[selectmonth.selectedIndex].value,new Date().getDate());}}else{var adate=aclick.getAttribute("date");var aarr=adate.split("-");aarr[0]=parseInt(aarr[0]);aarr[1]=parseInt(aarr[1]);aarr[2]=parseInt(aarr[2]);var pervdays=getCurrMonthLashDay(withID("aboluo-yearSelect").value,selectmonth.options[selectmonth.selectedIndex].value);if(aarr[2]>pervdays){aarr[2]=pervdays;}
setRigth(withID("aboluo-yearSelect").value,selectmonth.options[selectmonth.selectedIndex].value,aarr[2]);}};var Nowtime=new Date();var currMonth=Nowtime.getMonth();for(var i=0;i<12;i++){selectmonth.options.add(new Option((i+1),i+1));if(currMonth==i){selectmonth.options[i].selected=true;}}
var next=withClass("aboluo-month-a-next");var parent=next.parentNode;parent.insertBefore(selectmonth,next);}
function createTabledate(year,yue){var rilitabledele=withClass("aboluo-rilitbody");if(rilitabledele!=""&&rilitabledele!=null&&rilitabledele!='undefined'){rilitabledele.parentNode.removeChild(rilitabledele);}
var rilitable=newElement('tbody');rilitable.setAttribute("class","aboluo-rilitbody");var rili=withClass("aboluo-rilitable");rili.appendChild(rilitable);var date=setdateinfo(year,yue,1);var weekday=date.getDay();var pervLastDay;if(weekday!=0){pervLastDay=weekday-1;}else{pervLastDay=weekday+6;}
var pervMonthlastDay=getPervMonthLastDay(year,yue);var lastdays=pervMonthlastDay-pervLastDay+1;var tr=newElement('tr');tr.style.borderBottom="1px solid #e3e4e6";for(var i=lastdays;i<=pervMonthlastDay;i++){var td=newElement("td");var a=getA(parseInt(yue)-1==0?parseInt(year)-1:year,parseInt(yue)-1==0?12:parseInt(yue)-1,i);a.style.color="#BFBFC5";td.appendChild(a);td.setAttribute("class","aboluo-pervMonthDays");tr.appendChild(td);}
var startDays=8-weekday==8?1:8-weekday;for(var i=1;i<=startDays;i++){var td=newElement("td");var b=getA(year,yue,i);td.appendChild(b);tr.appendChild(td);}
rilitable.appendChild(tr);var currMonthLashDay=getCurrMonthLashDay(year,yue);var currmonthStartDay=currMonthLashDay-(currMonthLashDay-startDays)+1;var syts=currMonthLashDay-startDays;var xhcs=0;if(check(syts/7)){xhcs=Math.ceil(syts/7);}else{xhcs=syts/7;}
var jilvn=1;for(var i=0;i<xhcs;i++){var tr1=newElement('tr');if(i!=xhcs-1){tr1.style.borderBottom="1px solid #e3e4e6";}
for(var n=1;n<=7;n++){var td=newElement('td');if(startDays==0){var c=getA(parseInt(yue)+1==parseInt(13)?parseInt(year)+1:year,parseInt(yue)+1==parseInt(13)?1:parseInt(yue)+1,jilvn);c.style.color="#BFBFC5";td.appendChild(c);td.setAttribute("class","aboluo-nextMonthDays");jilvn++;tr1.appendChild(td);continue;}else{startDays++;var d=getA(year,yue,startDays);td.appendChild(d);if(startDays==currMonthLashDay){startDays=0;}
tr1.appendChild(td);}}
rilitable.appendChild(tr1);}
setHolidayred();setTrHeight();setA();}
function pervA(year,yue,day){createTabledate(year,yue);setRigth(year,yue,day);updateSelect(year,yue);}
function nextA(year,yue,day){createTabledate(year,yue);setRigth(year,yue,day);updateSelect(year,yue);}
function updateSelect(year,yue){var selectmonth=withID("aboluo-selectmonth");var selectyear=withID("aboluo-yearSelect");selectmonth.value=yue;selectyear.value=year;}
function setHolidayred(){var rows=withClass("aboluo-rilitbody").rows;for(var i=0;i<rows.length;i++){for(var j=0;j<rows[i].cells.length;j++){var cell=rows[i].cells[j];var a=rows[i].cells[j].childNodes[0];var adate=a.getAttribute("date");var arr=adate.split("-");var date=new Date();var year=date.getFullYear();var month=date.getMonth();var day=date.getDate();if(arr[0]==year&&arr[1]==month+1&&arr[2]==day){cell.setAttribute("class","aboluo-tdcurrToday");a.setAttribute("class","aboluo-currToday");}
if(j>=rows[i].cells.length-2){if(cell.getAttribute("class")!="aboluo-nextMonthDays"&&cell.getAttribute("class")!="aboluo-pervMonthDays"){a.style.color="red";}}}}}

function setRigth(year, yue, day) {
    withClass("aboluo-xssj").innerHTML = "";
    withClass("aboluo-ssjjr").innerHTML = "";
    year = year.toString();
    yue = yue.toString();
    day = day.toString();
    var rigthdiv = withClass("aboluo-rightdiv");
    var w = withClass("aboluo-w-700");
    rigthdiv.style.marginLeft = (w.offsetWidth * 0.7 + 4) + "px";
    var span = newElement('span');
    var date = setdateinfo(year, yue, day);
    span.innerHTML = formatByYearyueday(year, yue, day);
    var span1 = newElement('span');
    var week = getWeek(date.getDay());
    span1.innerHTML = week;
    var aboluoxssj = withClass("aboluo-xssj");
    aboluoxssj.appendChild(span);
    aboluoxssj.appendChild(span1);
    var currday = withClass("aboluo-currday");
    currday.innerHTML = day;
    currday.style.lineHeight = currday.offsetHeight + "px";
    var szrq = withClass("aboluo-ssjjr");
    szrq.style.marginTop = "20px";
    var span2 = newElement('span');
    span2.innerHTML = "Event:";
    szrq.appendChild(span2);

    var szrqselect = newElement("input");
    szrqselect.style.width = (withClass("aboluo-rightdiv").offsetWidth * 0.9) + "px";
    szrqselect.value = "";
    szrq.appendChild(szrqselect);

    var span4 = newElement('span');
    span4.innerHTML = "Time:";
    szrq.appendChild(span4);

    var szrqselect3 = newElement("input");
    szrqselect3.style.width = (withClass("aboluo-rightdiv").offsetWidth * 0.9) + "px";
    szrqselect3.value = "";
    szrq.appendChild(szrqselect3);

    var span3 = newElement('span');
    span3.innerHTML = "Location:";
    szrq.appendChild(span3);

    var szrqselect2 = newElement("input");
    szrqselect2.style.width = (withClass("aboluo-rightdiv").offsetWidth * 0.9) + "px";
    szrqselect2.value = "";
    szrq.appendChild(szrqselect2);

    var szrqbutton = newElement('input');
    szrqbutton.type = "button";
    szrqbutton.className = "btn";
    szrqbutton.value = "add";
    szrqbutton.setAttribute("onclick", "javascript:aboluoSetrq();");
    szrq.appendChild(szrqbutton);
    setaclass(year, yue, day);
}

function formatByYearyueday(year,yue,day){year=year.toString();yue=yue.toString();day=day.toString();return year+"-"+(yue.length<2?'0'+yue:yue)+"-"+(day.length<2?'0'+day:day);}
function formatByDate(date){date=date.substring(0,10);var daxx=date.toString().split("-");return daxx[0]+"-"+(daxx[1].length<2?'0'+daxx[1]:daxx[1])+"-"+(daxx[2].length<2?'0'+daxx[2]:daxx[2]);}
function setA(){var tbody=withClass("aboluo-rilitbody");var arr=tbody.getElementsByTagName("a");for(var i=0;i<arr.length;i++){var date=arr[i].getAttribute("date");var datearr=date.split("-");if(arr[i].parentNode.className=="aboluo-pervMonthDays"){arr[i].setAttribute("onclick","javascript:pervA("+datearr[0]+","+datearr[1]+","+datearr[2]+",this);javascript:stopBubble(this);")}else if(arr[i].parentNode.className=="aboluo-nextMonthDays"){arr[i].setAttribute("onclick","javascript:nextA("+datearr[0]+","+datearr[1]+","+datearr[2]+",this);javascript:stopBubble(this);")}else{arr[i].setAttribute("onclick","javascript:setRigth("+datearr[0]+","+datearr[1]+","+datearr[2]+");javascript:stopBubble(this);");}
for(var n=0;n<jjrmodelidlist.length;n++){if(formatByDate(jjrmodeltimelist[n])==formatByDate(date)){if(jjrmodelztlist[n]==1){var span=newElement('span');span.setAttribute("class","aboluo-td-a-ban");arr[i].style.background="#f5f5f5";arr[i].setAttribute("ztid",jjrmodelidlist[n]);arr[i].setAttribute("jjrzt",jjrmodelztlist[n]);span.innerHTML="班";arr[i].appendChild(span);}else if(jjrmodelztlist[n]==2){var span=newElement('span');span.setAttribute("class","aboluo-td-a-xiu");arr[i].setAttribute("ztid",jjrmodelidlist[n]);arr[i].setAttribute("jjrzt",jjrmodelztlist[n]);arr[i].style.background="#fff0f0";span.innerHTML="休";arr[i].appendChild(span);}else if(jjrmodelztlist[n]==0){arr[i].setAttribute("ztid",jjrmodelidlist[n]);arr[i].setAttribute("jjrzt",jjrmodelztlist[n]);}}}}}
function setaclass(year,yue,day){var a=withClass("aboluo-aclick");a.className="";var date=new Date();var year1=date.getFullYear();var month1=date.getMonth();var day1=date.getDate();if(year1==year&&yue==month1+1&&day1==day){}else{var tbody=withClass("aboluo-rilitbody");var arr=tbody.getElementsByTagName("a");for(var i=0;i<arr.length;i++){var date=arr[i].getAttribute("date");var datearr=date.split("-");if(datearr[0]==year&&datearr[1]==yue&&datearr[2]==day){arr[i].setAttribute("class","aboluo-aclick");}}}}
function getAclickDomDate(){var aclick=withClass("aboluo-aclick");if(aclick==""){var date=new Date();return date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();}else{return aclick.getAttribute("date");}}
function getAclickDom(){var aclick=withClass("aboluo-aclick");if(aclick==""){return withClass("aboluo-currToday");}else{return aclick;}}
function newElement(val){return document.createElement(val);}
function setdateinfo(year,yue,day){var date=new Date();date.setFullYear(parseInt(year));date.setMonth(parseInt(yue)-1);date.setDate(parseInt(day));return date;}
function isweekend(year,yue,day){var date=new Date();date.setFullYear(year);date.setMonth(yue-1);date.setDate(day);var week=date.getDay();if(week==0||week==6){return true;}
return false;}
function getWeek(val){var weekxq=new Array();weekxq[0]="SUN";weekxq[1]="MON";weekxq[2]="TUE";weekxq[3]="WED";weekxq[4]="THU";weekxq[5]="FRI";weekxq[6]="SAT";return weekxq[val];}
function check(c){var r=/^[+-]?[1-9]?[0-9]*\.[0-9]*$/;return r.test(c);}
function getPervMonthLastDay(year,yue){return parseInt(new Date(year,yue-1,0).getDate());}
function getCurrMonthLashDay(year,yue){if(yue>=12){year=year+1;yue=yue-12;}
return parseInt(new Date(year,yue,0).getDate());}
function getA(year,yue,day){var a=newElement("a");a.href="javascript:;";a.innerHTML=day;a.style.textDecoration="none";a.setAttribute("date",year+"-"+yue+"-"+day);return a;}
function leftrightclick(){var lefta=withClass("aboluo-month-a-perv");var righta=withClass("aboluo-month-a-next");righta.onclick=function(){var monthselect=withID("aboluo-selectmonth");var monthvalue=parseInt(monthselect.value);var yearselect=withID("aboluo-yearSelect");var yearvalue=parseInt(yearselect.value)
if(monthvalue==12){yearvalue+=1;getjjrszModelByYear(yearvalue);monthvalue=1;}else{monthvalue+=1;}
monthselect.value=monthvalue;yearselect.value=yearvalue;var aclick=withClass("aboluo-aclick");createTabledate(yearselect.value,monthselect.value);if(aclick==""){var pervdays1=getCurrMonthLashDay(yearselect.value,monthselect.value+1);if(new Date().getDate()>pervdays1){setRigth(yearselect.value,monthselect.value,pervdays1);}else{setRigth(yearselect.value,monthselect.value,new Date().getDate());}}else{var adate=aclick.getAttribute("date");var aarr=adate.split("-");aarr[0]=parseInt(aarr[0]);aarr[1]=parseInt(aarr[1]);aarr[2]=parseInt(aarr[2]);var pervdays=getCurrMonthLashDay(aarr[0],aarr[1]+1);if(aarr[2]>pervdays){aarr[2]=pervdays;}
setRigth(aarr[1]+1==13?aarr[0]+1:aarr[0],aarr[1]+1==13?1:aarr[1]+1,aarr[2]);}}
lefta.onclick=function(){var monthselect=withID("aboluo-selectmonth");var monthvalue=parseInt(monthselect.value);var yearselect=withID("aboluo-yearSelect");var yearvalue=parseInt(yearselect.value)
if(monthvalue==1){yearvalue-=1;getjjrszModelByYear(yearvalue);monthvalue=12;}else{monthvalue-=1;}
monthselect.value=monthvalue;yearselect.value=yearvalue;var aclick=withClass("aboluo-aclick");createTabledate(yearselect.value,monthselect.value);if(aclick==""){var pervdays1=getPervMonthLastDay(yearselect.value,monthselect.value);if(new Date().getDate()>pervdays1){setRigth(yearselect.value,monthselect.value,pervdays1);}else{setRigth(yearselect.value,monthselect.value,new Date().getDate());}}else{var adate=aclick.getAttribute("date");var aarr=adate.split("-");aarr[0]=parseInt(aarr[0]);aarr[1]=parseInt(aarr[1]);aarr[2]=parseInt(aarr[2]);var pervdays=getPervMonthLastDay(aarr[0],aarr[1]);if(aarr[2]>pervdays){aarr[2]=pervdays;}
setRigth(aarr[1]-1==0?aarr[0]-1:aarr[0],aarr[1]-1==0?12:aarr[1]-1,aarr[2]);}}
var today=withClass("aboluo-toToday");today.onclick=function(){var monthselect=withID("aboluo-selectmonth");var yearselect=withID("aboluo-yearSelect");var date=new Date();monthselect.value=date.getMonth()+1;yearselect.value=date.getFullYear();getjjrszModelByYear(date.getFullYear());createTabledate(yearselect.value,monthselect.value);setRigth(date.getFullYear(),date.getMonth()+1,date.getDate());}}
function setTrHeight(){var table=withClass("aboluo-rilidiv");var thead=withClass("aboluo-rilithead");var tbody=withClass("aboluo-rilitbody");var tbodyheight=table.offsetHeight-thead.offsetHeight;var rows=tbody.getElementsByTagName('tr');for(var i=0;i<rows.length;i++){rows[i].style.height=(tbodyheight/rows.length-2)+"px";var tds=rows[i].getElementsByTagName("td");for(var j=0;j<tds.length;j++){var a=tds[j].childNodes[0];a.style.width=(tds[j].offsetWidth-10)+"px";a.style.height=(tds[j].offsetHeight-7)+"px";a.style.lineHeight=(tds[j].offsetHeight-7)+"px";}}}
function withID(id){return document.getElementById(id);}
function withClass(id){var targets=targets||document.getElementsByTagName("*");var list=[];for(var k in targets){var target=targets[k];if(target.className==id){return target;}}
return "";}

function aboluoSetrq() {
    var curra = getAclickDom();
    var date = curra.getAttribute("date");
    var ztid = curra.getAttribute("ztid");
    var jjrzt = curra.getAttribute("jjrzt");
    var szjjr = withClass("aboluo-ssjjr");
    var a = szjjr.childNodes[1];

    var date2 = date.split("-");
    var newdate = date2[2]+"/"+date2[1]+"/"+date2[0];

    $.ajax({
        type: "POST",
        url: 'ajax/s.php',
        data: {
            "date": newdate,
            "zt": szjjr.childNodes[1].value,
            "zt3": szjjr.childNodes[3].value,
            "zt2": szjjr.childNodes[5].value,
            "ztid": ztid,
            "jjrzt": jjrzt
        },
        async: false,
        success: function(data) {
            alert(data);
        }, 
        error: function(data) {
            alert("Fail to save");
        }
    });
}

function show() {
    $.ajax({
        type: "GET",
        url: 'ajax/show.php',
        async: false,
        success: function(data) {
            $(".showhtml").html(data);
        },
        error: function(data) {
            alert("Fail to require");
        }
    });
}

