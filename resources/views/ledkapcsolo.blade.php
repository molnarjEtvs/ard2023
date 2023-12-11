@extends('layouts.master')
@section('title',"Főoldal")
@section('content')
<div>
    <h1>LED kapcsoló</h1>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-danger w-100 my-3" onclick="ledKapcsolas(255,0,0);">PIROS</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary w-100 my-3" onclick="ledKapcsolas(0,0,255);">KÉK</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-success w-100 my-3" onclick="ledKapcsolas(0,128,0);">ZÖLD</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-dark w-100 my-3">KIKAPCS</button>
                    </div>    
                </div>
            </div>
            <div class="col-6">
                <div></div>
            </div>
        </div>
    </div>
</div>

<script>
    function ledKapcsolas(red,green,blue){
        $.ajax({
            url: "ledsenddata",
            method: 'POST',
            data:{red:red,green:green,blue:blue},
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            beforeSend:()=>{
                //Küldés folyamatban
            },
            success:function(data){
                //Megérkezett a válasz...
            }
        });
    }
</script>
@endsection