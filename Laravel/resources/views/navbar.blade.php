
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto text-center">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
            <i class="fas fa-cube"></i> Inicio
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('misProveedores') ? 'active' : '' }}" href="/misProveedores">
            <i class="fas fa-users"></i> Proveedores
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('misProductos') ? 'active' : '' }}" href="/misProductos">
            <i class="fas fa-cogs"></i> Productos
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('misCategorias') ? 'active' : '' }}" href="/misCategorias">
            <i class="fas fa-th-list"></i> Categorías
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
