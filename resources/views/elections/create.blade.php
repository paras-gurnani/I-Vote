@extends('layouts.app')

@section('content')

<h1 class='text-center'>Create page</h1>
<div class='col-md-12 container'>
    <form method='post' enctype="multipart/form-data" action="{{route('elections.store')}}">
        @csrf
        <div class='row' style='padding-top:3%;'>
            <div class='col form-group' style='display:inline-block; padding-left:500px; max-width:50%;'>
                <div class="form-check" >
                    <input class="form-check-input" type="checkbox" value="CR" id="CR" name='Class Representative' checked>
                    <label class="form-check-label" for="CR">
                        Class Representative
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="MC" name='Music Council' id="MC">
                    <label class="form-check-label" for="MC">
                        Music Council
                    </label>
                </div>
                 <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="CC" name='Cultural Council' id="CC">
                    <label class="form-check-label" for="CC">
                        Cultural Council
                    </label>
                </div>
                 <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="SR" name='SORT Representative' id="SR">
                    <label class="form-check-label" for="SR">
                        SORT Representative
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="SC" name='Sports Council' id="SC">
                    <label class="form-check-label" for="SC">
                        Sports Council
                    </label>
                </div>
            </div>
            <div class='col form-group' style='display:inline-block;'>
                <label for="Start Time" style='display:block;' >Start Time:</label>
                <input type='date' name='StartDate' style='display:inline-block;'/>
                <input type='time'  name='StartTime'/>
                <br>
                <br>
                <label for="End Time" style='display:block;'>End Time:</label>
                <input type='date' name='EndDate' style='display:inline-block;'/>
                <input type='time'  name='EndTime'/>

                <br>

                <button type="submit" style="margin-top:5%;" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </div>
    </form>
</div>

@endsection
