@extends('main')

@section('title','| Create New Post')

@section('stylesheets')
	
	{!! Html::style('css/parsley.css')!!}
	{!! Html::style('css/select2.min.css')!!}
	<link rel="stylesheet" type="text/css" href="/css/sweetalert.css">


	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>
		tinymce.init({
			selector:'textarea',
			plugins:'link code',
			menubar:false
		});
	</script>

@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create New Post</h1>
			<hr>

			{!! Form::open(['route' => 'posts.store','data-parsley-validate'=>'','class'=>'create_form','files'=>true]) !!}
				{{Form::label('title','Title:')}}
				{{Form::text('title',null,array('class'=>'form-control','required'=>'','maxlength'=>'255'))}}

				{{Form::label('slug','Slug:')}}
				{{Form::text('slug',null,array('class'=>'form-control','required'=>'','minLength'=>'5','maxLength'=>'255'))}}
				
				{{Form::label('category_id',"Category:")}}
				<select class="form-control" name="category_id">
					@foreach($categories as $category)
						<option value='{{$category->id}}'>{{$category->name}}</option>
					@endforeach
				</select>

				{{Form::label('tags',"Tags:")}}
				<select class="form-control select2-multi" name="tags[]" multiple="multiple">
					@foreach($tags as $tag)
						<option value='{{$tag->id}}'>{{$tag->name}}</option>
					@endforeach
				</select>

				{{Form::label('featured_image',"Upload Featured Image:")}}
				{{Form::file('featured_image')}}

				{{Form::label('body',"Post Body:")}}
				{{Form::textarea('body',null,array('class'=>'form-control'))}}

				<button type="submit" class="btn btn-success btn-lg btn-block create-btn" style="margin-top:20px;">Create Post</button>

			{!! Form::close() !!}
		</div>
	</div>

@endsection


@section('scripts')
	{!! Html::script('js/parsley.min.js')!!}
	{!! Html::script('js/select2.min.js')!!}
	<script type=" text/javascript">
		$('.select2-multi').select2();
	</script>
	<script src="/js/sweetalert.min.js"></script>
	<script type="text/javascript">

var title,slug,body;
        $('button.create-btn').on('click', function(e){
        	title = $('#title').parsley();
        	slug = $('#slug').parsley();

            e.preventDefault();
            var self = $(this);
            swal({
                title             : "Are you sure?",
                text              : "You will not be able to recover this Album!",
                type              : "warning",
                showCancelButton  : true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText : "Yes, delete it!",
                cancelButtonText  : "No, Cancel delete!",
                closeOnConfirm    : false,
                closeOnCancel     : false
            },
            
            function(isConfirm){
            	if(isConfirm){
            		if(title.isValid() && slug.isValid() ){
                	
	                    swal("Deleted!","your album has been deleted", "success");

	                    setTimeout(function() {
	                        self.parents(".create_form").submit()
	                    }, 2000); //2 second delay (2000 milliseconds = 2 seconds)}
                    }
                    else{
	                	swal("cancelled","Data invalid", "error");
	                	setTimeout(function() {
	                        self.parents(".create_form").submit()
	                    }, 2000); //2 second delay (2000 milliseconds = 2 seconds)}
	                }
                }
                
                else{
                      swal("cancelled","Your album is safe", "error");
                }
            });
        });
    </script>                    
@endsection