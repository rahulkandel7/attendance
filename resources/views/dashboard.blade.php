@extends('layouts.app')

@section('css')
    <style>
        canvas {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }
        .clock {
    color: indigo;

    font-family: cursive;
    letter-spacing: 7px;
   


}
    </style>
@endsection

@section('content')
@include('layouts.message')
    <div class="flex justify-between items-end">
        <h1 class="font-bold text-3xl text-[#8a0000] mt-4">
            Bitmap I.T. Solution - Attendance System 
        </h1>
    
        <div class="flex">
            <div class="py-0 my-0">
                <p class="px-4 my-0 text-indigo-800 text-xl py-2">Hi 👋, {{Auth::user()->name}}</p>
            </div>
            <div id="MyClockDisplay" class="px-4 my-0 text-indigo-800 text-xl py-2" onload="showTime()"></div>
        </div>
    </div>


    
    @if (Auth::user()->role != "admin")
    
        <div class="flex mt-4" style="z-index: 2">
            <form >
                @csrf
                
                <button type="submit" class="py-2 px-8 rounded-md bg-fuchsia-500 hover:bg-fuchsia-600 text-white text-xl cursor-pointer" @if (App\Models\Attendance::where('user_id',Auth::user()->id )->where('date_recorded', Carbon\Carbon::now()->format('Y-m-d'))->count() == 0) id="clock-in" @else  disabled  @endif>
                    <i class="fa-solid fa-arrow-right-to-bracket pr-1"></i> Clock In
                </button>
            </form>
            
            <button id="clock-out" class=" ml-6 py-2 px-8 rounded-md bg-rose-500 hover:bg-rose-600 text-white text-xl cursor-pointer"  @if (App\Models\Attendance::where('user_id',Auth::user()->id )->where('date_recorded',Carbon\Carbon::now()->format('Y-m-d'))->where('exit_time','!=','')->exists())  disabled @endif
            > <i class="fa-solid fa-arrow-right-from-bracket"></i> Clock Out </button>

            

            <a href="{{route('applications.create')}}" class=" ml-6 py-2 px-8 rounded-md bg-green-500 hover:bg-green-600 text-white text-xl cursor-pointer"> <i class="fa-solid fa-person-walking pr-2"></i> Ask Leave</a>            
            
        </div>

        <hr class="my-2">

        <div class="grid grid-cols-3 gap-10"> 
            <div class="w-full h-32 bg-emerald-500 rounded-lg shadow-md shadow-emerald-200 my-4">
                <h1 class="text-white font-bold text-xl pt-4 px-4">
                    Total Attendance
                </h1>
                <div class="flex justify-between my-2">
                    <i class="fa-solid fa-clipboard-user text-3xl text-gray-100 pl-2 opacity-80"></i>
                    <p class="text-right pr-6 font-bold text-white text-3xl">
                        {{$ta}} 
                    </p>
                </div>
            </div>

            <div class="w-full h-32 bg-green-500 rounded-lg shadow-md shadow-green-200 my-4">
                <h1 class="text-white font-bold text-xl pt-4 px-4">
                    This Month Attendance
                </h1>
                <div class="flex justify-between my-2">
                    <i class="fa-solid fa-clipboard-user text-3xl text-gray-100 pl-2 opacity-80"></i>
                    <p class="text-right pr-6 font-bold text-white text-3xl">
                        {{$month}} 
                    </p>
                </div>
            </div>
    
            <div class="w-full h-32 bg-fuchsia-500 rounded-lg shadow-md shadow-fuchsia-200 my-4">
                <h1 class="text-white font-bold text-xl pt-4 px-4">
                    Late Entry
                </h1>
                <div class="flex justify-between my-2">
    
                    <i class="fa-solid fa-arrow-right-to-bracket text-3xl text-gray-100 pl-2 opacity-80"></i>
                    <p class="text-right pr-6 font-bold text-white text-3xl">
                         {{$le}}
                    </p>
                </div>
            </div>

            <div class="w-full h-32 bg-amber-500 rounded-lg shadow-md shadow-amber-200 my-4">
                <h1 class="text-white font-bold text-xl pt-4 px-4">
                    Early Exit
                </h1>
                <div class="flex justify-between my-2">
                    <i class="fa-solid fa-arrow-right-from-bracket text-3xl text-gray-100 pl-2 opacity-80"></i>
                    <p class="text-right pr-6 font-bold text-white text-3xl">
                         {{$ee}}
                    </p>
                </div>
            </div>

            
        </div>

        @else

        <div class="grid grid-cols-3 gap-10 my-4 mr-6"> 
            <div class="w-full h-32 bg-emerald-500 rounded-lg shadow-md shadow-emerald-200  mx-4">
                <h1 class="text-white font-bold text-xl pt-4 px-4">
                    Total Employee
                </h1>
                <div class="flex justify-between my-2">
                    <i class="fa-solid fa-users text-3xl text-gray-100 pl-2 opacity-80"></i>
                    <p class="text-right pr-6 font-bold text-white text-3xl">
                        {{$total_employee}} 
                    </p>
                </div>
            </div>
    
            <a href="{{route('clockedin')}}">
                <div class="w-full h-32 bg-fuchsia-500 rounded-lg shadow-md shadow-fuchsia-200 mx-4">
                    <h1 class="text-white font-bold text-xl pt-4 px-4">
                        Clocked In
                    </h1>
                    <div class="flex justify-between my-2">
        
                        <i class="fa-solid fa-arrow-right-to-bracket text-3xl text-gray-100 pl-2 opacity-80"></i>
                        <p class="text-right pr-6 font-bold text-white text-3xl">
                             {{$clocked_in}}
                        </p>
                    </div>
                </div>
            </a>

            <a href="{{route('notclocked')}}">
                <div class="w-full h-32 bg-amber-500 rounded-lg shadow-md shadow-amber-200  mx-4">
                    <h1 class="text-white font-bold text-xl pt-4 px-4">
                        Not Clocked In
                    </h1>
                    <div class="flex justify-between my-2">
                        <i class="fa-solid fa-arrow-right-from-bracket text-3xl text-gray-100 pl-2 opacity-80"></i>
                        <p class="text-right pr-6 font-bold text-white text-3xl">
                             {{$not_clocked_in}}
                        </p>
                    </div>
                </div>
            </a>

            <a href="{{route('todayapplication')}}">
                <div class="w-full h-32 bg-blue-500 rounded-lg shadow-md shadow-blue-200  mx-4">
                    <h1 class="text-white font-bold text-xl pt-4 px-4">
                        Today App. Leave
                    </h1>
                    <div class="flex justify-between my-2">
                        <i class="fa-solid fa-house-person-leave text-3xl text-gray-100 pl-2 opacity-80"></i>
                        <p class="text-right pr-6 font-bold text-white text-3xl">
                             {{$today_leave}}
                        </p>
                    </div>
                </div>
            </a>

            <a href="{{route('application')}}">
                <div class="w-full h-32 bg-indigo-500 rounded-lg shadow-md shadow-indigo-200  mx-4">
                    <h1 class="text-white font-bold text-xl pt-4 px-4">
                        Total App. Leave
                    </h1>
                    <div class="flex justify-between my-2">
                        <i class="fa-solid fa-house-person-leave text-3xl text-gray-100 pl-2 opacity-80"></i>
                        <p class="text-right pr-6 font-bold text-white text-3xl">
                             {{$total_application}}
                        </p>
                    </div>
                </div>
            </a>

            <a href="{{route('birthday')}}">
                <div class="w-full h-32 bg-pink-500 rounded-lg shadow-md shadow-pink-200  mx-4">
                    <h1 class="text-white font-bold text-xl pt-4 px-4">
                        Upcomming Birthdays(This Month)
                    </h1>
                    <div class="flex justify-between my-2">
                        <i class="fa-solid fa-house-person-leave text-3xl text-gray-100 pl-2 opacity-80"></i>
                        <p class="text-right pr-6 font-bold text-white text-3xl">
                             {{$birthday}}
                        </p>
                    </div>
                </div>
            </a>

            
        </div>
    @endif

     <div class="absolute right-8">
         <!-- Start of nepali calendar widget -->
        <script type="text/javascript"> <!--
            var nc_width = 330;
            var nc_height = 185;
            var nc_api_id = 86420220613735; //-->
            </script>
            <script type="text/javascript" src="https://www.ashesh.com.np/calendarlink/nc.js"></script>
            
        <!-- End of nepali calendar widget -->
     </div>

   
    
        @if($mybirthday)
            <div id="popupp" style="visibility:hidden;">
                <canvas id="c">
                    <button>Hello</button>
                </canvas>
    
                <audio id="my_audio">
                    <source src="{{asset('audio/h.mp3')}}" type="audio/mpeg">
                  </audio>
            </div>

        @endif
        
          


    @endsection

@section('model')
    <div class="w-full h-screen absolute top-0 bg-black bg-opacity-60  justify-center items-center hidden" id="reason_box">
        <div class="relative glass w-80 h-auto bg-white rounded-md">

            <div class="absolute top-2 right-3">
                <i class="fa-solid fa-circle-xmark text-gray-300 hover:text-red-500 cursor-pointer" id="hideee"></i>
            </div>

            <div class="flex justify-center">
                <img src="{{asset('images/logo.png')}}" class="py-2 w-52">
            </div>

            <form>
                <p class="text-center font-bold text-gray-500 text-xl">Remark</p>

                <div class="py-2 mx-6">
                    <textarea  class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600" placeholder="Reason Here" required id="reason"></textarea>

                </div>
                <div class="flex justify-center mt-2 mb-6">
                    <input type="submit" value="Submit" class="py-2 px-8 rounded-md bg-gray-500 hover:bg-gray-600 text-white text-xl cursor-pointer" id="submit">
                </div>
            </form>
        </div>
    </div>

    {{-- <div class="w-full h-screen absolute top-0 bg-black bg-opacity-60  justify-center items-center hidden" id="clocked">
        <div class=" glass w-80 h-auto bg-white rounded-md relative">

            <div class="absolute top-2 right-3">
                <i class="fa-solid fa-circle-xmark text-gray-300 hover:text-red-500 cursor-pointer" id="hidee"></i>
            </div>

            <div class="flex justify-center">
                <img src="{{asset('images/logo.png')}}" class="py-2 w-52">
            </div>
            
            <form class="ml-1" action="{{route('attendances.update',1)}}" method="post">
                @method('put')
                @csrf
                <p class="text-center font-bold text-gray-500 text-xl">Remark</p>

                <div class="py-2 mx-6">
                    <textarea  class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600" placeholder="Reason Here" name="early_exit"></textarea>

                </div>
                <div class="flex justify-center mt-2 mb-6">
                    <input type="submit" value="Clock Out" class="py-2 px-8 rounded-md bg-rose-500 hover:bg-rose-600 text-white text-xl cursor-pointer">
                </div>
            </form>
        </div>
    </div> --}}


    <div id="message" class="animate__animated hidden animate__slideInRight dismissible fixed right-8 top-4 z-50">
        <div class="w-auto rounded-md p-2 shadow-lg bg-gray-100 dark:bg-gray-600">
            <p class="border-l-4 border-indigo-400 px-2 text-indigo-900 dark:text-indigo-300 font-bold"><span class="fa fa-check bg-indigo-400 text-white px-1.5 py-0.5 rounded-full font-normal text-sm"></span> 
                <span id="message_text"></span>
            </p>
        </div>
    </div>
    <script>
       $(function() {
            setTimeout(function(){
                $(".dismissible").addClass('animate__slideOutRight').fadeOut(1000);
            }, 2000);
       });
    
    </script>
@endsection


@section('js')
    <script>
        $('#clockout').click(function(e) {
            e.preventDefault();

            $('#clocked').removeClass('hidden');
            $('#clocked').addClass('flex');

        });

        $('#hidee').click(function(e) {
            e.preventDefault();

            $('#clocked').removeClass('flex');
            $('#clocked').addClass('hidden');

        });

        $('#hideee').click(function(e) {
            e.preventDefault();

            $('#reason_box').removeClass('flex');
            $('#reason_box').addClass('hidden');

        });
    </script>
    <script>
        $("#clock-in").click(function (e) {

            e.preventDefault();



            if("{{Auth::user()->entry_time}}" < "{{Carbon\Carbon::now()->format('H:i:m')}}") {
                console.log('ima');

                    $('#reason_box').removeClass('hidden');
                    $('#reason_box').addClass('flex');

                    $('#submit').click(function (e) {
                        e.preventDefault();
                        $('#reason_box').removeClass('flex');
                    $('#reason_box').addClass('hidden');
                        $.ajax({
                            type: 'POST',
                            url: "{{route('attendances.store')}}",
                            dataType:"json",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'user_id': '{{Auth::user()->id}}',
                                'date_recorded' : "{{Carbon\Carbon::now()->format('Y-m-d')}}",
                                'entry_time': "{{Carbon\Carbon::now()->format('H:i:m')}}",
                                'late_entry': $("#reason").val(),
                            },
                            success: function (data) {
                                    console.log('sucess');
                            },
                            error: function(xhr, textStatus, error) {
                                $('#message').toggle('hidden');
                                $('#message_text').html(xhr.responseText);
                                window.setTimeout(function(){location.reload()},2000)
                                
                            },
                        });
                    });

                    
            } 
            else {
                            
                $.ajax({
                    type: 'POST',
                    url: "{{route('attendances.store')}}",
                    dataType:"json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'user_id': '{{Auth::user()->id}}',
                        'date_recorded' : "{{Carbon\Carbon::now()->format('Y-m-d')}}",
                        'entry_time': "{{Carbon\Carbon::now()->format('H:i:m')}}",
                    },
                    success: function (data) {
                        
                    },
                    error: function(xhr, textStatus, error) {
                                $('#message').toggle('hidden');
                                $('#message_text').html(xhr.responseText);
                                window.setTimeout(function(){location.reload()},2000)

                                
                            },
                });
            }
            
        });

        $("#clock-out").click(function (e) {

        e.preventDefault();



        if("{{Auth::user()->exit_time}}" > "{{Carbon\Carbon::now()->format('H:i:m')}}") {
            console.log('ima');

                $('#reason_box').removeClass('hidden');
                $('#reason_box').addClass('flex');

                $('#submit').click(function (e) {
                    e.preventDefault();
                    $('#reason_box').removeClass('flex');
                $('#reason_box').addClass('hidden');
                    $.ajax({
                        type: 'POST',
                        url: "{{route('attendances.updated')}}",
                        dataType:"json",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'user_id': '{{Auth::user()->id}}',
                            'date_recorded' : "{{Carbon\Carbon::now()->format('Y-m-d')}}",
                            'exit_time': "{{Carbon\Carbon::now()->format('H:i:m')}}",
                            'early_exit': $("#reason").val(),
                        },
                        success: function (data) {
                                console.log('sucess');
                        },
                        error: function(xhr, textStatus, error) {
                            $('#message').toggle('hidden');
                            $('#message_text').html(xhr.responseText);
                            window.setTimeout(function(){location.reload()},2000);
                            
                        },
                    });
                });

                
        } 
        else {
                        
            $.ajax({
                type: 'POST',
                url: "{{route('attendances.updated')}}",
                dataType:"json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'user_id': '{{Auth::user()->id}}',
                    'date_recorded' : "{{Carbon\Carbon::now()->format('Y-m-d')}}",
                    'exit_time': "{{Carbon\Carbon::now()->format('H:i:m')}}",
                },
                success: function (data) {
                    
                },
                error: function(xhr, textStatus, error) {
                            $('#message').toggle('hidden');
                            $('#message_text').html(xhr.responseText);
                            window.setTimeout(function(){location.reload()},2000);

                            
                        },
            });
        }

        });


        
    </script>

    <script>
        var w = c.width = window.innerWidth,
		h = c.height = window.innerHeight,
		ctx = c.getContext( '2d' ),
		
		hw = w / 2, // half-width
		hh = h / 2,
		
		opts = {
			strings: [ 'HAPPY', 'BIRTHDAY!', '{{Auth::user()->name}}' ],
			charSize: 30,
			charSpacing: 35,
			lineHeight: 40,
			
			cx: w / 2,
			cy: h / 2,
			
			fireworkPrevPoints: 10,
			fireworkBaseLineWidth: 5,
			fireworkAddedLineWidth: 8,
			fireworkSpawnTime: 200,
			fireworkBaseReachTime: 30,
			fireworkAddedReachTime: 30,
			fireworkCircleBaseSize: 20,
			fireworkCircleAddedSize: 10,
			fireworkCircleBaseTime: 30,
			fireworkCircleAddedTime: 30,
			fireworkCircleFadeBaseTime: 10,
			fireworkCircleFadeAddedTime: 5,
			fireworkBaseShards: 5,
			fireworkAddedShards: 5,
			fireworkShardPrevPoints: 3,
			fireworkShardBaseVel: 4,
			fireworkShardAddedVel: 2,
			fireworkShardBaseSize: 3,
			fireworkShardAddedSize: 3,
			gravity: .1,
			upFlow: -.1,
			letterContemplatingWaitTime: 360,
			balloonSpawnTime: 20,
			balloonBaseInflateTime: 10,
			balloonAddedInflateTime: 10,
			balloonBaseSize: 20,
			balloonAddedSize: 20,
			balloonBaseVel: .4,
			balloonAddedVel: .4,
			balloonBaseRadian: -( Math.PI / 2 - .5 ),
			balloonAddedRadian: -1,
		},
		calc = {
			totalWidth: opts.charSpacing * Math.max( opts.strings[0].length, opts.strings[1].length )
		},
		
		Tau = Math.PI * 2,
		TauQuarter = Tau / 4,
		
		letters = [];

ctx.font = opts.charSize + 'px Verdana';

function Letter( char, x, y ){
	this.char = char;
	this.x = x;
	this.y = y;
	
	this.dx = -ctx.measureText( char ).width / 2;
	this.dy = +opts.charSize / 2;
	
	this.fireworkDy = this.y - hh;
	
	var hue = x / calc.totalWidth * 360;
	
	this.color = 'hsl(hue,80%,50%)'.replace( 'hue', hue );
	this.lightAlphaColor = 'hsla(hue,80%,light%,alp)'.replace( 'hue', hue );
	this.lightColor = 'hsl(hue,80%,light%)'.replace( 'hue', hue );
	this.alphaColor = 'hsla(hue,80%,50%,alp)'.replace( 'hue', hue );
	
	this.reset();
}
Letter.prototype.reset = function(){
	
	this.phase = 'firework';
	this.tick = 0;
	this.spawned = false;
	this.spawningTime = opts.fireworkSpawnTime * Math.random() |0;
	this.reachTime = opts.fireworkBaseReachTime + opts.fireworkAddedReachTime * Math.random() |0;
	this.lineWidth = opts.fireworkBaseLineWidth + opts.fireworkAddedLineWidth * Math.random();
	this.prevPoints = [ [ 0, hh, 0 ] ];
}
Letter.prototype.step = function(){
	
	if( this.phase === 'firework' ){
		
		if( !this.spawned ){
			
			++this.tick;
			if( this.tick >= this.spawningTime ){
				
				this.tick = 0;
				this.spawned = true;
			}
			
		} else {
			
			++this.tick;
			
			var linearProportion = this.tick / this.reachTime,
					armonicProportion = Math.sin( linearProportion * TauQuarter ),
					
					x = linearProportion * this.x,
					y = hh + armonicProportion * this.fireworkDy;
			
			if( this.prevPoints.length > opts.fireworkPrevPoints )
				this.prevPoints.shift();
			
			this.prevPoints.push( [ x, y, linearProportion * this.lineWidth ] );
			
			var lineWidthProportion = 1 / ( this.prevPoints.length - 1 );
			
			for( var i = 1; i < this.prevPoints.length; ++i ){
				
				var point = this.prevPoints[ i ],
						point2 = this.prevPoints[ i - 1 ];
					
				ctx.strokeStyle = this.alphaColor.replace( 'alp', i / this.prevPoints.length );
				ctx.lineWidth = point[ 2 ] * lineWidthProportion * i;
				ctx.beginPath();
				ctx.moveTo( point[ 0 ], point[ 1 ] );
				ctx.lineTo( point2[ 0 ], point2[ 1 ] );
				ctx.stroke();
			
			}
			
			if( this.tick >= this.reachTime ){
				
				this.phase = 'contemplate';
				
				this.circleFinalSize = opts.fireworkCircleBaseSize + opts.fireworkCircleAddedSize * Math.random();
				this.circleCompleteTime = opts.fireworkCircleBaseTime + opts.fireworkCircleAddedTime * Math.random() |0;
				this.circleCreating = true;
				this.circleFading = false;
				
				this.circleFadeTime = opts.fireworkCircleFadeBaseTime + opts.fireworkCircleFadeAddedTime * Math.random() |0;
				this.tick = 0;
				this.tick2 = 0;
				
				this.shards = [];
				
				var shardCount = opts.fireworkBaseShards + opts.fireworkAddedShards * Math.random() |0,
						angle = Tau / shardCount,
						cos = Math.cos( angle ),
						sin = Math.sin( angle ),
						
						x = 1,
						y = 0;
				
				for( var i = 0; i < shardCount; ++i ){
					var x1 = x;
					x = x * cos - y * sin;
					y = y * cos + x1 * sin;
					
					this.shards.push( new Shard( this.x, this.y, x, y, this.alphaColor ) );
				}
			}
			
		}
	} else if( this.phase === 'contemplate' ){
		
		++this.tick;
		
		if( this.circleCreating ){
			
			++this.tick2;
			var proportion = this.tick2 / this.circleCompleteTime,
					armonic = -Math.cos( proportion * Math.PI ) / 2 + .5;
			
			ctx.beginPath();
			ctx.fillStyle = this.lightAlphaColor.replace( 'light', 50 + 50 * proportion ).replace( 'alp', proportion );
			ctx.beginPath();
			ctx.arc( this.x, this.y, armonic * this.circleFinalSize, 0, Tau );
			ctx.fill();
			
			if( this.tick2 > this.circleCompleteTime ){
				this.tick2 = 0;
				this.circleCreating = false;
				this.circleFading = true;
			}
		} else if( this.circleFading ){
		
			ctx.fillStyle = this.lightColor.replace( 'light', 70 );
			ctx.fillText( this.char, this.x + this.dx, this.y + this.dy );
			
			++this.tick2;
			var proportion = this.tick2 / this.circleFadeTime,
					armonic = -Math.cos( proportion * Math.PI ) / 2 + .5;
			
			ctx.beginPath();
			ctx.fillStyle = this.lightAlphaColor.replace( 'light', 100 ).replace( 'alp', 1 - armonic );
			ctx.arc( this.x, this.y, this.circleFinalSize, 0, Tau );
			ctx.fill();
			
			if( this.tick2 >= this.circleFadeTime )
				this.circleFading = false;
			
		} else {
			
			ctx.fillStyle = this.lightColor.replace( 'light', 70 );
			ctx.fillText( this.char, this.x + this.dx, this.y + this.dy );
		}
		
		for( var i = 0; i < this.shards.length; ++i ){
			
			this.shards[ i ].step();
			
			if( !this.shards[ i ].alive ){
				this.shards.splice( i, 1 );
				--i;
			}
		}
		
		if( this.tick > opts.letterContemplatingWaitTime ){
			
			this.phase = 'balloon';
			
			this.tick = 0;
			this.spawning = true;
			this.spawnTime = opts.balloonSpawnTime * Math.random() |0;
			this.inflating = false;
			this.inflateTime = opts.balloonBaseInflateTime + opts.balloonAddedInflateTime * Math.random() |0;
			this.size = opts.balloonBaseSize + opts.balloonAddedSize * Math.random() |0;
			
			var rad = opts.balloonBaseRadian + opts.balloonAddedRadian * Math.random(),
					vel = opts.balloonBaseVel + opts.balloonAddedVel * Math.random();
			
			this.vx = Math.cos( rad ) * vel;
			this.vy = Math.sin( rad ) * vel;
		}
	} else if( this.phase === 'balloon' ){
			
		ctx.strokeStyle = this.lightColor.replace( 'light', 80 );
		
		if( this.spawning ){
			
			++this.tick;
			ctx.fillStyle = this.lightColor.replace( 'light', 70 );
			ctx.fillText( this.char, this.x + this.dx, this.y + this.dy );
			
			if( this.tick >= this.spawnTime ){
				this.tick = 0;
				this.spawning = false;
				this.inflating = true;	
			}
		} else if( this.inflating ){
			
			++this.tick;
			
			var proportion = this.tick / this.inflateTime,
			    x = this.cx = this.x,
					y = this.cy = this.y - this.size * proportion;
			
			ctx.fillStyle = this.alphaColor.replace( 'alp', proportion );
			ctx.beginPath();
			generateBalloonPath( x, y, this.size * proportion );
			ctx.fill();
			
			ctx.beginPath();
			ctx.moveTo( x, y );
			ctx.lineTo( x, this.y );
			ctx.stroke();
			
			ctx.fillStyle = this.lightColor.replace( 'light', 70 );
			ctx.fillText( this.char, this.x + this.dx, this.y + this.dy );
			
			if( this.tick >= this.inflateTime ){
				this.tick = 0;
				this.inflating = false;
			}
			
		} else {
			
			this.cx += this.vx;
			this.cy += this.vy += opts.upFlow;
			
			ctx.fillStyle = this.color;
			ctx.beginPath();
			generateBalloonPath( this.cx, this.cy, this.size );
			ctx.fill();
			
			ctx.beginPath();
			ctx.moveTo( this.cx, this.cy );
			ctx.lineTo( this.cx, this.cy + this.size );
			ctx.stroke();
			
			ctx.fillStyle = this.lightColor.replace( 'light', 70 );
			ctx.fillText( this.char, this.cx + this.dx, this.cy + this.dy + this.size );
			
			if( this.cy + this.size < -hh || this.cx < -hw || this.cy > hw  )
				this.phase = 'done';
			
		}
	}
}
function Shard( x, y, vx, vy, color ){
	
	var vel = opts.fireworkShardBaseVel + opts.fireworkShardAddedVel * Math.random();
	
	this.vx = vx * vel;
	this.vy = vy * vel;
	
	this.x = x;
	this.y = y;
	
	this.prevPoints = [ [ x, y ] ];
	this.color = color;
	
	this.alive = true;
	
	this.size = opts.fireworkShardBaseSize + opts.fireworkShardAddedSize * Math.random();
}
Shard.prototype.step = function(){
	
	this.x += this.vx;
	this.y += this.vy += opts.gravity;
	
	if( this.prevPoints.length > opts.fireworkShardPrevPoints )
		this.prevPoints.shift();
	
	this.prevPoints.push( [ this.x, this.y ] );
	
	var lineWidthProportion = this.size / this.prevPoints.length;
	
	for( var k = 0; k < this.prevPoints.length - 1; ++k ){
		
		var point = this.prevPoints[ k ],
				point2 = this.prevPoints[ k + 1 ];
		
		ctx.strokeStyle = this.color.replace( 'alp', k / this.prevPoints.length );
		ctx.lineWidth = k * lineWidthProportion;
		ctx.beginPath();
		ctx.moveTo( point[ 0 ], point[ 1 ] );
		ctx.lineTo( point2[ 0 ], point2[ 1 ] );
		ctx.stroke();
		
	}
	
	if( this.prevPoints[ 0 ][ 1 ] > hh )
		this.alive = false;
}
function generateBalloonPath( x, y, size ){
	
	ctx.moveTo( x, y );
	ctx.bezierCurveTo( x - size / 2, y - size / 2,
									 	 x - size / 4, y - size,
									   x,            y - size );
	ctx.bezierCurveTo( x + size / 4, y - size,
									   x + size / 2, y - size / 2,
									   x,            y );
}

function anim(){
	
	window.requestAnimationFrame( anim );
	
	ctx.fillStyle = '#111';
	ctx.fillRect( 0, 0, w, h );
	
	ctx.translate( hw, hh );
	
	var done = true;
	for( var l = 0; l < letters.length; ++l ){
		
		letters[ l ].step();
		if( letters[ l ].phase !== 'done' )
			done = false;
	}
	
	ctx.translate( -hw, -hh );
	
	if( done )
		for( var l = 0; l < letters.length; ++l )
			letters[ l ].reset();
}

for( var i = 0; i < opts.strings.length; ++i ){
	for( var j = 0; j < opts.strings[ i ].length; ++j ){
		letters.push( new Letter( opts.strings[ i ][ j ], 
														j * opts.charSpacing + opts.charSpacing / 2 - opts.strings[ i ].length * opts.charSize / 2,
														i * opts.lineHeight + opts.lineHeight / 2 - opts.strings.length * opts.lineHeight / 2 ) );
	}
}

anim();

window.addEventListener( 'resize', function(){
	
	w = c.width = window.innerWidth;
	h = c.height = window.innerHeight;
	
	hw = w / 2;
	hh = h / 2;
	
	ctx.font = opts.charSize + 'px Verdana';
});



   

    </script>

    <script>
        

        (function() {
            var visited = sessionStorage.getItem('visited');
            if (!visited) {
                window.onload = function() {
                document.getElementById("my_audio").play();
                }
            
                setTimeout(function() { 
                    $('#c').hide();
                    $("#my_audio").stop();

                }, 12000);
                document.getElementById("popupp").style.visibility = "visible";
                sessionStorage.setItem('visited', true);

                
            }
        })();

    </script>

   <script>
       function showTime(){
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;
    
    setTimeout(showTime, 1000);
    
}

showTime();
   </script>

    
@endsection