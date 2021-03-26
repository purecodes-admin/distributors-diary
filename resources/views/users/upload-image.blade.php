@extends('layout/master')
@section('address', 'Add Distributor')
@section('content')

    <h3 class="p-5 font-semibold text-lg underline text-blue-700  hover:text-blue-900" style="width: 88%; margin:auto;">
        <span class="fas fa-user"></span>
        <a>Update Image</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Your Profile is Updated Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Your Profile is Not Updated...!!!
        </span>
    </h3>
    <div id="errors"></div>
    <div style="width: 88%; margin:auto;">
        <form method="Post" action="upload" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col md:">
                <label for="image" class="leading-10 pl-2 ml-4">Image:</label>
                <input type="file" name="image"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    required>

            </div>


            <div class="flex flex-col md:w-1/2 mt-2">
                <button class="bg-blue-700 hover:bg-blue-900 font-bold text-white ml-2 py-2 rounded" type="submit">Upload
                    Image</button><br>
            </div>
        </form>
    </div>


@endsection
