<div class="filter-accordion-body">
    <div class="year-grid">
        @php
            $years = range(date('Y') + 1, 2011);
            $selectedYears = (array) request()->query('years', []);
        @endphp

        @foreach($years as $year)
            @php $isSelected = in_array($year, $selectedYears); @endphp

            <label class="year-pill {{ $isSelected ? 'active' : '' }}">
                {{-- CAMBIO CLAVE: onchange="updateYearPill(this); applyFilters()" --}}
                <input type="checkbox" name="years[]" value="{{ $year }}" 
                       {{ $isSelected ? 'checked' : '' }}
                       onchange="updateYearPill(this); applyFilters()" 
                       style="display: none;">
                <span>{{ $year }}</span>
            </label>
        @endforeach
    </div>
</div>

<script>
    // Esta función local solo cambia el color del botón (UI)
    function updateYearPill(input) {
        if (input.checked) {
            input.parentElement.classList.add('active');
        } else {
            input.parentElement.classList.remove('active');
        }
    }
</script>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/catalog/partials/filters/_accordion_years.css') }}">
@endpush