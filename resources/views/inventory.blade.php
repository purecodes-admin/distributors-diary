@extends('layout/master')
@section('title','Records List')
@section('content')


     <div class="mb-3 flex justify-end">
     <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
             <a href="order"> 
                
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-4">Add Record</button>
                
             </a>
              
      </div>
      <h1 class="text-4xl text-blue-500 font-bold m-4">Inventory</h1>

         <table class="min-w-full leading-normal">
         <thead>
         <tr>
         <th  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
         <th  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Item_ID</th>
         <th  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Category</th>
         <th  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Customer_ID</th>
         <th  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Quantity</th>
         <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Price</th>
         </tr>
         </thead>
          @foreach($data as $record)
          <tbody>
          <tr>
          <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->id }}</td>
          <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->item_id }}</td>
          <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->category }}</td>
          <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->customer_id }}</td>
          <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->quantity }}</td>
          <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->price }}</td>
          <td> 
                 <!-- <a href={{"editstock/{id}".$record['id']}} class="ml-10"> 
                    <button class="bg-green-500  hover:bg-green-700 text-white font-bold px-2 rounded">Edit</button>
                 </a> -->
        </td>
        <td>
                 <a href={{"deletestock/".$record['id']}} class="ml-10"> 
                    <button class="bg-red-500  hover:bg-red-700 text-white font-bold px-2 rounded">Delete</button>
                 </a>
        </td>
          </tr>
          </tbody>

          @endforeach
          </table>
          @endsection