@extends('layouts.app')

@section('content')
<h1 class='text-center'>Create page</h1>
<div class='col-md-12 container'>
    <form method='post' enctype="multipart/form-data" action="{{route('candidates.store')}}">
        @csrf
        <div class='row'>
            <div class='col' style='display:inline-block; padding-left:200px;'>
                <img src="{{asset('images/noname.png')}}" width='350' height='350'
                    style='display:block; border-radius:50%;'>
                <br>
                <br>
                <input type='file' name='cover_image'>
            </div>
            <div class='col form-group' style='display:inline-block;'>
                <label for="field">Field:</label>

                <select class="custom-select" name="field" id="fields" >
                    <option selected>Choose a field</option>
                    <option value="Class Representative">Class Representative</option>
                    <option value="Music Council">Music Council</option>
                    <option value="Sports Council">Sports Council</option>
                    <option value="Cultural Council">Cultural Council</option>
                    <option value="SORT Representative">SORT Representative</option>
                </select>

                <label for="description" style="padding-top: 8%;">Describe Yourself</label>
                <textarea class="form-control" id="description" rows="4" name='desc'></textarea>

                <button type="submit" style="margin-top:10%;" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
