<h3>Comandos</h3>
<div class="row">
    <div class="col-lg-6 col-sm-6 col-12">
        @include('partials.input-file')
    </div>
    
    <div class="col-lg-6 col-sm-6 col-12">
        <form id="commands-form" action="{{ url('/resolve') }}" method="POST">
            {!! csrf_field() !!}
            @include('partials.textarea', ['name' => 'commands'])
            <br>
            <button class="btn btn-success">Procesar</button>
        </form>
  </div>
</div>