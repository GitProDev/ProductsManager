<template>
    <div class="px-6 py-8 bg-indigo-50">
      <!-- Filters Section -->
      <div class="filters grid gap-6 md:grid-cols-3">
        <!-- Category Filter -->
        <div>
          <label class="block text-lg font-semibold mb-2 text-gray-800">Category</label>
          <div class="relative">
            <select
              v-model="filters.categories"
              multiple
              class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            >
              <option value="all" @click="selectAll('categories')" class="font-semibold text-gray-700">
                Select All
              </option>
              <option
                v-for="category in categories"
                :key="category.id"
                :value="category.id"
              >
                {{ category.name }}
              </option>
            </select>
          </div>
        </div>
  
        <!-- Price Range Filter -->
        <div>
          <label class="block text-lg font-semibold mb-2 text-gray-800">Price Range</label>
          <div class="flex gap-4">
            <input
              type="number"
              v-model="filters.min_price"
              placeholder="Min"
              class="w-1/2 border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            />
            <input
              type="number"
              v-model="filters.max_price"
              placeholder="Max"
              class="w-1/2 border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            />
          </div>
        </div>
  
        <!-- Search Filter -->
        <div>
          <label class="block text-lg font-semibold mb-2 text-gray-800">Search</label>
          <div class="relative">
            <input
              type="text"
              v-model="filters.search"
              placeholder="Search products"
              class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            />
            <span class="absolute left-3 top-2.5 text-gray-500">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 107 7 7 7 0 00-7-7zM16 16l4 4-4-4z"/>
              </svg>
            </span>
          </div>
        </div>
        
        <!-- Seller Filter -->
        <div>
          <label class="block text-lg font-semibold mb-2 text-gray-800">Seller</label>
          <div class="relative">
            <select
              v-model="filters.sellers"
              multiple
              class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            >
              <option value="all" @click="selectAll('sellers')" class="font-semibold text-gray-700">
                Select All
              </option>
              <option
                v-for="seller in sellers"
                :key="seller.id"
                :value="seller.id"
              >
                {{ seller.name }}
              </option>
            </select>
          </div>
        </div>
  
        <!-- Rating Filter -->
        <div>
          <label class="block text-lg font-semibold mb-2 text-gray-800">Minimum Rating</label>
          <select
            v-model="filters.rating"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
          >
            <option value="0">All Ratings</option>
            <option value="1">1+ Stars</option>
            <option value="2">2+ Stars</option>
            <option value="3">3+ Stars</option>
            <option value="4">4+ Stars</option>
            <option value="5">5 Stars</option>
          </select>
        </div>
  
        <!-- Stock Availability Filter -->
        <div>
          <label class="block text-lg font-semibold mb-2 text-gray-800">Stock Availability</label>
          <select
            v-model="filters.stock_status"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
          >
            <option value="">All</option>
            <option value="in_stock">In Stock</option>
            <option value="out_of_stock">Out of Stock</option>
          </select>
        </div>
      </div>
      
      <div>
        <div class="mt-5 text-right">
          <div class="inline-block p-3">
            <UploadCSV />
          </div>
          <div class="inline-block p-3">
            <button @click="exportCsv" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg shadow-md font-semibold transition">
              Export CSV
            </button>
          </div>
        
        </div>
      </div>
  
      <!-- Products Section -->
      <div class="products grid gap-6 mt-10 md:grid-cols-3">
        <div
          v-for="product in filteredProducts"
          :key="product.id"
          class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300"
        >
          <div class="flex items-center gap-4">
            <img
              :src="product.seller.logo_url"
              alt="Seller Logo"
              class="h-12 w-12 object-contain rounded-full border border-gray-200"
            />
            <div>
              <h3 class="text-xl font-semibold text-gray-800">{{ product.name }}</h3>
              <p class="text-sm text-gray-500">{{ product.category.name }}</p>
            </div>
          </div>
  
          <div class="mt-6 space-y-2 text-sm text-gray-700">
            <p><strong class="text-gray-900">Seller:</strong> {{ product.seller.name }}</p>
            <p><strong class="text-gray-900">Price:</strong> ${{ product.price }}</p>
            <p><strong class="text-gray-900">Rating:</strong> {{ product.average_rating }} ⭐</p>
            <p>
              <strong class="text-gray-900">Status: </strong>
              <span
                :class="{
                  'text-green-500': product.stock_status === 'in_stock',
                  'text-red-500': product.stock_status === 'out_of_stock'
                }"
                >{{ product.stock_status.replace('_', ' ') }}</span
              >
            </p>
            <a
              :href="product.product_url"
              target="_blank"
              class="inline-block text-blue-600 hover:text-blue-800 mt-4 underline"
              >View Product</a
            >
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, watch, computed } from 'vue'
  import axios from 'axios'
  import UploadCSV from './UploadCSV.vue'
  
  const products = ref([])
  const categories = ref([])
  const sellers = ref([])
  
  const filters = ref({
    categories: [],
    sellers: [],
    min_price: 0,
    max_price: 10000,
    rating: 0,
    stock_status: null,
    search: ''
  })
  
  const loadCategories = async () => {
    const res = await axios.get('/product-manager/categories')
    categories.value = res.data
  }
  
  const loadSellers = async () => {
    const res = await axios.get('/product-manager/sellers')
    sellers.value = res.data
  }
  
  const loadProducts = async () => {
    const res = await axios.get('/product-manager/products', { params: filters.value })
    products.value = res.data
  }

  const exportCsv = async () => {
    try {
        await axios.post('/product-manager/export', filters.value);
        alert('Export started. You will receive an email shortly.');
    } catch (e) {
        console.error(e);
        alert('Something went wrong.');
    }
  };
  
  onMounted(async () => {
    await loadCategories()
    await loadSellers()
    await loadProducts()
  })
  
  watch(filters, loadProducts, { deep: true })
  
  // Function to select all options in multi-select
  const selectAll = (filterType) => {
    if (filterType === 'categories') {
      filters.value.categories = categories.value.map(c => c.id);
    }
    if (filterType === 'sellers') {
      filters.value.sellers = sellers.value.map(s => s.id);
    }
  }
  
  // Computed filter to apply all filters
  const filteredProducts = computed(() => {
    return products.value.filter((product) => {
      // Filter by Category
      if (filters.value.categories.length && !filters.value.categories.includes(product.category_id)) {
        return false
      }
      // Filter by Seller
      if (filters.value.sellers.length && !filters.value.sellers.includes(product.seller_id)) {
        return false
      }
      // Filter by Price
      if (product.price < filters.value.min_price || product.price > filters.value.max_price) {
        return false
      }
      // Filter by Rating
      if (filters.value.rating && product.average_rating < filters.value.rating) {
        return false
      }
      // Filter by Stock Availability
      if (filters.value.stock_status && product.stock_status !== filters.value.stock_status) {
        return false
      }
      // Filter by Search Term
      if (filters.value.search && !product.name.toLowerCase().includes(filters.value.search.toLowerCase())) {
        return false
      }
      return true
    })
  })
  </script>
  