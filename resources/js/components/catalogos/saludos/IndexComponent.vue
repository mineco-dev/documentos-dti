<template>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <h1 class="text-dark">Saludos</h1>
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
                  <option value="5">5 registros</option>
                  <option value="10">10 registros</option>
                  <option value="25">25 registros</option>
                  <option value="50">50 registros</option>
                  <option value="100">100 registros</option>
                  <option v-bind:value="saludos.total">todos los registros</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <router-link class="btn btn-primary" :to="{ name: 'saludos.create' } ">
              <i class="fas fa-plus-circle fa-lg"></i>
              Registrar saludo
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
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(saludo, index) in filter">
                      <td>{{ saludo.name }}</td>
                      <td>
                        <router-link :to="{ name: 'saludos.edit', params: { id: saludo.id} }">
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
        <div class="row" v-show="saludos.total > 0">
          <div class="col-md-12">
            <nav aria-label="...">
              <ul class="pagination justify-content-center">
                <li class="page-item" v-bind:class="{'disabled': saludos.current_page == 1}">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true" v-on:click.prevent="cambiarPagina(saludos.current_page - 1)">
                    Anterior
                  </a>
                </li>
                <li class="page-item" v-for="page in pagesNumber" v-bind:class="{'active': page == isActived}">
                  <a class="page-link" href="#" v-on:click.prevent="cambiarPagina(page)">{{page}}</a>
                </li>
                <li class="page-item" v-bind:class="{'disabled': saludos.current_page == saludos.last_page}">
                  <a class="page-link" href="#" v-on:click.prevent="cambiarPagina(saludos.current_page + 1)">
                    Siguiente
                  </a>
                </li>
              </ul>
            </nav>
            <p class="text-center">
              Mostrando registros:
              del <b>{{saludos.from}}</b>
              al <b>{{saludos.to}}</b>
              de un total de <b>{{saludos.total}}</b> {{count == 1 ? 'registro' : 'registros'}}
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
        saludos: {data: []},
        paginate: 10,
        search: '',
        offset: 3
      }
    },
    computed: {
      isActived: function() {
        return this.saludos.current_page
      },
      pagesNumber: function() {
        if(!this.saludos.to) {
          return []
        }
        let from = this.saludos.current_page - this.offset
        if( from < 1) {
          from = 1
        }
        let to = from + (this.offset * 2)
        if(to >= this.saludos.last_page) {
          to = this.saludos.last_page
        }
        let pagesArray = []
        while(from <= to) {
          pagesArray.push(from)
          from++
        }
        return pagesArray
      },
      filter() {
        return this.saludos.data.filter(entidad => entidad.name.toLowerCase().includes(this.search.toLowerCase()))
      },
      count() {
        return this.saludos.data.length
      }
    },
    mounted() {
      this.getList(1)
    },
    methods: {
      getList(page) {
        axios.get(`/api/saludos?paginate=${this.paginate}&page=${page}`).then(response => this.saludos = response.data)
        .catch(error => alert(error.response))
      },
      cambiarPagina(page) {
        if(this.saludos.current_page != page) {
          this.saludos.current_page = page
          this.getList(page)
        }
      }
    }
  }
</script>
