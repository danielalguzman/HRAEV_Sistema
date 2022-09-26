@extends('templates.main')

@section('content')

<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title"><b>Controles</b></h4>
    </div>
    <div class="page-rightheader ml-md-auto">
        <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
            <div class="btn-list">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventana1">
                    <i class="fa-solid fa-plus"></i>
                    Agregar Rubro
                </button>

                <!-- VENTANA EMERGENTE -->
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
                </div>
            </div>
        </div>
    </div>
</div>





<!-- CONTENIDO DE DEPARTAMENTOS -->
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @isset($departamentos)
                        @foreach ($departamentos as $departamento)
                        <div class="col-xl-5 col-md-5 col-lg-5 bg-white p-4 ml-3 mb-5 rounded border shadow ">
                            <a role="button" href="{{route('proyectos.create',$departamento->id)}}">{{$departamento->name}}</a>
                            {{-- <a class="btn btn-default bg-white pl-5 pr-5" role="button" href="">{{$departamento->name}}</a> --}}
                        </div>
                        @endforeach
                    @endisset
                </div>

                </div>

            </div>

        </div>

    </div>
</div>
<!-- FIN CONTENIDO DE DEPARTAMENTOS -->





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
