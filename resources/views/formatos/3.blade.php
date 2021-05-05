<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>
		Memorándum {{ $documento->correlativo }}
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
			font-size: 16px;
			odd-header-name: html_myHeader1;
		}
		div.container p {
			font-size: 16px;
			text-align: justify;
			text-justify: inter-word;
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
		<p align="center">
			MEMORÁNDUM <br>
			{{ $documento->correlativo }}
		</p>
		<br>
		<table style="width: 100%;">
			<tr>
				<td style="font-weight: bold; vertical-align:top;">PARA:</td>
				<td>
					<b>{{ $documento->destinatario }}</b> <br>
					{{ $documento->cargo }} <br>
					{{ $documento->dependencia }} <br>
					{{ $documento->entidad }}
				</td>
			</tr>
			<tr style="height:45px;">
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td style="font-weight: bold; vertical-align:top;">DE:</td>
				<td>
					<b>{{ $documento->destinatario }}</b> <br>
					{{ $documento->cargo }} <br>
					{{ $documento->dependencia }} <br>
					{{ $documento->entidad }}
				</td>
			</tr>
			<tr style="height:45px;">
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td style="font-weight: bold; vertical-align:top;">ASUNTO:</td>
				<td style="font-weight: bold;">{{ $documento->asunto }}</td>
			</tr>
			<tr style="height:45px;">
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td width="25%" style="font-weight: bold; vertical-align:top;">LUGAR Y FECHA:</td>
				<td>
					Guatemala, {{ Carbon\Carbon::parse($documento->fecha_emision)->formatLocalized('%d de %B de %Y') }}
				</td>
			</tr>
		</table>
		<hr>
		{!! $documento->respuesta !!}
	</div>
</body>
</html>
