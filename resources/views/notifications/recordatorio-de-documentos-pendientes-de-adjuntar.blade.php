@component('mail::message')
# {{$user->genero_id == 2 ? 'Estimada' : 'Estimado'}} {{$user->name}}

Usted ha recibido este correo porque en el sistema **{{config('app.name')}}**, tiene <b>{{count($documentos)}}</b> documento(s) pendiente(s) de adjuntar:

@component('mail::table')
| Tipo de documento | Correlativo     |
|:------------------|:----------------|
@foreach($documentos as $documento)
| {{$documento->tipo_documento}} {{$documento->anio}}           | {{ $documento->correlativo }} |
@endforeach
@endcomponent

@component('mail::button', ['url' => config('app.url') . "/home"])
Ir al sistema
@endcomponent

Atentamente,<br>
{{ config('app.name') }}
@endcomponent
