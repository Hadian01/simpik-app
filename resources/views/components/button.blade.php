{{-- KOMPONEN BUTTON JOIN PENITIP --}}
<button
    type="button"
    class="btn {{ $class ?? '' }}"
    style="background-color: #9B8CFF; color: white; padding: 8px 20px; border-radius: 8px; border: none; transition: all 0.3s ease;"
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
