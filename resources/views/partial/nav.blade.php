<div class="col-12 padding-zero">
  <nav class="navbar navbar-expand-md navbar-dark bg-navbar">
    <a href="/"><img class="navbar-brand logo-size" src="/img/logoo.png"></a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
      <div class="hide-nav-item navbar-nav">
        <a href="/" class="nav-item nav-link active">Home</a>
        <a href="/subscription" class="nav-item nav-link">Subscription</a>
        <a href="/movie" class="nav-item nav-link">Moive</a>
        <a href="/drama" class="nav-item nav-link">Drama</a>
        <a href="/music" class="nav-item nav-link">Music</a>
        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">More</a>
          <div class="dropdown-menu">
            <a href="/tvshow" class="text-white dropdown-item">TV Show</a>
            <a href="/comedy" class="text-white dropdown-item">Comedy</a>
            <a href="/healtheducation" class="text-white dropdown-item">Health & Education</a>
          </div>
        </div>
      </div>
      <div class="flag-div"></div>
      <form class="form-inline" action="{{route('search')}}" method="post">
        @csrf
        <div class="input-group nav-item">
          <input name="key" type="text" size="50" class="form-control search-input" placeholder="Search for Movie, Drama, TV Show and Music Video">
          <div class="input-group-append">
            <button type="submit" class="btn btn-light"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form>
      <div class="hide-nav-item navbar-nav">
        <a href="/myaccount" class="nav-item nav-link">My Account</a>
      </div>
      <div class="navbar-nav">
        <br>
        @if($cookie_value_msisdn!="")
      		<a href="/logout" class="btn btn-light login-btn">Logout</a>
      	@else
      		<a href="/login" class="btn btn-light login-btn">Login</a>
      	@endif
      </div>
    </div>
  </nav>
</div>
