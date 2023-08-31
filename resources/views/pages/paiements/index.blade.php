@extends('layouts.app')
@section('content')
<div class="min-height-200px">
    <div class="page-header">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><p>{{ $message }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>DataTable</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Paiements</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Export Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Listes des paiements</h4>
        </div>
        <div class="pb-20">
            <table class="table hover data-table-export nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Numéro Paiement</th>
                        <th>Numéro ACP</th>
                        <th>Proprietaire</th>
                        <th>Montant</th>
                        <th>Date de paiement</th>
                        <th>Agent</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paiements as $paiement)   
                    <tr>
                        <td class="table-plus">{{ $paiement->id }}</td>
                        <td>
                            {{ $paiement->parcelle->numACP }}
                        </td>
                            <td>
                                {{ $paiement->proprietaire->nom }} {{ $paiement->proprietaire->postnom }} {{ $paiement->proprietaire->prenom }} 
                            </td>
                        <td>{{ $paiement->montant }}</td>
                        <td>{{ $paiement->datePaie }}</td>
                        <td>{{ $paiement->user->email }}</td>
                        <td>
                            <!-- Les actions à ajouter pour chaque paiement -->
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    @access('read', 'Paiement')
                                    <a class="dropdown-item" href="{{ route('paiements.show', $paiement->id) }}"><i class="dw dw-eye"></i> View</a>
                                    @endaccess

                                    @access('delete', 'Paiement')
                                    @csrf
                                    @method('DELETE')
                                    <a class="dropdown-item" href="{{ route('paiements.destroy',$paiement->id) }}" onclick="supprimer(event)" item="Voulez-vous supprimer le paiement {{ $paiement->id }}" data-toggle="modal" data-target="#supprimer">
                                        <i class="dw dw-delete-3"></i> Supprimer					
                                    </a>
                                    @endaccess
                                </div>
                            </div>
                        </td>
                    </tr>    
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Export Datatable End -->
</div>
@include('partials.delete')
@endsection


@section('scripts')
<script>
    function supprimer(event){
        event.preventDefault();
        a = event.target.closest('a');

        let deleteForm = document.getElementById('deleteForm');
        deleteForm.setAttribute('action', a.getAttribute('href'));

        let textDelete = document.getElementById('textDelete');
        textDelete.innerHTML = a.getAttribute('item') + " ?";

        let titleDelete = document.getElementById('titleDelete');
        titleDelete.innerHTML = "Suppression";           
        
    }
</script>
	<!-- buttons for Export datatable -->
	<script src={{asset('AdminADP/src/plugins/datatables/js/dataTables.buttons.min.js')}}></script>
	<script src={{asset('AdminADP/src/plugins/datatables/js/buttons.bootstrap4.min.js')}}></script>
	<script src={{asset('AdminADP/src/plugins/datatables/js/buttons.print.min.js')}}></script>
	<script src={{asset('AdminADP/src/plugins/datatables/js/buttons.html5.min.js')}}></script>
	<script src={{asset('AdminADP/src/plugins/datatables/js/buttons.flash.min.js')}}></script>
	<script src={{asset('AdminADP/src/plugins/datatables/js/pdfmake.min.js')}}></script>
	<script src={{asset('AdminADP/src/plugins/datatables/js/vfs_fonts.js')}}></script>
				<!-- Datatable Setting js -->
	<script src={{asset('AdminADP/vendors/scripts/datatable-setting.js')}}></script>
@endsection