@extends('front.master.app')

@section('content')
    <section class="slide"></section><!--Slide-->

    <div class="actions-form">
        <h2>Sempre Mutuos</h2>
        <h2>Crédito rápido e online.
            O que falta para sua empresa crescer?</h2>
        <form action="" class="form-home text-center">
            <div class="row">
                <div class="col-6">
                    <a href="{{route('users.create', ['type' => 'debtor'])}}">
                        <button class="btn btn-success" type="button">
                            Quero emprestado <i class="fa fa-money" aria-hidden="true"></i>
                        </button>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{route('users.create', ['type' => 'creditor'])}}">
                        <button class="btn" type="button">
                            Quero ser investidor <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </a>
                </div>
            </div>
        </form>
    </div><!--actions-form-->

    <div class="rectangle"></div><!--rectangle-->

    <div class="clear"></div>

    <section class="quem-somos">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Quem somos?</h2>
                </div>
                <div class="col-sm-4">
                    <img src="{{url('assets/front/images/mutuos.png')}}" alt="Logo mutuos">
                </div>
                <div class="col-sm-8">
                    <p>A Mutuos é uma plataforma online que conecta empresas que necessitam de empréstimos com Investidores, sem burocracia e sem taxas abusivas, tornando este processo muito mais rápido, eficiente e justo. Trabalhamos nos moldes do peer-to-peer lending, que nada mais é que fazer a ponte entre pequenas e médias empresas com possíveis investidores (pessoas físicas) interessados. Tudo online, seguro, e sem burocracia.</p>
                </div>
            </div><!--row-->
        </div><!--Container-->
    </section><!--quem-somos-->

    <section class="como-funciona">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Como funciona?</h2>
                </div>
                <div class="col-sm-4">
                    <p>Após a criação da conta, suas informações serão analisadas e a resposta é rápida: só leva três dias. Se o pedido for aprovado, você receberá por e-mail uma proposta de empréstimo pessoal que cabe no seu bolso.</p>
                </div>
                <div class="col-sm-4">
                    <p>Envie os documentos pessoais necessários através do site da Mutuos. Para agilizar o processo, as fotos podem ser tiradas e enviadas pelo celular – desde que sejam legíveis.</p>
                </div>
                <div class="col-sm-4">
                    <p>Com as informações enviadas corretamente, seu pedido de empréstimo será aprovado. Para receber o dinheiro na conta, você precisará apenas confirmar o recebimento dos boletos bancários referentes à proposta.</p>
                </div>
            </div><!--row-->
        </div><!--Container-->
    </section><!--como funciona-->

    <footer class="contato">

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-12">
                    <h2>Contate-nos, estamos a disposição</h2>

                        <p>Fone:  (31) 9540-3432
                        Email: contato@sempremutuos.com.br
                        Endereço: Av. João Pinheiro 274 - 1° andar - Praça da Liberdade-Belo Horizonte/MG </p>
                </div>
            </div><!--row-->
        </div><!--Container-->

    </footer><!--Footer-->
@endsection
