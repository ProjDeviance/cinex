@extends('layouts.Title')

<html>
<style>
td{
padding: 25px;
}
</style>
<form method = 'post' action = 'Reg'>
<center>
<table style = "width:50%" border="0">
<tr>
<td>Email Address</td>
<td><input type = "email" name = "eadd" required></input></td>
</tr>
<tr>
<td>Username</td>
<td><input type = "text" name = "uname"required></input></td>
</tr>
<tr>
<td>Password</td>
<td><input type = "password" name = "pass"required></input></td>
</tr>
<tr>
<td>Cellphone Number</td>
<td><input type = "number" name = "CellNum"required></input></td>
</tr>
<tr>
<td>Establishment id</td>
<td><input type = "number" required name = "EsId" required></input></td>
</tr>
</center>



<table>
<center><input type = 'submit'></input></center>
</form>
</html>