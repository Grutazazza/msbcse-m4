{{--Это шаблон для вставки строки--}}
<tr>
    <td>{{$setting->name}}</td>
    <td>{{$setting->val}}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Функционал программы">
            <a href="{{route('telegram-setting.edit',$setting->id)}}" type="button" class="btn btn-sm btn-warning">Редактировать</a>
            {{--Передача id в модальное окно для удаления--}}
            <button type="button" class="btn btn-sm btn-danger destroySetting" data-bs-toggle="modal" data-bs-target="#getOpenDestroyModalWindow" data-id="{{$setting->id}}">Удалить</button>
        </div>
    </td>
</tr>
