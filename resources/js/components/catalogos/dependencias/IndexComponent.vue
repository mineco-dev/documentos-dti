<template>
  <div>
    <div class="content-header">
      <h1 class="text-dark">Dependencias</h1>
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
                  <option v-bind:value="dependencias.total">todos los registros</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <router-link class="btn btn-primary" :to="{ name: 'dependencias.create' } ">
              <i class="fas fa-plus-circle fa-lg"></i>
              Registrar dependencia
            </router-link>
          </div>
        </div>
        <div class="row row-cols-1 row-cols-md-5">
          <div class="col mb-4" v-for="(dependencia, index) in filter">
            <div class="card h-100 rounded shadow-sm border-0">
              <div class="card-body p-4">
                <h5 class="text-dark">
                  {{dependencia.name}}
                </h5>
              </div>
              <div class="card-footer text-muted">
                <router-link class="text-muted" title="Modificar dependencia" :to="{ name: 'dependencias.edit', params: { id: dependencia.id} }">
                  <i class="fas fa-edit fa-2x fa-fw"></i>
                </router-link>
              </div>
            </div>
          </div>
        </div>
        <div class="row" v-show="dependencias.total > 0">
          <div class="col-md-12">
            <nav aria-label="...">
              <ul class="pagination justify-content-center">
                <li class="page-item" v-bind:class="{'disabled': dependencias.current_page == 1}">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true" v-on:click.prevent="cambiarPagina(dependencias.current_page - 1)">
                    Anterior
                  </a>
                </li>
                <li class="page-item" v-for="page in pagesNumber" v-bind:class="{'active': page == isActived}">
                  <a class="page-link" href="#" v-on:click.prevent="cambiarPagina(page)">{{page}}</a>
                </li>
                <li class="page-item" v-bind:class="{'disabled': dependencias.current_page == dependencias.last_page}">
                  <a class="page-link" href="#" v-on:click.prevent="cambiarPagina(dependencias.current_page + 1)">
                    Siguiente
                  </a>
                </li>
              </ul>
            </nav>
            <p class="text-center">
              Mostrando registros:
              del <b>{{dependencias.from}}</b>
              al <b>{{dependencias.to}}</b>
              de un total de <b>{{dependencias.total}}</b> {{count == 1 ? 'registro' : 'registros'}}
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
        dependencias: {data: []},
        paginate: 10,
        search: '',
        offset: 3
      }
    },
    computed: {
      isActived: function() {
        return this.dependencias.current_page
      },
      pagesNumber: function() {
        if(!this.dependencias.to) {
          return []
        }
        let from = this.dependencias.current_page - this.offset
        if( from < 1) {
          from = 1
        }
        let to = from + (this.offset * 2)
        if(to >= this.dependencias.last_page) {
          to = this.dependencias.last_page
        }
        let pagesArray = []
        while(from <= to) {
          pagesArray.push(from)
          from++
        }
        return pagesArray
      },
      filter() {
        return this.dependencias.data.filter(entidad => entidad.name.toLowerCase().includes(this.search.toLowerCase()))
      },
      count() {
        return this.dependencias.data.length
      }
    },
    mounted() {
      this.getList(1)
    },
    methods: {
      getList(page) {
        axios.get(`/api/dependencias?paginate=${this.paginate}&page=${page}`).then(response => this.dependencias = response.data)
        .catch(error => alert(error.response))
      },
      cambiarPagina(page) {
        if(this.dependencias.current_page != page) {
          this.dependencias.current_page = page
          this.getList(page)
        }
      }
    }
  }
</script>
