<?php
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Admin\ShowProducts;

route::get('/', ShowProducts::class)->name('admin.index');