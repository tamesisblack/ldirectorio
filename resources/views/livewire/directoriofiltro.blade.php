<div>
    <div>
        <select id="selectDepNom" wire:model="selectedValue" wire:change="filterData" class="form-control mb-3">
            <option value="">Selecciona una opción...</option>
            @foreach ($data as $item)
                <option value="{{ $item->dep_nom }}">{{ $item->dep_nom }}</option>
            @endforeach
        </select>
        
        <!-- Span de cantidad -->
        <span class="badge badge-info">Cantidad: {{ count($filteredData) }}</span>
        <table class="table table-striped table-bordered mt-2">
            <thead class="thead-dark">
                <tr>
                    <th>Extension</th>
                    <th>Nombre</th>
                    <th>Dependencia</th>
                    <th>Descripción</th>
                    <!-- Agrega más columnas según tu modelo -->
                </tr>
            </thead>
            <tbody>
                @foreach ($filteredData as $item)
                    <tr>
                        <td>{{ $item->ext_num }}</td>
                        <td>{{ $item->usu_nom }}</td>
                        <td>{{ $item->dep_nom }}</td>
                        <td>{{ $item->depto_nom }}</td>
                        <!-- Ajusta según tu modelo -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Inicializar Select2 en el elemento select
        $('#selectDepNom').select2({
            placeholder: "Selecciona una opción...",
            allowClear: true, // Mostrar botón para limpiar selección
            width: '100%' // Ancho completo del select
        });

        // Escuchar cambios en Select2 y emitir evento Livewire
        $('#selectDepNom').on('change', function(e) {
            @this.set('selectedValue', e.target.value);
        });

        // Escuchar cambios de búsqueda en Select2 y filtrar datos en Livewire
        $('#selectDepNom').on('select2:select', function(e) {
            @this.set('selectedValue', e.params.data.id);
            @this.filterData();
        });

        // Escuchar cambios de búsqueda en Select2 y filtrar datos en Livewire
        $('#selectDepNom').on('select2:unselect', function(e) {
            @this.set('selectedValue', '');
            @this.filterData();
        });

        Livewire.on('dataFiltered', function() {
            // Esto se ejecuta cuando Livewire emite el evento 'dataFiltered'
            // Puedes agregar aquí cualquier lógica adicional después de filtrar los datos
        });
    });
</script>
@endpush
