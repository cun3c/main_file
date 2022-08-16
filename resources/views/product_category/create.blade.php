{{Form::open(array('url'=>'product_categorie','method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    <div class="col-12">
        <div class="form-group">
            {{Form::label('name',__('Name'),array('class'=>'form-control-label'))}}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Product Category'),'required'=>'required'))}}
        </div>
        <div class="form-group">
            <label for="categorie_img" class="form-control-label">{{ __('Upload Categorie Image') }}</label>
            <input type="file" name="categorie_img" id="categorie_img" class="custom-input-file">
            <label for="categorie_img">
                <i class="fa fa-upload"></i>
                <span>{{__('Choose a file')}}</span>
            </label>
        </div>
    </div>
    <div class="w-100 text-right">
        {{Form::submit(__('Save'),array('class'=>'btn btn-sm btn-primary rounded-pill mr-auto'))}}
    </div>
</div>
{{Form::close()}}
