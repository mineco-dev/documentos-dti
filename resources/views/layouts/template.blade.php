<html>
<head>
  <style>
    @page {
      size: 21.5cm 33cm;
      margin-top: 7.96cm;
      margin-bottom: 3.04cm;
      margin-left: 3.5cm;
      margin-right: 1.8cm;
      font-family: "Arial", Arial, serif;
      font-size: 12px;
      font-style: normal;
      odd-header-name: html_myHeader1;
      odd-footer-name: html_myFooter1;
    }
    p {
      text-align: justify;
      line-height: 24pt;
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
  </style>
</head>
<body>    
  <htmlpageheader name="myHeader1" style="display:none">
    <img src="images/logo-mineco2.png" alt="" width="130" height="120">
    <br>
    <u>8ª. Avenida 10-43, Zona 1</u>
    <br>
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    Guatemala, C.A.
    <br>
    <div class="float-right">
      <strong>
        Contrato No.  entre MINISTERIO DE
        <br>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        ECONOMÍA 
        
        <span class="upper">
          Nombre completo
        </span>
        <br>
        Página {PAGENO}/{nbpg}
      </strong>
    </div>
    </htmlpageheader>
    <htmlpagefooter name="myFooter1" style="display:none">
      <table width="100%">
        <tr>
          <td width="33%"></td>
          <td width="33%" align="center" style="font-weight: bold; font-style: italic;"></td>
          <td width="33%" style="text-align: right;">
            {PAGENO}
          </td>
        </tr>
      </table>
      </htmlpagefooter>
      <p>
        <strong>
          CONTRATO DE SERVICIOS PROFESIONALES NÚMERO {{$contrato->numero_contrato}}.
        </strong>
        En la ciudad de Guatemala, el
        {{App\Clases\CifrasEnLetras::convertirTresCifras((int)substr($contrato->fecha_impresion, 8,2),"masculino")}}
        de
        {{App\Clases\CifrasEnLetras::convertirNumerosEnMeses(substr($contrato->fecha_impresion, 5,2))}} del año
        {{App\Clases\CifrasEnLetras::convertirSeisCifras(substr($contrato->fecha_impresion, 0,4),"masculino")}}.
        <strong>
          POR UNA PARTE:
        </strong>
        <strong>SILVIA LORENA ESCOBAR SANTOS</strong>,
        de cincuenta y tres (53) años de edad, casada, guatemalteca, economista, de este domicilio, me identifico con el Documento Personal de Identificación -DPI- en el que consta que mi Código Único de Identificación es el Dos mil cuatrocientos tres (espacio) cero ocho mil doscientos doce (espacio) cero ciento uno (2403 08212 0101), emitido por el Registro Nacional de las Personas de la República de Guatemala (RENAP). Actúo en mi calidad de <strong>Director Técnico III</strong>, Especialidad Economía, de la <strong>Dirección de Atención y Asistencia al Consumidor -DIACO-</strong> lo cual acredito con certificación del Acuerdo de nombramiento número cuatrocientos veintiocho guión dos mil veinte (428-2020), de fecha trece de febrero del año dos mil veinte y Acta de toma de posesión del cargo número cero once guión dos mil veinte (011-2020), de fecha trece de febrero del año dos mil veinte, que obra a folio un mil novecientos noventa y ocho (1998) del libro de Actas de la Dirección de Recursos Humanos del Ministerio de Economía, comparezco para la suscripción del presente contrato de conformidad con lo establecido en el Acuerdo Ministerial número novecientos treinta y dos guion dos mil veinte (932-2020) de fecha quince de diciembre del año dos mil veinte, en el que se dispone en el Artículo uno (1) “Delegar en  los siguientes Directores y Registradores de los órganos y dependencias del  Ministerio de Economía: Dirección del Sistema Nacional de la Calidad; Dirección de Atención y Asistencia al Consumidor; Registro Mercantil General de la República; Registro de la Propiedad Intelectual; Dirección de Servicios Financieros Empresariales; Dirección de Servicios de Desarrollo Empresarial; (Programa Nacional de la Microempresa); Programa Nacional de Competitividad -PRONACOM-, Jefe de la Misión Permanente ante la Organización Mundial del Comercio -OMC- con sede en Ginebra, Suiza; la facultad de suscribir contratos por servicios técnicos y profesionales sin relación de dependencia, para el ejercicio fiscal dos mil veintiuno (2021), bajo el Grupo 0 “Servicios Personales” Subgrupo 02 “Personal Temporal”, con cargo al renglón de gasto 029 “Otras remuneraciones de Personal Temporal”, Subgrupo 08 “Personal Contratado por Organismos Internacionales”, con cargo al renglón de gasto 081 “Personal Administrativo, Técnico, Profesional y Operativo” , bajo el Grupo 1 “Servicios no Personales”, Subgrupo 15 “Arrendamiento y Derechos” , Subgrupo 18 “Servicios Técnicos y Profesionales”, Subgrupo 19 “Otros Servicios no Personales”, siempre que exista autorización por escrito del Viceministro que corresponda, visto bueno del Despacho Superior y que se cuente con disponibilidad presupuestaria. Dichos contratos serán aprobados por medio de Acuerdos Ministeriales firmados por el señor Ministro y refrendados por cualquier otro que no sea quien autorizó las contrataciones, de los Viceministros que integran el Ministerio de Economía”; Acuerdo Gubernativo número doscientos once guión dos mil diecinueve (211-2019), de fecha veinticuatro de octubre del año dos mil diecinueve, "Reglamento Orgánico Interno del Ministerio de Economía", Acuerdo Ministerial número setecientos sesenta y dos guion dos mil diecinueve (762-2019) de fecha diecinueve de noviembre de dos mil diecinueve “Estructura orgánica interna complementaria establecida en el Reglamento Orgánico Interno del Ministerio de Economía”, Artículo treinta y cinco (35) del Decreto veinticinco guión dos mil dieciocho (25-2018), Ley del Presupuesto General de Ingresos y Egresos del Estado para el ejercicio fiscal dos mil diecinueve; vigente para el año dos mil veintiuno, de conformidad con lo preceptuado en el artículo 171 literal b) de la Constitución Política de la República de Guatemala; Circular Conjunta del Ministerio de Finanzas Públicas, Oficina Nacional de Servicio Civil y Contraloría General de Cuentas, de fecha enero del año dos mil diecisiete, publicada en el Diario de Centro América el día once de enero del año dos mil diecisiete; y

        <strong>POR LA OTRA PARTE:</strong>
        @include('layouts.contratos.calculos.generales-de-contratista')

        Ambos otorgantes, aseguramos:
        <strong>a)</strong> Ser de los datos de identificación personal consignados;
        <strong>b)</strong> Hallarnos en el libre ejercicio de nuestros derechos civiles;
        <strong>c)</strong> Que hemos tenido a la vista los documentos de identificación indicados y la documentación con la que se acredita la calidad con que se actúa, la que de conformidad con la ley y a nuestro juicio es suficiente para la celebración del presente contrato;
        <strong>d)</strong> Que en lo sucesivo
        <strong>
          el Ministerio de Economía y @include('layouts.contratos.calculos.nombre-de-contratista')
        </strong>
        se denominarán simplemente como “EL CONTRATANTE” y “EL CONTRATISTA”, respectivamente; y,
        <strong>e)</strong> Que convenimos en otorgar
        <strong>CONTRATO DE SERVICIOS PROFESIONALES</strong>,
        de conformidad con las cláusulas siguientes:
        <strong class="clausula-1">
          <u>PRIMERA:</u>
          FUNDAMENTO LEGAL DEL CONTRATO.
        </strong>
        El presente contrato se suscribe de conformidad con lo preceptuado por los artículos cuarenta y cuatro <strong>(44)</strong>, cuarenta y siete <strong>(47)</strong>, cuarenta y ocho <strong>(48)</strong>, sesenta y cinco <strong>(65)</strong> y, sesenta y nueve <strong>(69)</strong> de la Ley de Contrataciones del Estado, Decreto cincuenta y siete guión noventa y dos <strong>(57-92)</strong> del Congreso de la República de Guatemala y sus reformas; y cuarenta y dos <strong>(42)</strong> de su Reglamento, contenido en Acuerdo Gubernativo número ciento veintidós guión dos mil dieciséis <strong>(122-2016)</strong> y sus reformas de la Presidencia de la República de Guatemala, artículos del dos mil veintisiete al dos mil treinta y seis <strong>(2027 al 2036)</strong> del Código Civil, Decreto Ley número ciento seis <strong>(106)</strong>, Decreto número veinticinco guión dos mil dieciocho <strong>(25-2018)</strong> del Congreso de la República, Ley del Presupuesto General de Ingresos y Egresos del Estado para el Ejercicio Fiscal dos mil diecinueve; vigente para el año dos mil veintiuno, de conformidad con lo preceptuado en el Artículo 171 literal b de la Constitución Política de la República de Guatemala; Circular Conjunta del Ministerio de Finanzas Públicas, Oficina Nacional de Servicio Civil y Contraloría General de Cuentas, de fecha enero del año dos mil diecisiete, publicada en el Diario de Centro América el día once de enero del año dos mil diecisiete.

        <strong class="clausula-2">
          <u>SEGUNDA:</u>
          OBJETO DEL CONTRATO.
        </strong>
        <strong>“EL CONTRATISTA”</strong> se obliga a prestar sus <strong>SERVICIOS DE CARÁCTER PROFESIONAL</strong> a “EL CONTRATANTE”, en
        @include('layouts.contratos.calculos.dependencia-de-contrato')
        del Ministerio de Economía, con toda su dedicación, diligencia y con apego a las disposiciones que se encuentren enmarcadas dentro de la normativa legal vigente en la realización de las actividades que se describen a continuación, sin ser éstas limitativas, sino únicamente enunciativas:
        @include('layouts.contratos.calculos.actividades-de-contrato')

        <strong class="clausula-3">
          <u>TERCERA:</u>
          DE LOS HONORARIOS Y FORMA DE PAGO.
        </strong>
        <strong>a)</strong> “EL CONTRATANTE” pagará a “EL CONTRATISTA” por los servicios profesionales que le preste, la cantidad integra total de
        <strong class="upper">@include('layouts.contratos.calculos.total-en-letras-de-contrato')</strong>,
        monto que incluye el Impuesto al Valor Agregado - IVA-, en concepto de honorarios y todos los impuestos vigentes y por establecerse contra la presentación obligatoria de factura electrónica en línea -FEL- contable vigente que extenderá a nombre de la Dirección de Atención de Asistencia al Consumidor y/o DIACO con número de identificación tributaria - NIT- tres millones novecientos cuatro mil quinientos noventa y dos guión siete (3904592-7), e informe de actividades realizadas durante el mes que se cancela, documentos que deberán ser debidamente aceptados y a satisfacción de “EL CONTRATANTE”. Los honorarios descritos serán cancelados en
        <strong>@include('layouts.contratos.calculos.pagos-de-contrato')</strong>
        montos que incluyen el Impuesto al Valor Agregado (IVA), y todos los impuestos vigentes y por establecerse, comprendidos del
        <strong>@include('layouts.contratos.calculos.plazo-de-contrato')</strong>,
        siendo condición indispensable de “EL CONTRATISTA”, entregar factura electrónica en línea -FEL- e informe de actividades en las fechas en que le sean solicitados por “EL CONTRATANTE”, y un informe final al vencimiento del contrato, caso contrario no se hará efectivo el pago correspondiente.

        <strong>“EL CONTRATISTA”</strong> tendrá obligaciones de: I) presentar informes extraordinarios o complementarios cuando le sean requeridos por el contratante, en forma inmediata, escrita y sin demora alguna, siendo el incumplimiento en la entrega de estos informes causa suficiente para retener el pago o pagos pendientes y/o rescindir el presente contrato unilateralmente sin responsabilidad alguna para “EL CONTRATANTE”, reservándose en todo caso “EL CONTRANTANTE” el derecho de ejecutar la fianza de cumplimiento descrita más adelante o proceder al cobro de la multa pactada, según lo considere prudente; II) proporcionar información escrita y/o electrónica a “EL CONTRATANTE”, de forma constante, pronta y detallada, donde indique el desarrollo de sus actividades y alcances de los servicios contratados, acompañado de la documentación pertinente, bastando para ello el simple requerimiento que “EL CONTRATANTE” le haga llegar en ese sentido. Los pagos serán cubiertos con cargo a la partida presupuestaria
        <strong>@include('layouts.contratos.calculos.partida-presupuestaria-de-contrato')</strong>
        financiado con fondos del Presupuesto General de Ingresos y Egresos del Estado, propios del ejercicio fiscal del año dos mil veintiuno, o cualquier partida que se utilice en el futuro, de la Unidad Ejecutora identificada con Cuentadancia número D3-32. <strong>b)</strong> “EL CONTRATISTA” tiene derecho a que, además de la retribución de los honorarios pactados, se le pague los gastos en que incurra cuando con motivo de los servicios prestados, tenga que trasladarse al interior o exterior del país, los cuales no constituyen ni incrementan los honorarios pactados en el presente contrato, de conformidad con lo preceptuado en el Artículo treinta y ocho (38) del Decreto veinticinco guión dos mil dieciocho (25-2018), Ley del Presupuesto General de Ingresos y Egresos del Estado para el ejercicio fiscal dos mil diecinueve, vigente para el año dos mil veintiuno, de conformidad con lo preceptuado en el artículo 171 literal b) de la Constitución Política de la República de Guatemala.

        <strong class="clausula-4">
          <u>CUARTA:</u>
          PLAZO DEL CONTRATO.
        </strong>
        El presente contrato surte efectos del
        <strong>@include('layouts.contratos.calculos.plazo-de-contrato')</strong>.
        Dicha contratación es de carácter temporal.

        <strong class="clausula-5">
          <u>QUINTA:</u>
          FIANZA DE CUMPLIMIENTO.
        </strong>
        “EL CONTRATISTA” como requisito previo para la aprobación del presente Contrato, deberá constituir a favor y a entera satisfacción de “EL CONTRATANTE”, en una Institución afianzadora debidamente autorizada para operar en la República de Guatemala y de reconocida capacidad y solvencia financiera, una fianza equivalente al <strong>diez por ciento (10%)</strong>, del valor total del contrato, que garantizará el cumplimiento de las obligaciones contractuales, su correcta ejecución y en su caso las sanciones que se impongan a “EL CONTRATISTA”, debiendo entregarla en original. En caso de incumplimiento del contrato que se suscribe, la fianza se hará efectiva por la institución afianzadora, con base en el reclamo que se haga a “EL CONTRATISTA”, sin necesidad de juicio alguno y/o expediente administrativo, extremos que se harán constar en la póliza respectiva.

        <strong class="clausula-6">
          <u>SEXTA:</u>
          APROBACIÓN.
        </strong>
        De conformidad con la Ley de Contrataciones del Estado, este contrato de <strong>SERVICIOS PROFESIONALES</strong>, necesita aprobación por medio de Acuerdo Ministerial, mismo que es necesario para su plena validez.

        <strong class="clausula-7">
          <u>SÉPTIMA:</u>
          IMPUESTOS Y RETENCIONES.
        </strong>
        "EL CONTRATISTA” bajo su estricta responsabilidad debe satisfacer los tributos acorde a su sistema de contabilidad que del presente contrato se deriven, en consecuencia cada pago de honorarios que se haga a “EL CONTRATISTA”, estará afecto a las retenciones y al pago de los impuestos que le fueren aplicables.

        <strong class="clausula-8">
          <u>OCTAVA:</u>
          DISPOSICIONES GENERALES.
        </strong>
        Forman parte del presente contrato y quedan incorporados al mismo el expediente que sirvió de base para su faccionamiento, así como la fianza o seguro de caución y el Acuerdo Ministerial de aprobación.

        <strong class="clausula-9">
          <u>NOVENA:</u>
          EVALUACIÓN DE LOS SERVICIOS.
        </strong>
        La evaluación de los servicios de “EL CONTRATISTA”, se realizará en dos momentos: a) Quien coordine las actividades mensualmente evaluará los servicios prestados por "EL CONTRATISTA" verificando la coherencia que debe existir entre los informes, los servicios prestados y la cláusula segunda del presente contrato; y b) Para garantizar que los servicios beneficien a la institución, "EL CONTRATANTE" elaborará el instrumento y definirá la instancia encargada de la evaluación periódica del cumplimiento de los compromisos contractuales.

        <strong class="clausula-10">
          <u>DÉCIMA:</u>
          PROHIBICIONES Y CONFIDENCIALIDAD.
        </strong>
        <strong>A “EL CONTRATISTA”</strong> le queda expresamente prohibido: a) ceder los derechos provenientes del presente contrato, b) revelar, informar, publicar, divulgar o transferir, directa o indirectamente, proporcionar por cualquier medio, información a terceros sobre los asuntos que son o sean de su conocimiento como consecuencia de los servicios que presta a “EL CONTRATANTE”, para que este determine la legitimidad de la solicitud y proceda en la forma que establece la Ley de Acceso a la Información Pública. En caso “EL CONTRATISTA” contravenga esta prohibición será responsable directo de los daños y perjuicios que hubiese causado, sin perjuicio del derecho que le asiste a “EL CONTRATANTE”, para dar por terminado este contrato y ejecutar la fianza respectiva o proceder al cobro de la multa pactada, según lo considere prudente. Las actividades, documentos, informes, proyectos, creaciones, programas, distintivos y otros que se originen de este contrato y que sean o no susceptibles de registrarse como Derechos de Autor y/o Derechos de Propiedad Intelectual serán propiedad exclusiva de “EL CONTRATANTE”, en la forma que establecen los artículos diez (10) y setenta y cinco (75) de la Ley de Derechos de Autor, por lo tanto no podrán ser explotados, cedidos, distribuidos y/o comercializados por “EL CONTRATISTA”, con ninguna otra persona o en otra actividad. Asimismo, toda información, datos, escritos o no escritos, digitales, electrónicos, impresos o no, relacionados con “EL CONTRATANTE” y los servicios prestados se mantendrán en obligación de confidencialidad por parte de “EL CONTRATISTA”; c) dar intervención o participación en la ejecución del presente contrato, a terceras personas. En todo caso “EL CONTRATISTA” será responsable personalmente por el pago de honorarios que se deriven de la contravención a la presente estipulación concediéndole a “EL CONTRATANTE” el derecho de repetir en su contra, por cualesquiera sumas a las que eventualmente fuera obligado a pagar; d) remover, reproducir, resumir, alterar, mutilar o copiar cualquiera información o material de “EL CONTRATANTE”, estando “EL CONTRATISTA” consciente y advertido de la responsabilidad penal en que pudiere incurrir si incumple con lo dispuesto en esta cláusula, de conformidad con lo establecido en los artículos Doscientos setenta y cuatro (274) “A”, doscientos setenta y cuatro (274) “B”, Doscientos setenta y cuatro (274) “C”. Doscientos setenta y cuatro (274) “D”. Doscientos setenta y cuatro (274) “E”, Doscientos setenta y cuatro (274) “F”, Doscientos setenta y cuatro (274) “G” y Doscientos setenta y cinco (275) del Código Penal, Decreto Diecisiete guion setenta y tres (17-73) del Congreso de la República de Guatemala, y cualquiera otra disposición aplicable. Así como proporcionar información a terceros sobre los asuntos que son o sean de su conocimiento como consecuencia de los servicios que preste a “EL CONTRATANTE”. Las actividades, documentos e informes que se originen de este contrato serán propiedad exclusiva de “EL CONTRATANTE” y no podrán ser utilizados para ninguna otra actividad del técnico o profesional, ni cedidos por éste a terceras personas o empresas.

        <strong class="clausula-11">
          <u>DÉCIMA PRIMERA:</u>
          OTRAS CONDICIONES.
        </strong>
        Los servicios que prestará “EL CONTRATISTA” serán de carácter estrictamente profesional y “EL CONTRATISTA” no tiene calidad de servidor o funcionario público, por lo que no tiene derecho a las prestaciones administrativo-funcionales que la Ley de Servicio Civil otorga a los servidores públicos, tales como: Indemnización, vacaciones, aguinaldo, bonificaciones, pago de tiempo extraordinario, licencias y permisos, etcétera, por cuanto que la retribución acordada no tiene la calidad de sueldo o salario sino de <strong>“honorarios”</strong> y, como consecuencia, este contrato no crea relación laboral entre los otorgantes, y lo que preceptúa el cuarto párrafo del artículo treinta y cinco (35) de la Ley del Presupuesto General de Ingresos y Egresos del Estado para el Ejercicio Fiscal dos mil diecinueve, Decreto veinticinco guión dos mil dieciocho (25-2018), del doce de diciembre del año dos mil dieciocho, para el ejercicio fiscal dos mil diecinueve, vigente para el año dos mil veintiuno, de conformidad con lo preceptuado en el artículo 171 literal b) de la Constitución Política de la República de Guatemala, y las personas contratadas con cargo al renglón presupuestario Cero veintinueve (029) no están sujetos a jornada u horario de trabajo de la dependencia contratante. Asimismo por razones de vulnerabilidad y de acuerdo a las disposiciones ministeriales en caso de calamidad pública “EL CONTRATISTA” podrá contar con seguros, con cargo al presupuesto vigente, sin que ello implique relación laboral o constituya otorgamiento de otras remuneraciones o compensaciones económicas adicionales o extraordinarias a las ya pactadas, por lo que “EL CONTRATISTA” acepta que se le realice el descuento correspondiente en el sistema de nóminas. De igual forma “EL CONTRATISTA” puede prestar sus servicios por instrucciones superiores, en cualquier órgano o dependencia del Ministerio de Economía, diferente a la que en su momento haya requerido la contratación, incluyendo cualquier lugar de la República de Guatemala.

        <strong class="clausula-12">
          <u>DÉCIMA SEGUNDA:</u>
          SANCIONES.
        </strong>
        En caso de retraso en la prestación de los servicios, se aplicará la multa que establece el artículo 85 de la Ley de Contrataciones del Estado y el artículo 62 bis de su reglamento. No obstante lo anterior, en caso de incumplimiento de las condiciones establecidas en el presente contrato, se ejecutará la fianza respectiva, salvo caso fortuito o causas de fuerza mayor debidamente comprobadas y aceptadas por “EL CONTRATANTE”. “EL CONTRATISTA” al concluir el contrato ya sea por rescisión de mutuo acuerdo o bien unilateral antes del vencimiento del plazo, así como a la finalización del contrato, está obligado a devolver el mobiliario y equipo que le fuera asignado. Caso contrario “EL CONTRATANTE”, procederá a realizar las acciones legales que estime pertinente.

        <strong class="clausula-13">
          <u>DÉCIMA TERCERA:</u>
          CONTROVERSIAS.
        </strong>
        Las Controversias que surjan relativas al cumplimiento, interpretación, aplicación y efectos de este contrato, se resolverán con carácter conciliatorio y en caso de no llegarse a un acuerdo, se someterán a la jurisdicción del Tribunal de lo Contencioso Administrativo. Para el cumplimiento de las obligaciones provenientes del presente contrato, “EL CONTRATISTA” renuncia al fuero de su domicilio y se somete a los Tribunales de Justicia que “EL CONTRATANTE” elija, señalando para recibir citaciones, emplazamientos o notificaciones la dirección de residencia proporcionada en este contrato, teniendo como bien hechas las que allí se le hagan.

        <strong class="clausula-14">
          <u>DÉCIMA CUARTA:</u>
          COLEGIACION PROFESIONAL.
        </strong>
        El Contratista, acredita con la Constancia de Profesional Activo, extendida por el Colegio Profesional respectivo, que puede ejercer su profesión universitaria durante la vigencia del presente contrato.

        <strong class="clausula-15">
          <u>DÉCIMA QUINTA:</u>
          TERMINACIÓN.
        </strong>
        El presente contrato se dará por terminado cuando ocurran cualesquiera de las circunstancias siguientes:
        <strong>a)</strong> Por vencimiento del plazo;
        <strong>b)</strong> Por rescisión de mutuo acuerdo;
        <strong>c)</strong> Por caso fortuito o de fuerza mayor, para cualquiera de las partes contratantes que hagan imposible continuar con el cumplimiento del contrato, eximiéndolas de todas las responsabilidades derivadas del mismo, dando aviso por escrito de tal circunstancia a la otra parte;
        <strong>d)</strong> “EL CONTRATANTE” se reserva el derecho de dar por terminado unilateralmente el presente contrato, sin responsabilidad alguna y sin necesidad de agotar previamente ningún trámite administrativo o judicial.

        <strong class="clausula-16">
          <u>DÉCIMA SEXTA:</u>
          DECLARACIÓN JURADA.
        </strong>
        De manera expresa “EL CONTRATISTA” declara bajo juramento de ley y debidamente enterado de las penas relativas al delito de perjurio, que no está comprendido dentro de las prohibiciones que establece el Artículo ochenta (80) de la Ley de Contrataciones del Estado, y que no es deudor moroso del Estado de Guatemala, ni de las entidades a que se refiera el Artículo uno (1) del mismo cuerpo legal. Declara además que no tiene proceso administrativo o judicial pendiente en contra del  “EL CONTRATANTE” o cualquier órgano o dependencia del Ministerio de Economía así como de cualquier otra entidad pública centralizada, descentralizada, autónoma, semiautónoma o que utilice o administre fondos públicos, quedando en todo caso sujeto a las responsabilidades legales que se deriven si lo manifestado no fuese cierto y garantizando el cumplimiento de tal condición con todos sus bienes presentes y futuros, sin que esto lo exima de las demás responsabilidades en que pudiera incurrir. Además manifiesta que no presta servicios o labora en ninguna otra institución del Estado y que al día de hoy no es servidor público de “EL CONTRATANTE”, o cualquier otra entidad del Estado.

        <strong class="clausula-17">
          <u>DÉCIMA SEPTIMA:</u>
          COHECHO.
        </strong>
        Manifiesta el Contratista que conoce las penas relativas al delito de cohecho así como las disposiciones contenidas en el Capítulo III del Título XIII del Decreto 17-73 del Congreso de la República de Guatemala, Código Penal. Adicionalmente, conozco las normas jurídicas que facultan a la Autoridad Superior de la entidad afectada para aplicar las sanciones administrativas que pudieren corresponderle, incluyendo la inhabilitación en el Sistema GUATECOMPRAS.

        <strong class="clausula-18">
          <u>DÉCIMA OCTAVA:</u>
          ACEPTACIÓN.
        </strong>
        En los términos relacionados y condiciones descritas “EL CONTRATANTE” y “EL CONTRATISTA”, manifestamos nuestra expresa aceptación a todas y cada una de las cláusulas del presente contrato. Leímos íntegramente lo escrito y enterados de contenido, objeto, validez y efectos legales, lo ratificamos, aceptamos y firmamos en
        <strong>
          {{App\Clases\CifrasEnLetras::convertirTresCifras($totalPaginas,'masculino')}}
          ({{$totalPaginas}})
        </strong>
        hojas de papel bond tamaño oficio con membrete del Ministerio de Economía, impresas únicamente en su anverso.
      </p>
    </body>
    </html>