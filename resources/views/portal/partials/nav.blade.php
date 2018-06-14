<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">ISLP Portal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{Request::route()->getName() === 'dashboard' ? "active": ""}}">
                <a class="nav-link" href="{{url('/portal/dashboard')}}">Dashboard</a>
            </li>
            @if(request()->user->role === 0)
                <li class="nav-item {{Request::route()->getName() === 'competitions' ? "active": ""}}">
                    <a class="nav-link" href="{{url('/portal/competitions')}}">Competitions</a>
                </li>
                <li class="nav-item {{Request::route()->getName() === 'judging' ? "active": ""}}">
                    <a class="nav-link" href="{{url('/portal/judging')}}">Judging</a>
                </li>
                <li class="nav-item {{Request::route()->getName() === 'users' ? "active": ""}}">
                    <a class="nav-link" href="{{url('/portal/users')}}">Users</a>
                </li>
                <li class="nav-item {{Request::route()->getName() === 'mentorapplications' ? "active": ""}}">
                    <a class="nav-link" href="{{url('/portal/mentorapplications')}}">Mentor Applications</a>
                </li>
                <li class="nav-item {{Request::route()->getName() === 'rubric' ? "active": ""}}">
                    <a class="nav-link" href="{{url('/portal/rubric')}}">Rubric</a>
                </li>
            @endif
            @if(request()->user->role === 2)
                <li class="nav-item {{Request::route()->getName() === 'judge' ? "active": ""}}">
                    <a class="nav-link" href="{{url('/portal/judge')}}">Judge</a>
                </li>
            @endif
            @if(request()->user->role === 0 || request()->user->role === 1)
                <li class="nav-item {{Request::route()->getName() === 'submissions' ? "active": ""}}">
                    <a class="nav-link" href="{{url('/portal/submissions')}}">Submissions</a>
                </li>
            @endif
            <li class="nav-item {{Request::route()->getName() === 'account' ? "active": ""}}">
                <a class="nav-link" href="{{url('/portal/account')}}">Account</a>
            </li>
        </ul>
    </div>
</nav>