<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">FinancePH</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      @if(!auth()->user())
        <li><a href="#" id="create-btn" data-toggle="modal" data-target="#create-register"><span class="glyphicon glyphicon-user"></span> Register</a></li>
        <li><a href="#" id="login-btn" data-toggle="modal" data-target="#login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      @else
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{auth()->user()->name}}
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#" class="update-profile" data-toggle="modal" data-target="#create-register" data-id="{{auth()->user()->id}}" data-name="{{auth()->user()->name}}" data-email="{{auth()->user()->email}}" data-image="{{auth()->user()->image}}">Profile</a></li>
          </ul>
        </li>
        <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      @endif
    </ul>
  </div>
</nav>