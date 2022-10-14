
{{--Модальное окно с автоподставкой--}}
<div class="modal fade" id="getOpenDestroyModalWindow" tabindex="-1" aria-labelledby="getOpenDestroyModalWindow_Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="getOpenDestroyModalWindow_Label">Окно подтверждения удаления</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="getOpenDestroyModalWindow_context">
                ...
            </div>
            <div class="modal-footer">
                {{--подставка через JS--}}
                <form method="POST" id="getOpenDestroyModalWindow_operation">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>


{{--Собственный прописанный скрипт. НЕ ПОВТОРЯЕТСЯ!!!!--}}

@pushonce('script')
        <script>

            //Получает идентификатор из index
            //для динамического изменения берём роут на index и в конец пересылаем на нужный нам id
            let url = '{{route($nameRoute)}}'

            //Все кнопки удаления
            let allQuerySelector = document.querySelectorAll('.destroy');

            //переборка всех кнопок
            allQuerySelector.forEach((element)=>{
                element.addEventListener('click',(el)=>{

                    //id из dataset
                    let id = element.dataset.id;


                    //смена текстта в модальном окне
                    let elementModalContext = document.querySelector('#getOpenDestroyModalWindow_context');
                    elementModalContext.innerText = "Вы точно хотите удалить элемент с идентификатором "+id;

                    //Смена ссылки
                    let elementModalForm = document.querySelector('#getOpenDestroyModalWindow_operation');
                    elementModalForm.setAttribute('action',url+'/'+id);
                })
            })
        </script>

@endpushonce
