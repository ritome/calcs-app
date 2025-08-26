<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Volt::route('/calcs/{a}/{op}/{b}', 'calc')
    ->whereNumber('a')  // 整数のみ
    ->whereNumber('b'); // 整数のみ
