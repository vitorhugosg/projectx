<template>
  <mdb-navbar class="fundo-black flexible-navbar white" position="top" scrolling>
    <mdb-navbar-brand @click.native="toggleSideNav" class="navbar-bars"><mdb-icon icon="bars"/></mdb-navbar-brand>
    <mdb-navbar-nav left>
      <mdb-breadcrumb>{{computedPage.activePage}}</mdb-breadcrumb>
    </mdb-navbar-nav>
    <mdb-navbar-toggler/>
    <mdb-navbar-nav right>
      <mdb-dropdown class="nav-item notifications-nav" tag="li">
        <mdb-dropdown-toggle slot="toggle" tag="li" outline="none" class="btn-transparent">
          <mdb-badge color="green">3</mdb-badge> <mdb-icon icon="bell red-text" /> <span class="d-none d-md-inline-block up-font">Notifications</span>
        </mdb-dropdown-toggle>
        <mdb-dropdown-menu>
          <mdb-dropdown-item>
            <mdb-icon icon="money text-red-two" class="mr-2" aria-hidden="true" />
            <span>New order received</span>
            <span class="float-right"><mdb-icon icon="clock-o text-red-two" arfaa-hidden="true"/> 13 min</span>
          </mdb-dropdown-item>
          <mdb-dropdown-item>
            <mdb-icon icon="money text-red-two" class="mr-2" aria-hidden="true" />
            <span>New order received</span>
            <span class="float-right"><mdb-icon icon="clock-o text-red-two" arfaa-hidden="true"/> 33 min</span>
          </mdb-dropdown-item>
          <mdb-dropdown-item>
            <mdb-icon icon="line-chart text-red-two" class="mr-2" aria-hidden="true" />
            <span>Your campaign is about to end</span>
            <span class="float-right"><mdb-icon icon="clock-o text-red-two" arfaa-hidden="true"/> 53 min</span>
          </mdb-dropdown-item>
        </mdb-dropdown-menu>
      </mdb-dropdown>
      <mdb-nav-item>
        <mdb-icon icon="envelope red-text" /><span class="up-font clearfix d-none d-sm-inline-block">Contact</span>
      </mdb-nav-item>
      <mdb-nav-item>
        <mdb-icon icon="comments-o red-text" /><span class="up-font clearfix d-none d-sm-inline-block">Support</span>
      </mdb-nav-item>
      <mdb-dropdown class="nav-item" tag="li">
        <mdb-dropdown-toggle slot="toggle" tag="li" outline="none" class="btn-transparent">
          <mdb-icon icon="user red-text"></mdb-icon> <span class="up-font clearfix d-none d-sm-inline-block">Profile</span>
        </mdb-dropdown-toggle>
        <mdb-dropdown-menu right>
          <span v-on:click="closeLogin()">
            <mdb-dropdown-item ><i class="fa fa-user mt-2 mb-2 mr-2 text-red-two"/>Log Out</mdb-dropdown-item>
          </span>
          <mdb-dropdown-item><i class="fa fa-user mt-2 mb-2 mr-2 text-red-two"/>My account</mdb-dropdown-item>
        </mdb-dropdown-menu>
      </mdb-dropdown>
    </mdb-navbar-nav>
  </mdb-navbar>
</template>

<script>
import { mdbNavbar, mdbNavbarBrand, mdbNavItem, mdbNavbarNav, mdbNavbarToggler, mdbBreadcrumb, mdbDropdown, mdbDropdownToggle, mdbDropdownMenu, mdbDropdownItem, mdbIcon, mdbBadge } from 'mdbvue'
import mixinsUser from '@/store/modules/users/mixins'
export default {
  name: 'Navbar',
  props: {
    page: {
      type: String
    }
  },
  mixins: [mixinsUser],
  components: {
    mdbNavbar,
    mdbNavbarBrand,
    mdbNavItem,
    mdbNavbarNav,
    mdbNavbarToggler,
    mdbBreadcrumb,
    mdbDropdown,
    mdbDropdownToggle,
    mdbDropdownMenu,
    mdbDropdownItem,
    mdbIcon,
    mdbBadge
  },
  data () {
    return {
      activePage: this.page,
      toggle: false
    }
  },
  methods: {
    toggleSideNav () {
      this.toggle = !this.toggle
      this.$parent.$emit('toggle', this.toggle)
    }
  },
  computed: {
    computedPage () {
      return {
        activePage: this.page
      }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.navbar .dropdown-toggle {
  padding: 0 10px !important;
  font-size: 14px;
}

.navbar ul {
  padding: 5px 0;
}

.navbar .btn {
  font-weight: 300;
}

.navbar-collapse {
  order: 0 !important;
}

.navbar .notifications-nav .dropdown-menu {
  width: 23rem; }

.navbar-expand-lg .navbar-nav {
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  flex-direction: row;
}

.btn-transparent {
  background-color: transparent !important;
  color: #000;
  text-transform: none;
  box-shadow: none !important;
}

.btn-transparent:hover, .btn-transparent:active {
  box-shadow: none !important;
}

.up-font{
  font-size: 16px !important;
  color:#fff !important; 
}

.red-text {
  font-size: 20px !important;
}

.fundo-black {
  background-color:#222 !important;
  color:#fff !important;
}
.dropdown-toggle::after {
  color:#fff !important;
}
.breadcrumb {
  font-size: 18px !important;
}

.text-red-two{
  color: #BE3030 !important;
  font-size: 13px !important;
}
.navbar .notifications-nav .dropdown-menu[data-v-41458b80] {
  background-color:#222 !important;
  
}
.dropdown .dropdown-menu .dropdown-item, .dropup .dropdown-menu .dropdown-item, .dropleft .dropdown-menu .dropdown-item, .dropright .dropdown-menu .dropdown-item {
  color:#fff !important;
}
.navbar-expand-lg .navbar-nav .dropdown-menu {
  background-color:#222 !important;
}
</style>
