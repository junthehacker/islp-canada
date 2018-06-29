<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top filled" id="primary-nav">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}"><i class="fa fa-caret-left" aria-hidden="true"></i> Landing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('forum') }}"><i class="fa fa-home" aria-hidden="true"></i> Forum Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('forum/new') }}"><i class="fa fa-plus" aria-hidden="true"></i> New Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/portal/login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Portal</a>
                </li>
            </ul>
        </div>
    </div>
</nav>