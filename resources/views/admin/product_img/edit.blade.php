<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="/admin/product_cat/{{$test->id}}" method="POST" >
	{{csrf_field()}}
	@method("PUT")
	<input type="text" name="nama_kategori" value="{{$test->category_name}}" required=""><br>
	<input type="submit" name="submit" value="update">
</form>
</body>
</html>
