<table id="testTbl" border=1>
<tr id="tr1">
<td width=6%><input type=checkbox id="box1"></td>
<td id="b">第一行</td>
</tr>
<tr id="tr2">
<td width=6%><input type=checkbox id="box2"></td>
<td id="b">第二行</td>
</tr>
<tr bgcolor=#0000FF>
<td width=6%><input type=checkbox id="box3"></td>
<td>第三行</td>
</tr>
</table>
动态添加表行的javascript函数如下：
function addRow(){
//添加一行
var newTr = testTbl.insertRow();
//添加两列
var newTd0 = newTr.insertCell();
var newTd1 = newTr.insertCell();
//设置列内容和属性
newTd0.innerHTML = '<input type=checkbox id="box4">';
newTd2.innerText= '新加行';
}