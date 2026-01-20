{{-- KOMPONEN CARD Dashboard --}}
<div class="col-md-4 mb-3">
    <div class="card text-center"
         style="background: {{ $bg_color ?? '#E3DFFF' }};
                border: none;
                border-radius: 12px;
                padding: 20px;">
        <h5 class="mb-2 font-weight-semibold">{{ $title }}</h5>
        <h2 class="mb-0 font-weight-bold">{{ $value }}</h2>
    </div>
</div>
