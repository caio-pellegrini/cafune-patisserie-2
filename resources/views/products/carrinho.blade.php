<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Styles -->
</head>

<body class="antialiased">
  @include('layouts.navigation')



  <div class="sm:justify-center sm:items-center relative min-h-screen bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    @if ($mensagem = Session::get('sucesso'))
    <div class="card green">
      <div class="card-content white-text">
        <span class="card-title">Parabeéns</span>
        <p>{{ $mensagem }}</p>
      </div>
    </div>
    @endif

    @if ($mensagem = Session::get('aviso'))
    <div class="card green">
      <div class="card-content white-text">
        <span class="card-title">Tudo bem</span>
        <p>{{ $mensagem }}</p>
      </div>
    </div>
    @endif

    @if($itens->count() == 0)
    <div class="card yellow">
      <div class="card-content white-text">
        <span class="card-title">Seu carrinho está vazio</span>
        <p>Aproveite nossas promoções</p>
      </div>
    </div>
    @else
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Seu carrinho possui '). $itens->count() .__(' itens.') }}
    </h2>



    <table class="stripped">
      <thead>
        <tr>
          <th></th>
          <th>Nome</th>
          <th>Preço</th>
          <th>Quantidade</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($itens as $item)
        <tr>
          <td><img src="{{ asset('storage/' . $item->attributes->image) }}" alt="{{ $item->name }}" style="max-width: 100%;"></td>
          <td>{{ $item->name }}</td>
          <td>R$ {{ number_format($item->price, 2, ',', '.') }}/{{ $item->attributes->unit_of_measure }}</td>
          {{-- BTN ATUALIZAR --}}
          <form action="{{ route('atualizacarrinho') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            <td><input style="width: 50px; font-weight: 900;" class="white center quantity-input" type="number" min="1" name="quantity" value="{{ $item->quantity }}"></td>
          </form>
          <td>


            {{-- BTN DELETAR --}}
            <form action="{{ route('removecarrinho') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{ $item->id }}">
              <button class="btn-floating waves-effect waves-light red"><i class="material-icons">delete</i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <h5>
      Valor Total: R$ {{ number_format(\Cart::getTotal(), 2, ',', '.') }}
    </h5>

    <div class="row container center">


      <a href=" {{ route('cardapio') }}" class="btn waves-effect waves-light blue">Continuar comprando<i class="material-icons">arrow_back</i></a>
      <a href="{{ route('limpacarrinho') }}" class="btn waves-effect waves-light blue">Limpar carrinho<i class="material-icons">clear</i></a>
      <button class="btn waves-effect waves-light green">Finalizar pedido<i class="material-icons">check</i></button>
    </div>

    @endif



  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var quantityInputs = document.querySelectorAll('.quantity-input');

      quantityInputs.forEach(function(input) {
        input.addEventListener('change', function() {
          this.form.submit();
        })
      });

    });
  </script>

</body>

</html>