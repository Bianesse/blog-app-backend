<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#" style="padding-left: 2rem">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto"> 
      <li class="nav-item active">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/about">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/formProduct/add">Add Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/posts">Posts</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="{{ route('logout') }}" onclick="return confirm('Are you sure?');" class="nav-link">
          <button type="button" class="btn btn-danger">Logout</button>
        </a>
      </li>
    </ul>
  </div>
</nav>
