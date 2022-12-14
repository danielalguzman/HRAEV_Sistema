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

<!-- ESTABLECIMIENTO DE OBJETIVOS Y CARGAR EVIDENCIA -->
<div class="page-rightheader ml-md-auto">
	<div class="row">
		<div class="col-xl-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="card-body">
				<div class="form-group" style="width=30%;">
						<h4><label for="status_id"><b>Establecimiento de Objetivos</b></label><br></h4>
						<div class="row">
							<div class="table-responsive">
								<table class="table  text-wrap border-bottom table-borderless" id="mytable">
									<tbody>
										<tr>
											<td>
												<div class="form-group">
												<br><label class="form-label">Adjunta la Política de Seguridad.</label>
													<div class="input-group file-browser">
														<input type="text" class="form-control border-right-0 browse-file" placeholder="Formato PDF" readonly value="@isset($profile->url_image){{substr(explode('/', $profile->url_image)[1],10)}}@endisset">
														<label class="input-group-append mb-0">
															<span class="btn ripple btn-primary"> Examinar <input type="file" class="file-browserinput" 
																style="display: none;" accept="image/*" name="url_image" 
																id="url_image" onchange="previewImage(event)">
															</span>
														</label>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>

								<!-- INSERTA LA LECTURA DE QUE SE CARGÓ CON EXITO -->
								<div class="text-right">
									<button type="text" class="btn" id="enviar">
									<input type="text" class="form-control" placeholder="          ... Cargando" readonly>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- SELECCIONAR LA POLÍTICA ALINEADA -->
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

					<!--<select class="form-control custom-select status @error('status_id') is-invalid @enderror"
							name="status_id" id="status_id">
						@isset($statuses)
							<option>  </option>
							@foreach($statuses as $status)
								<option value="{{$status->id}}">
									{{ $status->name }}
								</option>
							@endforeach
						@endisset
					</select> -->

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
</div>


<!-- LECTURA DESDE LA BD DE LOS RUBROS CON LOS QUE CUENTAN LOS CONTROLES -->
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row border-bottom" Style="margin-bottom: 3%;">
                    @isset($departamentos)
                        @foreach ($departamentos as $departamento)
                        <div class="col-xl-5 col-md-5 col-lg-5 bg-white p-4 ml-3 mb-5 rounded border shadow ">
                            <a role="button" href="{{route('proyectos.create',$departamento->id)}}">{{$departamento->name}}</a>
                            {{-- <a class="btn btn-default bg-white pl-5 pr-5" role="button" href="">{{$departamento->name}}</a> --}}
                        </div>
                        @endforeach
                    @endisset
                </div>


				<table class=" text-nowrap" id="hr-table">
					<tbody>
						<tr class="border-bottom">
							<td></td>
							<div class="text-right">
								<!--  <a role="button" class="btn btn-outline-dark" href="{{ url()->previous() }}">
									<i class="feather feather-corner-down-left sidemenu_icon"></i>
									Regresar
								</a>  -->

								<button type="submit" class="btn btn-primary" id="enviar">
									<i class="feather feather-save sidemenu_icon"></i>
									Guardar
								</button>
							</div>
						</tr>
					</tbody>
				</table>
            </div>
        </div>
    </div>
</div>
<!-- FIN DE LA LECTURA DE LOS RUBROS DE LOS CONTROLES -->









<!-- CONTENIDO -->
<!--
<div class="row">
		<div class="col-xl-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="card-body">
					<form action="{{route('proyectos.store')}}" method="POST">
						@csrf
						<h4 class="mb-5 font-weight-semibold">Detalles del proyecto</h4>

						{{-- Primera fila del formulario --}}
						<div class="row">
							{{-- Nombre del evento --}}
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Nombre del proyecto:</label>
									<input class="form-control @error('name') is-invalid @enderror" placeholder="Ingresa nombre del proyecto" name="name" type="text" maxlength="50" value="{{ old('name') }}" required>
									@error('name')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
								</div>
							</div>
							{{-- Fecha de inicio --}}
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Fecha de inicio:</label>
									<div class="input-group">
										<input class="form-control fc-datepicker @error('start_date') is-invalid @enderror" placeholder="YYYY-MM-DD" type="date" name="start_date" value="{{ old('start_date') }}" required>
										@error('start_date')
                                    	    <span class="invalid-feedback" role="alert">
                                    	        {{ $message }}
                                    	    </span>
                                    	@enderror
									</div>
								</div>
							</div>
							{{-- Fecha de finalización --}}
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Fecha de finalización:</label>
									<div class="input-group">
										<input class="form-control fc-datepicker @error('end_date') is-invalid @enderror" placeholder="YYYY-MM-DD" type="date" name="end_date" value="{{ old('end_date') }}" required>
										@error('end_date')
                                    	    <span class="invalid-feedback" role="alert">
                                    	        {{ $message }}
                                    	    </span>
                                    	@enderror
									</div>
								</div>
							</div>
							{{-- Cliente --}}
							<div class="col-md-3">
								<div class="form-group">
									<label class="form-label">Cliente:</label>
									<select class="form-control custom-select select2 @error('customer_id') is-invalid @enderror" data-placeholder="Selecciona un cliente" id="customer_id" name="customer_id" required>
										<option value="-1" selected hidden>Selecciona un cliente</option>
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

						{{-- Segunda fila del formulario --}}
						<div class="row">
							{{-- Descripción --}}
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Descripción:</label>
									<textarea rows="3" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Agrega una breve descripción" maxlength="250" required></textarea>
									@error('description')
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
									<label class="form-label">Costo por hora:</label>
									<input type="number" name="cost_hour" id="cost_hour" maxlength="6" class="form-control mb-md-1 mb-5 @error('cost_hour') is-invalid @enderror" onkeyup="updateCostActivities(event);" onchange="updateCostActivities(event);" value="150" value="{{ old('cost_hour') }}"  required>
									@error('cost_hour')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
								</div>
							</div>
						</div>

						<div class="d-flex">
							<h4 class="mb-5 font-weight-semibold">Actividades del proyecto</h4>
						</div>
						


						{{-- Tabla de actividades --}}
						<div class="row">
							<div class="table-responsive">
								<table class="table  text-wrap border-bottom table-borderless" id="mytable">
									<thead>
										<tr>
											<th class="border-bottom-0 text-center" width='65%'>Actividad</th>
											<th class="border-bottom-0 text-center" width='25%'>Asignada a</th>
											<th class="border-bottom-0 text-center" width='100px'>Fecha fin</th>
											<th class="border-bottom-0 text-center" width='12%'>Horas</th>
											<th class="border-bottom-0 text-center">Monto</th>
											<th class="border-bottom-0 text-center"> </th>
										</tr>
									</thead>
									<tbody id="lista_actividades">
										<tr>
											<td>
												<input type="text" name="activity_name[]" id="" placeholder="Ingresa titulo de actividad" style=" width:100%;" class="form-control @error('activity_name[]') is-invalid @enderror" value="{{ old('activity_name[]') }}" required>
												@error('activity_name[]')
                                    			    <span class="invalid-feedback" role="alert">
                                    			        {{ $message }}
                                    			    </span>
                                    			@enderror
											</td>
											<td>
												<select name="user_id[]" id="" class="form-control custom-select select2 @error('user_id') is-invalid @enderror" required>
													<option value="-1" selected  hidden>Asignar a...</option>
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
												<input type="date" name="activity_end_date[]" id="" class="form-control fc-datepicker @error('activity_end_date[]') is-invalid @enderror" required>
												@error('activity_end_date[]')
                                    			    <span class="invalid-feedback" role="alert">
                                    			        {{ $message }}
                                    			    </span>
                                    			@enderror
											</td>
											<td>
												<input type="number" class="form-control mb-md-1 mb-5 hours @error('time_hour[]') is-invalid @enderror" value=0 min="1" align="right" name="time_hour[]" onchange="updateCostActivity(event);" onkeyup="updateCostActivity(event);" value="{{ old('time_hour[]') }}" required>
												@error('time_hour[]')
                                    			    <span class="invalid-feedback" role="alert">
                                    			        {{ $message }}
                                    			    </span>
                                    			@enderror
											</td>
											<td class="amounts">$0.00</td>
											<td  onclick="removeActivity(event);">
												<a class="action-btns1" title="Remover"><i class="fa-solid fa-xmark text-danger"></i></a>
											</td>
										</tr>
									</tbody>
								</table>

								<button type="button" class="btn btn-outline-info mr-2" onclick="addActivity(event);">Agregar Actividad</button>

								<table class="table text-nowrap" id="hr-table">
									<tbody>
										<tr class="border-bottom">
											<td></td>
											<td align="right" width="15%"><h6 class="mb-1 fs-17 text-muted">Total:</h6></td>
											<td width="15%"><input class="form-control mb-md-1 mb-5 fs-17" id="total" name="total_cost" value="$0.00" readonly></td>
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
-->
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
