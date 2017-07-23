<?php AssetBuilder::setStatus('cms-versions', true); ?>

<div class="row">
    <div id="version_pagination" class="pull-left">
        {!! $pagination !!}
    </div>

    <div class="pull-right">
        <p>Published Version: #<span class="live_version_id">{{ $live_version->version_id }}</span> {{ $live_version->getName() }}</p>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped">

        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Author</th>
            <th>Published</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($versions as $version)
            <tr id="v_{{ $version->version_id }}">
                <td>{{ $version->version_id }}</td>
                <td>{{ $version->getName() }}</td>
                <td>
                    {{ ($version->user)?$version->user->email:'Undefined' }}
                </td>
                <td>
                    @if (!$version->scheduled_versions->isEmpty())
                        @if ($version->version_id == $live_version->version_id)
                            Yes and
                        @endif
                        @foreach($version->scheduled_versions as $scheduled_version)
                            Scheduled for {{ DateTimeHelper::display($scheduled_version->live_from) }} {{ $scheduled_version->repeat_text() }}
                                <i class="version_publish_schedule_remove glyphicon glyphicon-remove itemTooltip"
                                   data-scheduled-version-id="{{ $scheduled_version->id }}" title="Remove"></i><br />
                        @endforeach
                    @elseif ($version->version_id == $live_version->version_id)
                        Yes
                    @else
                        No
                    @endif
                </td>
                <td>
                    <a href="{{ CoasterCms\Helpers\Cms\Page\Path::getFullUrl($version->page_id).'?preview='.$version->preview_key }}"
                       target="_blank"><i class="glyphicon glyphicon-eye-open itemTooltip" title="Preview"></i></a>
                    <a href="{{ route('coaster.admin.pages.edit', ['pageId' => $version->page_id, 'version' => $version->version_id]) }}"><i
                                class="glyphicon glyphicon-pencil itemTooltip" title="Edit"></i></a>
                    @if ($can_publish || $version->user_id == Auth::user()->id)
                        <i class="version_rename glyphicon glyphicon-bookmark itemTooltip"
                           data-version="{{ $version->version_id }}" title="Rename"></i>
                    @endif
                    @if ($can_publish)
                        <i class="version_publish_schedule glyphicon glyphicon-time itemTooltip"
                           data-version="{{ $version->version_id }}" title="Schedule Version Publish"></i>
                        <i class="version_publish glyphicon glyphicon-ok-circle itemTooltip"
                           data-version="{{ $version->version_id }}" title="Publish"></i>
                    @else
                        <i class="request_publish glyphicon glyphicon-ok-circle itemTooltip"
                           data-version="{{ $version->version_id }}" title="Request Publish"></i>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>