@extends('templates.main')

@section('content')

<!-- CABECERA -->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h2><b>Marco de Gestión de Seguridad de la Información (MGSI)</b></h4>
        <ul class="breadcrumb">
            <li class="mb-1 fs-16"><a href="{{ url()->previous() }}">Visualización de MGSI	</a></li>
            <li class="text-muted mb-1 fs-16 ml-2 mr-2"> / </li>
            <li class="text-muted mb-1 fs-16">Nuevo MGSI</li>
        </ul>
    </div>
</div>
<!-- FIN CABECERA -->


<!-- CONTENIDO
<div class="row">
	<div class="col-xl-12 col-md-12 col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="form-group" style="width=30%;">
					<h4><label for="status_id"><b>Objetivos Alineados a la Política General de Seguridad de la Información</b></label><br></h4><br>
					<input type="checkbox" id="cbox1" value="uno_checkbox">    01. Establecer, operar y mantener un modelo de gobierno de seguridad de la información.</label><br><br>
					<input type="checkbox" id="cbox2" value="dos_checkbox">    02. Efectuar la identificación de Infraestructuras de información esenciales y, en su caso, críticas, así como de activos clave de la Institución, y elaborar el catálogo respectivo.</label><br><br>
					<input type="checkbox" id="cbox2" value="tres_checkbox">   03. Establecer los mecanismos de administración de riesgos que permitan identificar, analizar, evaluar, atender y monitorear los riesgos.</label><br><br>
					<input type="checkbox" id="cbox4" value="cuatro_checkbox"> 04. Establecer un SGSI que proteja los activos de información de la Institución, con la finalidad de preservar su confidencialidad, integridad y disponibilidad.</label><br><br>
					<input type="checkbox" id="cbox5" value="cinco_checkbox">  05. Establecer mecanismos para la respuesta inmediata a incidentes a la seguridad de la información.</label><br><br>
					<input type="checkbox" id="cbox6" value="seis_checkbox">   06. Vigilar los mecanismos establecidos y el desempeño del SGSI, a fin de prever desviaciones y mantener una mejora continua.</label><br><br>
					<input type="checkbox" id="cbox7" value="siete_checkbox">  07. Fomentar una cultura de seguridad de la información en la Institución.</label><br>

					@error('status_id')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="card-footer text-right">
				<button type="submit" class="btn btn-primary" id="enviar">
					<i class="feather feather-save sidemenu_icon"></i> Añadir Objetivo
				</button>

				<button type="submit" class="btn btn-primary" id="enviar">
					<i class="feather feather-save sidemenu_icon"></i> Actualizar Información
				</button>
			</div>
		</div>
	</div>
</div> -->






	<div class="row">
		<div class="col-xl-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="card-body">
					<form action="{{route('proyectos.store')}}" method="POST">
						@csrf
						<h4 class="mb-5 font-weight-semibold"><b>Controles: </b></h4>

						{{-- IMGRESAR INFORMACIÓND E CONTROLES. PRIMERA FILA DEL FORMULARIO --}}
						<div class="table-responsive">
							<table class="table  text-wrap border-bottom table-borderless" id="mytable">
								<tr>
									<td width="5%"><b>ID</b></td>
									<td width="30%"><b>Control</b></td>
									<td width="10%"><b>¿Se cumple con le control?</b></td>
									<td width="15%"><b>Descripción/Justificación</b></td>
									<td width="20%"><b>Evdencia</b></td>
								</tr>

								<tr>
									<td>
										{{-- ID DE LOS CONTROLES --}}
										<div>
											01
										</div>
									</td>

									<td>
										{{-- DESCRIPCIÓN DE LOS CONTROLES --}}
											<div>
												Desarrollar un procedimiento o adoptar una metodología de gestión y tratamiento de riesgos
												de seguridad y, deacuerdo a sus respultados, implementar las acciones preventivas y correctivas correspondientes
											</div>
									</td>

									<td>
										<!-- PRUEBA PARA LA LISTA DESPLEGABLE (ABIERTA) -->
										{{-- LISTA DESPLEGABLE DE AFIRAMCIÓN/NEGACIÓN --}}
										<div class="col-md-3">
											<div class="form-group">
												<form name="formulario" method="post" action="/send.php">
													<!-- Campo de texto combinado con lista de opciones -->
													<input type="text" list="items" />
													<!-- Lista de opciones -->
													
													<datalist id="items">
														<option value="Si">Se cumple</option>
														<option value="No">No se cumple</option>
													</datalist>
												</form>

											</div>
										</div>
									</td>

									<td>
										{{-- Descripción/Justificación --}}
										<textarea rows="4" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Descripción&#10;o&#10;Justificación" maxlength="250" required></textarea>
										@error('description')
											<span class="invalid-feedback" role="alert">
												{{ $message }}
											</span>
										@enderror
									</td>	

									<td>
										{{-- EVIDENCIA --}}
										<!-- ABRE EXPLORADOR PARA ADJUNTAR EL PDF DE LA EVIDENCIA -->
										<div class="input-group file-browser">
											<input type="text" class="form-control border-right-0 browse-file" placeholder="PDF" readonly value="@isset($profile->url_image){{substr(explode('/', $profile->url_image)[1],10)}}@endisset">
											<label class="input-group-append mb-0">
												<span class="btn ripple btn-primary"> Examinar <input type="file" class="file-browserinput" 
													style="display: none;" accept="image/*" name="url_image" 
													id="url_image" onchange="previewImage(event)">
												</span>
											</label>
										</div> <br>

										{{-- Cliente --}}
										<label class="form-label">Tipo:</label>
										<select class="form-control custom-select select2 @error('customer_id') is-invalid @enderror" data-placeholder="Selecciona un cliente" id="customer_id" name="customer_id" required>
											<option value="-1" selected hidden>Selecciona...</option>
											@isset($customers)
												@foreach ($customers as $customer)
													<option value={{$customer->id}}>{{$customer->first_name}} {{$customer->last_name}}</option>
												@endforeach
											@endisset
										</select>
										@error('customer_id')
											<span class="invalid-feedback" role="alert">
												{{ $message }}
											</span>
										@enderror
									</td>
								</tr>
								<!-- FIN DE LAS CELDAS-->
								

								{{-- SEGUNDO REGISTRO DE CONTROLES --}}
								<tr class="card-footer">
									<td>
										{{-- ID DE LOS CONTROLES --}}
										<div>
											02
										</div>
									</td>

									<td>
										{{-- DESCRIPCIÓN DE LOS CONTROLES --}}
											<div aling="center">
												Crear, probar e implementar el plan de respuesta y gestión de los incidentes de seguridad,
												que incluya la confromación del ERISC, así como las acciones de preparación, detección y análisis,
												contención, erradicación y recuperación, y actividades posteriores al incidente.
											</div>
									</td>

									<td>
										<!-- PRUEBA PARA LA LISTA DESPLEGABLE (ABIERTA) -->
										{{-- LISTA DESPLEGABLE DE AFIRAMCIÓN/NEGACIÓN --}}
										<div class="col-md-3">
											<div class="form-group">
												<form name="formulario" method="post" action="/send.php">
													<!-- Campo de texto combinado con lista de opciones -->
													<input type="text" list="items" />
													<!-- Lista de opciones -->
													
													<datalist id="items">
														<option value="Si">Se cumple</option>
														<option value="No">No se cumple</option>
													</datalist>
												</form>

											</div>
										</div>
									</td>

									<td>
										{{-- Descripción/Justificación --}}
										<textarea rows="4" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Descripción&#10;o&#10;Justificación" maxlength="250" required></textarea>
										@error('description')
											<span class="invalid-feedback" role="alert">
												{{ $message }}
											</span>
										@enderror
									</td>	

									<td>
										{{-- EVIDENCIA --}}
										<!-- ABRE EXPLORADOR PARA ADJUNTAR EL PDF DE LA EVIDENCIA -->
										<div class="input-group file-browser">
											<input type="text" class="form-control border-right-0 browse-file" placeholder="PDF" readonly value="@isset($profile->url_image){{substr(explode('/', $profile->url_image)[1],10)}}@endisset">
											<label class="input-group-append mb-0">
												<span class="btn ripple btn-primary"> Examinar <input type="file" class="file-browserinput" 
													style="display: none;" accept="image/*" name="url_image" 
													id="url_image" onchange="previewImage(event)">
												</span>
											</label>
										</div> <br>

										{{-- Cliente --}}
										<label class="form-label">Tipo:</label>
										<select class="form-control custom-select select2 @error('customer_id') is-invalid @enderror" data-placeholder="Selecciona un cliente" id="customer_id" name="customer_id" required>
											<option value="-1" selected hidden>Selecciona...</option>
											@isset($customers)
												@foreach ($customers as $customer)
													<option value={{$customer->id}}>{{$customer->first_name}} {{$customer->last_name}}</option>
												@endforeach
											@endisset
										</select>
										@error('customer_id')
											<span class="invalid-feedback" role="alert">
												{{ $message }}
											</span>
										@enderror
									</td>
								</tr>
								<!-- FINAL DEL SEGUNDO REGISTRO -->

								{{-- TERCER REGISTRO DE CONTROLES --}}
								<tr class="card-footer">
									<td>
										{{-- ID DE LOS CONTROLES --}}
										<div>
											03
										</div>
									</td>

									<td>
										{{-- DESCRIPCIÓN DE LOS CONTROLES --}}
											<div aling="center">
												Establecer políticas de contraseñas para la administración de TICs, que definan 
												la complejidad y la periodicidad de renovación. Es lo posible implementar 
												inventarios de credenciales de acceso por categorías de activos de infromación.
											</div>
									</td>

									<td>
										<!-- PRUEBA PARA LA LISTA DESPLEGABLE (ABIERTA) -->
										{{-- LISTA DESPLEGABLE DE AFIRAMCIÓN/NEGACIÓN --}}
										<div class="col-md-3">
											<div class="form-group">
												<form name="formulario" method="post" action="/send.php">
													<!-- Campo de texto combinado con lista de opciones -->
													<input type="text" list="items" />
													<!-- Lista de opciones -->
													
													<datalist id="items">
														<option value="Si">Se cumple</option>
														<option value="No">No se cumple</option>
													</datalist>
												</form>

											</div>
										</div>
									</td>

									<td>
										{{-- Descripción/Justificación --}}
										<textarea rows="4" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Descripción&#10;o&#10;Justificación" maxlength="250" required></textarea>
										@error('description')
											<span class="invalid-feedback" role="alert">
												{{ $message }}
											</span>
										@enderror
									</td>	

									<td>
										{{-- EVIDENCIA --}}
										<!-- ABRE EXPLORADOR PARA ADJUNTAR EL PDF DE LA EVIDENCIA -->
										<div class="input-group file-browser">
											<input type="text" class="form-control border-right-0 browse-file" placeholder="PDF" readonly value="@isset($profile->url_image){{substr(explode('/', $profile->url_image)[1],10)}}@endisset">
											<label class="input-group-append mb-0">
												<span class="btn ripple btn-primary"> Examinar <input type="file" class="file-browserinput" 
													style="display: none;" accept="image/*" name="url_image" 
													id="url_image" onchange="previewImage(event)">
												</span>
											</label>
										</div> <br>

										{{-- Cliente --}}
										<label class="form-label">Tipo:</label>
										<select class="form-control custom-select select2 @error('customer_id') is-invalid @enderror" data-placeholder="Selecciona un cliente" id="customer_id" name="customer_id" required>
											<option value="-1" selected hidden>Selecciona...</option>
											@isset($customers)
												@foreach ($customers as $customer)
													<option value={{$customer->id}}>{{$customer->first_name}} {{$customer->last_name}}</option>
												@endforeach
											@endisset
										</select>
										@error('customer_id')
											<span class="invalid-feedback" role="alert">
												{{ $message }}
											</span>
										@enderror
									</td>
								</tr>
								<!-- FINAL DE LAS CELDAS-->

							</table>
							<!-- FIN DE LA TABLA -->

							<table class=" text-nowrap" id="hr-table">
								<tbody>
									<tr class="border-bottom">
										<td></td>
										<div class="text-right" Style="margin-top: 5%;">
											<a role="button" class="btn btn-outline-dark" href="{{ url()->previous() }}">
												<i class="feather feather-corner-down-left sidemenu_icon"></i>
												Regresar
											</a>

											<button type="submit" class="btn btn-primary" id="enviar">
												<i class="feather feather-save sidemenu_icon"></i>
												Guardar
											</button>
										</div>
									</tr>
								</tbody>
							</table>

						</div>
						<!-- FINAL DEL DIV DE H4 -->

						</div>
					</div>
				</form>
			</div>

			
		</div>
	</div>
<!-- FIN CONTENIDO -->
@endsection

@section('extra-script')
	<script>
		

		/*
			Agrega una nueva fila a la tabla de actividades
		*/
		function addActivity(event){
			let table = document.getElementById('lista_actividades');

			console.log(table.childNodes.length);

			let row = document.createElement('tr');

			ro.innerHTML = '<td>'+
							'	<input type="text" name="activity_name[]" id="" placeholder="Ingresa titulo de actividad" style=" width:100%;" class="form-control @error('activity_name[]') is-invalid @enderror" value="{{ old('activity_name[]') }}" required>'+
							'	@error('activity_name[]')'+
                            '	    <span class="invalid-feedback" role="alert">'+
                            '	        {{ $message }}'+
                            '	    </span>'+
                            '	@enderror'+
							'</td>'+
							'<td>'+
							'	<select name="user_id[]" id="" class="form-control custom-select select2 @error('user_id') is-invalid @enderror" required>'+
							'		<option value="-1" selected  hidden>Asignar a...</option>'+
							'		@isset($employees)'+
							'			@foreach ($employees as $employee)'+
							'				<option value={{$employee->id}}>{{$employee->name}}</option>'+
							'			@endforeach'+
							'		@endisset'+
							'	</select>'+
							'	@error('user_id[]')'+
                            '	    <span class="invalid-feedback" role="alert">'+
                            '	        {{ $message }}'+
                            '	    </span>'+
                            '	@enderror'+
							'</td>'+
							'<td>'+
							'	<input type="date" name="activity_end_date[]" id="" class="form-control fc-datepicker @error('activity_end_date[]') is-invalid @enderror" required>'+
							'	@error('activity_end_date[]')'+
                            '	    <span class="invalid-feedback" role="alert">'+
                            '	        {{ $message }}'+
                            '	    </span>'+
                            '	@enderror'+
							'</td>'+
							'<td>'+
							'	<input type="number" class="form-control mb-md-1 mb-5 hours @error('time_hour[]') is-invalid @enderror" value=0 min="1" align="right" name="time_hour[]" onchange="updateCostActivity(event);" onkeyup="updateCostActivity(event);" value="{{ old('time_hour[]') }}" required>'+
							'	@error('time_hour[]')'+
                            '	    <span class="invalid-feedback" role="alert">'+
                            '	        {{ $message }}'+
                            '	    </span>'+
                            '	@enderror'+
							'</td>'+
							'<td class="amounts">$0.00</td>'+
							'<td  onclick="removeActivity(event);">'+
							'	<a class="action-btns1" title="Remover"><i class="fa-solid fa-xmark text-danger"></i></a>'+
							'</td>';

			table.appendChild(row);
		}


		/*
			Remueve una fila de la tabla de actividades
		*/
		function removeActivity(event){
			currentRow = event.target.parentNode.parentNode.parentNode; 
			currentRow.remove();
			totalCostProject();
		}


		/*
			Actualiza el costo de una actividad
		*/
		function updateCostActivity(event) {
			hoursActivity = event.target.value;
			currentRow = event.target.parentNode.parentNode; 
			amountActivity = currentRow.querySelector('.amounts');
			costHour = document.getElementById('cost_hour');

			amountActivity.innerText = numberToMoney(costHour.value * hoursActivity);

			totalCostProject();
		}

		/*
			Actualiza el de todas las actividades
		*/
		function updateCostActivities(event) {
			hours = document.getElementsByClassName('hours');
			amounts = document.getElementsByClassName('amounts');
			costHour = document.getElementById('cost_hour');

			for (let i = 0; i < hours.length; i++) {
				amounts[i].innerText = numberToMoney(hours[i].value * costHour.value);
			}

			totalCostProject();
		}		

		/*
			Asigna el costo total del proyecto
		*/
		function totalCostProject() {
			total = document.getElementById('total');
			amounts = document.getElementsByClassName('amounts');
			sum = 0;

			for (let i = 0; i < amounts.length; i++) {
				sum += moneyToNumber(amounts[i].innerText);
			}

			total.value = numberToMoney(sum);


		}	


		/*
		Da formato de moneda a String
	*/
	function numberToMoney(value) {
		const formatterDolar = new Intl.NumberFormat('en-US', {
    		style: 'currency',
       		currency: 'USD'
     	});
		if (isNaN(value)) {
			value = 0;
		}

		return formatterDolar.format(value);
	}



	/*
		Convierte String con formato de moneda a numero flotante
	*/
	function moneyToNumber(value) {
		valueWithoutSignDollar = value.split("$");
		valueWhitoutComas = valueWithoutSignDollar[1].replace(/,/g, "");
		if (valueWhitoutComas == '') {
			value = 0;
		} else {
			value = parseFloat(valueWhitoutComas);
		}

		return value;
	}
	</script>
@endsection

