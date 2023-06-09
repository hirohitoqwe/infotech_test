<div>
    <div class="float-left m-2">
        <div>
            <label for="n_category_name">Наименование новой категории</label>
            <input type="text" id="n_category_name" class="form-control" required
                   wire:model="new_category.{{"category_name"}}">
        </div>
        <div>
            <label for="n_category_descr">Описание новой категории</label>
            <textarea id="n_category_descr" style="resize: none" class="form-control bi-textarea-resize"
                      wire:model="new_category.{{"description"}}"></textarea>
            @error('new_category.description')<span class="error">Недостаточно символов в описании</span> @enderror
        </div>
        <div>
            <label for="parent">Родительская категория</label>
            <div wire:ignore>
                <select id="select-category" name="parent" class="w-25">
                    <option value="">Отсутствует</option>
                    @foreach($categories as $category)
                        <option value={{$category->category_name}}>{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button class="btn btn-success mt-md-2" wire:click="create">Создать новую категорию</button>
    </div>
    @if($created)
        <h3>Категория создана</h3>
    @endif
    <div class="categories float-left">
        @foreach($categories as $category)
            <div class="w-50 h-50 border border-secondary p-4 m-2">
                <p>Наименование категории: {{$category->category_name}}</p>
                <p>Описание категории: {{$category->description}}</p>
                <p>Количество подкатегорий: {{$category->sub_count}}</p>
                <p>Количество товаров в категории: {{$category->p_count}}</p>
                <p>Наименование родительской категории: {{$category->parent_category ?? "Отсутсвует"}}</p>
                <p>Удалить
                    <button wire:click="delete({{$category->id}})"><i class="bi bi-x-lg"></i></button>
                </p>
                <p>Редактировать
                    <button wire:click="changeEditCategory({{$category->id}})"><i class="bi bi-pencil"></i></button>
                </p>
                <div class="options">
                    <div class="edit" style="{{$edit === $category->id ? "" :"display:none"}}">
                        <p>
                            <label for="edited_name">Наименование</label>
                            <input type="text" class="form-control" id="edited_name" wire:model="edited.{{"name"}}"
                                   required>
                        </p>
                        <p>
                            <label for="edited_desc">Описание</label>
                            <textarea id="edited_desc" style="resize: none" class="form-control"
                                      wire:model="edited.{{"description"}}"></textarea>
                        </p>
                        <button wire:click="update({{$category->id}})">Обновить</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    $(document).ready(function () {
        $('select').select2();
    })

    let loadSelect2 = function (element, settings) {
        let $element = window.$(element);
        $element.on('change', function (e) {
            @this.
            set('new_category.parent_category', $(this).select2("val"));
        });
    }

    document.addEventListener("livewire:load", () => {
        let settings = {};

        loadSelect2('#select-category', settings);
    })

</script>
