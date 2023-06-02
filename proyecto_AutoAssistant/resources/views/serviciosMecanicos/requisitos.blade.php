<style>
    .container {
    
    padding: 20px;
    color: #242424;
    }

    .title {
    margin-bottom: 20px;
    }

    .requirements {
    font-size: 19px;
    list-style: none;
    padding-left: 0;
    color: #242424;
    }

    .requirements li{
        background-color: #d9d9d9;
    }

    .accordion {
    margin-bottom: 20px;
    }

    .accordion-header {
    background-color: #007bff;
    color: #fff;
    padding: 10px;
    cursor: pointer;
    }

    .accordion-content {
    background-color: #d9d9d9;
    padding: 10px;
    }

    .cardo{
        background-color: #d9d9d9;
    }
    img{
    max-width: 100%;
    max-height: 160px; 
    display: block;
    margin: 0 auto; 
    object-fit: contain; 
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Servicios Mecanicos') }}
        </h2>
    </x-slot>
    <br>
    @if(auth()->user()->hasRole('taller_mecanico'))
        
        <div class="row">
            <div class="container">
                <details class="accordion" open>
                    <summary class="accordion-header h2 text-white">Requisitos de Mecanicos</summary>
                    <div class="accordion-content">
                        <ol class="list-group list-group-numbered requirements">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Nombre del taller</div>
                                Nombre del taller mecanico para identificarse.
                                </div>
                                <span class="badge bg-danger rounded-pill">Obligatorio</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Dueño o representante</div>
                                Nombre del dueño o un representante del taller.
                                </div>
                                <span class="badge bg-danger rounded-pill">Obligatorio</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Rubro</div>
                                Area en la que trabajaran.
                                </div>
                                <span class="badge bg-danger rounded-pill">Obligatorio</span>
                            </li>
                            
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Direccion</div>
                                Direccion del taller mecanico y funtos de referencias.
                                </div>
                                <span class="badge bg-danger rounded-pill">Obligatorio</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Servicios que ofrecen</div>
                                Nombre del servicio que ofrece el taller.
                                </div>
                                <span class="badge bg-danger rounded-pill">Obligatorio</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Descripcion del servicio</div>
                                Breve descripcion sobre el servicio que se brinda.
                                </div>
                                <span class="badge bg-success rounded-pill">Opcional</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Tipo de servicio</div>
                                El tipo de servicio que ofrecera ya sea adomicilio o con citas previas.
                                </div>
                                <span class="badge bg-danger rounded-pill">Obligatorio</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Horario de atencion</div>
                                Horarios de atencion a clientes.
                                </div>
                                <span class="badge bg-danger rounded-pill">Obligatorio</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Numero de contacto</div>
                                Numero telefonico para contactar.
                                </div>
                                <span class="badge bg-success rounded-pill">Opcional</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Logo o imagen del servicio</div>
                                Logotipo que represente el taller o una imagen que represente el servicio.
                                </div>
                                <span class="badge bg-danger rounded-pill">Obligatorio</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Acreditaciones</div>
                                Imagenes de certificaciones, especializaciones o reconocimientos, MAXIMO 4. 
                                </div>
                                <span class="badge bg-success rounded-pill">Opcional</span>
                            </li>
                        </ol>
                    </div>
                </details>
                <div class="row">
                    <a href="{{ route('servicios-mecanicos.create') }}" class="btn btn-primary btn-lg">Inscribir servicio mecanico</a>
                </div>
            </div>
        </div>
    @endif

    @if(auth()->user()->hasRole('mecanico_independiente'))
        <div class="row">
            <div class="container">
                <details class="accordion" open>
                    <summary class="accordion-header h2 text-white">Requisitos de Mecanicos</summary>
                    <div class="accordion-content">
                        <ol class="list-group list-group-numbered requirements">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Representante</div>
                                Nombre del mecanico para identificarse.
                                </div>
                                <span class="badge bg-danger rounded-pill">Obligatorio</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Rubro</div>
                                Tipo de area en la que trabajara.
                                </div>
                                <span class="badge bg-danger rounded-pill">Obligatorio</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Tipo de servicio</div>
                                El tipo de servicio que ofrecera ya sea adomicilio o con citas previas.
                                </div>
                                <span class="badge bg-danger rounded-pill">Obligatorio</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Servicio que ofrece</div>
                                Nombre del servicio que ofrecera.
                                </div>
                                <span class="badge bg-danger rounded-pill">Obligatorio</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Descripcion del servicio</div>
                                Breve descripcion del servicio que brindara.
                                </div>
                                <span class="badge bg-success rounded-pill">Opcional</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Horario de Atencion</div>
                                Horarios de atencion para clientes.
                                </div>
                                <span class="badge bg-danger rounded-pill">Obligatorio</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Numero de contacto</div>
                                Numero telefonico para contactar.
                                </div>
                                <span class="badge bg-success rounded-pill">Opcional</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Logo o imagen del servicio</div>
                                Logotipo que represente al mecanico o una imagen que represente al servicio.
                                </div>
                                <span class="badge bg-success rounded-pill">Opcional</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Acreditaciones</div>
                                Imagenes de certificaciones, especializaciones o reconocimientos, MAXIMO 4.
                                </div>
                                <span class="badge bg-success rounded-pill">Opcional</span>
                            </li>
                        </ol>
                    </div>
                </details>
                <div class="row">
                    <a href="{{ route('servicios-mecanicos.create') }}" class="btn btn-primary btn-lg">Inscribir servicio mecanico</a>
                </div>
            </div>
        </div>       
    @endif
    

    @if(Auth::check())
        <div class="row">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="container">
                <h2 class="title text-white">Servicios Inscritos</h2>
                <div class="d-flex flex-column">
                    @if($serviciosMecanicos->isEmpty())
                        <div class="col-md-12">
                            <div class="alert alert-info" role="alert">
                                No tienes ningún servicio mecánico inscrito.
                            </div>
                        </div>
                    @else
                        @php
                            $hasServices = false;
                        @endphp
                        @foreach($serviciosMecanicos as $servicioMecanico)
                            @if(Auth::id() == $servicioMecanico->id_user)
                                @php
                                    $hasServices = true;
                                @endphp
                                <div class="card m-2">
                                    <img src="{{ $servicioMecanico->logo }}" class="card-img-top" alt="Imagen del servicio mecánico">
                                    <div class="card-body cardo">
                                        <h5 class="card-title">{{ $servicioMecanico->servicios }}</h5>
                                        <p class="card-text">Creado el: {{ $servicioMecanico->created_at->format('d/m/Y') }}</p>
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('servicios-mecanicos.edit', $servicioMecanico->id) }}" class="btn btn-primary">Modificar</a>
                                            <form action="{{ route('servicios-mecanicos.destroy', $servicioMecanico->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @if(!$hasServices)
                            <div class="col-md-12">
                                <div class="alert alert-info" role="alert">
                                    No tienes ningún servicio mecánico inscrito.
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endif


    

</x-app-layout>
<script>
  function toggleAccordion() {
    const accordion = document.querySelector('.accordion');
    accordion.toggleAttribute('open');
  }
</script>
