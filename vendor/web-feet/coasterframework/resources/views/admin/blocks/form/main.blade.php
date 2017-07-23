<div class="form-group">
    {!! Form::label($name, $label, ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-3">Email From:</div>
            <div class="col-sm-9">{!! Form::text($name.'[from]', $content->email_from, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="row">
            <div class="col-sm-3">Email To:</div>
            <div class="col-sm-9">{!! Form::text($name.'[to]', $content->email_to, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="row">
            <div class="col-sm-3">Submit Page:</div>
            <div class="col-sm-9">{!! Form::select($name.'[page]', $pageList, $content->page_to, ['class' => 'form-control']) !!}</div>
        </div>
        @if ($content->template)
        <div class="row">
            <div class="col-sm-3">Form Template:</div>
            <div class="col-sm-9">{!! Form::select($name.'[template]', $formTemplates, $content->template, ['class' => 'form-control form-template']) !!}</div>
        </div>
        @endif
        <div class="row">
            <div class="col-sm-3">Enable Secure Captcha:</div>
            <div class="col-sm-9">{!! Form::checkbox($name.'[captcha]', 1, $content->captcha, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="row">
            <div class="col-sm-3">Form Submissions:</div>
            <div class="col-sm-9"><a href="{{ route('coaster.admin.forms.submissions', ['blockId' => $_block->id, 'pageId' => $_block->getPageId()]) }}" class="btn btn-default">View</a></div>
        </div>
    </div>
</div>