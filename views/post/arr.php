

<!--[if lte IE 8]><SCRIPT src='source/excanvas.js'></script><![endif]--><SCRIPT src='/ChartNew.js-master/ChartNew.js'></script>
<SCRIPT src='/ChartNew.js-master/Add-ins/format.js'></script>
<SCRIPT src='/ChartNew.js-master/Add-ins/stats.js'></script>
<SCRIPT>
function label_by_data(v2,v3) {
        money_per_man = Math.round(v3/v2);
        city = '';
        <?=$func_txt?>
        //return(city + ' (' + money_per_man + ' руб/чел)');
        return(city);
    }

var charJSPersonalDefaultOptions = { decimalSeparator : "," , thousandSeparator : ".", roundNumber : "none", graphTitleFontSize: 2 };

//defCanvasWidth=3000;
//  defCanvasHeight=2000;
defCanvasWidth=1200;
defCanvasHeight=500;

var mydata1 = {
	labels : [<?=$Xlabels?>],        
    	xBegin : <?=$min_g?>,
    	xEnd : <?=$max_g?>,
        

	datasets : [
		{
			pointColor : "black",
			strokeColor : "rgba(0,0,0,0)",
			pointStrokeColor : "black",
			data : [<?=$YData?>],
	      		xPos : [<?=$XData?>],                        
      			title : "МО"
		},
		{
			pointColor : "rgba(0,0,0,0)",
			strokeColor : "red",
			pointStrokeColor : "rgba(0,0,0,0)",
			//data : ["<%=#linear_regression_b0#+new Date(2015,5,1,0,0,0).getTime()*#linear_regression_b1#%>",,,"<%=#linear_regression_b0#+new Date(2015,6,1,0,0,0).getTime()*#linear_regression_b1#%>"],
                        data : [<?=$YLine?>],
                        //data : [11582678.804398,22463377.075195,32683387.784958,42284003.90625,51292754.087448,59755519.40918,67704416.627884,75171562.5,82121169.782639,88649588.745117,94781595.170975,100541964.84375,105947214.95247,111024874.14551,115794212.47673,120274500,124135392.9348,127762292.3584,131168962.59499,134369167.96875,137372084.69582,140193006.46973,142842638.87596,145331687.5,147648223.26088,149824362.91504,151868365.05699,153788488.28125,155590238.31749,157282791.38184,158872570.82558,160366000],                        
                        xPos : [<?=$XLine?>],
                        //data : [31,31,31,31,26.25390625,22.5625,22.5625,19.71484375,17.5,17.5,17.5,15.91796875,14.6875,14.6875,13.73828125],
                        
      			title : "Граница эффективности"
		}
	]
};           


var opt1 = {
      canvasBorders : true,
      canvasBordersWidth : 3,
      canvasBordersColor : "black",
      datasetFill : false,
      graphTitle : <?='"'.$title.'"'?>,
      animations: false,
      graphTitleFontSize: 18,
      graphMin : <?=$graphMin?>,
      graphMax : <?=$graphMax?>,
      yAxisMinimumInterval : 5,
      thousandSeparator : "",
      decimalSeparator : ".",
      bezierCurve: false,
      annotateDisplay: true,
      inGraphDataShow : true,
      inGraphDataTmpl : "<%=(v1 == 'Граница эффективности' ? '' : label_by_data(v2,v3))%>",
} ;


stats(mydata1,opt1);

</SCRIPT>

<h3>Красноярский край (2017 год). Граница эффективности</h3>
<p><b>Источник данных:</b> сайты муниципальных образований<p>
<h4>Расходы на аппарат/Население. Группы по бюджетной обеспеченности</h4>
<OL>
    <li><a href="?job=1">Группа от 20 тыс.руб. до 35 тыс. руб. на одного жителя</a></li>
    <li><a href="?job=2">Группа от 35 тыс.руб. до 50 тыс. руб. на одного жителя</a></li>
    <li><a href="?job=3">Группа от 50 тыс.руб. до 65 тыс. руб. на одного жителя</a></li>    
</OL>
<h4>Расходы на аппарат/Бюджетная обеспеченность. Группы по населению</h4>
<OL>
    <li><a href="?job=4">Группа до 20 тыс.чел.</a></li>
    <li><a href="?job=5">Группа от 20 тыс.чел. дт 30 тыс.чел.</a></li>
    <li><a href="?job=6">Группа от 30 тыс.чел.</a></li>    
</OL>
<script>

document.write("<canvas id=\"canvas_Line1\" height=\""+defCanvasHeight+"\" width=\""+defCanvasWidth+"\"></canvas>");
window.onload = function() {


    var myLine = new Chart(document.getElementById("canvas_Line1").getContext("2d")).Line(mydata1,opt1);
}
</script>


<table class="table table-sm table-striped table table-bordered table-hover ">
<thead class="thead-inverse">
<tr>
<th>МО</th>
<th>Всего расходов</th>
<th>Население</th>
<th>Обеспеченность</th>
<th>Расходы на аппарат</th>
</tr>
</thead>
<tbody>
<tr>
<td>Тюхтетский район</td>
<td>396 612 700,00</td>
<td>8 151</td>
<td>48 658,16</td>
<td>26 007 800,00</td>
</tr>
<tr>
<td>Бирилюсский район</td>
<td>506 325 200,00</td>
<td>9 844</td>
<td>51 434,90</td>
<td>27 758 000,00</td>
</tr>
<tr>
<td>Боготольский район</td>
<td>483 599 400,00</td>
<td>10 038</td>
<td>48 176,87</td>
<td>23 449 500,00</td>
</tr>
<tr>
<td>Идринский район</td>
<td>523 261 027,00</td>
<td>11 411</td>
<td>45 855,84</td>
<td>22 829 937,64</td>
</tr>
<tr>
<td>Тасеевский район</td>
<td>493 410 167,35</td>
<td>11 632</td>
<td>42 418,34</td>
<td>28 134 418,75</td>
</tr>
<tr>
<td>Новоселовский район</td>
<td>684 392 500,00</td>
<td>13 102</td>
<td>52 235,73</td>
<td>23 922 100,00</td>
</tr>
<tr>
<td>Дзержинский район</td>
<td>462 698 674,00</td>
<td>13 375</td>
<td>34 594,29</td>
<td>28 109 750,00</td>
</tr>
<tr>
<td>Краснотуранский район</td>
<td>715 240 462,53</td>
<td>14 152</td>
<td>50 539,89</td>
<td>34 159 067,00</td>
</tr>
<tr>
<td>Мотыгинский район</td>
<td>888 253 820,00</td>
<td>14 598</td>
<td>60 847,64</td>
<td>10 261 940,00</td>
</tr>
<tr>
<td>Каратузский район</td>
<td>760 179 050,00</td>
<td>15 172</td>
<td>50 104,08</td>
<td>28 839 840,00</td>
</tr>
<tr>
<td>Ачинский район</td>
<td>703 653 856,96</td>
<td>15 390</td>
<td>45 721,50</td>
<td>25 954 980,00</td>
</tr>
<tr>
<td>Манский район</td>
<td>660 832 281,87</td>
<td>15 780</td>
<td>41 877,84</td>
<td>27 911 313,34</td>
</tr>
<tr>
<td>Большемуртинский район</td>
<td>533 039 300,00</td>
<td>18 277</td>
<td>29 164,49</td>
<td>32 965 800,00</td>
</tr>
<tr>
<td>Балахтинский район</td>
<td>950 866 600,00</td>
<td>18 837</td>
<td>50 478,66</td>
<td>36 262 700,00</td>
</tr>
<tr>
<td>Сухобузимский район</td>
<td>860 055 150,95</td>
<td>20 001</td>
<td>43 000,61</td>
<td>25 123 216,15</td>
</tr>
<tr>
<td>Абанский район</td>
<td>822 538 900,00</td>
<td>20 266</td>
<td>40 587,14</td>
<td>22 650 000,00</td>
</tr>
<tr>
<td>Уярский район</td>
<td>440 401 770,00</td>
<td>20 921</td>
<td>21 050,70</td>
<td>25 411 500,00</td>
</tr>
<tr>
<td>Кежемский район</td>
<td>1 360 913 848,00</td>
<td>21 122</td>
<td>64 431,11</td>
<td>45 365 964,00</td>
</tr>
<tr>
<td>Назаровский район</td>
<td>891 234 500,00</td>
<td>22 393</td>
<td>39 799,69</td>
<td>37 274 100,00</td>
</tr>
<tr>
<td>Березовский район</td>
<td>547 463 600,00</td>
<td>22 973</td>
<td>23 830,74</td>
<td>27 166 300,00</td>
</tr>
<tr>
<td>Иланский район</td>
<td>714 794 200,00</td>
<td>23 971</td>
<td>29 819,12</td>
<td>22 956 900,00</td>
</tr>
<tr>
<td>Канский район</td>
<td>923 693 700,00</td>
<td>25 542</td>
<td>36 163,72</td>
<td>28 505 900,00</td>
</tr>
<tr>
<td>Минусинский район</td>
<td>993 048 253,32</td>
<td>25 954</td>
<td>38 261,86</td>
<td>32 029 324,64</td>
</tr>
<tr>
<td>г. Дивногорск</td>
<td>941 236 100,00</td>
<td>29 117</td>
<td>32 326,00</td>
<td>32 413 500,00</td>
</tr>
<tr>
<td>Нижнеингашский район</td>
<td>1 029 925 200,00</td>
<td>29 813</td>
<td>34 546,18</td>
<td>37 673 500,00</td>
</tr>
<tr>
<td>Рыбинский район</td>
<td>1 265 957 145,80</td>
<td>31 259</td>
<td>40 498,96</td>
<td>39 300 610,90</td>
</tr>
<tr>
<td>Ужурский район</td>
<td>1 084 027 000,00</td>
<td>31 545</td>
<td>34 364,46</td>
<td>78 985 000,00</td>
</tr>
<tr>
<td>Шушенский район</td>
<td>1 349 456 794,58</td>
<td>32 283</td>
<td>41 800,85</td>
<td>33 613 812,44</td>
</tr>
<tr>
<td>Курагинский район</td>
<td>1 058 134 200,00</td>
<td>45 532</td>
<td>23 239,35</td>
<td>31 457 100,00</td>
</tr>
<tr>
<td>Богучанский район</td>
<td>2 028 300 069,17</td>
<td>45 544</td>
<td>44 534,96</td>
<td>56 484 520,90</td>
</tr>
<tr>
<td>Емельяновский район</td>
<td>1 579 559 056,00</td>
<td>48 640</td>
<td>32 474,49</td>
<td>32 803 931,00</td>
</tr>
</tbody>
</table>
