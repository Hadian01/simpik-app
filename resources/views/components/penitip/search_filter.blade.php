{{-- KOMPONEN SEARCH & FILTER --}}
<div class="d-flex justify-content-end align-items-center gap-5 mb-4">

    {{-- Search Input --}}
    <div class="input-group" style="width: 300px;">
        <div class="input-group-prepend">
            <span class="input-group-text" style="background: white; border-right: none;">
                <i class="bi bi-search"></i>
            </span>
        </div>
        <input type="text" id="searchInput" class="form-control" placeholder="Search" style="border-left: none;">
    </div>

    {{-- Filter Button --}}
    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modalFilter">
        <i class="bi bi-funnel"></i> Filter
    </button>
</div>
