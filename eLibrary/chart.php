﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


    
<head>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>-->
   <script type="text/javascript" src="js/alixixi_jquery.min.js"></script>
   <script type="text/javascript" src="highcharts-4.0.3/js/highcharts.js"></script>
   
  
   /*get series data from database */
   
      <?php
	//single php file,return value
	 
	$mysqli = new mysqli("localhost", "root", "apache", "db_library");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
	
	mysqli_query($mysqli,"SET NAMES 'UTF8'");
	$query = $mysqli->query("select * from xm_lib_type ");
	
	$type=66;
	//$data[$type]=array();
	
	while($a = $query->fetch_array(MYSQLI_BOTH)){
	$pid=$a["id"];
	$typ=$a["subject"];
	
	$typ=urlencode($typ);
	$data[$typ]=array();
	//echo $typ;
		$year=14;
		 $queryyear = $mysqli->query("select * from xm_year ");
			while($b = $queryyear->fetch_array(MYSQLI_BOTH)){
			
			$qid=$b["id"];
			$str = $mysqli->query("select * from xm_lib where pid='$pid' and qid='$qid' ");
			$data[$typ][]=intval(mysqli_num_rows($str));
			
			$year++;
			}
			
			$serial[] = array("name"=>$typ,"data"=>$data[$typ]);
			//$type++;
			//$data[$type]=array();
			}
			
		
	

	$json=urldecode(json_encode($serial));//如果没有urlencode()urldecode()对中文进行编码解码，那么json_encode()处理的中文会显示为乱码
	//echo $json; //send json data to var data
	
	?>  
	
	 <script>
	 $(function () { 
	    $('#container').highcharts({
	        chart: {
	            type: 'column' //line spline area bar pie scatter polar  chart
	        },
	        title: {
	            text: 'Elibrary annual report chart'
	        },
			subtitle: {
                text: ' subtitle'
            },

			legend: {
            align: 'right',
            verticalAlign: 'top',
            layout: 'vertical',
            x: 0,
            y: 100
       	    },
		
			tooltip: {
			 formatter: function() {
        		return 'The value for <b>' + this.x + '</b> is <b>' + this.y + '</b>, in series '+ this.series.name;
   			 },
             // Enable for y-axis only
   			 crosshairs: [false, true]
			},

	        xAxis: {
	            categories: ['2014', '2015', '2016', '2017', '2018']
	        },
	        yAxis: {
	            title: {
	                text: 'total number'
	            }
	        },
	        series: <?php echo $json ?>
	    });
	});
   </script>
  
</head>
	
<body>
 
		
		
	  
	 
  
   <div id="container" style="min-width:800px;height:400px;"></div>
</body>
</html>
<!--
我们在之前分析了highcharts生成折线图和饼图的实例，这篇通过技术cto网一周的pv、uv为例，讲解利用highcharts生成条形图的实例。条形图，不仅可以对比不同项目之间的情况，还能清楚表达某个时间段一个项目的具体变化情况，也是我们经常使用的一个图表之一。
第一步：创建数据库保存一周网站的pv、uv情况；
CREATE TABLE `tiaoxingtu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pv` int(10) DEFAULT NULL,
  `uv` int(10) DEFAULT NULL,
  `did` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

第二步：利用php程序获取网站一周pv、uv数据，我们知道highcharts能够渲染json格式的数据，因此通过php程序我们将数据转换为json格式；
include_once('connect.php');
$res = mysql_query("select * from tiaoxingtu");
while($row = mysql_fetch_array($res)){
    $pv[] = intval($row['pv']);
    $uv[] = intval($row['uv']);
}
$data = array(array("name"=>"pv","data"=>$pv),array("name"=>"uv","data"=>$uv));
$data = json_encode($data);
我们之前也强调了字符串的数字必须通过intval强制转换后highcharts才能识别，比如： $pv[] = intval($row['pv']);

第三步：编写js程序实现数据的渲染；
<script type="text/javascript" src="jquery.min.js"></script>
<script src="js/highcharts.js"></script>
<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: '技术CTO一周uv、pv直方图'
            },
            subtitle: {
                text: '来源: www.jscto.net'
            },
            xAxis: {
                categories: ['周一','周二','周三','周四','周五','周六','周日']
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: <?php echo $data?>
        });
    });
</script>
最后我们在网页body之间的任何地方加上<div id="container" style="width:600px;height:480px"></div>即可


Preprocess data using JSON

JSON has the advantage of already being JavaScript, meaning that in many cases no preprocessing is needed. Another advantage to using JSON is that PHP has a built in function called json_encode(); which returns a JavaScript array that can be used directly in Highcharts.

Here is a basic example with a JSON file containing the data shown and using the jQuery .getJSON function to load it.
•The JSON file
[
[1,12],
[2,5],
[3,18],
[4,13],
[5,7],
[6,4],
[7,9],
[8,10],
[9,15],
[10,22]
]

•Using getJSON to preprocess the options and then create the chart.
$(document).ready(function() {

    var options = {
        chart: {
            renderTo: 'container',
            type: 'spline'
        },
        series: [{}]
    };

    $.getJSON('data.json', function(data) {
        options.series[0].data = data;
        var chart = new Highcharts.Chart(options);
    });

});


There are two things to note here:
1.The data from the external JSON file should be loaded into the chart options before the chart is created. This is a best practice suggestion, since creating the chart and then loading the data into it requires means drawing the chart twice.
2.The data.json file in the example is on the same domain as the chart itself, the .getJSON function does not work cross domains. To load JSON files cross domain, JSONP needs to be used

Live data

After a chart has been defined by the configuration object, optionally preprocessed and finally initialized and rendered using new Highcharts.Chart(), we have the opportunity to alter the chart using a toolbox of API methods. The chart, axis, series and point objects have a range of methods like update, remove, addSeries, addPoints and so on. The complete list can be seen in the API Reference under "Methods and Properties" at the left.

Setting up a live chart

The following example shows how to run a live chart with data retrieved from the server each second, or more precisely, one second after the server's last reply. It is done by setting up a custom function, requestData, that initially is called from the chart's load event, and subsequently from its own Ajax success callback function. You can see the results live at live-server.htm.
1.Set up the server. In this case, we have a simple PHP script returning a JavaScript array with the JavaScript time and a random y value. This is the contents of the live-server-data.php file:
<?php
// Set the JSON header
header("Content-type: text/json");

// The x value is the current JavaScript time, which is the Unix time multiplied 
// by 1000.
$x = time() * 1000;
// The y value is a random number
$y = rand(0, 100);

// Create a PHP array and echo it as JSON
$ret = array($x, $y);
echo json_encode($ret);
?>

2.Define the chart variable globally, as we want to access it both from the document ready function and our requestData funcion. If the chart variable is defined inside the document ready callback function, it will not be available in the global scope later.
var chart; // global

3.Set up the requestData function. In this case it uses jQuery's $.ajax method to handle the Ajax stuff, but it could just as well use any other Ajax framework. When the data is successfully received from the server, the string is eval'd and added to the chart's first series using the Highcharts addPoint method. If the series length is greater than 20, we shift off the first point so that the series will move to the left rather than just cram the points tighter.
/**
 * Request data from the server, add it to the graph and set a timeout 
 * to request again
 */
function requestData() {
    $.ajax({
        url: 'live-server-data.php',
        success: function(point) {
            var series = chart.series[0],
                shift = series.data.length > 20; // shift if the series is 
                                                 // longer than 20

            // add the point
            chart.series[0].addPoint(point, true, shift);
            
            // call it again after one second
            setTimeout(requestData, 1000);    
        },
        cache: false
    });
}

4.Create the chart. Notice how our requestData function is initially called from the chart's load event. The initial data is an empty array.
$(document).ready(function() {
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            defaultSeriesType: 'spline',
            events: {
                load: requestData
            }
        },
        title: {
            text: 'Live random data'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Value',
                margin: 80
            }
        },
        series: [{
            name: 'Random data',
            data: []
        }]
    });        
});

-->