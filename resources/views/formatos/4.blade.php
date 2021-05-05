<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>
		Providencia {{ $documento->correlativo }}
	</title>
	<style>
		@page {
			/*size: 22cm 28cm;*/
			/*
			
			margin-left: 3.5cm;
			margin-right: 1.8cm;
			font-family: "Arial", Arial, serif;
			
			font-style: normal;
			*/
			margin-top: 5cm;
			margin-bottom: 0.5cm;
			font-size: 14px;
			odd-header-name: html_myHeader1;
		}
		div.container p {
			font-size: 14px;
		}
		.float-right {
			font:bold;
			margin-top: -0.4cm;
			font-size: 10px;
			text-align: right;
		}
		.upper {
			text-transform: uppercase;
		}
		.lower {
			text-transform: lowercase;
		}
		.title {
			text-transform: capitalize;
		}
		.circle {
			font-size: 15px;
		}
		p.ql-align-center{
			text-align: center;
		}
		p.ql-align-left{
			text-align: left;
		}
		p.ql-align-right{
			text-align: right;
		}
	</style>
</head>
<body>
	<htmlpageheader name="myHeader1" style="display:none">
		<table width="100%">
			<tr>
				<td width="25%">
				</td>
				<td width="50%" align="center">
					<img src="images/MINECO-01.png" width="125" height="125">
				</td>
				<td width="25%">
				</td>
			</tr>
		</table>
	</htmlpageheader>
	<div class="container">
		<p align="right">
			Guatemala,
			{{ Carbon\Carbon::parse($documento->fecha_emision)->formatLocalized('%d de %B de %Y') }}
			<br>
			<b>Dirección de Tecnologías de la Información</b> <br>
			<b>Providencia</b>
			{{ $documento->correlativo }}
		</p>
		<p align="right">
			<b>ASUNTO</b>: {{ $documento->asunto }}
		</p>
		<br>
		<p>
			{{ $documento->saludo }} <br>
			{{ $documento->destinatario }} <br>
			{{ $documento->cargo }} <br>
			{{ $documento->dependencia }} <br>
			{{ $documento->entidad }}
		</p>
		<br>
		<p>
			Estimado/a {{ $documento->saludo }} {{ $documento->destinatario }}
		</p>
		{!! $documento->respuesta !!}
		<br>
		Atentamente,
	</div>
</body>
</html>
