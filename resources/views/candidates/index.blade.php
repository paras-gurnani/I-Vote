@extends('layouts.app')

@section('content')
<div class="" style="margin:0 0 0 0; width:100vw max-width:100vw">
    <div class="row justify-content-center ">
        <div class="col-md-12">
            
                @csrf
                @for ($i = 0; $i < count($fields); $i++)
                <div class='field' style="margin-bottom: 40px;">
                    <h3>{{$fields[$i]}}</h3>
                    @for ($j = 0; $j < count($candidates[$i]); $j++) 
                    <div class="card text-center"
                        style="width: 18rem; display:inline-block; margin-right:25px;">
                        <br>
                        <img src="{{asset('images/'.($candidates[$i][$j])->cover_image)}}" height='100' width='100' class="" alt="..."
                            style='border-radius:50% '>
                        <div class="card-body">
                            <h5 class="card-title">{{$candidates[$i][$j]->name}}</h5>
                            <p class="card-text">{{$candidates[$i][$j]->desc}}</p>
                            <input type="radio" class="btn-check" name="{{$fields[$i]}}" id="{{$candidates[$i][$j]->name}}" value="{{$candidates[$i][$j]->name}}"
                                style="display: none;" autocomplete="off">
                            {{-- <label class="btn btn-outline-primary" for="{{$i.$field}}">Vote for me</label> --}}
                        </div>
                </div>

                @endfor


                @endfor
                <br>
                <br>
                {{-- <button type="submit" class='btn btn-lg btn-primary' style='margin-left:44%'>Submit</button> --}}
        </div>

        
        <!-- </div>
        
    </div>-->
    </div>
</div>
@endsection
