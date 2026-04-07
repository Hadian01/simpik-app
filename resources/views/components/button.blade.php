{{-- KOMPONEN BUTTON JOIN PENITIP --}}
<button
    type="button"
    class="btn btn-sm {{ $class ?? '' }}" style="background:#9B8CFF;color:white;"
    @if(isset($dataToggle))
        data-toggle="{{ $dataToggle }}"
    @endif
    @if(isset($dataTarget))
        data-target="{{ $dataTarget }}"
    @endif
    onmouseover="this.style.backgroundColor='#8B7CFF'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(155, 140, 255, 0.3)';"
    onmouseout="this.style.backgroundColor='#9B8CFF'; this.style.transform='translateY(0)'; this.style.boxShadow='none';"
    onmousedown="this.style.transform='translateY(0)';"
>
    <strong>{{ $icon ?? '+' }}</strong> {{ $text ?? 'Join sebagai penitip' }}
</button>
