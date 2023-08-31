<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{route('dashboard')}}">
            <img src="{{asset ('AdminADP/vendors/images/hoteldeville.png')}}" width="50px" height="50px" alt="" class="light-logo"> &nbsp; GestADP
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href=" {{route('dashboard')}} " class="dropdown-toggle no-arrow">
                        <span class="micon icon-copy fa fa-dashboard"></span><span class="mtext">Dashboard</span>
                    </a>
                </li>
                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon icon-copy fa fa-group"></span><span class="mtext">Proprietaires</span>
                        </a>
                        <ul class="submenu">
                            @access('create','Propriétaire')
                            <li><a href="{{ route('proprietaires.create') }}">Nouveau</a></li>
                            @endaccess
                            @access('read','Propriétaire')
                            <li><a href="{{ route('proprietaires.index') }}">Liste</a></li>
                            @endaccess
                        </ul>
                    </li>
                </ul>
                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">        
                            <span class="micon icon-copy fa fa-home"></span><span class="mtext">Parcelles</span>
                        </a>
                        <ul class="submenu">
                            @access('create','Parcelle')
                            <li><a href="{{ route('parcelles.create') }}">Nouveau</a></li>
                            @endaccess
                            @access('read','Parcelle')
                            <li><a href="{{ route('parcelles.index') }}">Liste</a></li>
                            @endaccess
                        </ul>
                    </li>
                </ul>
                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle"> 
                            <span class="micon icon-copy fa fa-print"></span><span class="mtext">Paiements</span>
                        </a>
                        <ul class="submenu">
                            @access('create','Paiement')
                            <li><a href="{{ route('paiements.create') }}">Nouveau</a></li>
                            @endaccess
                            @access('read','Paiement')
                            <li><a href="{{ route('paiements.index') }}">Liste</a></li>
                            @endaccess
                        </ul>
                    </li>
                </ul>
                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle"> 
                            <span class="micon icon-copy fa fa-file-text"></span><span class="mtext">Attestations</span>
                        </a>
                        <ul class="submenu">
                            @access('create', 'Attestation')
                            <li><a href="{{route('attestations.create')}}">Nouveau</a></li>
                            @endaccess
                            @access('read', 'Attestation')
                            <li><a href="{{route('attestations.index')}}">Liste</a></li>
                            @endaccess
                        </ul>
                    </li>
                </ul>

                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <i class="" aria-hidden="true"></i> 
                            <span class="micon icon-copy fa fa-user-circle-o"></span><span class="mtext">Agents</span>
                        </a>
                        <ul class="submenu">
                            @access('create', 'User')
                            <li><a href="{{ route('agents.create') }}">Nouveau</a></li>
                            @endaccess
                            @access('read', 'User')
                            <li><a href="{{ route('agents.index') }}">Liste</a></li>
                            @endaccess
                        </ul>
                    </li>
                </ul>
                @access('read', 'Fonction') 
                <li>
                    <a href="{{ route('fonctions.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon icon-copy fa fa-legal"></span><span class="mtext">Fontions</span>
                    </a>
                </li>
                @endaccess
                @access('read', 'Category')
                <li>
                    <a href="{{ route('categories.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon icon-copy fa fa-linode"></span><span class="mtext">Categories</span>
                    </a>
                </li>
                @endaccess
                @access('read', 'Nationality')
                <li>
                    <a href="{{ route('nationalities.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon icon-copy fa fa-chain"></span><span class="mtext">Nationnalités</span>
                    </a>
                </li>
                @endaccess
            </ul>
        </div>
    </div>
</div>