@extends('layout')
@section('pagina_titulo', 'minhas compras')

@section('pagina_conteudo')

<div class="container">
	<div class="row">
		<h3>Minhas compras</h3>
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
        <div class="divider"></div>
        <div class="col s12 m12 l12">
        	<h4>Compras concluídas</h4>
        	@forelse($compras as $pedido)
        		<h5 class="col l6 s12 m6 ">Pedido: {{ $pedido->id }}</h5>
        		<h5 class="col l6 s12 m6 ">Criado em: {{ $pedido->created_at->format('d/m/Y H:i') }}</h5>

        		<table>
        			<thead>
        				<tr>
        					<th></th>
        					<th></th>
        					<th></th>
        					<th></th>
        					<th></th>
        				</tr>
        			</thead>
        		</table>

        	@endforelse
        </div>
	</div>
</div>
