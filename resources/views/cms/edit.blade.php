@extends('layouts.app-cms')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">

        <div class="card-header">
          <a class="bi bi-backspace-fill" href="{{ url()->previous() }}"> Späť</a>
        </div>
        
        <div class="card-body">
          
            {!! Form::model($pages, ['route' => ['cms-pages.update', $pages->id], 'method' => 'PUT']) !!}
            
            <div class="row">
              <div class="col-sm-12"  style="margin-bottom: 10pt">
                {{ Form::label('title', __('cms.title')) }}:
                {{ Form::text('title', $pages->title ?? '', ['class' => 'form-control']) }}  
              </div>
              <div class="col-sm-12"  style="margin-bottom: 10pt">
                {{ Form::label('title_nav', __('cms.title_nav')) }}:
                {{ Form::text('title_nav', $pages->title_nav ?? '', ['class' => 'form-control']) }}  
              </div>
            </div>
            
            <div class="row">
              <div class="col-sm-12"  style="margin-bottom: 10pt">
                {{ Form::label('slug', __('cms.slug')) }}:
                {{ Form::text('slug', $pages->slug ?? '', ['class' => 'form-control']) }} 
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12"  style="margin-bottom: 10pt">
                <input type="checkbox" name="status" value="1" {{ ($pages->status == 1) ? 'checked' : null}} />
                {{ Form::label('status', __('cms.status')) }}
              </div>
            </div>

            <div class="form-group">
              <textarea class="form-control summernote" name="content1" id="summernote"></textarea>
            </div>
            
          </div>
          
        <div class="card-footer content-center">
          <div class="row">
              {{ Form::submit(__('cms.update'), array('class' => 'btn btn-sm btn-primary')) }}
            {!! Form::close() !!}
            &nbsp;&nbsp;&nbsp;
            {!! Form::open(array('route' => ['cms-pages.destroy', $pages->id], 'method'=>'DELETE')) !!}
              {!! Form::submit(__('cms.delete'), array('class' => 'btn btn-danger', 'onclick' => 'return confirm("You are about to delete the page.")' )) !!}
            {!! Form::close() !!}  
          </div>
        </div>
        
        

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $('#summernote').summernote({
      placeholder: '{!! addslashes($pages->content1) !!}',
      tabsize: 2,
      height: 400
    }).summernote('code', '{!! addslashes($pages->content1) !!}');
</script>

@endsection