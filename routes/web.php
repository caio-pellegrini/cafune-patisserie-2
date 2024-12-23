<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\ImageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sobre-nos', function () {
    return view('sobre-nos');
})->name('sobre-nos');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/image', [ImageController::class, 'update'])->name('profile.image');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('listarCheckout');
    Route::get('/checkout-success', [CheckoutController::class, 'checkoutSuccess'])->name('checkout-success');
    Route::get('/checkout-cancel', function () {
        return view('welcome');
    })->name('checkout-cancel');


    Route::post('/pedidos', [OrderController::class, 'store'])->name('novoPedido');
    Route::get('/pedidos', [OrderController::class, 'index'])->name('pedidos');

});

Route::get('/cardapio', [ProductController::class, 'index'])->name('cardapio');
Route::get('/cardapio/{id}', [ProductController::class, 'show'])->name('detalhes');

Route::get('/carrinho', [CarrinhoController::class, 'carrinhoLista'])->name('exibircarrinho');
Route::post('/carrinho', [CarrinhoController::class, 'adicionaCarrinho'])->name('addcarrinho');
Route::post('/remover', [CarrinhoController::class, 'removeCarrinho'])->name('removecarrinho');
Route::post('/atualizar', [CarrinhoController::class, 'atualizaCarrinho'])->name('atualizacarrinho');
Route::get('/limpar', [CarrinhoController::class, 'limpaCarrinho'])->name('limpacarrinho');


require __DIR__.'/auth.php';