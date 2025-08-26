<?php

use function Livewire\Volt\{state, mount};

state([
    'a' => 0,
    'b' => 0,
    'op' => '',
    'symbol' => '',
    'result' => null,
    'error' => null,
]);

mount(function (string $a, string $op, string $b) {
    $this->a = (int)$a;
    $this->b = (int)$b;
    $this->op = strtolower($op); 

    switch ($op) {
        case 'addition':       $this->symbol = '+'; $val = $this->a + $this->b; break;
        case 'subtraction':    $this->symbol = '-'; $val = $this->a - $this->b; break;
        case 'multiplication': $this->symbol = 'x'; $val = $this->a * $this->b; break;
        case 'division':
            $this->symbol = '÷';
            if ($this->b === 0) { $this->error = '0で割れません。'; return; }
            $val = $this->a / $this->b; break;
        default:
            $this->error = '無効な演算子です'; return;
    }

    $this->result = (is_float($val) && fmod($val, 1.0) !== 0.0) ? $val : (int)$val;
});
?>

<div>
    <h1>計算結果</h1>

    @if ($error)
        <p>{{ $error }}</p>
    @else
        <p>{{ $a }} {{ $symbol }} {{ $b }} = {{ $result }}</p>
    @endif

    <hr>
    <p>使い方の例:</p>
    <ul>
        <li>/calcs/1/addition/2 → 3</li>
        <li>/calcs/3/subtraction/1 → 2</li>
        <li>/calcs/2/multiplication/4 → 8</li>
        <li>/calcs/8/division/3 → 2.6666666667</li>
        <li>注意: addition / subtraction / multiplication / division 以外を入力するとエラーになります(T_T)</li>
    </ul>
</div>
