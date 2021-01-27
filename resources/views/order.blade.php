@extends('layout/master')
@section('address','Add Supplier')
@section('content')
  <div class="container">
    <div class="border rounded-lg bg-white">
      <h3 class="p-5 font-semibold text-lg underline text-blue-500 hover:text-blue-700">
        <span class="fas fa-user"></span>
        <a>Place Order</a>
      </h3>
            <form action="store" method="POST" name="myForm" id="addForm">
            @csrf
            <div class="flex flex-col w-1/2">
              <label for="item_id" class="leading-10 pl-2">Item ID:</label>
              <select name="item_id" id="item_id" class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                 <option value="">Select Item_id</option>
                 @foreach($items as $item)
                 <option value="{{$item->id}}">{{$item->id}}</option>
                 @endforeach
              </select>
              
            </div>

            <div class="flex flex-col w-1/2">
              <label for="discription" class="leading-10 pl-2">Catogery:</label>
              <select name="category" id="category" class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                 <option value="">Select Category</option>
                 <option value="supplier">Supplier</option>
                 <option value="purchaser">Purchaser</option>
              </select>
              
            </div>


            <div class="flex flex-col w-1/2">
              <label for="supplier_id" class="leading-10 pl-2">Supplier/Purchaser ID:</label>
              <select name="customer_id" id="customer_id" class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
            
                 <option value="">Select ID</option>
                 @foreach($suppliers as $supplier)
                 <option value="{{$supplier->id}}">{{$supplier->id}}</option>
                 @endforeach

              
              </select>
              
            </div>

            <div class="flex flex-col w-1/2">
              <label for="quantity" class="leading-10 pl-2">Quantity:</label>
              <input type="text" value="{{old('quantity')}}" name="quantity" class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Quantity">
              
            </div>


            <div class="flex flex-col w-1/2">
              <label for="price" class="leading-10 pl-2">Price:</label>
              <input type="text" value="{{old('price')}}" name="price" class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Enter Price">
              
            </div>

 

            <div class="flex flex-col w-1/2 mt-2">
            <button class="bg-blue-500 hover:bg-blue-700 font-bold text-white ml-2 py-2 rounded" type="submit">Confirm Order</button><br>
            </div>



            </form>
      
    </div>
    
  </div>


@endsection