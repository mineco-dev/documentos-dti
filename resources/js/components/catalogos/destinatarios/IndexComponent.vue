<template>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="rol">
          <div class="col-12">
            <h1>Destinatarios</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="form-row">
              <div class="form-group col-md-6" v-show="count > 10">
                <label for="search">Filtrar</label>
                <input type="search" class="form-control" id="search" v-model="search">
              </div>
              <div class="form-group col-md-2">
                <label id="paginated" for="inputPassword4">Mostrar</label>
                <select class="form-control" id="paginated" v-model="paginate" v-on:change="getList">
                  <option value="5">5 registros de un </option>
                  <option value="10">10 registros</option>
                  <option value="25">25 registros</option>
                  <option value="50">50 registros</option>
                  <option value="100">100 registros</option>
                  <option v-bind:value="destinatarios.total">todos los registros</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <router-link class="btn btn-primary" :to="{ name: 'destinatarios.create' } ">
              <i class="fas fa-plus-circle fa-lg"></i>
              Registrar destinatario
            </router-link>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Cargo</th>
                      <th>Dependencia</th>
                      <th>Entidad</th>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(destinatario, index) in filter">
                      <td>
                        {{ destinatario.saludo ? destinatario.saludo.substring(0,3) : '' }}
                        {{ destinatario.name }}
                      </td>
                      <td>{{ destinatario.cargo }}</td>
                      <td>{{ destinatario.dependencia }}</td>
                      <td>{{ destinatario.entidad }}</td>
                      <td>
                        <router-link :to="{ name: 'destinatarios.edit', params: { id: destinatario.id} }">
                          Modificar
                        </router-link>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row" v-show="destinatarios.total > 0">
          <div class="col-md-12">
            <nav aria-label="...">
              <ul class="pagination justify-content-center">
                <li class="page-item" v-bind:class="{'disabled': destinatarios.current_page == 1}">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true" v-on:click.prevent="cambiarPagina(destinatarios.current_page - 1)">
                    Anterior
                  </a>
                </li>
                <li class="page-item" v-for="page in pagesNumber" v-bind:class="{'active': page == isActived}">
                  <a class="page-link" href="#" v-on:click.prevent="cambiarPagina(page)">{{page}}</a>
                </li>
                <li class="page-item" v-bind:class="{'disabled': destinatarios.current_page == destinatarios.last_page}">
                  <a class="page-link" href="#" v-on:click.prevent="cambiarPagina(destinatarios.current_page + 1)">
                    Siguiente
                  </a>
                </li>
              </ul>
            </nav>
            <p class="text-center">
              Mostrando registros:
              del <b>{{destinatarios.from}}</b>
              al <b>{{destinatarios.to}}</b>
              de un total de <b>{{destinatarios.total}}</b> {{count == 1 ? 'registro' : 'registros'}}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        destinatarios: {data: []},
        paginate: 10,
        search: '',
        offset: 3
      }
    },
    computed: {
      isActived: function() {
        return this.destinatarios.current_page
      },
      pagesNumber: function() {
        if(!this.destinatarios.to) {
          return []
        }
        let from = this.destinatarios.current_page - this.offset
        if( from < 1) {
          from = 1
        }
        let to = from + (this.offset * 2)
        if(to >= this.destinatarios.last_page) {
          to = this.destinatarios.last_page
        }
        let pagesArray = []
        while(from <= to) {
          pagesArray.push(from)
          from++
        }
        return pagesArray
      },
      filter() {
        return this.destinatarios.data.filter(entidad => entidad.name.toLowerCase().includes(this.search.toLowerCase()))
      },
      count() {
        return this.destinatarios.data.length
      }
    },
    mounted() {
      this.getList(1)
    },
    methods: {
      getList(page) {
        axios.get(`/api/destinatarios?paginate=${this.paginate}&page=${page}`).then(response => this.destinatarios = response.data)
        .catch(error => alert(error.response))
      },
      cambiarPagina(page) {
        if(this.destinatarios.current_page != page) {
          this.destinatarios.current_page = page
          this.getList(page)
        }
      }
    }
  }
</script>
