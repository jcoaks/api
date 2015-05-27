<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Webservice JSON</title>
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	</head>
	<body>
		
		<form id="form1" method="post">
			<input type="text" name="nombre" placeholder="Nombre">
			<button type="submit">Guardar</button>
		</form>
	   
		<script>

		$("#form1").submit(function() 
		{
			var url = 'webservice.php/guardar';

			//Obtengo los valores del form
			var inputs = this.elements;
			var values = {};
			$.each(this.elements, function(i, v){
				var input = $(v);
				values[input.attr("name")] = input.val();
				delete values["undefined"];
			});

			//Llamando al webservice
			$.ajax({
				url: url,
				type: 'POST',
				contentType: 'application/json',
				dataType: 'json',
				data: JSON.stringify(values),
				success: function(data) {
					console.log(data);
				},
				error: function (data) {
					console.log(data);
				}
			});
		});
		</script>
	</body>
</html>


