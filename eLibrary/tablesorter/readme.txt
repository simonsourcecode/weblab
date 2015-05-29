使用jquery的tablesorter插件进行表格排序2013-03-07 09:19:46    使用方法： 
1.下载tablesorter  

2.解压文件，将jquery和jquery.tablesorter.min.js导入到项目文件中

3.修改html：

    1）添加链接

[html]  www.2cto.com

<script type="text/javascript" src='/pagemedia/js/jquery.tablesorter.min.js'></script>  

<script type="text/javascript" src='/pagemedia/js/jquery.min.js'></script>  

 

   2）修改表格

[html]  

<table id="myTable"  class='tablesorter'>  

为table添加id和class，class为tablesorter.（注意：table必须有thead和tbody）

   3）添加javascript脚本：

[html]  

<script>  

$(document).ready(function(){  

     $("#myTable").tablesorter();       

 });  

</script>  