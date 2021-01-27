<style>
body {
  font-family: "Montserrat";
  font-size: 16px;
}

</style>



    <div id="app">
    <header>
      <div class="text-white bg-gray-900 py-5 px-10 md:flex md:items-center md:justify-between md:px-40">
    <div class="flex items-center justify-between">
      <div>@include('layout.logo')</div>
      <div class="md:hidden align-middle">
        <i class="material-icons align-middle cursor-pointer" @click.prevent="toogle">menu</i>
      </div>
    </div>
    <div :class="open ? 'block' : 'hidden'" class="flex flex-col text-left md:block md:text-right mt-3 md:mt-0">
      <a href="supplier" class="mt-3 md:mx-3 hover:text-blue-500">Suppliers</a>
      <a href="purchaser" class="mt-3 md:mx-3 hover:text-blue-500">Purchasers</a>
      <a href="items" class="mt-3 md:mx-3 hover:text-green-500">Items</a>
      <a href="inventory" class="mt-3 md:mx-3 hover:text-green-500">Stock</a>
      <a href="" class="mt-3 md:mx-3 hover:text-red-500">Logout  </a>
 
    </div>
  </div>
    </header>
    </div>