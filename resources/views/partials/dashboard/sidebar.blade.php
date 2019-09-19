<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>Rapports</a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                    <li class="nav-item">
                                            <a class="nav-link" href="{{route('rapport.users')}}"><i class="fa fa-fw fa-users"></i>Des Utilisateurs</a>
                                        </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('rapport.days.words')}}"><i class="fa fa-fw fa-calendar-check"></i>Jours Travailleé</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('rapport.days.absent')}}"><i class="fa fa-fw fa-window-close"></i>Jour d'absence</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('rapport.times.retard')}}"><i class="fa fa-fw fa-times-circle"></i>Heures de retard</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                             </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
