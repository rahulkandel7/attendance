

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <style>
            /* ---- reset ---- */  canvas{ display: block; vertical-align: bottom; } /* ---- particles.js container ---- */ #particles-js{ position:absolute; width: 100%; height: 100%; background-color: #000000; background-image: url(""); background-repeat: no-repeat; background-size: cover; background-position: 50% 50%; } /* ---- stats.js ---- */ .count-particles{ background: #000022; position: absolute; top: 48px; left: 0; width: 80px; color: #13E8E9; font-size: .8em; text-align: left; text-indent: 4px; line-height: 14px; padding-bottom: 2px; font-family: Helvetica, Arial, sans-serif; font-weight: bold; } .js-count-particles{ font-size: 1.1em; } #stats, .count-particles{ -webkit-user-select: none; margin-top: 5px; margin-left: 5px; } #stats{ border-radius: 3px 3px 0 0; overflow: hidden; } 
           
    
            .glass{
                background: rgba(95, 95, 95, 0.25);
                box-shadow: 0 8px 32px 0 rgba(65, 65, 66, 0.37);
                backdrop-filter: blur( 3.5px );
                -webkit-backdrop-filter: blur( 3.5px );
                border-radius: 10px;
                border: 1px solid rgba(109, 108, 108, 0.18);
            }
        </style>

    </head>

    <body>
        <div id="particles-js">
            
        </div>

        <div class="  h-screen w-full">
            <div class="w-full h-screen flex justify-center items-center ">
                <div class=" glass w-80 h-auto bg-white">
                    <div class="flex justify-center">
                        <img src="{{asset('images/logo.png')}}" class="py-2 w-52">
                    </div>
                    
                    <form action="{{route('password.update')}}" method="post">
                        @csrf
                        @foreach($errors->all() as $message)
                            <li class="px-4 text-red-500 font-bold">{{$message}}</li>
                        @endforeach

                         <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="my-2 py-2 mx-6">
                            <input type="email" class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600" name="email" placeholder="Enter Email Address" value="{{old('email', $request->email)}}" required>
                        </div>
    
                        <div class="py-2 mx-6">
                            <input type="password" class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600" name="password" placeholder="Enter Password" required>
                        </div>

                        <div class="py-2 mx-6">
                            <input type="password" class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600" name="password_confirmation" placeholder="Confirm Password" required>
                        </div>

                        

                        <div class="flex justify-center mt-2 mb-6">
                            <input type="submit" value="Reset Password" class="px-8 py-2 bg-gray-500 rounded-full text-white hover:bg-gray-700 cursor-pointer">
                        </div>
                    </form>
                </div>
            </div>
    
        </div>


        <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> 
       

        <script>
            particlesJS("particles-js", {"particles":{"number":{"value":251,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"triangle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":true,"speed":65.77845451084887,"size_min":0,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":true,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":97.44956223829463,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});
            
        </script>
    </body>
</html>

