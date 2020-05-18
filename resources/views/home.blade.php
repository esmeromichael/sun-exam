@extends('layouts.app')
@section('content')
<style type="text/css">
	img {
	  display: block;
	  max-width: 100%;
	}
	.preview {
	  overflow: hidden;
	  width: 160px; 
	  height: 160px;
	  margin: 10px;
	  border: 1px solid red;
	}
	.modal-lg{
	  max-width: 1000px !important;
	}

	.avatar_img {
        display: inline-block;
        position: relative;
        overflow: hidden;
        width: 520px;
        height: 300px;
        border-radius: 4px;
        background-color: #FAFAFA;
        cursor: pointer;
        border-style: dashed;
        border-width: 1px;
        border-color: #888888;
        z-index: 9999;
        margin-right: 20px;
        margin-left: -22px;
    }
    .embed-avatar {
        display: block;
        width: 100%;
        height: 100%;
        display: block;
        position: absolute;
        top: 0;
        left: 0;
    }

    .img-avatar {
        display: block;
        width: 100%;
        height: 100%;
        background-size: 100% 100%;
        background-repeat: no-repeat;
    }
</style>
	@if(auth()->user())
	    @if(auth()->user()->id == 1)
	    	<div  class="article-result">
	    		@include('index_ajax');
	    	</div>
	    	
	    @else
	    	<h2>Welcome!  {{auth()->user()->name}}</h2>
	    @endif
    @endif
    <script src="/js/register.js"></script>
@endsection