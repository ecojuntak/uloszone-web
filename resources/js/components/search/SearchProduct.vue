<template>
  <div>
    <div class="card globalcard" style="min-height: 400px">
      <div class="card-header">


        <nav class="navbar navbar-expand-lg mproduct p-1" style="background-color: transparent; border:none">
          <h5 class="mr-3">Filter Produk</h5>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
              <li>
                <a
                    class="nav-link dropdown-toggle"
                    id="navbarDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >Kategori</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" @click="filterProductByCategory('ATBM')">Alat Tenun Bukan Mesin</a>
                  <a class="dropdown-item" @click="filterProductByCategory('Tradisional')">Tradisional</a>
                  <a class="dropdown-item" @click="filterProductByCategory('Mesin')">Mesin</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" @click="filterProductByCategory('')">Semua kategori</a>
                </div>
              </li>
              <li>
                <a
                    class="nav-link dropdown-toggle"
                    id="navbarDropdown1"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >Urutkan Berdasarkan</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                  <a class="dropdown-item" @click="sortProductByName('asc')">Nama A-Z</a>
                  <a class="dropdown-item" @click="sortProductByName('des')">Nama Z-A</a>
                  <a class="dropdown-item" @click="sortProductByPrice('asc')">Harga Termurah</a>
                  <a class="dropdown-item" @click="sortProductByPrice('des')">Harga Termahal</a>
                </div>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input
                  class="form-control form-control-sm mr-sm-2"
                  type="search"
                  placeholder="Filter Nama"
                  aria-label="Search"
                  v-model="searchName"
                  @input="filterProductByName"
              >
            </form>
          </div>
        </nav>
      </div>
      <div class="card-body">
        <div class="" v-if="products.length>0">
          <div class="row">
            <div v-for="product in products" class="col-6 col-md-2 col-lg-2 px-1">
              <div class="card products">
                <a :href="'/products/' + product.id">
                  <div class="imgwrapper">
                    <img :src="'/images/' + JSON.parse(product.images)[0]" alt="Card image cap">
                  </div>
                </a>
                <div class="card-body">
                  <p class="card-title productname">{{ product.name }}</p>
                  <h6 style="color: #ff5205">Rp {{formatPrice( product.price )}}</h6>
                  <p class="card-text float-right">
                    <small class="text-muted"> {{ product.merchant.profile.name }}</small>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div v-else class="col-12 center center-block align-center text-center">
          <img src="/images/assets/search_result_empty.png" style="height: 120px; border: none; opacity: 0.5"/>
          <p class="text font-bold">
            <br>
            Oops, produk tidak ditemukan :(
          </p>
          <div class="btn essence-btn " id="searchagain">Lakukan Pencarian Baru</div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['keyword'],
  data() {
    return {
      products: [],
      orginalProductsData: [],
      searchName: ""
    };
  },
  methods: {
      formatPrice(value) {
          let val = (value/1).toFixed().replace('.', ',')
          return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
      },
    getProducts() {
      let payload = {
        keyword: this.keyword
      }

      window.axios
        .get("/api/product/search?keyword=" + this.keyword)
        .then(res => {
          this.orginalProductsData = res.data;
          this.products = this.orginalProductsData;
        })
        .catch(err => {
          console.log(err);
        });
    },
    filterProductByName() {
      this.products = this.orginalProductsData.filter(product =>
        product.name.toLowerCase().includes(this.searchName.toLowerCase())
      );
    },
    filterProductByCategory(category) {
      this.products = this.orginalProductsData.filter(product =>
        product.category.includes(category)
      );
    },
    sortProductByName(type) {
      if (type === "asc") {
        this.products = this.orginalProductsData.sort((a, b) => {
          return a.name > b.name ? 1 : -1;
        });
      } else {
        this.products = this.orginalProductsData.sort((a, b) => {
          return a.name < b.name ? 1 : -1;
        });
      }
    },
    sortProductByPrice(type) {
      if (type === "asc") {
        this.products = this.orginalProductsData.sort((a, b) => {
          return parseInt(a.price) > parseInt(b.price) ? 1 : -1;
        });
      } else {
        this.products = this.orginalProductsData.sort((a, b) => {
          return parseInt(a.price) > parseInt(b.price) ? 1 : -1;
        });
      }
    },
  },
  mounted() {
    this.getProducts();
  }
};
</script>

<style>
</style>
