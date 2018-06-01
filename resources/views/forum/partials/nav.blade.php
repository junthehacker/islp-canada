<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top filled" id="primary-nav">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{Request::route()->getName() === 'landing.home' ? "active": ""}}">
                    <a class="nav-link" href="#home" data-toggle="collapse" data-target=".navbar-collapse.show"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about" data-toggle="collapse" data-target=".navbar-collapse.show"><i class="fa fa-info" aria-hidden="true"></i> About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#register" data-toggle="collapse" data-target=".navbar-collapse.show"><i class="fa fa-pencil" aria-hidden="true"></i> Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#rules" data-toggle="collapse" data-target=".navbar-collapse.show"><i class="fa fa-list-ol" aria-hidden="true"></i> Rules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#schedule" data-toggle="collapse" data-target=".navbar-collapse.show"><i class="fa fa-calendar" aria-hidden="true"></i> Schedule</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/portal/login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Portal</a>
                </li>
            </ul>
        </div>
    </div>
</nav>