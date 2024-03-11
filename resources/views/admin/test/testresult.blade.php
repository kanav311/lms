
<table class="table table-stripped">
    <thead>
    <tr>
        <th>{{ __lang('question') }}</th>
        <th>{{ __lang('answer') }}</th>
        <th>{{ __lang('correct') }}</th>
    </tr>
    </thead>
    <tbody>
    @php foreach($rowset as $row):  @endphp
    <tr>
        <td>{!! clean($row->question) !!}</td>
        <td>{{ $row->option}}</td>
        <td>{{ boolToString($row->is_correct) }}</td>
    </tr>
    @php endforeach;  @endphp
    </tbody>

</table>
