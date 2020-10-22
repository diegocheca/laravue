<!-- File: resources/js/views/categories/List.vue -->
<template>
  <div class="app-container">
    <div class="filter-container">
      <el-button class="filter-item" type="primary" icon="el-icon-plus" @click="handleCreate">
        {{ $t('table.add') }}
      </el-button>
    </div>
    <el-table v-loading="loading" :data="list" border fit highlight-current-row>
      <el-table-column align="center" label="id " width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.id }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="direccion" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.direccion }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Cliente" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.idcliente }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="idtecnico" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.idtecnico }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="description">
        <template slot-scope="scope">
          <span>{{ scope.row.description }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="startdate">
        <template slot-scope="scope">
          <span>{{ scope.row.startdate }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="enddate">
        <template slot-scope="scope">
          <span>{{ scope.row.enddate }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="estado">
        <template slot-scope="scope">
          <el-tag :type="scope.row.estado | statusFilter">
            {{ scope.row.estado }}
          </el-tag>
          <!-- <span>{{ scope.row.estado }}</span> -->
        </template>
      </el-table-column>
      <el-table-column align="center" label="Actions" width="350">
        <template slot-scope="scope">
          <el-button type="primary" size="small" icon="el-icon-edit" @click="handleEditForm(scope.row.id, scope.row.description);">
            Edit
          </el-button>
          <el-button type="danger" size="small" icon="el-icon-delete" @click="handleDelete(scope.row.id, scope.row.description, scope.row.direccion , scope.row.idcliente);">
            Delete
          </el-button>
        </template>
      </el-table-column>
    </el-table>
    <el-dialog :title="formTitle" :visible.sync="ordenesFormVisible">
      <div class="form-container">
        <el-form ref="categoryForm" :model="currentOrden" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item label="Tarea" prop="description">
            <el-input v-model="currentOrden.description" />
          </el-form-item>
          <el-form-item label="Direccion" prop="direccion">
            <el-input v-model="currentOrden.direccion" />
          </el-form-item>
          <el-form-item label="Id del Cliente" prop="idcliente">
            <el-input v-model="currentOrden.idcliente" type="number" />
          </el-form-item>
          <el-form-item label="Id del Tecnico" prop="idtecnico">
            <el-input v-model="currentOrden.idtecnico" type="number" />
          </el-form-item>
          <el-form-item label="Fecha Inicio" prop="startdate">
            <el-date-picker v-model="currentOrden.startdate" type="datetime" placeholder="Please pick a date" />
          </el-form-item>
          <el-form-item label="Fecha Fin" prop="enddate">
            <el-date-picker v-model="currentOrden.enddate" type="datetime" placeholder="Please pick a date" />
          </el-form-item>
          <el-form-item label="Estado" prop="estado">
            <el-select v-model="currentOrden.estado" class="filter-item" placeholder="Seleccionar el estado">
              <el-option v-for="item in tipos_de_estado" :key="item.key" :label="item.display_name" :value="item.key" />
            </el-select>
          </el-form-item>
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
  </div>
</template>

<script>
import Resource from '@/api/resource';
const ordenesResource = new Resource('ordendetrabajo');
const tipos_de_estado = [
  { key: '1', display_name: 'En Proceso' },
  { key: '2', display_name: 'Termianda' },
  { key: '3', display_name: 'Suspendida' },
  { key: '4', display_name: 'Archivada' },
];

export default {
  name: 'OrdenesTrabajaoList',
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
      formTitle: '',
      tipos_de_estado,
      loading: true,
      ordenesFormVisible: false,
      currentOrden: {},
    };
  },
  created() {
    this.getList();
  },
  methods: {
    async getList() {
      this.loading = true;
      const { data } = await ordenesResource.list({});
      this.list = data;
      this.loading = false;
    },
    handleEditForm(id) {
      this.formTitle = 'Editando una Orden de trabajo';
      this.currentOrden = this.list.find(ordenes => ordenes.id === id);
      this.ordenesFormVisible = true;
    },
    handleSubmit() {
      if (this.currentOrden.id !== undefined) { // modificar orden
        console.log('por actualizar');
        ordenesResource.update(this.currentOrden.id, this.currentOrden).then(response => {
          this.$message({
            type: 'success',
            message: 'La orden ha sido actualizada correctamente',
            duration: 5 * 1000,
          });
          this.getList();
        }).catch(error => {
          console.log(error);
        }).finally(() => {
          this.categoryFormVisible = false;
        });
      } else { // crear nueva orden
        ordenesResource
          .store(this.currentOrden)
          .then(response => {
            this.$message({
              message: 'Se creó la tarea: ' + this.currentOrden.description + ', correctamente. Gracias',
              type: 'success',
              duration: 5 * 1000,
            });
            this.currentOrden = {
              description: '',
              direccion: '',
              idcliente: '',
              idtecnico: '',
              startdate: '',
              enddate: '',
              estado: '',
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
      this.currentOrden = {
        description: '',
        direccion: '',
        idcliente: '',
      };
    },
    handleDelete(id, name, dir, idcliente) {
      this.currentOrden = {
        id: id,
        description: name,
        direccion: dir,
        idcliente: idcliente,
      };
      console.log(this.currentOrden);
      this.$confirm('Estas seguro de eliminar permanentemente la tarea ' + name + '. ?', 'Confirme', {
        confirmButtonText: 'Si, borrar',
        cancelButtonText: 'Cancelar',
        type: 'warning',
      }).then(() => {
        ordenesResource.destroy(id).then(response => {
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
  },
};
</script>
