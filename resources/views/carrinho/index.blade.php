@extends('layout')
@section('pagina_titulo', 'carrinho')

@section('pagina_conteudo')

<div class="container">
    <div class="row">
        <h3>Produtos carrinho</h3>
        <hr/>
        @if(Session::has('mensagem-sucesso'))
            <div class="card-panel green">
                <strong>{{ Session::get('mensagem-sucesso') }}</strong>
            </div>
        @endif

         @if(Session::has('mensagem-falha'))
            <div class="card-panel green">
                <strong>{{ Session::get('mensagem-falha') }}</strong>
            </div>
        @endif
        @forelse($pedidos as $pedido)
        <h5 class="col l6 s12 m6"> Pedido: {{ $pedido->id }} </h5>
        <h5 class="col l6 s12 m6"> Criado em: {{ $pedido->created_at->format('d/m/Y H:i') }}</h5>

        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Qtd</th>
                    <th>Produto</th>
                    <th>Valor Unit.</th>
                    <th>Desconto</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @php
                 $total_pedido = 0;
                @endphp

                @foreach($pedido->pedido_produtos as $pedido_produto)


                    <tr>
                        <td>
                            <img width="100" height="100" src="{{ asset($pedido_produto->produto->imagem) }}">
                        </td>
                        <td class="center-align">
                            <div class="center-align">
                                <a class="col l4 m4 s4" href="#" onclick="carrinhoRemoverProduto({{ $pedido->id }}, {{ $pedido_produto->produto_id }}, 1 )">
                                    <i class="material-icons small">remove_circle_outline</i>
                                </a>
                                <span class="col l4 m4 s4"> {{ $pedido_produto->qtd }} </span>
                                <a class="col l4 m4 s4" href="#" onclick="carrinhoAdicionarProduto({{ $pedido_produto->produto_id }})">
                                    <i class="material-icons small">add_circle_outline</i>
                                </a>

                            </div>
                            <a href="#"  onclick="carrinhoRemoverProduto({{ $pedido->id }}, {{ $pedido_produto->produto_id }}, 0 )" class="tooltipped" data-position="right" data-delay="50" data-tooltip="Retirar produto do carrinho">Retirar produto</a>
                        </td>
                        <td>{{ $pedido_produto->produto->nome }}</td>
                        <td>R$ {{ number_format($pedido_produto->produto->valor,2 , ',' , '.') }}</td>
                        <td>R$ {{ number_format($pedido_produto->produto->desconto,2 , ',' , '.') }}</td>
                         @php
                            $total_produto = $pedido_produto->valores - $pedido_produto->descontos;
                            $total_pedido += $total_produto;
                         @endphp
                         <td>R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            <strong class="col offset-16 offset-m6 offset-s6 offset-m6 l4 m4 s4 right-align">Total do pedido: </strong>
            <span class="col l2 m2 s2 ">R$ {{ number_format($total_pedido,2, ',', '.') }}</span>
        </div>

         <div class="row">
            <a class="btn-large tooltipped col l4 s4 m4 offset-18 offset-l8 offset-s8 offfset-m8" data-position="top" data-delay="50" data-tooltip="Voltar a página inicial para continuar comprando?" href="{{ route('index') }}">Continuar comprando</a>
        </div>
       @empty
        <h5>Não há nenhum produto no carrinho</h5>
        
       @endforelse
    </div>
</div>

<form id="form-remover-produto" method="POST" action="{{ route('carrinho.remover') }}">
    {{ csrf_field() }}
    {{ method_field("DELETE")}}
    <input type="hidden" name="pedido_id">
    <input type="hidden" name="produto_id">
    <input type="hidden" name="item">
</form>

<form id="form-adicionar-produto" method="POST" action="{{ route('carrinho.adicionar') }}">
    {{ csrf_field() }}
    <input type="hidden" name="id">
    
</form>

 @push('scripts')
  <script type="text/javascript" src="\js\carrinho.js"></script>
 @endpush

@endsection