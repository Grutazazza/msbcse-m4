<tr>
    <td>{{$command->id}}</td>
    <td>{{$command->command}}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{route('telegram-command.show',$command->id)}}" type="button" class="btn btn-sm btn-primary">Просмотреть</a>
            <a href="{{route('telegram-command.edit',$command->id)}}" type="button" class="btn btn-sm btn-warning">Редактировать</a>
            <button type="button" class="btn btn-sm btn-danger destroy" data-bs-toggle="modal" data-bs-target="#getOpenDestroyModalWindow" data-id="{{$command->id}}">Удалить</button>

        </div>
    </td>
</tr>
