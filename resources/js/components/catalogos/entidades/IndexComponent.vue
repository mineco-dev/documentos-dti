<template>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="rol">
          <div class="col-12">
            <h1>Entidades</h1>
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
                  <option v-bind:value="entidades.total">todos los registros</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <router-link class="btn btn-primary" :to="{ name: 'entidades.create' } ">
              <i class="fas fa-plus-circle fa-lg"></i>
              Registrar entidad
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
                    <tr v-for="(entidad, index) in filter">
                      <td>{{ entidad.name }}</td>
                      <td>
                        <router-link :to="{ name: 'entidades.edit', params: { id: entidad.id} }">
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
        <div class="row" v-show="entidades.total > 0">
          <div class="col-md-12">
            <nav aria-label="...">
              <ul class="pagination justify-content-center">
                <li class="page-item" v-bind:class="{'disabled': entidades.current_page == 1}">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true" v-on:click.prevent="cambiarPagina(entidades.current_page - 1)">
                    Anterior
                  </a>
                </li>
                <li class="page-item" v-for="page in pagesNumber" v-bind:class="{'active': page == isActived}">
                  <a class="page-link" href="#" v-on:click.prevent="cambiarPagina(page)">{{page}}</a>
                </li>
                <li class="page-item" v-bind:class="{'disabled': entidades.current_page == entidades.last_page}">
                  <a class="page-link" href="#" v-on:click.prevent="cambiarPagina(entidades.current_page + 1)">
                    Siguiente
                  </a>
                </li>
              </ul>
            </nav>
            <p class="text-center">
              Mostrando registros:
              del <b>{{entidades.from}}</b>
              al <b>{{entidades.to}}</b>
              de un total de <b>{{entidades.total}}</b> {{count == 1 ? 'registro' : 'registros'}}
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
        entidades: {data: []},
        paginate: 10,
        search: '',
        offset: 3
      }
    },
    computed: {
      isActived: function() {
        return this.entidades.current_page
      },
      pagesNumber: function() {
        if(!this.entidades.to) {
          return []
        }
        let from = this.entidades.current_page - this.offset
        if( from < 1) {
          from = 1
        }
        let to = from + (this.offset * 2)
        if(to >= this.entidades.last_page) {
          to = this.entidades.last_page
        }
        let pagesArray = []
        while(from <= to) {
          pagesArray.push(from)
          from++
        }
        return pagesArray
      },
      filter() {
        return this.entidades.data.filter(entidad => entidad.name.toLowerCase().includes(this.search.toLowerCase()))
      },
      count() {
        return this.entidades.data.length
      }
    },
    mounted() {
      this.getList(1)
    },
    methods: {
      getList(page) {
        axios.get(`/api/entidades?paginate=${this.paginate}&page=${page}`).then(response => this.entidades = response.data)
        .catch(error => alert(error.response))
      },
      cambiarPagina(page) {
        if(this.entidades.current_page != page) {
          this.entidades.current_page = page
          this.getList(page)
        }
      }
    }
  }
</script>
