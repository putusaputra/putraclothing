<nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Putra Clothing</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/shop">Shop</a>
            </li>
          </ul>
          <div class="nav-item float-lg-right">
            <a class = "checkout-link" href = "/checkout" title = "Checkout here !">
              <img class = "checkout-icon" src = "{{ asset('icons/cart.svg') }}"/>
              <span id = "checkout-count" class = "badge badge-secondary"></span>
            </a>
            <a class="nav-link nav-link-checkout" href="/admin">Admin Page</a>
          </div>
        </div>
      </nav>