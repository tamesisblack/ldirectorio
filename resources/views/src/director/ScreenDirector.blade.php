@extends('layouts.layoutPrincipal')
@section('title', 'Directores')
@section('content')

<!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Directorio</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Directorio</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{-- @livewire('director-mantenimiento') --}}
                <!-- Botón Agregar Director -->
                <button class="btn btn-success mb-3" id="btnAgregarDirector" data-toggle="modal" data-target="#modalEditar">Agregar Director</button>
                <button class="btn btn-primary mb-3 ml-3" data-toggle="modal" data-target="#modalFiltro">
                    Mostrar Filtro
                </button>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        
                            <th>Extensión</th>
                            <th>Nombre</th>
                            <th>Dependencia</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Extensión</th>
                            <th>Nombre</th>
                            <th>Dependencia</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($directores as $item)
                        <tr>
                        
                            <td>{{ $item->ext_num }}</td>
                            <td>{{ $item->usu_nom }}</td>
                            <td>{{ $item->dep_nom }}</td>
                            <td>{{ $item->depto_nom }}</td>
                            <td>
                                <!-- Botón para editar un director -->
                                <button class="btn btn-primary btnEditar m-2" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modalEditar">Editar</button>
                                <!-- Botón para eliminar un director -->
                                <button class="btn btn-danger btnEliminar m-2" data-id="{{ $item->id }}">Eliminar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para editar/agregar director -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalFiltroLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFiltroLabel">Editar Director</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de edición/agregación -->
                    <form id="formEditarDirector">
                        @csrf
                        <input type="hidden" id="directorId" name="directorId">
            
                        <div class="form-group">
                            <label for="ext_num">Extensión</label>
                            <input type="text" class="form-control" id="ext_num" required name="ext_num">
                        </div>
                        <div class="form-group">
                            <label for="usu_nom">Nombre</label>
                            <input type="text" class="form-control" id="usu_nom" required name="usu_nom">
                        </div>
                        <div class="form-group">
                            <label for="dep_nom">Dependencia</label>
                            <input type="text" class="form-control" id="dep_nom" required name="dep_nom">
                        </div>
                        <div class="form-group">
                            <label for="depto_nom">Descripción</label>
                            <input type="text" class="form-control" id="depto_nom" required  name="depto_nom">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal para editar/agregar director -->
    <!--modal filto-->
    <!-- Modal -->
    <div class="modal fade" id="modalFiltro" tabindex="-1" role="dialog" aria-labelledby="modalFiltroLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen modal-dialog-scrollable" role="document">    
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFiltroLabel">Filtro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí cargarás tu componente Livewire -->
                    @livewire('directoriofiltro')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <!-- Puedes agregar un botón de guardar u otra acción si lo necesitas -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- Fin Modal -->
@endsection

@push('scripts')
<script>
   $(document).ready(function() {
        // Verificar si la tabla ya tiene una instancia de DataTables
        if ($.fn.DataTable.isDataTable('#dataTable')) {
            // Destruir la instancia existente de DataTables
            $('#dataTable').DataTable().destroy();
        }
        
        // Inicializar DataTables con la configuración necesaria
        $('#dataTable').DataTable({
            // Configuración de DataTables
            "ordering": false, // Desactivar el ordenamiento inicial si es necesario
            // Otros parámetros según tus necesidades
        });
    });
</script>
<!-- SweetAlert 2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Notificación de éxito
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}'
        });
        @endif

        // Notificación de error
        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: '{{ session('error') }}'
        });
        @endif

        // Escuchar clic en botón de eliminar
        var botonesEliminar = document.querySelectorAll('.btnEliminar');
        botonesEliminar.forEach(function (boton) {
            boton.addEventListener('click', function (event) {
                event.preventDefault();
                var id = boton.getAttribute('data-id');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede deshacer",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Enviar solicitud POST para eliminar
                        eliminarDirector(id);
                    }
                });
            });
        });

        function eliminarDirector(id) {
            // Construir la URL de eliminación
            var url = "{{ route('director.eliminar', ':id') }}";
            url = url.replace(':id', id);

            // Enviar la solicitud POST
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Mostrar mensaje de éxito
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: data.message // Mensaje de éxito desde el controlador
                });

                // Actualizar la página o hacer cualquier acción adicional necesaria
                location.reload(); // Recargar la página
            })
            .catch(error => {
                // Mostrar mensaje de error
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'Hubo un problema al eliminar el director'
                });
            });
        }
        var botonesEditar = document.querySelectorAll('.btnEditar');
        botonesEditar.forEach(function (boton) {
            boton.addEventListener('click', function (event) {
                event.preventDefault();
                var id = boton.getAttribute('data-id');

                // Realizar solicitud AJAX para obtener los datos del director
                fetch("{{ url('/director') }}/" + id)
                    .then(response => response.json())
                    .then(data => {
                        // Llenar el formulario con los datos obtenidos
                        document.getElementById('directorId').value = data.id;
                     
                        document.getElementById('ext_num').value = data.ext_num;
                        document.getElementById('usu_nom').value = data.usu_nom;
                        document.getElementById('dep_nom').value = data.dep_nom;
                        document.getElementById('depto_nom').value = data.depto_nom;

                        // Abrir el modal de edición
                        $('#modalEditar').modal('show');
                    })
                    .catch(error => {
                        console.error('Error al obtener los datos del director:', error);
                        Swal.fire({
                            icon: 'error',
                            title: '¡Error!',
                            text: 'Hubo un problema al cargar los datos del director'
                        });
                    });
            });
        });

         // Manejar envío del formulario de edición
         var formEditarDirector = document.getElementById('formEditarDirector');
        formEditarDirector.addEventListener('submit', function (event) {
            event.preventDefault();

            // Obtener los datos del formulario
            var formData = new FormData(formEditarDirector);
            var url = formData.get('directorId') ? "{{ route('director.actualizar', ':id') }}" : "{{ route('director.agregar') }}";
            if (formData.get('directorId')) {
                url = url.replace(':id', formData.get('directorId'));
            }

            // Realizar solicitud AJAX para enviar los datos al servidor
            fetch(url, {
                method: formData.get('directorId') ? 'POST' : 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Mostrar mensaje de éxito
                if (data.success) {
                    // Mostrar SweetAlert de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: data.message
                    });

                    // Cerrar el modal después de actualizar
                    $('#modalEditar').modal('hide');

                    // Actualizar la interfaz de usuario si es necesario
                    actualizarInterfazUsuario(data); // Función para actualizar según los datos recibidos

                } else {
                    // Mostrar SweetAlert de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message
                    });
                }
                // Cerrar el modal después de actualizar
                $('#modalEditar').modal('hide');

                // Opcional: Recargar la página o actualizar los datos en la tabla
                // location.reload();
            })
            .catch(error => {
                console.error('Error al actualizar los datos del director:', error);
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'Hubo un problema al actualizar los datos del director'
                });
            });
        });
    });

    // Función para actualizar la interfaz de usuario según los datos recibidos
    function actualizarInterfazUsuario(datos) {
        location.reload();
    }
</script>
@endpush
@section('styles')
    <style>
        /* Aquí puedes agregar tus estilos personalizados */
        .modal-fullscreen {
            width: 100vw;
            max-width: none;
            height: 100vh;
            margin: 0;
        }
    </style>
@endsection
