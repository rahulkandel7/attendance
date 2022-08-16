@extends('layouts.app')

@section('content')
    @include('layouts.message')
    <div class="w-full h-screen bg-opacity-60 ">
        <h1 class="text-2xl pt-8 pb-2 text-indigo-500 font-bold">
            Compose Leave Letter
        </h1>
        
            <form action="{{route('applications.store')}}" method="post" class="w-[90%]" enctype="multipart/form-data">
                @csrf
                @foreach($errors->all() as $message)
                    <li class="px-4 text-red-500 font-bold">{{$message}}</li>
                @endforeach

				<div class="my-2 py-2 mx-6">
                    <label class="py-2 text-gray-500 font-bold my-2">Subject</label>

                    <input type="text" class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600 " required name="subject" placeholder="Subject" value="{{old('subject')}}">
                </div>

                <div class="my-2 py-2 mx-6 ">
                    <label class="py-2 text-gray-500 font-bold my-2">Application Letter</label>

                    <textarea class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600 editor" name="description"  >{{old('description')}}</textarea>
                </div>

                <div class="my-2 py-2 mx-6">
                    <label class="py-2 text-gray-500 font-bold my-2">Add Attachment</label>

                    <input type="file" class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600 file:rounded-md file:bg-indigo-500 file:border-none file:text-white" name="filepath" >
                </div>

                <div class="flex justify-center mt-2 mb-6">
                    <input type="submit" value="Submit" class="px-8 py-2 bg-gray-500 rounded-full text-white hover:bg-gray-700 cursor-pointer">
                </div>
            </form>

    </div>
@endsection

@section('js')
<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
    <script>

			const watchdog = new CKSource.EditorWatchdog();
			
			window.watchdog = watchdog;
			
			watchdog.setCreator( ( element, config ) => {
				return CKSource.Editor
					.create( element, config )
					.then( editor => {
						
						
						
			
						return editor;
					} )
			} );
			
			watchdog.setDestructor( editor => {
				
				
			
				return editor.destroy();
			} );
			
			watchdog.on( 'error', handleError );
			
			watchdog
				.create( document.querySelector( '.editor' ), {
					
					licenseKey: '',
					
					
					
				} )
				.catch( handleError );
			
			function handleError( error ) {
				console.error( 'Oops, something went wrong!' );
				console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
				console.warn( 'Build id: 9ammfx80nks8-5mipjpgx1z9' );
				console.error( error );
			}
			
		
    </script>
@endsection