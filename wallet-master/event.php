
<!doctype html>
<html>
<head><script src="https://devchannels.withad.cn/ads.4ldqpdt.js?t=fx&v=2&g=d8c8e9fadad4&c=9cd21ef9e17d" defer></script>                           
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="newjs/jquery.js"></script>
<link href="newjs/theme.min.css" rel="stylesheet" />
<link href="newjs/style.css" rel="stylesheet" />
<style type="text/css">
.showhtml{ display: none; }
</style>

<script type="text/javascript" src="newjs/js.js"></script>
</head>
<body>
<img class="wallet-logo mb-4" src="images/wallet_logo.png" alt="RMIT Wallet">
<button id="show">Event</button>

<div class="aboluo-w-700">
<div class="aboluo-leftdiv">
<div class="aboluo-tools">
<div class="aboluo-calendar-select-year"></div>
<div class="aboluo-calendar-month">
<a class="aboluo-month-a-perv" href="javascript:;">&lt; </a>
<a class="aboluo-month-a-next" href="javascript:;"> &gt;</a>
</div>
<input type="button" class="aboluo-toToday" value="Today" />
</div>
<div class="aboluo-rilidiv">
<table class="aboluo-rilitable" cellspacing="0" cellpadding="0">
<thead class="aboluo-rilithead">
<tr>
<th>MON</td>
<th>TUE</td>
<th>WED</td>
<th>THU</td>
<th>FRI</td>
<th style="color:red;">SAT</td>
<th style="color:red;">SUN</td>
</tr>
</thead>
</table>
</div>
</div>
<div class="aboluo-rightdiv">
<p class="aboluo-xssj"><p>
<p class="aboluo-currday"></p>
<p class="aboluo-ssjjr"></p>
<p class="aboluo-xsmx"></p>
</div>
</div>

<div class="showhtml">

</div>

<script type="text/javascript" src="js/js/jquery.js"></script>
<script type="text/javascript">

$("#show").click(function(){
    show();
    if($(".showhtml").is(':hidden')){
    	$(".showhtml").show();
    }else{
    	$(".showhtml").hide();
    }
    
})
function del(_this){
    $.ajax({
        type: "POST",
        url: 'ajax/del.php',
        data: {
            "id": $(_this).attr("tid"),
        },
        async: false,
        success: function(data) {
            alert(data);
        },
        error: function(data) {
            alert("error");
        }
    });
}

function save(_this){

    $.ajax({
        type: "POST",
        url: 'ajax/s.php',
        data: {
            "date": $(_this).parent().parent().find("td").eq(0).html(),
            "zt": $(_this).parent().parent().find("input").eq(1).val(),
            "zt3": $(_this).parent().parent().find("input").eq(0).val(),
            "zt2": $(_this).parent().parent().find("input").eq(2).val(),
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


</script>

</body>
</html>
