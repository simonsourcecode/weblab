ʹ��jquery��tablesorter������б������2013-03-07 09:19:46    ʹ�÷����� 
1.����tablesorter  

2.��ѹ�ļ�����jquery��jquery.tablesorter.min.js���뵽��Ŀ�ļ���

3.�޸�html��

    1���������

[html]  www.2cto.com

<script type="text/javascript" src='/pagemedia/js/jquery.tablesorter.min.js'></script>  

<script type="text/javascript" src='/pagemedia/js/jquery.min.js'></script>  

 

   2���޸ı��

[html]  

<table id="myTable"  class='tablesorter'>  

Ϊtable���id��class��classΪtablesorter.��ע�⣺table������thead��tbody��

   3�����javascript�ű���

[html]  

<script>  

$(document).ready(function(){  

     $("#myTable").tablesorter();       

 });  

</script>  