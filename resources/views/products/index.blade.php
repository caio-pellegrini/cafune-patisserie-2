{{-- Verifica se há produtos disponíveis --}}
@if($products->count())
    <div class="products-container">
        {{-- Loop através de cada produto --}}
        @foreach ($products as $product)
        @if($products->count())
            <div class="product-details">
                <h2>{{ $product->name }}</h2> {{-- Exibe o nome do produto --}}
                <p>{{ $product->description }}</p> {{-- Exibe a descrição do produto --}}
                <p>Preço: R$ {{ number_format($product->price, 2, ',', '.') }}</p> {{-- Exibe o preço do produto --}}

                {{-- Verifica se existe um caminho de imagem e exibe a imagem --}}
                @if($product->product_image)
                    <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->name }}" style="max-width: 100%;">
                @endif

                {{-- Exibe a categoria do produto, se disponível --}}
                @if($product->category)
                    <p>Categoria: {{ $product->category->name }}</p>
                @endif
            </div>
        @else
            <p>Nenhum produto encontrado.</p>
        @endif
        @endforeach
    </div>
@else
    <p>Nenhum produto encontrado.</p>
@endif
