<!-- File: resources/js/views/categories/List.vue -->
<template>
  <div class="app-container">
    <h1>Estoy en materiales</h1>
    <div class="filter-container">
      <el-input v-model="filtro" :placeholder="placeHolderFilter" style="width: 200px;" class="filter-item" @keyup.enter.native="handleFilter" />
      <el-button class="filter-item" type="primary" icon="el-icon-plus" @click="handleCreate">
        {{ $t('table.add') }}
      </el-button>
      <el-button v-waves :loading="downloadLoading" class="filter-item" type="primary" icon="el-icon-download" @click="handleDownload">
        {{ $t('table.export') }}
      </el-button>
      <el-checkbox v-model="showunidad" label="unidades" class="filter-item" style="margin-left:15px;" @change="tableKey=tableKey+1">
        {{ $t('table.unidad') }}
      </el-checkbox>
      <!--
      <el-checkbox v-model="showestado" label="estado" class="filter-item" style="margin-left:15px;" @change="tableKey=tableKey+1">
        {{ $t('table.Estado') }}
      </el-checkbox>
      <el-checkbox v-model="showtecnico" label="tecnico" class="filter-item" style="margin-left:15px;" @change="tableKey=tableKey+1">
        {{ $t('table.Tecnico') }}
      </el-checkbox> -->
    </div>
    <!-- antes en :data="pagina" -->
    <el-table
      :key="tableKey"
      v-loading="loading"
      :data="filtrar"
      border
      fit
      highlight-current-row
      @sort-change="sortChange"
    >
      <el-table-column prop="id" sortable="custom" align="center" label="id " width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.id }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="descripcion" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.descripcion }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="stock" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.stock }}</span>
        </template>
      </el-table-column>
      <!-- <el-table-column v-if="showtecnico" align="center" label="idtecnico" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.idtecnico }}</span>
        </template>
      </el-table-column> -->
      <!-- <el-table-column v-if="showporcentaje" label="Porcentaje" width="110px" align="center">
        <template slot-scope="scope">
          <span style="color:red;">{{ scope.row.porcent }}</span>
        </template>
      </el-table-column> -->
      <el-table-column align="center" label="proveedor">
        <template slot-scope="scope">
          <span>{{ scope.row.proveedor }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="contactoproveedor">
        <template slot-scope="scope">
          <span>{{ scope.row.contactoproveedor }}</span>
        </template>
      </el-table-column>
      <el-table-column v-if="showunidad" align="center" label="unidad">
        <template slot-scope="scope">
          <span>{{ scope.row.unidad }}</span>
        </template>
      </el-table-column>
      <!-- <el-table-column v-if="showestado" align="center" label="estado">
        <template slot-scope="scope">
          <el-tag :type="scope.row.estado | statusFilter">
            {{ scope.row.estado }}
          </el-tag>
        </template>
      </el-table-column> -->
      <el-table-column align="center" label="Actions" width="350">
        <template slot-scope="scope">
          <el-button type="info" size="small" icon="el-icon-edit" @click="handleUsadaDialog(scope.row.id, scope.row.descripcion);">
            Usada en
          </el-button>
          <el-button type="primary" size="small" icon="el-icon-edit" @click="handleEditForm(scope.row.id, scope.row.descripcion);">
            Edit
          </el-button>
          <el-button type="danger" size="small" icon="el-icon-delete" @click="handleDelete(scope.row.id, scope.row.descripcion);">
            Delete
          </el-button>
          <!-- <el-button v-if="scope.row.porcent!=100" size="mini" type="success" @click="handleModifyStatus(scope.row.id)">
            {{ $t('table.EndTask') }}
          </el-button> -->
        </template>
      </el-table-column>
    </el-table>
    <pagination v-show="!loading" :total="total" :page.sync="paginaNumero" :limit.sync="tamañoPagina" @pagination="paginacion" />
    <el-dialog :title="formTitle" :visible.sync="ordenesFormVisible">
      <div class="form-container">
        <el-form ref="categoryForm" :model="OrdenActualizando" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item label="Material" prop="descripcion">
            <el-input v-model="OrdenActualizando.descripcion" style="width: 100%;" />
          </el-form-item>
          <el-form-item label="stock" prop="stock">
            <el-input v-model="OrdenActualizando.stock" type="number" style="width: 100%;" />
          </el-form-item>
          <el-form-item label="Proveedor" prop="proveedor">
            <el-input v-model="OrdenActualizando.proveedor" type="text" />
          </el-form-item>
          <el-form-item label="Contacto de proveedor" prop="contactoproveedor">
            <el-input v-model="OrdenActualizando.contactoproveedor" type="text" />
          </el-form-item>
          <el-form-item label="Unidad" prop="unidad">
            <el-input v-model="OrdenActualizando.unidad" type="text" />
          </el-form-item>
          <!-- <el-form-item label="Estado" prop="estado">
            <el-select v-model="OrdenActualizando.estado" class="filter-item" placeholder="Seleccionar el estado">
              <el-option v-for="item in tipos_de_estado" :key="item.key" :label="item.display_name" :value="item.key" />
            </el-select>
          </el-form-item> -->
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="ordenesFormVisible = false">
            Cancelar
          </el-button>
          <el-button type="primary" @click="handleSubmit()">
            Crear
          </el-button>
        </div>
      </div>
    </el-dialog>
    <el-dialog title="Lista de Ordenes de Trabajo donde se uso" :visible.sync="usadaDialogVisible">
      <el-table :datoos="informacionOrdendesMateriales" border fit highlight-current-row style="width: 100%">
        <el-table-column prop="key" label="Channel" />
        <el-table-column prop="pv" label="Pv" />
      </el-table>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="dialogPvVisible = false">{{ $t('table.confirm') }}</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
import { parseTime } from '@/utils';
import Pagination from '@/components/Pagination';

const materialesResource = new Resource('materiales');
// const tipos_de_estado = [
//   { key: '1', display_name: 'En Proceso' },
//   { key: '2', display_name: 'Termianda' },
//   { key: '3', display_name: 'Suspendida' },
//   { key: '4', display_name: 'Archivada' },
// ];

export default {
  name: 'MaterialesList',
  components: { Pagination },
  directives: { waves },
  filters: {
    statusFilter(estado) {
      const statusMap = {
        2: 'success',
        1: 'info',
        3: 'danger',
        4: 'danger',
      };
      return statusMap[estado];
    },
  },
  data() {
    return {
      list: [],
      tableKey: 0,
      formTitle: '',
      // tipos_de_estado,
      loading: true,
      ordenesFormVisible: false,
      usadaDialogVisible: false,
      currentMaterial: {},
      OrdenActualizando: {},
      downloadLoading: false,
      showunidad: false,
      // showtecnico: false,
      // showestado: true,
      listQuery: {
        page: 1,
        limit: 20,
        importance: undefined,
        title: undefined,
        type: undefined,
        sort: '+id',
      },
      listQueryParaRelacion: {
        id: 1,
        sort: '+id',
      },
      lista: {
      },
      pagina: [],
      total: 0,
      tamañoPagina: 0,
      paginaNumero: 0,
      informacionOrdendesMateriales: '',
    };
  },
  computed: {
    filtrar() {
      if (!this.filtro) {
        return this.pagina;
      }
      return this.list.filter(a =>
        a.descripcion.toLowerCase().includes(this.filtro.toLowerCase()));
    },
  },
  created() {
    this.getList();
  },
  methods: {
    async getList() {
      this.loading = true;
      const { data } = await materialesResource.list({});
      this.list = data;
      console.log(this.list);
      this.total = this.list.length;
      this.lista.pagina1 = this.list.slice(0, 19);
      this.pagina = this.lista.pagina1;
      this.paginaNumero = 1;
      this.tamañoPagina = 20;
      this.loading = false;
    },
    async handleUsadaDialog(id) {
      /* fetchPv(pv).then(response => {
        this.pvData = response.data.pvData;
        this.dialogPvVisible = true;
      });
      informacionOrdendesMateriales
      usadaDialogVisible*/
      // this.listQueryParaRelacion.id = id;
      // const { datoos } = await materialesResource.listaOrdendesMateriales(this.listQueryParaRelacion);
      // this.informacionOrdendesMateriales = axios.get('http://localhost:8000/material-en-ordenes/'+id);
      // console.log('la relacion:');
      // console.log(this.informacionOrdendesMateriales);
      /*
      this.total = this.list.length;
      this.lista.pagina1 = this.list.slice(0, 19);
      this.pagina = this.lista.pagina1;
      this.paginaNumero = 1;
      this.tamañoPagina = 20;
      this.loading = false;
      this.OrdenActualizando = {
        'id': this.currentMaterial.id,
        'descripcion': this.currentMaterial.descripcion,
        'stock': this.currentMaterial.stock,
        'proveedor': this.currentMaterial.proveedor,
        'contactoproveedor': this.currentMaterial.contactoproveedor,
        'unidad': this.currentMaterial.unidad,
      };
      con1sole.log(this.OrdenActualizando);
      this.ordenesFormVisible = true;
      */
    },
    handleEditForm(id) {
      this.formTitle = 'Editando un Material, con ID: ' + id;
      this.currentMaterial = this.list.find(ordenes => ordenes.id === id);
      this.OrdenActualizando = {
        'id': this.currentMaterial.id,
        'descripcion': this.currentMaterial.descripcion,
        'stock': this.currentMaterial.stock,
        'proveedor': this.currentMaterial.proveedor,
        'contactoproveedor': this.currentMaterial.contactoproveedor,
        'unidad': this.currentMaterial.unidad,
      };
      console.log('la copia:');
      console.log(this.OrdenActualizando);
      this.ordenesFormVisible = true;
    },
    handleSubmit() {
      if (this.OrdenActualizando.id !== undefined) { // modificar orden
        console.log('por actualizar');
        materialesResource.update(this.OrdenActualizando.id, this.OrdenActualizando).then(response => {
          this.$message({
            type: 'success',
            message: 'La orden ha sido actualizada correctamente',
            duration: 5 * 1000,
          });
          this.getList();
          this.ordenesFormVisible = false;
        }).catch(error => {
          console.log(error);
        }).finally(() => {
          this.ordenesFormVisible = false;
        });
      } else { // crear nueva orden
        materialesResource
          .store(this.OrdenActualizando)
          .then(response => {
            this.$message({
              message: 'Se creó el nuevo material: ' + this.OrdenActualizando.descripcion + ', correctamente. Gracias',
              type: 'success',
              duration: 5 * 1000,
            });
            this.OrdenActualizando = {
              id: '',
              description: '',
              stock: '',
              proveedor: '',
              contactoproveedor: '',
              unidad: '',
            };
            this.OrdenActualizando = {
              id: '',
              description: '',
              stock: '',
              proveedor: '',
              contactoproveedor: '',
              unidad: '',
            };
            this.ordenesFormVisible = false;
            this.getList();
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    handleCreate() {
      this.ordenesFormVisible = true;
      this.OrdenActualizando = {
        id: '',
        description: '',
        stock: '',
        proveedor: '',
        contactoproveedor: '',
        unidad: '',
      };
    },
    handleDownload() {
      this.downloadLoading = true;
      import('@/vendor/Export2Excel').then(excel => {
        const tHeader = ['id', 'descripcion', 'stock'];
        const filterVal = ['id', 'descripcion', 'stock'];
        const data = this.formatJson(filterVal, this.list);
        excel.export_json_to_excel({
          header: tHeader,
          data,
          filename: 'table25-list',
        });
        this.downloadLoading = false;
      });
    },
    handleModifyStatus(id) {
      // actualizo la base de datos
      this.currentMaterial = this.list.find(ordenes => ordenes.id === id);
      this.currentMaterial.porcent = 100;
      materialesResource.update(id, this.currentMaterial).then(response => {
        this.$message({
          type: 'success',
          message: 'La orden ha se completó al 100%',
          duration: 5 * 1000,
        });
        this.getList();
        this.ordenesFormVisible = false;
      }).catch(error => {
        console.log(error);
      }).finally(() => {
        this.ordenesFormVisible = false;
      });
      // this.$message({
      //   message: 'Successful operation',
      //   type: 'success',
      // });
      // row.status = status;
    },
    formatJson(filterVal, jsonData) {
      return jsonData.map(v => filterVal.map(j => {
        if (j === 'timestamp') {
          return parseTime(v[j]);
        } else {
          return v[j];
        }
      }));
    },
    handleDelete(id, name) {
      this.currentMaterial = {
        id: id,
        description: name,
      };
      // console.log(this.currentMaterial);
      this.$confirm('Estas seguro de eliminar permanentemente el material: ' + name + '. ?', 'Confirme', {
        confirmButtonText: 'Si, borrar',
        cancelButtonText: 'Cancelar',
        type: 'warning',
      }).then(() => {
        materialesResource.destroy(id).then(response => {
          this.$message({
            type: 'success',
            message: 'La tarea ha sido borrada correctamente',
          });
          this.getList();
        }).catch(error => {
          console.log(error);
        });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: 'No se ha borrado la tarea',
        });
      });
    },
    // funcion para manejar el $emit del componente pagination
    paginacion(val) {
      console.log(val);
      this.tamañoPagina = val.limit;
      this.paginaNumero = val.page;
      const indexInf = (val.page - 1) * val.limit;
      const indexSup = indexInf + val.limit - 1;
      this.pagina = this.list.slice(indexInf, indexSup);
    },
    sortChange(data) {
      console.log('entra al metodo sort');
      console.log(data);
      const { prop, order } = data;
      console.log(prop);
      console.log(order);
      if (prop === 'id') {
        this.sortByID(order);
      }
    },
    sortByID(order) {
      if (order === 'ascending') {
        console.log('debe orderdenar ascendentemente');
        this.pagina.sort((a, b) => {
          if (a.id < b.id) {
            return 1;
          }
          if (a.id > b.id) {
            return -1;
          }
        });
      } else {
        console.log('debe orderdenar descendente');
        this.pagina.sort((a, b) => {
          if (a.id < b.id) {
            return -1;
          }
          if (a.id > b.id) {
            return 1;
          }
        });
      }
      // this.handleFilter();
    },
  },
};
</script>
<style scoped>
.line{
  text-align: center;
}
</style>
