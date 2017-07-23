<div class="form-group {{ $field_class }}">
    {!! Form::label($name, $label, ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::hidden($name . '[exists]', 1) !!}
        {!! Form::select($name . '[select]', $selectOptions, $submitted_data?:$content, ['id' => $name, 'style' => 'width: 100%', 'class' => 'form-control chosen-select '.$class] + $disabled) !!}
        <span class="help-block">{{ $field_message }}</span>
    </div>
</div>