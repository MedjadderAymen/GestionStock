<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header align-items-center mb-2">
            <img src="{{asset("assets/img/brand/Stock.png")}}" style="width: 120px" alt="stock">
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route("home")}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("user.index")}}">
                            <i class="fas fa-users text-primary"></i>
                            <span class="nav-link-text">Employers</span>
                        </a>
                    </li>
<!--                    <li class="nav-item">
                        <a class="nav-link" href="{{route("site.index")}}">
                            <i class="fas fa-warehouse text-primary"></i>
                            <span class="nav-link-text">Sites</span>
                        </a>
                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("stock.index")}}">
                            <i class="ni ni-box-2 text-primary"></i>
                            <span class="nav-link-text">Parc</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("printer.index")}}">
                            <i class="fas fa-print text-primary"></i>
                            <span class="nav-link-text">Imprimantes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("toner.index")}}">
                            <i class="ni ni-palette text-primary"></i>
                            <span class="nav-link-text">Toner</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("invoice.index")}}">
                            <i class="fas fa-file-invoice text-primary"></i>
                            <span class="nav-link-text">Facture</span>
                        </a>
                    </li>
                </ul>
                <!-- Divider -->
                <hr class="my-3">

                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">System</span>
                </h6>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link" href="" target="_blank">
                            <i class="ni ni-spaceship"></i>
                            <span class="nav-link-text">Report error</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
