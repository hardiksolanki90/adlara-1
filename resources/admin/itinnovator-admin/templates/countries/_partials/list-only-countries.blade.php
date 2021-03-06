@foreach ($obj as $key => $o)
<tr class="m-datatable__row">
  <td>{{ $o->id }}</td>
            <td>
        <span>
                      {{ $o->name }}
                  </span>
      </td>
                <td>
        <span>
                      {{ $o->iso_code }}
                  </span>
      </td>
        <td>
    <div class="dropdown">
      <button class="btn btn-action btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton_{{ $o->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ t('Action') }}
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_{{ $o->id }}" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 37px, 0px); top: 0px; left: 0px; will-change: transform;">
        <a class="dropdown-item" href="{{ AdminURL('country/edit/' . $o->id) }}">{{ t('Edit') }}</a>
        <a class="dropdown-item" href="{{ AdminURL('country/delete/' . $o->id) }}">{{ t('Delete') }}</a>

      </div>
    </div>
  </td>
</tr>
@endforeach
