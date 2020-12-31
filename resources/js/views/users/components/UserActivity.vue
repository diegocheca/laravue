<template>
  <el-card v-if="user.name">
    <el-tabs v-model="activeActivity" @tab-click="handleClick">
      <el-tab-pane label="Activity" name="first">
        <div class="user-activity">
          <div class="post">
            <div class="user-block">
              <img
                class="img-circle"
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDkaQO69Fro8SZLTVZQ75JH2R0T-sn5yIA_lKGwvvgQ0R0BoQtUQ"
                alt="user image"
              >
              <span class="username text-muted">
                <a href="#">Iron Man</a>
                <a href="#" class="pull-right btn-box-tool">
                  <i class="fa fa-times" />
                </a>
              </span>
              <span class="description">Shared publicly - 7:30 PM today</span>
            </div>
            <p>
              Lorem ipsum represents a long-held tradition for designers,
              typographers and the like. Some people hate it and argue for
              its demise, but others ignore the hate as they create awesome
              tools to help create filler text for everyone from bacon lovers
              to Charlie Sheen fans.
            </p>
            <ul class="list-inline">
              <li>
                <a href="#" class="link-black text-sm">
                  <i class="el-icon-share" /> Share
                </a>
              </li>
              <li>
                <a href="#" class="link-black text-sm">
                  <svg-icon icon-class="like" />Like
                </a>
              </li>
              <li class="pull-right">
                <a href="#" class="link-black text-sm">
                  <svg-icon icon-class="comment" />Comments
                  (5)
                </a>
              </li>
            </ul>
            <el-input placeholder="Type a comment" />
          </div>
          <div class="post">
            <div class="user-block">
              <img
                class="img-circle"
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMMN-8f9CQQ3MKJpboBJIqaiJ2Wus2Tf4w_vx9STtalxrY3qGJ"
                alt="user image"
              >
              <span class="username text-muted">
                <a href="#">Captain American</a>
                <a href="#" class="pull-right btn-box-tool">
                  <i class="fa fa-times" />
                </a>
              </span>
              <span class="description">Sent you a message - yesterday</span>
            </div>
            <p>
              Lorem ipsum represents a long-held tradition for designers,
              typographers and the like. Some people hate it and argue for
              its demise, but others ignore the hate as they create awesome
              tools to help create filler text for everyone from bacon lovers
              to Charlie Sheen fans.
            </p>
            <el-input placeholder="Response">
              <el-button slot="append">
                Send
              </el-button>
            </el-input>
          </div>
          <div class="post">
            <div class="user-block">
              <img
                class="img-circle img-bordered-sm"
                src="https://cdn3.iconfinder.com/data/icons/movies-3/32/daredevil-superhero-marvel-comics-mutant-avatar-512.png"
                alt="User Image"
              >
              <span class="username">
                <a href="#">Daredevil</a>
                <a href="#" class="pull-right btn-box-tool">
                  <i class="fa fa-times" />
                </a>
              </span>
              <span class="description">Posted 4 photos - 2 days ago</span>
            </div>
            <div class="user-images">
              <el-carousel :interval="6000" type="card" height="200px">
                <el-carousel-item v-for="item in carouselImages" :key="item">
                  <img :src="item" class="image">
                </el-carousel-item>
              </el-carousel>
            </div>
            <ul class="list-inline">
              <li>
                <a href="#" class="link-black text-sm">
                  <i class="el-icon-share" /> Share
                </a>
              </li>
              <li>
                <a href="#" class="link-black text-sm">
                  <svg-icon icon-class="like" />Like
                </a>
              </li>
              <li class="pull-right">
                <a href="#" class="link-black text-sm">
                  <svg-icon icon-class="comment" />Comments
                  (5)
                </a>
              </li>
            </ul>
            <el-input placeholder="Type a comment" />
          </div>
        </div>
      </el-tab-pane>
      <el-tab-pane label="Timeline" name="second">
        <div class="block">
          <el-timeline>
            <el-timeline-item v-for="log in logs" :key="log.id" :timestamp="mostrar_fecha(log.created_at)" placement="top">
              <el-card>
                <h4>{{ log.tipo_log }}</h4>
                <p>Se modifico la tabla: <strong>{{ log.tabla_modificada }} </strong> / por el usuairo: <strong>{{ log.created_by }}</strong> / con el estado: <strong> {{ log.estado }}</strong></p>
              </el-card>
            </el-timeline-item>
            <!-- <el-timeline-item timestamp="2019/4/17" placement="top">
              <el-card>
                <h4>Update Github template</h4>
                <p>tuandm committed 2019/4/17 20:46</p>
              </el-card>
            </el-timeline-item>
            <el-timeline-item timestamp="2019/4/18" placement="top">
              <el-card>
                <h4>Update Github template</h4>
                <p>tonynguyen committed 2019/4/18 20:46</p>
              </el-card>
              <el-card>
                <h4>Update Github template</h4>
                <p>tuandm committed 2019/4/19 21:16</p>
              </el-card>
            </el-timeline-item>
            <el-timeline-item timestamp="2019/4/19" placement="top">
              <el-card>
                <h4>
                  Deploy
                  <a href="https://laravue.dev" target="_blank">laravue.dev</a>
                </h4>
                <p>tuandm deployed 2019/4/19 10:23</p>
              </el-card>
            </el-timeline-item> -->
          </el-timeline>
        </div>
      </el-tab-pane>
      <el-tab-pane v-loading="updating" label="Account" name="third">
        <el-form-item label="Name">
          <el-input v-model="user.name" :disabled="user.role === 'admin'" />
        </el-form-item>
        <el-form-item label="Email">
          <el-input v-model="user.email" :disabled="user.role === 'admin'" />
        </el-form-item>
        <el-form-item>
          <el-button type="primary" :disabled="user.role === 'admin'" @click="onSubmit">
            Update
          </el-button>
        </el-form-item>
      </el-tab-pane>
      <el-tab-pane v-loading="updating" label="Password" name="fourth">
        <el-form-item label="Email">
          <el-input v-model="user.email" :disabled="user.role === 'admin'" />
        </el-form-item>
        <el-form-item label="Password">
          <span v-show="pwdType" class="show-pwd" @click="showPwd">
            <svg-icon icon-class="eye" />
          </span>
          <span v-show="!pwdType" class="show-pwd" @click="showPwd">
            <svg-icon icon-class="eye-open" />
          </span>
          <el-input
            v-model="user.password"
            :disabled="user.role === 'admin'"
            :type="pwdType"
            placeholder="password"
          />
        </el-form-item>
        <el-form-item label="Confirm Password">
          <span v-show="pwdTypeConfirm" class="show-pwd" @click="showPwdConfirm">
            <svg-icon icon-class="eye" />
          </span>
          <span v-show="!pwdTypeConfirm" class="show-pwd" @click="showPwdConfirm">
            <svg-icon icon-class="eye-open" />
          </span>
          <el-input
            v-model="user.passwordconfirm"
            :disabled="user.role === 'admin'"
            :type="pwdTypeConfirm"
            placeholder="confirm password"
          />
        </el-form-item>
        <el-form-item>
          <p> {{ samePasswords }} </p>
          <el-button type="primary" :disabled="user.role === 'admin'" @click="onSubmitPass">
            Update Password
          </el-button>
        </el-form-item>
      </el-tab-pane>
    </el-tabs>
  </el-card>
</template>

<script>
import Resource from '@/api/resource';
const userResource = new Resource('users');
const activitiesResource = new Resource('activities');

export default {
  props: {
    user: {
      type: Object,
      default: () => {
        return {
          name: '',
          email: '',
          avatar: '',
          password: '',
          passwordconfirm: '',
          roles: [],
        };
      },
    },
  },
  data() {
    return {
      activeActivity: 'first',
      carouselImages: [
        'https://cdn.laravue.dev/photo1.png',
        'https://cdn.laravue.dev/photo2.png',
        'https://cdn.laravue.dev/photo3.jpg',
        'https://cdn.laravue.dev/photo4.jpg',
      ],
      logs: [],
      total: 0,
      updating: false,
      updatingpass: false,
      pwdType: 'password',
      pwdTypeConfirm: 'password',
    };
  },
  computed: {
    samePasswords() {
      if (this.user.password === this.user.passwordconfirm) {
        return true;
      } else {
        return false;
      }
    },
  },
  created() {
    this.getLogs();
  },
  methods: {
    async getLogs() {
      console.log('empezanod a traer los logs');
      const { data } = await activitiesResource.list({});
      this.logs = data;
      this.total = this.logs.length;
      console.log(this.logs);
    },
    mostrar_fecha(fecha_log) {
      console.log(' fecha entera:' + fecha_log);
      var anio = fecha_log.substring(0, 4);
      var mes = fecha_log.substring(5, 7);
      var dia = fecha_log.substring(8, 10);
      var hora = fecha_log.substring(11, 13);
      var minutos = fecha_log.substring(14, 16);
      var segundos = fecha_log.substring(17, 19);
      anio = parseInt(anio);
      mes = parseInt(mes) - 1;
      dia = parseInt(dia);
      hora = parseInt(hora);
      minutos = parseInt(minutos);
      segundos = parseInt(segundos);
      // console.log(' hora:' + hora);
      // console.log(' minutos:' + minutos);
      // console.log(' segundos:' + segundos);
      // var fecha = new Date(parseInt(fecha_log.substring(0, 4)), parseInt(fecha_log.substring(5, 7)), parseInt(fecha_log.substring(8, 10)));
      var fecha = new Date(anio, mes, dia, hora, minutos, segundos);
      console.log(' fecha creada:' + fecha);
      var options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
      return fecha.toLocaleDateString('es-ES', options);
    },
    showPwd() {
      if (this.pwdType === 'password') {
        this.pwdType = '';
      } else {
        this.pwdType = 'password';
      }
    },
    showPwdConfirm() {
      if (this.pwdTypeConfirm === 'password') {
        this.pwdTypeConfirm = '';
      } else {
        this.pwdTypeConfirm = 'password';
      }
    },
    handleClick(tab, event) {
      console.log('Switching tab ', tab, event);
    },
    onSubmit() {
      this.updating = true;
      userResource
        .update(this.user.id, this.user)
        .then(response => {
          this.updating = false;
          this.$message({
            message: 'User information has been updated successfully',
            type: 'success',
            duration: 5 * 1000,
          });
        })
        .catch(error => {
          console.log(error);
          this.updating = false;
        });
    },
    onSubmitPass() {
      this.updating = true;
      userResource
        .update(this.user.id, this.user)
        .then(response => {
          this.updating = false;
          this.$message({
            message: 'User information has been updated successfully',
            type: 'success',
            duration: 5 * 1000,
          });
        })
        .catch(error => {
          console.log(error);
          this.updating = false;
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.user-activity {
  .user-block {
    .username, .description {
      display: block;
      margin-left: 50px;
      padding: 2px 0;
    }
    img {
      width: 40px;
      height: 40px;
      float: left;
    }
    :after {
      clear: both;
    }
    .img-circle {
      border-radius: 50%;
      border: 2px solid #d2d6de;
      padding: 2px;
    }
    span {
      font-weight: 500;
      font-size: 12px;
    }
  }
  .post {
    font-size: 14px;
    border-bottom: 1px solid #d2d6de;
    margin-bottom: 15px;
    padding-bottom: 15px;
    color: #666;
    .image {
      width: 100%;
    }
    .user-images {
      padding-top: 20px;
    }
  }
  .list-inline {
    padding-left: 0;
    margin-left: -5px;
    list-style: none;
    li {
      display: inline-block;
      padding-right: 5px;
      padding-left: 5px;
      font-size: 13px;
    }
    .link-black {
      &:hover, &:focus {
        color: #999;
      }
    }
  }
  .el-carousel__item h3 {
    color: #475669;
    font-size: 14px;
    opacity: 0.75;
    line-height: 200px;
    margin: 0;
  }

  .el-carousel__item:nth-child(2n) {
    background-color: #99a9bf;
  }

  .el-carousel__item:nth-child(2n+1) {
    background-color: #d3dce6;
  }
}
</style>
