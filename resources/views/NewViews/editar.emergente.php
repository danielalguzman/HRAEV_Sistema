@extends('templates.main')

@section('content')

<!-- CABECERA -->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title"><b> Editar Archivo #{{$project->id}}</b></h4>
        <ul class="breadcrumb">
            <li class="mb-1 fs-16"><a href="{{ url()->previous() }}">Regresar la tabla de capturas</a></li>
            <li class="text-muted mb-1 fs-16 ml-2 mr-2"> / </li>
            <li class="text-muted mb-1 fs-16">Evidencias...</li>
        </ul>
    </div>
</div>
<!-- FIN CABECERA -->




<!-- CONTENIDO -->
	<div class="row">
		<div class="col-xl-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="card-body">
					<form action="{{route('proyectos.update', $project->id)}}" method="POST">
						@method('PUT')
						@csrf
						<h4 class="mb-5 font-weight-semibold">Detalles Archivo #{{$project->id}}</h4>

						{{-- Primera fila del formulario --}}
						<div class="row">
							{{-- Nombre del evento --}}
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Rubro:</label>
										<div class="text-right">
											<button type="text" class="btn" id="enviar">
											<input type="text" class="form-control" placeholder="              Ejemplo" readonly>
											</button>
										</div>
								</div>
							</div>


							{{-- Tipo --}}
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Tipo:</label>
										<div class="text-right">
											<button type="text" class="btn" id="enviar">
											<input type="text" class="form-control" placeholder="              Ejemplo" readonly>
											</button>
										</div>
								</div>
							</div>
							
							{{-- Subtipo --}}
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Subtipo:</label>
									<select class="form-control custom-select select2 @error('customer_id') is-invalid @enderror" data-placeholder="Selecciona un cliente" id="customer_id" name="customer_id">
										<option value="{{$project->customers->id}}" selected>{{$project->customers->first_name}} {{$project->customers->last_name}}</option>
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
								</div>
							</div>
						</div>

						<br><br>
						<div class="row">
							<div class="col-md-10">
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<!--INGRESA LO EQUIVALENTE A COSTO POR HORA -->
								</div>
							</div>
						</div>

						<div class="d-flex">
							<h4 class="mb-5 font-weight-semibold"><b>Modificaicón de las Evidencias</b></h4>
						</div>
						


						{{-- Tabla de actividades --}}
						<!-- TABLA PARA AGREGAR EVIDENCIAS --> 
						<div class="row">
							<div class="table-responsive">
								<table class="table  text-wrap border-bottom table-borderless" id="mytable">
									<thead>
										<tr>
											<th class="border-bottom-0 text-center" width='11%'>ID</th>
											<th class="border-bottom-0 text-center" width='65%'>Descripción</th>
											<th class="border-bottom-0 text-center" width='25%'>Encargado</th>
											<th class="border-bottom-0 text-center" width='6%'>Fecha de Actualización</th>
											<th class="border-bottom-0 text-center" width='58%'>Evidencia</th>
											<th class="border-bottom-0 text-center"> </th>
										</tr>
									</thead>
									<tbody id="lista_actividades">
										@foreach ($project->tasks as $task)
										<tr>
											<td>
												<input type="number" name="activity_id[]" id="" class="form-control" value="{{$task->id}}" readonly>
											</td>

											<td>
												<input type="text" name="activity_name[]" id="" placeholder="Ingresa titulo de actividad" style=" width:100%;" class="form-control @error('activity_name[]') is-invalid @enderror" value="{{$task->name}}" required>
												@error('activity_name[]')
                                    			    <span class="invalid-feedback" role="alert">
                                    			        {{ $message }}
                                    			    </span>
                                    			@enderror
											</td>

											<td>											
												<select name="user_id[]" id="" class="form-control custom-select select2 @error('user_id') is-invalid @enderror">
													<option value="{{$task->users->id}}" selected>{{$task->users->name}}</option>
													@isset($employees)
														@foreach ($employees as $employee)
															<option value={{$employee->id}}>{{$employee->name}}</option>
														@endforeach
													@endisset
												</select>
												@error('user_id[]')
                                    			    <span class="invalid-feedback" role="alert">
                                    			        {{ $message }}
                                    			    </span>
                                    			@enderror
											</td>

											<td>
												<input type="date" name="activity_end_date[]" id="" class="form-control fc-datepicker @error('activity_end_date[]') is-invalid @enderror" required value="{{$task->end_date}}">
												@error('activity_end_date[]')
                                    			    <span class="invalid-feedback" role="alert">
                                    			        {{ $message }}
                                    			    </span>
                                    			@enderror
											</td>

											<td>
												<div class="text-right">
													<button type="text" class="btn" id="enviar">
													<input type="text" class="form-control" placeholder="          ... Cargando" readonly>
													</button>
												</div>
											</td>

											<td>
												
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>

								<!-- <button type="button" class="btn btn-outline-info mr-2" onclick="addActivity(event);">Agregar Evidencia</button> -->

								<!-- VENTANA EXTRA (PRUEBA) -->
								<div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
									<div class="btn-list">
										<button type="button" class="btn btn-outline-info mr-2" data-bs-toggle="modal" data-bs-target="#ventana1">
											<i class="fa-solid fa-plus"></i> Agregar Rubro
										</button>
										

										<!-- VENTANA EMERGENTE PARA LAS EVIDENCIAS-->
										<div class="modal fade" id="ventana1" tabindex="-1" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content" Style="border-radius: 20px;">
													<!-- HEADER DE LA VENTANA-->
													<div class="modal-header">
														<h2 class="modal-title" style="font-size: 20px; font-weight: bold;">Agregar Rubro</h2>
														<button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>

													<!-- CONTENIDO DE LA VENTANA-->
													<div class="modal-body">
													<div class="row">
														<form action="{{route('departamentos.store')}}" method="POST">
															@csrf
															<div class="card-body">
																<div class="row">
																	<div class="col-md-12">
																		<div class="form-group">
																			<label for="name" class="form-label">Nombre del Rubro</label>
																			<input id="name" class="form-control @error('name')is-invalid @enderror" type="text" required
																				placeholder="Ej. Finanzas" name="name" maxlength="250"
																				value="{{ old('name') }}">
																			@error('name')
																				<span class="invalid-feedback" role="alert">
																					<strong> {{ $message }}</strong>
																				</span>
																			@enderror
																		</div>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
																<button type="submit" class="btn btn-primary">
																	Guardar
																</button>
															</div>
														</form>
													</div>
													</div>
												</div>
											</div>
										</div> <!-- FIN DE LA VENTANA EMERGENTE -->
									</div>
								</div> <!-- FIN DEL DIV QU ENGLOBA EL BOTON Y LA VENTANA EMERGENTE -->

								<table class="table text-nowrap" id="hr-table">
									<tbody>
										<tr class="border-bottom">
											<td></td>
											<!-- AGREGAR ACTIVIDADES DESPUES DEL BOTÓN DE AGREGAR -->
										</tr>
									</tbody>
								</table>

							</div>
						</div>
					</div>
					<div class="card-footer text-right">
						<a role="button" class="btn btn-outline-dark" href="{{ url()->previous() }}">
							<i class="feather feather-corner-down-left sidemenu_icon"></i>
							Regresar
						</a>
						<button type="submit" class="btn btn-primary" id="enviar">
							<i class="feather feather-save sidemenu_icon"></i>
							Guardar
						</button>
					</div>
				</form>
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

			ro.innerHTML = '<td><input type="number" name="activity_id[]" id="" class="form-control" value=-1 readonly style="visibility:hidden;"></td>'+
							'<td>'+
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