<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="stylesheet" href="/css/documentos_dti.css">
</head>
<body class="sidebar-mini layout-fixed">
  <div class="wrapper" id="wrapper">
    <nav class="main-header navbar navbar-expand navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars"></i>
          </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/" class="nav-link" title="Ir a la página de bienvenida">
            {{config('app.name')}}
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" title="Cuenta de usuario">
            <i class="far fa-user fa-lg"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">
              @{{$store.state.user.name}}
              <br>
              @{{$store.state.user.description}}
              <br>
              @{{$store.state.user.email}}
            </span>
            <div class="dropdown-divider"></div>
            <router-link class="dropdown-item" :to="{ name: 'user.profile' }">
              <i class="fas fa-id-badge mr-2"></i>
              Perfil de usuario
            </router-link>
            <div class="dropdown-divider"></div>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="link-streched dropdown-item dropdown-footer link" type="submit">
                {{ __('Logout') }}
              </button>
            </form>
          </div>
        </li>
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="/" class="brand-link">
        <img src="https://ui-avatars.com/api/?size=48&name={{ config('app.name', 'Laravel') }}" alt="SV" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
      </a>
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img v-bind:src="$store.state.user.profile_photo_url" class="img-circle elevation-2" alt="Imagen de usuario">
          </div>
          <div class="info">
            <a href="#" class="d-block">
              @{{$store.state.user.first_name}}
            </a>
          </div>
        </div>
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu">
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'home'} ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Inicio</p>
              </router-link>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                  Configuración
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link class="nav-link" :to="{ name: 'tipo-documentos.index'} ">
                    <i class="nav-icon fas fa-sort-numeric-up"></i>
                    <p>
                      Correlativos
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link" :to="{ name: 'saludos.index'} ">
                    <i class="nav-icon fas fa-university"></i>
                    <p>
                      Saludos
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link" :to="{ name: 'dependencias.index'} ">
                    <i class="fas fa-code-branch nav-icon"></i>
                    <p>Dependencias</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link" :to="{ name: 'entidades.index'} ">
                    <i class="fas fa-store-alt nav-icon"></i>
                    <p>
                      Entidades
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link" :to="{ name: 'cargos.index'} ">
                    <i class="fas fa-certificate nav-icon"></i>
                    <p>
                      Cargos
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link" :to="{ name: 'destinatarios.index'} ">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      Destinatarios
                    </p>
                  </router-link>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'mis-documentos.index', query: { type: 1 } }">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>Mis documentos</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'documentos.index', query: { type: 1 } }">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>Documentos</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'documentos.pendientes', query: { type: 1 } }">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>Pendientes</p>
              </router-link>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <router-view></router-view>
  </div>
  <script src="/js/documentos_dti.js"></script>
</body>
</html>